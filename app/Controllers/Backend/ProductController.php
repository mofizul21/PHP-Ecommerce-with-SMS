<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Product;
use Respect\Validation\Validator;

class ProductController extends Controller{
    public function getIndex(){
        view('backend/product/index');
    }

    public function postIndex(){
        $title          = $_POST['title'];
        $slug           = $_POST['slug'];
        $category_id    = (int)$_POST['category_id'];
        $description    = $_POST['description'];
        $price          = $_POST['price'];
        $sales_price    = $_POST['sales_price'];
        $active         = (int)$_POST['active'];

        $validator = new Validator();

        if ($validator::alnum(' ')->validate($title) === false) {
            $errors['title'] = "Title can contain only alphabets and numeric";
        }
        if ($validator::slug()->validate($slug) === false) {
            $errors['slug'] = "Slug must be slug-format";
        }
        if (strlen($description) < 0) {
            $errors['description'] = "Description can be empty";
        }
        if ($validator::numericVal()->positive()->validate($price) === false) {
            $errors['price'] = "Price must be number and can not be negetive number";
        }
        if ($validator::numericVal()->positive()->validate($sales_price) === false) {
            $errors['sales_price'] = "Sales price must be number and can not be negetive number";
        }

        if (empty($errors)) {
            Product::create([
                'title'         => $title,
                'slug'          => $slug,
                'category_id'   => $category_id,
                'description'   => $description,
                'price'         => $price,
                'sales_price'   => $sales_price,
                'active'        => $active
            ]);
            successMsg('Product created successfully.', 'dashboard/products');
        }else{
            $_SESSION['errors'] = $errors;
            header('location: /dashboard/products');
        }
    }
}
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
        $product_photo  = $_FILES['product_photo'];
        $active         = (int)$_POST['active'];

        $validator = new Validator();

        if ($validator::alnum(' ')->validate($title) === false) {
            $errors['title'] = "Title can contain only alphabets and numeric";
        }
        if ($validator::slug()->validate($slug) === false) {
            $errors['slug'] = "Slug must be slug-format";
        }
        if ($validator::image()->validate($product_photo['name'])) {
            $errors['product_photo'] = "Product photo must be an image file";
        }
        if (strlen($description) < 3) {
            $errors['description'] = "Description can not be empty";
        }
        if ($validator::numericVal()->positive()->validate($price) === false) {
            $errors['price'] = "Price must be number and can not be negetive number";
        }
        if ($validator::numericVal()->positive()->validate($sales_price) === false) {
            $errors['sales_price'] = "Sales price must be number and can not be negetive number";
        }

        if (empty($errors)) {           

            $product = Product::create([
                'title'         => $title,
                'slug'          => $slug,
                'category_id'   => $category_id,
                'description'   => $description,
                'price'         => $price,
                'sales_price'   => $sales_price,
                'active'        => $active
            ]);

            // process file upload
            $file_name = 'product_photo_' . time();
            $extension = explode('.', $product_photo['name']);
            $ext = end($extension);
            move_uploaded_file($product_photo['tmp_name'], 'media/product_photo/' . $file_name . '.' . $ext);
            //upload into product_images table using ProductImage model
            $product->product_photo()->create([
                'image_path'    =>  $file_name . '.' . $ext,
            ]);
            successMsg('Product created successfully.', 'dashboard/products');
        }else{
            $_SESSION['errors'] = $errors;
            header('location: /dashboard/products');
        }
    }
}
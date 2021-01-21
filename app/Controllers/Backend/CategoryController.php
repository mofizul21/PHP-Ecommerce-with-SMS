<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use Exception;
use Respect\Validation\Validator;

class CategoryController extends Controller{
    public function getIndex(){
        view('backend/category/index');
    }

    public function postIndex()
    {
        $title  = $_POST['title'];
        $slug   = $_POST['slug'];
        $active = $_POST['active'];

        $validator = new Validator();

        if ($validator::alpha(' ')->validate($title) === false) {
            $errors['title'] = "Title can contain only alphabets";
        }
        if ($validator::slug()->validate($slug) === false) {
            $errors['slug'] = "Slug must be slug-format";
        }

        if (empty($errors)) {
            try {
                Category::create([
                    'title'     =>  $title,
                    'slug'      =>  $slug,
                    'active'    =>  $active,
                ]);

                successMsg('Category created successfully.', 'dashboard/categories');
            } catch (Exception $e) {
                echo $e->getMessage();
            }            
        }else{
            $_SESSION['errors'] = $errors;
            header('location: /dashboard/categories');
        }
    }
}
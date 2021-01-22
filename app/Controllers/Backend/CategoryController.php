<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use Exception;
use Respect\Validation\Validator;

class CategoryController extends Controller{
    public function getIndex(){   
        $categories = Category::all();
        view('backend/category/index', ['categories' => $categories]);        
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

    public function getEdit($id = null){
        if ($id===null) {
            errMsg('Invalid id', 'dashboard/categories');
        }
        $_SESSION['category_id'] = $id;
        view('backend/category/edit');
        unset($_SESSION['category_id']);
    }

    public function postEdit($id = null){
        if ($id === null) {
            errMsg('Invalid id', 'dashboard/categories');
        }

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

        try {
            $category = Category::find($id);
            $category->update([
                'title'     =>  $title,
                'slug'      =>  $slug,
                'active'    =>  $active,
            ]);
            successMsg('Category updated successfully.', 'dashboard/categories');
        } catch (Exception $e) {
            errMsg($e->getMessage(), 'dashboard/categories');
        }
    }

    public function getDelete($id= null){
        if ($id === null) {
            errMsg('Invalid id', 'dashboard/categories');
        }
        $category = Category::find($id);
        $category->delete();
        successMsg('Category deleted successfully.', 'dashboard/categories');
    }
}
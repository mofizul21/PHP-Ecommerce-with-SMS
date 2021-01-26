<?php

namespace App\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Controllers\Controller;

class CartController extends Controller
{
    public function getIndex()
    {
        $cart = $_SESSION['cart'] ?? [];
        $sum = array_sum(array_column($cart, 'total_price'));

        $categories = Category::all();
        view('cart', ['categories' => $categories, 'cart' => $cart, 'sum' => $sum]);
    }

    public function postIndex()
    {
        $id       = $_POST['id'];

        $product = Product::findOrFail($id);

        if ($product === null) {
            header('location: /');
        }

        $cart = $_SESSION['cart'] ?? [];

        if (array_key_exists($id, $cart)) {
            $cart[$id]['quantity']++;
            $cart[$id]['total_price'] += $product->price;
        } else {
            $cart[$id] = [
                'title'         =>  $product->title,
                'image'         =>  $product->product_photo->image_path,
                'description'   =>  $product->description,
                'quantity'      =>  1,
                'unit_price'    =>  $product->price,
                'total_price'   =>  $product->price
            ];
        }

        $_SESSION['cart'] = $cart;

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
        header('Location: /cart');
    }

    // Remove an item from the cart
    public function postRemove(){
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);
        header('Location: /cart');
    }

    // Empty whole cart
    public function postDestroy()
    {
        unset($_SESSION['cart']);
        header('Location: /cart');
    }
}

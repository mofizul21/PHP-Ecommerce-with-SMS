<?php

namespace App\Controllers\Frontend;

use App\Models\Category;
use App\Controllers\Controller;
use App\Models\Order;
use Respect\Validation\Validator;

class CheckoutController extends Controller{
    public function getIndex(){
        $categories = Category::all();
        $cart = $_SESSION['cart'] ?? [];
        $sum = array_sum(array_column($cart, 'total_price'));
        
        view('checkout', ['categories' => $categories, 'cart' => $cart, 'sum' => $sum]);
    }

    public function postIndex(){
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $email          = $_POST['email'];
        $phone_number   = $_POST['phone_number'];
        $address        = $_POST['address'];

        $valdator = new Validator();

        if (empty($first_name)) {
            $errors['first_name'] = "First name can not be empty";
        }
        if (empty($last_name)) {
            $errors['last_name'] = "Last name can not be empty";
        }
        if (empty($email)) {
            $errors['email'] = "Email name can not be empty";
        }
        if (empty($phone_number)) {
            $errors['phone_number'] = "First name can not be empty";
        }
        if (empty($address)) {
            $errors['address'] = "First name can not be empty";
        }

        if ($valdator::email()->validate($email) === false) {
            $errors['email'] = "Email must be a valid email";
        }

        if (strlen($phone_number) < 11) {
            $errors['phone_number'] = "Phone number must be 11 chars";
        }

        if (empty($errors)) {
            $cart = $_SESSION['cart'] ?? [];
            $sum = array_sum(array_column($cart, 'total_price'));

            $order = Order::create([
                'user_id'       =>  $_SESSION['user']['id'],
                'first_name'    =>  $first_name,
                'last_name'     =>  $last_name,
                'email'         =>  $email,
                'phone_number'  =>  $phone_number,
                'billing_address'=>  $address,
                'total_amount'  =>  $sum,
                'payment_details'=>  'Cash on delivery',
            ]);

            foreach ($cart as $id => $product) {
                // products() from Order model
                $order->products()->create([
                    'product_id'    =>  $id,
                    'quantity'      =>  $product['quantity'],
                    'price'         =>  $product['total_price'],
                ]);
            }

            unset($_SESSION['cart']);

            successMsg('Your order has been placed.', '');
        }

        header('Location: /checkout');
        
    }
}
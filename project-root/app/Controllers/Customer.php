<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\UserModel;

class Customer extends User
{
    public function register() // Register a customer
    {
        if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();
            $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

            if(isset($_POST['register_role'])) // If the admin is the one adding the person
            {
                $role = $_POST['register_role'];
            }

            else // A customer is registering themselves
            {
                $role = 1;
            }

            $data = 
            [
                'role_id' => $role,
                'user_firstname' => $_POST['register_firstname'],
                'user_lastname' => $_POST['register_lastname'],
                'user_email' => $_POST['register_email'],
                'user_password' => $password,
                'user_number' => $_POST['register_number'],
                'user_location' => $_POST['register_location']
            ];

            $is_registered = $usermodel->insert($data, true); 

            if($is_registered) // Successful registration
            {
                $session = session(); // Add customer info to the session
                
                $user_data = [
                    'user_id' => $is_registered,
                    'user_firstname'  => $_POST['register_firstname'],
                    'user_lastname'  => $_POST['register_lastname']
                ];

                $session->set($user_data);

                $customer = new Customer;
                return $customer->placeOrder();
            }

            else // Failed registration
            {
                echo "<script>alert('Login Failed')</script>";
                return view('user/log_in');
            }
        }

        else // Customer viewing the page for the first time
        {
            return view('customer/register');
        }
        
    }

    public function placeOrder() // Request a delivery order
    {
        $session = session();

        if(isset($_POST['order_submit'])) // Order requested
        {
            $ordermodel = new OrderModel();

            $data = 
            [
                'user_id' => $session->get('user_id'),
                'pickup_location' => $_POST['order_pickup'],
                'destination_location' => $_POST['order_destination'],
                'status' => 'pending',
                'is_paid' => false
            ];

            $is_placed = $ordermodel->insert($data, true);

            if($is_placed) // Order placement successful
            {
                $session->set('order_id', $is_placed);
                echo "Order placed";
            }

            else // Order placement failed
            {
                echo "<script>alert('Order failed')</script>";
                return view('user/place_order');
            }
        }

        else // Customer viewing the page for the first time
        {
            return view('customer/place_order');
        } 
    }

    public function trackOrder()
    {
        return view('customer/track_order');
    }
}
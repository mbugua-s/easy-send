<?php

namespace App\Controllers;

use App\Models\UserModel;

class Customer extends User
{
    public function register()
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

            if($is_registered)
            {
                $session = session();
                
                $user_data = [
                    'user_id' => $is_registered,
                    'user_firstname'  => $_POST['register_firstname'],
                    'user_lastname'  => $_POST['register_lastname']
                ];

                $session->set($user_data);

                $customer = new Customer;
                return $customer->placeOrder();
            }

            else
            {
                echo "<script>alert('Login Failed')</script>";
                return view('user/log_in');
            }
        }

        else
        {
            return view('user/register');
        }
        
    }

    public function placeOrder()
    {
        $session = session();
        
        return view('customer/place_order');
    }
}
<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function home()
    {
        return view('user/home');
    }

    public function logIn()
    {
        return view('user/log_in');
    }

    public function register()
    {
        if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();

            $data = 
            [
                'customer_firstname' => $_POST['register_firstname'],
                'customer_lastname' => $_POST['register_lastname'],
                'customer_email' => $_POST['register_email'],
                'customer_number' => $_POST['register_number'],
                'customer_location' => $_POST['register_location']
            ];

            $is_registered = $usermodel->insert($data, true);

            if($is_registered)
            {
                echo "User Registered";
            }

            else
            {
                echo "Registration Failed";
            }
        }

        else
        {
            return view('user/register');
        }
        
    }

    public function logOut()
    {
        return view('user/home');
    }
}
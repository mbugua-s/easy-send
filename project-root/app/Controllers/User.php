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
        if(isset($_POST['login_submit']))
        {
            $usermodel = new UserModel();
            $email = $_POST['login_email'];

            $user = $usermodel->where('customer_email', $email)->find();

            if(password_verify($_POST['login_password'], $user[0]['customer_password']))
            {
                $session = session();
                return view('user/home');
            }

            else
            {
                echo "<script>alert('Login Failed')</script>";
                return view('user/log_in');
            }
        }
        
        else
        {
            return view('user/log_in');
        }
    }

    public function register()
    {
        if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();
            $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

            $data = 
            [
                'customer_firstname' => $_POST['register_firstname'],
                'customer_lastname' => $_POST['register_lastname'],
                'customer_email' => $_POST['register_email'],
                'customer_password' => $password,
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
        $session = session();
        $session->destroy();
        return view('user/log_in');
    }
}
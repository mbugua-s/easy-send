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

            $user = $usermodel->where('user_email', $email)->find();

            if(password_verify($_POST['login_password'], $user[0]['user_password']))
            {
                $session = session();

                switch($user[0]['role_id']) // Redirecting the different types of users to their respective landing pages
                {
                    case 1:
                        return view('user/home');
                        break;

                    case 2:
                        return view('admin/home');
                        break;

                    case 3:
                        return view('delivery_person');
                        break;
                }

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
        
        /* if(isset($_POST['login_submit']))
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
        } */
    }

    public function register()
    {
        /* if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();
            $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

            $data = 
            [
                'role_id' => 1,
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
        } */
        
    }

    public function logOut()
    {
        $session = session();
        $session->destroy();
        return view('user/log_in');
    }

}
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

                $user_data = [
                    'user_id' => $user[0]['user_id'],
                    'user_firstname'  => $user[0]['user_firstname'],
                    'user_lastname'  => $user[0]['user_lastname']
                ];
                
                $session->set($user_data);

                switch($user[0]['role_id']) // Redirecting the different types of users to their respective landing pages
                {
                    case 1:
                        $customer = new Customer;
                        return $customer->placeOrder();
                        break;

                    case 2:
                        return view('admin/home');
                        break;

                    case 3:
                        return view('delivery_person/home');
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
    }

    public function logOut()
    {
        $session = session();
        $session->destroy();
        return view('user/log_in');
    }

    public function ps()
    {
        echo password_hash('2345', PASSWORD_DEFAULT);
    }

}
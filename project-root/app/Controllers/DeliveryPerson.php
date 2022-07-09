<?php

namespace App\Controllers;

use App\Models\DeliveryPersonModel;
use App\Models\UserModel;

class DeliveryPerson extends User
{
    public function register()
    {
        if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();
            $deliverypersonmodel = new DeliveryPersonModel();
            $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

            $file = $this->request->getFile('register_photo'); // Getting the uploaded file, renaming it, and moving it to public/profile_photos

            if($file->isValid() && !$file->hasMoved()) 
            {
                $file->move('./profile_photos', $_POST['register_firstname'].' '. $_POST['register_lastname'].'.'.$file->getExtension());
            }

            else
            {
                echo '<script>alert("Invalid File")</script>';
                return view('delivery_person/register');
            }

            $user_data = 
            [
                'role_id' => 3,
                'user_firstname' => $_POST['register_firstname'],
                'user_lastname' => $_POST['register_lastname'],
                'user_email' => $_POST['register_email'],
                'user_password' => $password,
                'user_number' => $_POST['register_number'],
                'user_location' => $_POST['register_location']
            ];

            $user_id = $usermodel->insert($user_data, true);

            if($user_id)
            {
                $dp_data = 
                [
                    'user_id' => $user_id,
                    'dp_profile_photo' => $file->getName(),
                    'dp_city' => $_POST['register_city']
                ];

                $is_registered = $deliverypersonmodel->insert($dp_data, true);

                if($is_registered)
                {
                    $session = session();
                
                    $user_data = [
                        'user_id' => $is_registered,
                        'user_firstname'  => $_POST['register_firstname'],
                        'user_lastname'  => $_POST['register_lastname']
                    ];

                    $session->set($user_data);
                    
                    echo "Delivery Person registered";
                }
            }

            else
            {
                echo "Registration Failed";
            }
        }

        else
        {
            return view('delivery_person/register');
        }       
    }
}
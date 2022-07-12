<?php

namespace App\Controllers;

use App\Models\DeliveryPersonModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class DeliveryPerson extends User
{
    public function register() // Register a delivery person
    {
        if(isset($_POST['register_submit']))
        {
            $usermodel = new UserModel();
            $deliverypersonmodel = new DeliveryPersonModel();
            $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

            $file = $this->request->getFile('register_photo'); // Getting the uploaded file, renaming it, and moving it to public/profile_photos

            if($file->isValid() && !$file->hasMoved()) 
            {
                $file->move('./profile_photos', $_POST['register_firstname'].'_'. $_POST['register_lastname'].'.'.$file->getExtension());
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

            if($user_id) // If inserting user data is successful, then insert extra delivery person data
            {
                $dp_data = 
                [
                    'user_id' => $user_id,
                    'dp_profile_photo' => $file->getName(),
                    'dp_city' => $_POST['register_city']
                ];

                $is_registered = $deliverypersonmodel->insert($dp_data, true);

                if($is_registered) // Successful registration, after which we add the delivery person's data to the session
                {
                    $session = session();
                
                    $user_data = [
                        'user_id' => $is_registered,
                        'user_firstname'  => $_POST['register_firstname'],
                        'user_lastname'  => $_POST['register_lastname'],
                        'dp_id' => $is_registered
                    ];

                    $session->set($user_data);                   
                    echo '<script>alert("Registration Successful")</script>';
                    return $this->viewAvailableOrders();
                }

                else // Inserting the delivery person specific data failed
                {
                    echo '<script>alert("Registration Failed")</script>';
                }
            }

            else // Inserting the general user data failed
            {
                echo '<script>alert("Registration Failed")</script>';
                return view('delivery_person/register');
            }
        }

        else // Delivery person loading the page for the first time
        {
            return view('delivery_person/register');
        }       
    }

    public function editProfile() // Edit the delivery person's profile
    {
        $session = session();
        $userModel = new UserModel();
        $deliveryPersonModel = new DeliveryPersonModel();
        
        if(isset($_POST['edit_submit'])) // If they submitted their profile details
        {           
            if($this->request->getFile('edit_photo')) // If they uploaded a new profile photo, check it's valid and add it to the dp_data array
            {
                $file = $this->request->getFile('edit_photo');

                if($file->isValid() && !$file->hasMoved()) // Uploaded file is valid
                {
                    $file->move('./profile_photos', $_POST['edit_firstname'].'_'. $_POST['edit_lastname'].'.'.$file->getExtension());

                    $dp_data = 
                    [
                        'dp_profile_photo' => $file->getName(),
                        'dp_city' => $_POST['edit_city']
                    ];
                }

                else // Uploaded file is invalid
                {
                    echo '<script>alert("Invalid File")</script>';
                    return view('delivery_person/register');
                }
            }

            else // They did not upload a new photo, so the dp_data array doesn't need the dp_profile_photo key
            {
                $dp_data = 
                [
                    'dp_city' => $_POST['edit_city']
                ];
            }
            
            $user_data = 
            [
                'role_id' => 3,
                'user_firstname' => $_POST['edit_firstname'],
                'user_lastname' => $_POST['edit_lastname'],
                'user_email' => $_POST['edit_email'],
                'user_number' => $_POST['edit_number'],
                'user_location' => $_POST['edit_location']
            ];

            $is_user_updated = $userModel->update($session->get('user_id'), $user_data); 

            if($is_user_updated) // General user data has been updated successfully
            {
                $is_dp_updated = $deliveryPersonModel->update($session->get('dp_id'), $dp_data);

                if($is_dp_updated) // Delivery person data has been updated successfully
                {   
                    echo "<script>alert('Delivery Person Update Successful')</script>";
                    return $this->viewAvailableOrders();
                }

                else
                {
                    echo "<script>alert('Delivery Person Update Failed')</script>";
                    return view('delivery_person/edit_profile');
                }
            }

            else // Updating general user data failed
            {
                echo "<script>alert('User Update Failed')</script>";
                return view('delivery_person/edit_profile');
            }
        }

        else // Delivery person is visiting the page for the first time, so retrieve their data from the db so that they can edit it
        {
            $delivery_person_data = 
            [
                'user_data' => $userModel->find($session->get('user_id')), // General data
                'delivery_person_data' => ($deliveryPersonModel->where('user_id', $session->get('user_id'))->find())[0] // Delivery person data
            ];

            return view('delivery_person/edit_profile', $delivery_person_data);
        }
    }

    public function viewAvailableOrders()
    {
        $ordermodel = new OrderModel();

        $available_orders = 
        [
            'available_orders' => $ordermodel->where('status', 'pending')->findAll()

        ];
        
        return view('delivery_person/available_orders', $available_orders);
    }
}
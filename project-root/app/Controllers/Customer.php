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
            return view('user/register');
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
                return $this->trackOrder();
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
        $session = session();

        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('pickup_location, destination_location, created_at, status');
        $builder->where('user_id', $session->get('user_id'));
        $builder->orderBy('order_id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();

        foreach($query->getResultArray() as $row)
        {
            $order_details[] = $row;
        }

        $order_details = $order_details[0];

        if($order_details['status'] == 'accepted')
        {
            $builder = $db->table('order_deliveryperson');
            $builder->select('dp_profile_photo, user_firstname, user_lastname');
            $builder->join('delivery_person', 'order_deliveryperson.dp_id = delivery_person.dp_id', 'inner');
            $builder->join('user', 'delivery_person.user_id = user.user_id', 'inner');
            $builder->where('order_id', $session->get('order_id'));
            $query = $builder->get();

            foreach($query->getResultArray() as $row)
            {
                $dp_details[] = $row;
            }

            $user_order['dp'] = $dp_details[0];
        }

        $user_order['order'] = $order_details;

        return view('customer/track_order', $user_order);
    }
}
<?php

namespace App\Controllers;

use App\Models\ConfirmationPhotoModel;
use App\Models\OrderDeliveryPersonModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use Config\Pager;

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

            $order_data = 
            [
                'user_id' => $session->get('user_id'),
                'pickup_area' => $_POST['order_pickup_area'],
                'pickup_street_name' => $_POST['order_pickup_street_name'],
                'pickup_estate' => $_POST['order_pickup_estate'],
                'pickup_house_no' => $_POST['order_pickup_house'],
                'pickup_comment' => $_POST['order_pickup_comment'],
                'destination_area' => $_POST['order_destination_area'],
                'destination_street_name' => $_POST['order_destination_street_name'],
                'destination_estate' => $_POST['order_destination_estate'],
                'destination_house_no' => $_POST['order_destination_house'],
                'destination_comment' => $_POST['order_destination_comment'],
                'destination_phone_no' => $_POST['order_destination_phone'],
                'status' => 'pending',
                'is_paid' => false
            ];

            $is_placed = $ordermodel->insert($order_data, true);

            if($is_placed) // Order placement successful
            {
                $paymentModel = new PaymentModel();
                $payment_data = 
                [
                    'order_id' => $is_placed,
                    'payment_code' => $_POST['order_mpesa_code']
                ];

                $is_paid = $paymentModel->insert($payment_data, true);

                if($is_paid)
                {
                    $update_order_data = 
                    [
                        'is_paid' => 1
                    ];
                    
                    $ordermodel->update($is_placed, $update_order_data);
                    $session->set('order_id', $is_placed);
                    return $this->trackOrder();
                }
                
                else
                {
                    echo "<script>alert('Order payment failed')</script>";
                    return view('user/place_order');
                }
            }

            else // Order placement failed
            {
                echo "<script>alert('Order placement failed')</script>";
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
        $builder->select('pickup_area, pickup_street_name, pickup_estate, pickup_house_no, pickup_comment, destination_area, destination_street_name, destination_estate, destination_house_no, destination_comment, destination_phone_no, status, created_at');
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

    public function viewOrderHistory()
    {
        $session = session();
        
        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('orders.created_at, pickup_area, pickup_estate, destination_area, destination_estate');
        $builder->join('order_deliveryperson', 'order_deliveryperson.order_id = orders.order_id', 'inner');
        $builder->join('delivery_person', 'order_deliveryperson.dp_id = delivery_person.dp_id', 'inner');
        $builder->join('user', 'user.user_id = delivery_person.user_id', 'inner');
        $builder->where('status', 'completed');
        $builder->where('orders.user_id', $session->get('user_id'));
        $query = $builder->get();

        foreach($query->getResultArray() as $row)
        {
            $result[] = $row;
        }

        if(isset($result))
        {
            $order = 
            [
                'order' => $result
            ];
        }

        else
        {
            $order = 
            [
                'order' => 'no orders'
            ];
        }
            
        return view('user/order_history', $order);
    }
}
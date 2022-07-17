<?php

namespace App\Controllers;

use App\Models\DeliveryPersonModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class User extends BaseController
{
    public function home() // Display the home page
    {
        return view('user/home');
    }

    public function logIn() // Log in customers, admins and delivery persons
    {
        if(isset($_POST['login_submit'])) // User has submitted login details
        {
            $usermodel = new UserModel();
            $email = $_POST['login_email'];

            $user = $usermodel->where('user_email', $email)->find();

            if(password_verify($_POST['login_password'], $user[0]['user_password'])) // If user has the correct credentials, save their data in the session
            {
                $session = session();

                $user_data = [
                    'user_id' => $user[0]['user_id'],
                    'user_role' => $user[0]['role_id'],
                    'user_firstname'  => $user[0]['user_firstname'],
                    'user_lastname'  => $user[0]['user_lastname']
                ];
                
                $session->set($user_data);

                // Redirecting users to their respective landing pages
                switch($user[0]['role_id'])
                {
                    case 1:
                        $customer = new Customer;
                        
                        if($this->checkForExistingCustomerOrder($user[0]['user_id'])) // If they have an existing order, take them to the track order page, otherwise take them to the place order page
                        {
                            $session->set('order_id', $this->checkForExistingCustomerOrder($user[0]['user_id']));
                            return $customer->trackOrder();
                        }
                        
                        else
                        {
                            return $customer->placeOrder();
                        }
                        
                        break;

                    case 2:
                        return view('user/home');
                        break;

                    case 3:
                        $deliveryPersonModel = new DeliveryPersonModel(); // Adding the delivery person's dp_id to the session
                        $dp_id = ($deliveryPersonModel->where('user_id', $user[0]['user_id'])->find())[0]['dp_id'];
                        $session->set('dp_id', $dp_id);
                        $deliveryperson = new Deliveryperson();

                        if($this->checkForExistingDPOrder($dp_id)) // If they have an existing order, take them to the fulfill order page, otherwise take them to the available orders page
                        {
                            $session->set('order_id', $this->checkForExistingDPOrder($dp_id));
                            return $deliveryperson->fulfillOrder();
                        }

                        else
                        {
                            return $deliveryperson->viewAvailableOrders();
                        }

                        break;
                }
            }

            else // Failed login
            {
                echo "<script>alert('Login Failed')</script>";
                return view('user/log_in');
            }
        }
        
        else // User viewing the log_in page for the first time
        {
            return view('user/log_in');
        }
    }

    public function logOut() // Log out customers, admins and delivery persons
    {
        $session = session();
        $session->destroy();
        return view('user/log_in');
    }

    public function editProfile() // Edit the details of customers and admins
    {
        $session = session();
        $usermodel = new UserModel();
        
        if(isset($_POST['edit_submit'])) // User has submitted their profile details
        {
            $data = 
            [
                'role_id' => $session->get('user_role'),
                'user_firstname' => $_POST['edit_firstname'],
                'user_lastname' => $_POST['edit_lastname'],
                'user_email' => $_POST['edit_email'],
                'user_number' => $_POST['edit_number'],
                'user_location' => $_POST['edit_location']
            ];

            $is_updated = $usermodel->update($session->get('user_id'), $data);

            if($is_updated)
            {
                echo "<script>alert('Successful Update')</script>";

                if($session->get('user_role') == 1) // Redirect customer and admin to their pages
                {
                    $customer = new Customer;
                    return $customer->placeOrder();
                }

                else
                {
                    // Admin redirect
                }
            }

            else // Failed update
            {
                echo "<script>alert('Update Failed')</script>";
                return view('user/edit_profile');
            }
        }

        else // User viewing the page for the first time, so retrieve their details from the db
        {
            $user_data = 
            [
                'user_data' => $usermodel->find($session->get('user_id'))
            ];

            return view('user/edit_profile', $user_data);
        }
    }

    private function redirectEditProfileRequest() // Check the role of the user and redirect them to their edit profile page
    {
        $session = session();
        
        switch($session->get('user_role'))
        {
            case 1:
                $customer = new Customer;
                return $customer->placeOrder();
                break;

            case 2:
                return view('admin/home');
                break;

            case 3:
                $deliveryperson = new Deliveryperson();
                return $deliveryperson->viewAvailableOrders();
                break;
        }
    }

    protected function checkForExistingCustomerOrder($user_id) // Check whether the customer/admin has an ongoing order. If they do, add the order_id to the session
    {
        $orderModel = new OrderModel();
        $existing_order = $orderModel->where('user_id', $user_id)
                                     ->groupStart()
                                        ->where('status', 'accepted')
                                        ->orWhere('status', 'pending')
                                     ->groupEnd()
                                     ->orderBy('order_id', 'DESC')
                                     ->findAll(1);
        
        if($existing_order)
        {
            return $existing_order[0]['order_id'];
        }

        else
        {
            return false;
        }
    }

    private function checkForExistingDPOrder($dp_id) // Check whether the delivery person has an ongoing order. If they do, add the order_id to the session
    {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('orders.order_id')
                ->join('order_deliveryperson', 'orders.order_id = order_deliveryperson.order_id', "inner")
                ->where('order_deliveryperson.dp_id', $dp_id)
                ->groupStart()
                    ->where('status', 'pending')
                    ->orWhere('status', 'accepted')
                ->groupEnd()
                ->orderBy('orders.order_id', 'DESC')
                ->limit(1);
        $query = $builder->get();

        foreach($query->getResultArray() as $row)
        {
            $order[] = $row;
        }

        if(isset($order[0]))
        {
            return $order[0]['order_id'];
        }

        else
        {
            return false;
        }
    }
}
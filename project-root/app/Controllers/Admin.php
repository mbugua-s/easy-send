<?php

namespace App\Controllers;

use App\Models\DeliveryPersonModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function viewGeneralStatistics()
    {
        $orderModel = new OrderModel();
        $userModel = new UserModel();
        $deliveryPersonModel = new DeliveryPersonModel();
        $paymentModel = new PaymentModel();

        $statistics = 
        [
            'Total Users' => $userModel->countAll(),
            'Total Customers' => $userModel->where('role_id', 1)->countAllResults(),
            'Total Delivery Persons' => $deliveryPersonModel->countAll(),
            'Total Orders' => $orderModel->countAll(),
            'Total Completed Orders' => $orderModel->where('status', 'completed')->countAllResults(),
            'Total Money Received (Ksh)' => ($paymentModel->countAll() * 250)
        ];

        $stats['statistics'] = $statistics;
                                    
        return view('admin/general_statistics', $stats);
    }
}
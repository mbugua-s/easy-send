<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'order_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['user_id', 'pickup_area', 'pickup_street_name', 'pickup_estate', 'pickup_house_no', 'pickup_comment', 'destination_area', 'destination_street_name', 'destination_estate', 'destination_house_no', 'destination_comment', 'destination_phone_no', 'status', 'is_paid'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
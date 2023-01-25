<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryPersonModel extends Model
{
    protected $table      = 'delivery_person';
    protected $primaryKey = 'dp_id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['user_id', 'dp_profile_photo', 'dp_city'];
}
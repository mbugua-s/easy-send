<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['customer_firstname', 'customer_lastname', 'customer_email', 'customer_number', 'customer_location'];
}
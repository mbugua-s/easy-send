<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDeliveryPersonModel extends Model
{
    protected $table      = 'order_deliveryperson';
    protected $primaryKey = 'order_deliveryperson_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['order_id', 'dp_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
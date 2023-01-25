<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfirmationPhotoModel extends Model
{
    protected $table      = 'confirmation_photo';
    protected $primaryKey = 'confirmation_photo_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['order_id', 'confirmation_photo'];
}
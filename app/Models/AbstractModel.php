<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    protected $guarded = ['id', 'category_id'];
}

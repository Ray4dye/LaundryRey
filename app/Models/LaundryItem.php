<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaundryItem extends Model
{
    use HasFactory;

    protected $table = 'laundry_items';
    protected $guarded = ['id'];
}

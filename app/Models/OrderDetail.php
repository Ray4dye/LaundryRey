<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $guarded = ['id'];

    public function laundryItem()
    {
        return $this->belongsTo(LaundryItem::class, 'laundry_item_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}

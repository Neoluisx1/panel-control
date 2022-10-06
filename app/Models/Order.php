<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'shipping', 'items', 'discount', 'cash','type', 'status', 'user_id', 'customer_id', 'notes', 'delivery_date','pay','ticket'];

    // relationships
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault();
        //ponemos withDefault para las ventas que no tienen cliente y no marque error object
    }
}

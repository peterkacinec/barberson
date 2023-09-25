<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', //todo potrebujem?
        'date',
        'price', //todo potrebujem?
        'status', // enum konkretnych moznosti pending, completed, cancelled, refunded
        'payment_type',
        'provider_id',
        'customer_id',
        'customer_address',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

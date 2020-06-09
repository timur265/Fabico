<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'company_name', 'bank', 'address', 'tin', 'ctea', 'mfi', 'user_id', 'name', 'email', 'comment', 'phone_number'
    ];

    /**
     * Get all order items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * Get total order amount
     *
     * @return integer
    */
    public function getTotalAmount()
    {
        $amount = 0;
        foreach ($this->orderItems as $orderItem)
            $amount += ($orderItem->price * $orderItem->quantity);
        return $amount;
    }

    /**
     * Get total products count
     * 
     * @return integer
     */
    public function getTotalProductCount()
    {
        $count = 0;
        foreach ($this->orderItems as $orderItem)
            $count += $orderItem->quantity;
        return $count;
    }
}

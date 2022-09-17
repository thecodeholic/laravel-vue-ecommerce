<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'address1', 'address2', 'city', 'state', 'zipcode', 'country_code', 'customer_id'];

    public function getCustomer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }
}

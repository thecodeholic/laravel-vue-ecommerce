<?php

namespace App\Models;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'status',];

    public function getUser()
    {
        return $this->hasOne(User::class);
    }

    private function _getAddresses(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id');
    }

    public function getShippingAddress(): HasOne
    {
        return $this->_getAddresses()->where('type', AddressType::Shipping);
    }

    public function getBillingAddress(): HasOne
    {
        return $this->_getAddresses()->where('type', AddressType::Billing);
    }
}

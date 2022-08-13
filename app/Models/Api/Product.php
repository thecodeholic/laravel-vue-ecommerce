<?php

namespace App\Models\Api;

class Product extends \App\Models\Product
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_number',
        'client_name',
        'client_email',
        'client_phone',
        'package_type',
        'logo_name',
        'tagline',
        'color_preferences',
        'description_philosophy',
        'price',
        'status',
        'payment_status',
    ];
}

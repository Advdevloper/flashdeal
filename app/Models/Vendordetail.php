<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendordetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_firstname',
        'vendor_lastname',
        'vendor_businessname',
        'vendor_email',
        'vendor_mobile',
        'vendor_country',
        'vendor_state',
        'vendor_address',
        'vendor_status',
        'vendor_document',
        'vendor_userid',
    ];

}

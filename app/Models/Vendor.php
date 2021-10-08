<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'vendors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'po_vendor_code',
        'item_vendor_code'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}

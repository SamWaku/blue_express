<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveryteam extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'INumber',
        'Address',
        'Phone',
        'Email',
        'idstaff'
    ];

    public $table = 'deliveryteam';

    public $timestamp = 'false';

}

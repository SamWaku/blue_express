<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'ManId',
        'Address',
        'Phone',
        'Email',
        'Position'
    ];

    public $table = 'staff';

    public $timestamp = 'false';
}

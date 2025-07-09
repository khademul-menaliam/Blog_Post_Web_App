<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','subjects','message'];

    public static $messages = [
        'email.required' => 'Email is required',
        'email.email' => 'Email is not valid',
        'email.unique' => 'Email already exists',
    ];

}

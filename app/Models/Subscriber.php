<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
    ];
    public static $rules = [
        'email' => 'required|email|unique:subscribers,email',
    ];

    public static $messages = [
        'email.required' => 'Email is required',
        'email.email' => 'Email is not valid',
        'email.unique' => 'Email already exists',
    ];

}

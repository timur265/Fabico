<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name', 'email', 'phone_number', 'question'
    ];
}

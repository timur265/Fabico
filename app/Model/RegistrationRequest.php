<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegistrationRequest extends Model
{
    protected $fillable = [
        'company_name', 'city', 'email', 'user_id'
    ];

    /**
     * Related user
     * @return mixed
     */
    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function confirm() {
        $this->user->confirmed = true;
        $this->user->save();
    }

    public function confirmed() {
        return $this->user->confirmed;
    }
}

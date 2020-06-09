<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all users roles
     * @return \Illuminate\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Authorize role or array of roles
     *
     * @param string|array $roles
     *
     * @return boolean
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized');
    }

    /**
     * Check multiple roles
     * @param  array  $roles Array of roles
     * @return boolean
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param  string  $role Role to check
     * @return boolean
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Upload image for user
     * @param $image
     * @return void
     */
    public function uploadImage($image)
    {
        if($image == null) return;

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function removeImage()
    {
        if($this->image != null)
            Storage::delete('uploads/' . $this->image);
    }

    public function getImage()
    {
        if($this->image != null)
            return '/uploads/' . $this->image;
        else
            return asset('assets/img/avatars/avatar9.jpg');
    }

    public function change($password)
    {
        if($password == null) return;

        $this->password = Hash::make($password);
        $this->save();
    }

    public function registrationRequest() {
        return $this->hasOne(\App\Model\RegistrationRequest::class);
    }

    public function delete()
    {
        if ($this->registrationRequest)
            $this->registrationRequest()->delete();
        parent::delete();
    }
}

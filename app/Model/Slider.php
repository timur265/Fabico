<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = [
        'ru_title','ru_description', 'link_video', 'link_page', 'image'
    ];

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
}

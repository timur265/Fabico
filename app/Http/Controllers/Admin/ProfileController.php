<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.profile.show', compact(
            'user'
        ));
    }
}

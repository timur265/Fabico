<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RegistrationRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = RegistrationRequest::orderBy('created_at', 'desc')->get();
        return view('admin.pages.requests.index', compact('requests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = RegistrationRequest::findOrFail($id);
        return view('admin.pages.requests.show', compact('request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Confirm registration request
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmRequest(int $id)
    {
        RegistrationRequest::findOrFail($id)->confirm();
        return redirect()->route('requests.index');
    }
}

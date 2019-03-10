<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profiles.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'profile_pic'=>'required',
        ]);

        $profiles = new Profile;
        $profiles->name = $request->name;
        $profiles->user_id = Auth::user()->id;   //current user logddin
        $profiles->designation = $request->designation;

        if (Input::hasFile('profile_pic')) {
            $file = Input::file('profile_pic');
            $file->move(public_path().'/uploads/', $file->getClientOriginalName());
            $url= URL::to("/"). '/uploads/'.$file->getClientOriginalName();
            // return $url;
            // exit();
        }
        // $profiles->profile_pic = $request->profile_pic;
        // $profiles->user_id = Auth::user();

        $profiles->profile_pic = $url;
        $profiles ->save();
        return redirect('/home')->with('message','profile added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}

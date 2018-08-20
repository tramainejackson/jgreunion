<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Reunion;
use App\ReunionCommittee;
use App\FamilyMember;
use App\State;
use App\ProfilePost;
use App\Committee_Title;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProfilePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile_post  $profile_post
     * @return \Illuminate\Http\Response
     */
    public function show(profile_post $profile_post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profile_post  $profile_post
     * @return \Illuminate\Http\Response
     */
    public function edit(profile_post $profile_post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profile_post  $profile_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profile_post $profile_post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profile_post  $profile_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile_post $profile_post)
    {
        //
    }
}

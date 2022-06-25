<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Auth;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.user.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find($id);
        if(!is_null($user)) {

          return view('frontend.pages.user.profileupdate' , compact('user'));

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {
       $user = User::find($id);

       $user->name            =$request->name;
       $user->email           =$request->email;
       $user->phone           =$request->phone;
       $user->address         =$request->address;
       $user->city            =$request->city;
       $user->country         =$request->country;
       $user->zipcode         =$request->zipcode;


       if($request->image)
       {
           // existing image
           if(File::exists('backend/img/users/'  . $user->image)){
               File::delete('backend/img/users/'  . $user->image);
           }

           //
           $image = $request->file('image');
           $img = time() . '.' . $image->getClientOriginalExtension();
           $location = public_path('backend/img/users/'   .$img);
           Image:: make($image)->save($location);
           $user->image = $img;
       }

       $user->save();
       return redirect()->route('user-profile');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

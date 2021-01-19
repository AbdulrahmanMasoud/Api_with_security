<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use GeneralTrait; //هنا انا استدعيته في الكلاس عشان اقدر اقول this
    public function index()
    {
        $users = User::select('id','name_'.app()->getLocale().' as name','email','password')->get();
        return response()->json([
            'users' => $users,
        ]);
    }
    /********************************************************/
    public function getUserById(Request $request){
        /** هنا انا عمل الميثود دي عشانا اجرب ارجع رساله الخطأ لو الايدي مش موجود */
        $user = User::select('id','name_'.app()->getLocale().' as name','email','password')->find($request->id);
        if(!$user){
            //this method (returnError) From Trait File
            return $this->returnError('E0011','Cant Find This User');
        }
        /* هنا بقا لو لقي الداتا موجوده هيستخدم الميثود اللي هي ريتيرن داتا و انا امررله فيها الكي و الداتا و رساله النجاح */
        //this method (returnData) From Trait File
        return $this->returnData('user',$user,'Get User Done');
    }
    /**************************************************************/

    public function store(Request $request)
    {
        User::insert([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        //دي بترجع رساله نجاح بس
        //this method (returnSuccessMessage) From Trait File
        return $this->returnSuccessMessage('Add User Done');
    }

    
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

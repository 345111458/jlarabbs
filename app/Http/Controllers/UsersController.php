<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Auth;
use App\Handlers\ImagesUploadHandler;

class UsersController extends Controller
{
    //

    public function __construct(){


//        $this->middleware('auth',['except'=>['show']]);
    }

    public function show(User $user){


        return view('users.show',compact('user'));
    }


    public function edit(User $user){
        $this->authorize('update',$user);


        return view('users.edit',compact('user'));
    }


    public function update(UserRequest $request, ImagesUploadHandler $upload ,  User $user){

        $data = $request->all();
        if($request->avatar){
            $users = $upload->save($request->avatar,'avatar', $user->id,416);
            if($users){
                $data['avatar'] = $users['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }


}

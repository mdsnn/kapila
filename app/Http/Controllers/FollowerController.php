<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(){
        //$follower = auth()->user();
        //$follower->followings()->attach($user->id);
        //$user = User::find($id);


        //return redirect()->route('users.show', $user->id)->with('success', 'followed successfulyy');

    }
    public function unfollow(){

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        $editing = true;
        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'bio' => 'nullable|min:1|max:240',
                'image'=> 'image'
            ]
            );
            if(request()->has('image')){

                $imagePath = request()->file('image')->store('profile', 'public');
                $validated['image'] = $imagePath;

            }




            $user = User::find($id);
            $user->bio = $request->bio;
            $user->name = $request->name;
            $image=$request->image;
            if ($image){
                $imagename = time().'.'.$image->extension();
                $request->image->move(public_path('images'), $imagename);
                $user->image = 'images/'.$imagename;
            }
            $user->save();
            return redirect()->route('users.show', $user->id);

    }
    public function profile(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        return view('users.show', compact('user', 'ideas'));

    }

    /**
     * Remove the specified resource from storage.
     */

}

<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store(Request $request)
    {
        request()->validate([
            'content' =>'required|min:3|max:240'
        ]);
        $idea = new Idea;
        $idea->user_id=auth()->id();
        $idea->content = $request->content;
        $idea->save();

    return redirect('/')->with('success', 'Idea was created succesfully');



    }
    public function show(Idea $idea){

        return view('ideas.show', compact('idea'));

    }
    public function edit(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));

    }
    public function update(Request $request, $id){

        request()->validate([
            'content' =>'required|min:3|max:240'
        ]);
        $idea = Idea::find($id);
        $idea->content = $request->content;
        $idea->save();



        return redirect()->route('idea.show', $idea->id)->with('success', 'idea updated successfully!');

    }

    public function destroy(Idea $idea){
        //if(auth()->id() !== $idea->user_id){
            //abort(404);
        //}
        $idea->delete();
        return redirect('/')->with('success', 'Idea was deleted succesfully');

    }
}

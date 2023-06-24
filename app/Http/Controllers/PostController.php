<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller

{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // $request = les données qui viennent du formulaire 
    // $request['content'] = "salut les gars"
    {
        // 1) On valide les données : en précisant les critères que l'on veut
        $request->validate([
            //'name de 'input' => [critères]
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
            //autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
        ]);

        // 2) Sauvegarde du message
        Post::create([
            'content' => $request->content, // syntaxe objet
            'tags' => $request['tags'], // syntaxe tableau associatif
            'image' => $request->input('image'), // autre syntaxe
            'user_id' => Auth::user()->id // j'accède à l'Id du user connecté

        ]);

        // 3) On redirige vers l'accueil avec un message de succès
        return redirect()->route('home')->with('message', 'Message créé avec succès');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

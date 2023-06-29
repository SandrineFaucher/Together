<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1) On valide les données : en précisant les critères que l'on veut
        $request->validate([
            //'name de 'input' => [critères]
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            //autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
        ]);

        // 2) Sauvegarde du message
        Comment::create([
            'content' => $request->content, // syntaxe objet
            'tags' => $request['tags'], // syntaxe tableau associatif
            'image' => isset($request ['image']) ? uploadImage($request['image']): "default_user.jpg",
            'post_id' => $request['post_id'],
            'user_id' => Auth::user()->id

        ]);

        // 3) On redirige vers l'accueil avec un message de succès
        return redirect()->route('home')->with('message', 'Message créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        // affichage du formulaire de modification 
        //['nom variable dans vue' => variable]
        return view('comments/edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Comment $comment, Request $request)
    {
        // double sécurité pour vérifier que ce soit bien l'admin ou l'auteur du poste qui accède à la modification
        $this->authorize('update', $comment);


        // validation des données à modifier 
        $request->validate([
            'image' => 'nullable',
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50'
        ]);

        //on sauvegarde les modifications en bdd
        $comment->update([
            'image' => $request->input('image'),
            'content' => $request->input('content'),
            'tags' => $request->input('tags'),

        ]);

        return redirect()->route('home')->with('message', 'Votre commentaire a bien été modifié');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // double sécurité pour vérifier que ce soit bien l'admin ou l'auteur du poste qui accède à la modification
        $this->authorize('delete', $comment);
       
        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // (les id doivent être identiques)


        $comment->delete();   // on réalise la suppression
        return redirect()->route('home')->with('message', 'Le commentaire a bien été supprimé');
    }
}

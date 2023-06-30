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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
        ]);

        // 2) Sauvegarde du message
        Post::create([
            'content' => $request->content, // syntaxe objet
            'tags' => $request['tags'], // syntaxe tableau associatif
            'image' => isset($request ['image']) ? uploadImage($request['image']): "default_user.jpg",
            'user_id' => Auth::user()->id // j'accède à l'Id du user connecté

        ]);

        // 3) On redirige vers l'accueil avec un message de succès
        return redirect()->route('home')->with('message', 'Message créé avec succès');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //je charge les posts du user
        //$user->load('posts');
        // accès dans la vue : $user->posts

        //['nom variable dans vue' => variable]
        return view('posts/edit' , ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post , Request $request){

            // double sécurité pour vérifier que ce soit bien l'admin ou l'auteur du poste qui accède à la modification
            $this->authorize('update', $post);

            // validation des données à modifier 
                 $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'content' => 'required|min:25|max:1000',
                'tags' => 'required|min:3|max:50'
            ]);
    
            //on sauvegarde les modifications en bdd
            $post->update([
            'image' => isset($request ['image']) ? uploadImage($request['image']): "default_user.jpg",
            'content' => $request->input('content'),
            'tags' => $request->input('tags'),
            
            ]);
                         
            // on redirige sur la page précédente
         
            return redirect()->route('home')->with('message', 'Votre post a bien été modifié');
            
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        // double sécurité pour vérifier que ce soit bien l'admin ou l'auteur du poste qui accède à la modification
        $this->authorize('delete', $post);


        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // (les id doivent être identiques)
        
        if(Auth::user()->id == $post->user_id){
            $post->delete();   // on réalise la suppression
            return redirect()->route('home')->with('message', 'Le post a bien été supprimé');
            }else{
            return redirect()->back()->withErrors(['erreur'=> 'suppression du post impossible']);
            }

    }

    public function search(Request $request){
        // Je valide la saisie avec des critères
        $request->validate([
            //'name de 'input' => [critères]
            'search' => 'required|min:3|max:20|string'
        ]);


        // Je récupère le mot clé et j'enlève les espaces autour pour la comparaison
        $keyword = trim($request->input('search'));

          
        // je récupère les posts en fonction du mot clé dans la recherche 
        $posts = Post::where('tags', 'like', "%{$keyword}%")
        ->orWhere('content','like' , "%{$keyword}%")   
        ->get();
       
        return view('home', ['posts' => $posts]);
        
    }

}

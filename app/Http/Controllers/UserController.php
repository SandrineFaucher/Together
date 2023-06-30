<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
         
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('posts'); // je charge les posts du user
        return view('user.show', compact('user')); // je renvoie la vue en y injectant le user à l'intérieur
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //je charge les posts du user
        //$user->load('posts');
        // accès dans la vue : $user->posts

        //['nom variable dans vue' => variable]
        return view('user/edit' , ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //on modifie les infos de l'utilisateur
        $user->pseudo = $request->input('pseudo');
        $user->image = isset($request ['image']) ? uploadImage($request['image']): "default_user.jpg";

        //on sauvegarde les changements en bdd
        $user->save();

        // on redirige sur la page précédente
        return back()->with('message', 'Le compte a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    //*********************DESTROY : pour supprimer l'utilisateur***********************/
    
    public function destroy(User $user)
    {
        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // (les id doivent être identiques)
        if(Auth::user()->id == $user->id){
            $user->delete();   // on réalise la suppression
            return redirect()->route('index')->with('message', 'Le compte a bien été supprimé');
            }else{
            return redirect()->back()->withErrors(['erreur'=> 'suppression du compte impossible']);
            }
    }
}

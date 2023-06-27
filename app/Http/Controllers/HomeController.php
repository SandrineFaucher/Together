<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // seuls les invités non connectés peuvent voir l'index (inscription + connexion)
        $this->middleware('guest')->only('index');
        // seuls les visiteurs connectés peuvent voir
        $this->middleware('auth')->only('home');
    }

    public function index() // renvoyer la page d'accueil du site (inscription + connexion)
    {
        
        return view('index');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() // renvoyer la page home.blade.php avec tous les messages
    {
        // RECUPERATION DES MESSAGES**************************************************** //

        // syntaxe de base pour tout récupérer
        //$posts = Post::all();

        // je teste cette liste de messages
        //dd ($posts);

        // syntaxe avec le + récent en premier
        //$posts = Post::latest()->get();

        // je teste cette liste de message
        //dd($posts);

        //syntaxe avec le + récent en premier + la pagination
        //$posts = Post::latest()->paginate(10);

        //je teste la lieste des messages
        //dd($posts);

        //****************************EAGER LOADINGµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ */
        // EAGER LOADING = méthode 1***(équivalent INNER JOIN)***************************/

        //je veux charger en + de mes posts :
        // -les commentaires associés à chaque post
        // - l'utilisateur qui a posté chaque post
        //$posts = Post::with('comments', 'user')->latest()->paginate(10);

        //je teste la liste des messages
        //dd($posts);

        // EAGER LOADING = méthode 2 *****************************************************/
        // je récupère  les messages  avec le dernier en premier et par pagination
        //$posts = Post::latest()->paginate(10);
        // je charge les relations souhaitées (comme ci-dessus)
       // $posts->load('comments', 'user');

        // je teste cette liste de mesages
        //dd($posts);
        
        //***********************EAGER LOADING AVANCE : encapsulé ("nested eager loading") */

        //je veux charger en + l'utilisateur qui a posté chaque commentaire
        $posts = Post::with('comments.user', 'user')->latest()->paginate(10);
        

        //je teste la liste
       // dd($posts);

        //je retourne la vue home en y injectant les posts
        return view('home', ['posts' => $posts]);

        //autre syntaxe
        // return view('home', compact('posts'))<
    }
}

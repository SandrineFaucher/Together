@extends('layouts.app')

@section('content')

    
    <div class="background text-center">

        <!-- si je viens de la route recherche par mot clé -->
        @if (Route::currentRouteName() == 'search')
        <h1 class="m-5">Résultats pour votre recherche </h1>
        @else



        <!--*****************************titre***********************************************-->
        <div class="text-center  mb-5">
            <h1> LET'S WRITE TOGETHER <i class="fa-solid fa-pen-fancy"></i> </h1>
        </div>

        <!-- ************************Formulaire d'ajout de message*************************-->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <!--balise de sécurité contre les failles csrf-->


            <!--****************************input image ***********************************-->

            <div class="updateimage mx-auto w-50 mt-5 mb-2 text-center">
                <label class="uploadimage"> Importer une image < à 2 MO <input
                        class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                        id="fileToUpload">
                        <i class="fa-solid fa-file-import "></i>
                </label>
            </div>

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- ******************************** input comment du post **************************************-->

            <div class="container-fluid postuser text-center mt-1 mb-5">

                <div class="mb-3 w-50 mx-auto">
                    <label for="exampleFormControlTextarea1" class="form-label">Commentaire</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"
                        name="content"></textarea>
                </div>

                @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!--******************************input tags****************************************-->
                <div class="mb-3 w-50 mx-auto">
                    <label> <i class="fa-solid fa-hashtag"></i> </label>
                    <input class="form-control @error('tags') is-invalid @enderror" type="text" placeholder="Mots clés"
                        aria-label="default input example" name="tags">
                </div>

                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="button text-center mt-5">
                <button class="btn btn-primary mx-auto" type="submit" name="post">
                    Envoyer
                </button>
            </div>
        </form>
        @endif
        
        <!--*********************  Boucle qui affiche les messages ******************************-->
        <!--***********************condition pour les résultats de la recherche******************-->
        @if (count($posts) == 0)
            <img src="{{asset('images/searchnofound.jpg')}}" alt="imageloupe" class="imagesearchnofound m-5">
           <h3 class="m-5"> Aucun résultat pour votre recherche </h3>

        @else 
        @foreach ($posts as $post)
            <div class="container card m-3 mx-auto">
                <div class="updateimage mx-auto w-50 mt-5 mb-2 text-center">
                    <img class="card-img-top" src="images/{{$post->image}}" alt="post-image" name="image.jpg">
                </div>
                <div class="card-body text-center">
                                       
                    <h4> {{ $post->user->pseudo }} </h4>
                    <img class="card-img-top imageuser" src="images/{{$post->user->image}}" alt="post-image" name="image.jpg">
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text"> #{{ implode(' #', explode(' ', $post->tags)) }}</p>

                    <div class="row text-center d-flex justify-center">
                        <div class="col-md-4">
                            <a href="{{ route('posts.edit', $post) }}">
                                <!-- *************************Bouton de modification *********************************-->
                                <button class="btn btn-info" name="modifier">modifier</button>
                            </a>
                        </div>

                        <!--**************************bouton de suppression **************************************-->
                        <div class="col-md-4">
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">supprimer </button>
                            </form>
                        </div>


                        <div class="col-md-4"> <!--script javascript pour dérouler le formulaire à partir du bouton coommentaire-->
                            <button class="btn btn-info"
                                onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">
                                commenter
                            </button>
                        </div>
                            <!-- script javascript pour le formulaire qui s'affiche en accordéon avec le bouton commentaire -->
                            <div style="display:none" class="col p-3 mb-2" id="formulairecommentaire{{ $post->id }}">
                                <!--nouveau formulaire pour ajouter un commentaire au post -->
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    @method('post')

                                    <!-- input du commentaire-->
                                    <label for="exampleFormControlTextarea1" class="form-label">Commentaire</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"
                                    name="content" placeholder="Votre commentaire"></textarea>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <!--input des tags -->
                                    <div class="mb-3 w-50 mx-auto">
                                        <label> <i class="fa-solid fa-hashtag"></i> </label>
                                        <input class="form-control @error('tags') is-invalid @enderror" type="text" placeholder="Mots clés"
                                            aria-label="default input example" name="tags">
                                    </div>
                    
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <!--input des images-->
                                    <div class="updateimage mx-auto w-50 mt-5 mb-2 text-center">
                                        <label class="uploadimage"> Importer une image < à 2 MO <input
                                                class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                                                id="fileToUpload">
                                                <i class="fa-solid fa-file-import "></i>
                                        </label>
                                    </div>
                        
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <div class="button text-center mt-5">
                                        <input type="hidden"  value="{{$post->id}}" name="post_id">
                                        <button type="submit"class="btn btn-secondary" >
                                            Envoyer
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        
                    </div>
                    <!--**************affichage des commentaires*****************************************************-->

                    <div class="card-body text-center">
                        <h5 class="m-5">Commentaires</h5>
                        <div class="row">

                            @foreach ($post->comments as $comment)
                                <!--grâce à l'eager loading lors de la récupération des posts, je crée un alias de l'objet comment
                            table 'comment' et je peux ainsi récupérer ses champs pour les afficher-->
                                <div class="col-md-3 mx-auto my-auto">
                                    <p>{{ $comment->created_at }}</p>
                                </div>
                                <div class="col-md-3 mx-auto my-auto">
                                    <img class="card-img-top w-25" src="images/{{$comment->user->image}}" alt="post-image" name="image.jpg">
                                </div>
                                <div class="col-md-3">
                                    <p>{{ $comment->content }}</p>
                                </div>
                                <div class="col-md-3 mx-auto my-auto">
                                    <p>#{{ implode(' #', explode(' ', $comment->tags)) }}</P>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('comments.edit', $comment) }}">
                                            <!-- *************************Bouton de modification *********************************-->
                                            <button class="btn btn-info" name="modifier">modifier</button>
                                        </a>
                                    </div>
        
                                    <div class="col-md-4">
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">supprimer </button>
                                        </form>
                                    </div>
        
                                </div>


                            @endforeach


                        </div>

                    </div>
                    
                </div>
              </div>
        @endforeach
    @endif
</div>

</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="background">

        <!--*****************************titre*******************************************-->
        <div class="text-center  mb-5">
            <h1> LET'S WRITE TOGETHER <i class="fa-solid fa-pen-fancy"></i> </h1>
        </div>

        <!-- ************************Formulaire d'ajout de message*************************-->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <!--balise de sécurité contre les failles csrf-->


            <!--****************************input image *************************************-->

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

            <!-- ******************************** input comment**************************************-->

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



        <!--*********************  Boucle qui affiche les messages ******************************-->

        <div class="updateimage mx-auto w-50 mt-5 mb-2 text-center">
        @foreach ($posts as $post)
            <div class="container card m-3 text-center">
                <img class="card-img-top" src="{{ asset('images/' . $post->image) }}" alt="post-image">
                <div class="card-body">
                    <p> {{ $post->user->pseudo }} </p>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text">{{ $post->tags }}</p>

                    <div class="row text-center d-flex justy-center">
                        <div class="col-md-2">
                        <!-- *************************Bouton de modification *********************************-->
                            <button class="btn btn-info">modifier</button>
                        </div>
    
                        <!--**************************bouton de suppression **************************************-->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-danger">supprimer </button>
                        </div>
                    </div>
                    
                <!--**************affichage des commentaires*****************************************************-->
                </div>
                <div class="card-body text-center">
                   <h5>Commentaires</h5> 
                    <div class="col-md-6 user">

                    </div>
                    <div class="col-md-6">
                        
                    </div>
                        
                </div>
                

                <!--******************bouton modifier => mène à la page modification du message******************-->
                <!--@can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}">
                    <button class="btn btn-info">modifier</button>
                    </a>
                    @endcan -->
            </div>
        @endforeach
        </div>
    
    </div>
@endsection
@extends ('layouts.app')


@section('content')
    <main class="container">
      
        <div class="row">
                          
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf<!--balise de sécurité contre les failles csrf-->
                @method('PUT')
    
                <!--****************************input image *************************************-->
                    <div class="updateimage mx-auto w-50 mt-5 mb-2 text-center">
                    <label class="uploadimage"> Importer une image < à 2 MO <input
                            class="form-control @error('image') is-invalid @enderror" type="text" name="image"
                            id="fileToUpload" value="image.jpg">
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
                        <label for="exampleFormControlTextarea1" class="form-label">Votre message</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"
                            name="content">{{ $comment->content }}</textarea>
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
                            aria-label="default input example" name="tags" value="{{ $comment->tags }}">
                    </div>
    
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="button text-center mt-5">
                    <button class="btn btn-primary mx-auto" type="submit">
                        Valider les changements
                    </button>
                </div>
            </form>
     
            
        </div>
    </main>
    @endsection

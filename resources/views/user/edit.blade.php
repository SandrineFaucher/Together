@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <div class="background p-5">
        <main class="container text-center">

            <h1>Mon compte</h1>

            <img class="w-25 mt-5 mb-5 rounded-circle" src="{{ asset('images/' . $user->image) }} " alt="image_utilisateur">

            <h3 class="pb-3">Je modifie mes informations </h3>

            <div class="row ">

                <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-5">
                        <label for="pseudo">Nouveau pseudo</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="pseudo"
                            value="{{ $user->pseudo }}" id="pseudo">
                    </div>

                    <div class="form-group">
                        
                        <label class="uploadimage"> Importer une image < à 2 MO <input
                            class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                            id="fileToUpload">
                            <i class="fa-solid fa-file-import "></i>
                        </label>

                    </div>

                    <button type="submit" class="btn btn-primary mt-5">Valider</button>
                </form>


                <div class="destroyaccount mt-5 mb-5">
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">supprimer le compte</button>
                </form>

            </div>
        </main>
    </div>
@endsection

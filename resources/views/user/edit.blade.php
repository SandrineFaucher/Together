@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">

        <h1>Mon compte</h1>

        <h3 class="pb-3">Modifier mes informations </h3>
        <div class="row">


            <img class="w-25" src="{{ asset('images/' . $user->image) }} " alt="image_utilisateur">  
            <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="pseudo">Nouveau pseudo</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="pseudo" value="{{ $user->pseudo }}" id="pseudo">
                </div>

                <div class="form-group">
                    <label for="image">Nouvelle image</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="image" value="{{ $user->image }}" id="image">
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>

            <form action="{{route('users.destroy', $user)}}" method="POST">
                @csrf
                @method("delete")
                <button type="submit" class="btn btn-danger">supprimer le compte</button>
            </form>
            
        </div>
    </main>
    @endsection

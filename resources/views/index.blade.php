@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">

        <h1>Bienvenue sur Together</h1>

        <div class="row mt-5 w-50 mx-auto">
            <div class="col-6">
                <a href="register"><button class="btn btn-lg px-5 btn primary">Inscription</button></a>
            </div>
            <div class="col-6">
                <a href="login"><button class="btn btn-lg px-5 btn primary">Connexion</button></a>
            </div>
        </div>
    </main>
@endsection

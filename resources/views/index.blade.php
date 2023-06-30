@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <div class="background">
    <main class="container">

        <h1 class="pt-5">Bienvenue sur le réseau : </h1>

        <div class="text-center  mb-5">
            <img src="{{asset('images/logo.png')}}" alt="logoassociation" class="w-50">
        </div>


        <div class="row mt-5 w-50 mx-auto">
            <div class="col-6 mb-5" >
                <a href="register"><button class="btn btn-lg px-5 btn-info bg-info-subtle">Inscription</button></a>
            </div>
            <div class="col-6">
                <a href="login"><button class="btn btn-lg px-5 btn primary btn-info bg-info-subtle">Connexion</button></a>
            </div>
        </div>
    </main>
</div>
@endsection

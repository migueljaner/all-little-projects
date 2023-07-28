@extends('layouts.app')

@section('content')
<img id="welcome" src="https://images.wallpaperscraft.com/image/singapore_casino_hotel_59558_1920x1080.jpg">

<div id="welcomeText">
    <h1 class="text-center text-uppercase text-white align-middle">Welcome to your business manager tool</h1>
</div>

<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection

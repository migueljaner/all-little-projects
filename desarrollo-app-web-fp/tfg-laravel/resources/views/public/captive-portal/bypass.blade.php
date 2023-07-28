@extends('layouts.captive-portal')

@section('title', 'Captive Portal')

@section('head')

    <script>

        addEventOnLoad(function(){

            var params;
    
            toggleModal('modalValidatingData');

            params = {
                @foreach (array_get($data, "parameters", []) as $key => $value)
                    {!! "'".$key."': '".$value."'" !!},
                @endforeach
            };

            formLogin = document.createElement('form');
            formLogin.action = params['login'];
            formLogin.method = 'post';
            formLogin.style.display = 'none';

            Object.keys(params).forEach(function(key){
                var inputFormLogin = document.createElement('input');
                inputFormLogin.type = 'hidden';
                inputFormLogin.name = key;
                inputFormLogin.value = params[key];
                formLogin.appendChild(inputFormLogin);
            });

            document.body.appendChild(formLogin);

            formLogin.submit();

        });
    
    </script>

@endsection

@section('content')
@endsection
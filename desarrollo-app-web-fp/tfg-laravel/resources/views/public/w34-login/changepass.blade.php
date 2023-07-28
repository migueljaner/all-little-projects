@extends('layouts.app')

@section('content')
<div class="col-sm-4 container text-center w34successalert"> 
    @if(session('changepwd') == '1')
        <div class="alert alert-success">
            @lang('userconf.changepwd.success')
        </div>
    @elseif(session('changepwd') == '0')
        <div class="alert alert-success" id="deldone">
            @lang('userconf.changepwd.error')
        </div>
    @endif
    <script>
        setTimeout(function() {
            $('.w34successalert').hide();
        }, 5000);
    </script>
</div>

<div class="container">
    <div class="row justify-content-center mt-5" style="margin-top: 4rem;">      
        <div class="col-md-8">    
            <div class="card">
                <div class="card-header">@lang('userconf.changepwd.title')</div>
                    <div class="card-body">
                        <form id="form-change-password" role="form" method="POST" action="{{ route('userchangepwd') }}" novalidate class="form-horizontal">
                            <div class="form-group row">           
                                <label for="current-password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                                <div class="col-md-6">
                                    @csrf
                                    <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Re-enter Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                                </div>
                            </div>
                            <div class="offset-md-4 col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
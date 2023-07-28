@extends('layouts.app')

@section('content')
    <!--Title-->
    @if (session('successcreate')||session('successedit')||session('successrecover')||session('successdel'))
        <div class="col-sm-4 container text-center w34successalert"> 
            @if (session('successcreate') == 'ok')
            {{Session::forget('successcreate')}}
            <div class="alert alert-success">
                @lang('tables.successcreate')
            </div>
            @endif
            @if(session('successedit') == 'ok')
            {{Session::forget('successedit')}}
            <div id="editdone" class="alert alert-success">
                @lang('tables.successedit')
            </div>
            @endif
            @if(session('successdel') == 'ok')
            {{Session::forget('successdel')}}
            <div id="deldone" class="alert alert-success">
                @lang('tables.successdel')
            </div>
            @endif
            @if(session('successrecover') == 'ok')
            {{Session::forget('successrecover')}}
            <div id="recoverdone" class="alert alert-success">
                @lang('tables.successrecover')
            </div>
            @endif
            <script>
                setTimeout(function() {
                    $('.w34successalert').hide();
                }, 5000);
            </script>
        </div>
        
        
    @endif
    
    
    <div class="top_page mt-5">
        @if ($table == 'Clients' || $table == 'Establishments')
        <div></div>
        <a href="/show/del/{{$table}}<?=isset($client_id)? '/'.$client_id : ''?>"><img src="https://cleanstreets.westminster.gov.uk/wp-content/uploads/2018/08/006-trash-bin.png" alt="recycle bin"></a>
        @endif
        <h1 class="text-center text-uppercase text-primary">{{$table}}</h1>
        <hr class="star-dark mb-5 text-primary">
    </div>
    <!--Creación de la tabla-->
    <div class="text-center" id="add">
        @if($table != 'Clients')
            <button class="btn btn-primary" id="backButton" onclick="window.history.go(-1); return false;"><i class="fas fa-arrow-left"></i></button> 
        @endif
        @if(isset($perms) && !Auth::user()->isAdmin() && $table != 'Clients' && !str_contains($table, 'Deleted'))
            @foreach ($perms as $perm => $p)
                @if($p->crear == 1 && Auth::id() === $p->usuarios_id && $table != 'Clientele')
                    <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd{{$table}}')">Add &nbsp;&nbsp;{{$table}}</button>
                @endif
            @endforeach
        @endif
        @if(Auth::user()->isAdmin() && !str_contains($table, 'Deleted') && $table != 'Clientele')
            <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd{{$table}}')">Add &nbsp;&nbsp;{{$table}}</button> 
        @endif
    </div> 
    @if (isset($data) && !empty($data[0]) && count($data) > 0)
        <table id="myTable" class="display nowrap">
            <thead>
                <tr>
                    @foreach ($columns as $col)
                        <th>{{$col}}</th>
                    @endforeach
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody> 
                @if (Auth::user()->isAdmin()) 
                    @foreach ($data as $key => $value)
                    <tr>
                        @if(Auth::user()->isAdmin())
                            @foreach ($columns as $col)
                                <td>{{$value->$col}}</td>
                            @endforeach
                        @endif
                        @if(Auth::user()->isAdmin())
                            <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                @if(str_contains($table, 'Deleted'))
                                    <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td>
                                @else
                                    <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                @endif
                        @endif    
                    </tr>
                    @endforeach
                @elseif(!Auth::user()->isAdmin())
                    @foreach ($data as $key => $value) 
                        <tr>
                            @foreach ($perms as $perm => $p)
                                @if($table === 'Clients' || $table === 'Deleted Clients')
                                    @if ($value->id == $p->client_id)
                                        @foreach ($columns as $col)
                                            <td>{{$value->$col}}</td>
                                        @endforeach
                                    @endif
                                    @if($value->id == $p->client_id and $p->borrar == 1)
                                        <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                    @elseif($value->id == $p->client_id and $p->borrar == 0)
                                        <td></td>
                                    @endif
                                    @if($value->id == $p->client_id and $p->editar == 1 )
                                        @if($table === 'Clients')
                                            <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                        @elseif($table === 'Deleted Clients')
                                            <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td>
                                        @endif
                                    @elseif($value->id == $p->client_id and $p->editar == 0)
                                        <td></td>
                                    @endif
                                @elseif($table != 'Clients')
                                    @if (Auth::id() == $p->usuarios_id && $client_id == $p->client_id)
                                        @foreach ($columns as $col)
                                            <td>{{$value->$col}}</td>
                                        @endforeach
                                        @if($client_id == $p->client_id)
                                            @if($p->borrar == 1)
                                                <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                            @elseif($p->borrar == 0 )
                                                <td></td>
                                            @endif
                                            @if($p->editar == 1)
                                                @if(str_contains($table, 'Deleted'))
                                                    <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td> 
                                                @else
                                                    <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                                @endif
                                            @elseif($p->editar == 0)
                                                <td></td>
                                            @endif    
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    @endif  
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                @endif
                <script>
                    $("#myTable").DataTable({
                        responsive: true
                    });
                </script>
            </tbody>
        </table>
    @else
        <h1 class="text-center mt-5 text-secondary">@lang('tables.nodata')</h1>
    @endif
    <br><br><br><br><br>
    @include('public.w34-login.modals')
@endsection
@extends('layouts.app')

@section('content')
    <div class="top_page mt-5">
        <h1 class="text-center text-uppercase text-primary">{{$table}}</h1>
        <hr class="star-dark mb-5 text-primary">
    </div>
    <div class="text-center" id="add">
        @if(Auth::user()->isAdmin())
            <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd{{$table}}')">Add &nbsp;&nbsp;{{$table}}</button>
        @endif         
    </div> 
    <table id="myTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                @if (Auth::user()->isAdmin())
                    <th></th>
                    <th></th>       
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    @if (Auth::user()->isAdmin())
                        <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                        <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>          
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $('#myTable').dataTable();
    </script>
    <div class="modal" id="modaladd{{$table}}">
            <div class="modal-dialog">
            <form action="/add/{{$table}}" method='post'>
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title text-primary text-uppercase ml-1 mt-2">Add {{$table}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body pt-2 pb-0">
                        <hr class="separator text-primary">
                        <div class="container mb-4 text-secondary">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="addTable">
                                        <tbody>
                                        @csrf
                                            <tr> 
                                                <th class="pb-0">Name</th>
                                                <td><input type="text" name="name" class="align-middle allinput" maxlength="36" required></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div id="modalDelete" class="modal">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header text-center pb-0">
                        <h4 class="modal-title text-danger px-4">Are you sure you want to delete it?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>   
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon-box">
                            <img src="https://image.flaticon.com/icons/svg/53/53639.svg">
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <select name="changefor">
                            @foreach ($data as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger ml-4">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modalEdit">
            <div class="modal-dialog">
            <form action="/update/{{$table}}" method='post'>
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title text-primary text-uppercase ml-1 mt-2">Edit {{$table}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body pt-2 pb-0">
                        <hr class="separator text-primary">
                        <div class="container mb-4 text-secondary">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="addTable">
                                        <tbody>
                                        @csrf
                                            <tr> 
                                                <th class="pb-0">Name</th>
                                                <td><input type="text" name="name" class="align-middle allinput" maxlength="36" required></td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td><input type="hidden" name="id" class="align-middle allinput"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
@endsection
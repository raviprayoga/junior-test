@extends('partials.sidebar')
@section('content')
    <body>
        <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <!-- profile info & task notification -->
                        <div class="col-md-6 col-sm-4 clearfix">
                            <a href="{{route('logout')}}">
                                <ul class="notification-area pull-right">
                                    <li class="dropdown" style="margin-top: 30%">
                                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                    </li>
                                </ul>
                            </a>
                            <ul class="pull-right">
                                <li style="margin-top: 50%">
                                    <button type="button" class="pluss" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-plus-square fa-2x icn-pls"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header area end -->

                {{--  Judul Content  --}}
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">{{__('employees')}}</h4>
                                {{--  <ul class="breadcrumbs pull-left">
                                    <li><a href="index.html">Home</a></li>
                                    <li><span>Employees</span></li>
                                </ul>  --}}
                            </div>
                        </div>
                    </div>
                </div>

                 {{-- CONTENT --}}
                 <div class="main-content-inner">
                    <table id="dtBasicExample" class="table table-striped table-hover" width="100%">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>{{__("first")}}</th>
                                <th>{{__("last")}}</th>
                                <th>{{__("company")}}</th>
                                <th>{{__("email")}}</th>
                                <th>{{__("phone")}}</th>
                                <th style="text-align: center">{{__("action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;    
                            @endphp
                            @foreach ($employe as $item_employe)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item_employe->first_name}}</td>
                                <td>{{$item_employe->last_name}}</td>
                                <td>{{$item_employe->companies['name']}}</td>
                                <td>{{$item_employe->email}}</td>
                                <td>{{$item_employe->phone}}</td>
                                <td style="text-align: center">
                                    <a href="/upload/delate_employe/{{$item_employe->id}}" style="color: #495057"><i class="fas fa-trash fa-lg icn-dlt"></i></a>
                                    <a data-toggle="modal" data-target="#editModalEmploye-{{$item_employe->id}}" href="" style="color: #495057"><i class="fas fa-edit fa-lg icn-edt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{--  add modal  --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body" style="text-align: center">
                            <form action="/upload_employe/proses_upload_employe" method="POST" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                <input class="modal_body mbdy" name="first_name" type="text" placeholder="First Name"> <br>
                                <input class="modal_body mbdy" style="margin-top: 4%" name="last_name" type="text" placeholder="Last Name"> <br>
                                    <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="company" name="company">
                                        <option value="" selected> Select Company... </option>
                                            @foreach ($company as $item_company)
                                                <option value="{{$item_company->id}}">{{$item_company->name}}</option>
                                            @endforeach
                                    </select>
                                <input class="modal_body mbdy" style="margin-top: 4%" name="email" type="text" placeholder="Email">
                                <input class="modal_body mbdy" style="margin-top: 4%" name="phone" type="text" placeholder="Phone"> <br>
                                <div class="btnmdl1">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" value="Upload" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                
                {{-- edit modal --}}
                @foreach ($employe as $edtemploye)
                    {{-- Update Modal --}}
                    <div class="modal fade" id="editModalEmploye-{{$edtemploye->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Employees</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" style="text-align: center">
                            <form action="{{("/edit{$edtemploye->id}/editEmploye")}}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value=" ">
                                <input class="modal_body mbdy" style="margin-top: 4%" name="first_name" type="text" id="first_name" value="{{$edtemploye->first_name}}"> 
                                <input class="modal_body mbdy" style="margin-top: 4%" name="last_name" type="text" id="last_name" value="{{$edtemploye->last_name}}">
                                <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="company" name="company">
                                    <option value="" selected> Select Company... </option>
                                        @foreach ($company as $item_company)
                                            <option value="{{$item_company->id}}">{{$item_company->name}}</option>
                                        @endforeach
                                </select>
                                <input class="modal_body mbdy" style="margin-top: 4%" name="email" type="text" id="email" value="{{$edtemploye->email}}"> 
                                <input class="modal_body mbdy" style="margin-top: 4%" name="phone" type="text" id="phone" value="{{$edtemploye->phone}}"> 
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button  type="submit" value="Simpan Data" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </body>
@stop
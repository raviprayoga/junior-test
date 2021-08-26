@extends('partials.sidebar')
@section('content')
    <body>
        <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <div class="col-md-1 col-sm-2 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- nav and search button -->
                        <div class="col-md-4 mt-2">
                            <div class="">
                                <form action="/home" type="get">
                                    <input class="srch col-md-6" name="query" type="search" placeholder="search" >
                                    <input  hidden  name="paged" value="{{ $paged }}">
                                    <button class="btn btn-danger" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-7 col-sm-4 clearfix mt-3">
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
                            <ul class="pull-right">
                                <li class="mt-2">
                                    <p type="button" class="btn ImportExcel" data-toggle="modal" data-target="#modalImport">
                                        Import From Excel
                                    </p>
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
                                <h4 class="page-title pull-left">{{__("multilang.companies")}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="breadcrumbs-area clearfix">
                                <div class="card-tools">
                                        <select class="dropdown-item" style="width: 150px; margin-bottom: 6px;color: #fff;background-color: #adb5bd;border-radius: 4px;" name="" id="pagination">
                                            <option value="{{('home')}}?query={{ request('query') }}&paged=5000">show all</option>
                                            <option value="{{('home')}}?query={{ request('query') }}&paged=5"@if($paged == 5) selected @endif>5</option>
                                            <option value="{{('home')}}?query={{ request('query') }}&paged=10"@if($paged == 10) selected @endif>10</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="breadcrumbs-area clearfix">
                                <li class="nav-item" style="list-style: none">
                                    <table>
                                        <td style="padding: 5px;"> {{__("multilang.time")}} : </td>
                                        <td>
                                            <select class="custom-select" id="timezone" name="company" onchange="if (this.value) window.location.href=this.value">
                                                <option value=""> {{ Session::get('timezone') }} </option>
                                            </select>
                                        </td>
                                    </table>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="main-content-inner">
                    <table id="mytable" class="table table-striped table-hover" width="100%">
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
                            {{--  {{auth()->user()->name}}  --}}
                            <tr>
                                <th>No</th>
                                <th>{{__("multilang.name")}}</th>
                                <th>{{__("multilang.email")}}</th>
                                <th>{{__("multilang.logo")}}</th>
                                <th>Website</th>
                                <th>{{__("multilang.created_by_id")}}</th>
                                <th>{{__("multilang.updated_by_id")}}</th>
                                <th>created_at</th>
                                <th style="text-align: center">{{__("multilang.action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $no=1;    
                        @endphp
                        @foreach ($company as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->logo}}{{-- <img src="{{ url('/img_company/'.$item->logo) }}" alt="" style="width: 70px; height: 70px;"> --}}</td>
                                <td>{{$item->website}}</td>
                                <td style="text-align: center">{{$item->created_by_id}}</td>
                                <td style="text-align: center">{{$item->updated_by_id}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->setTimezone(Session::get('timezone'))->format(' Y-m-d h:i:s') }}</td>
                                <td style="text-align: center">
                                    <a href="/upload/delate_company/{{ $item->id }}" style="color: #495057"><i class="fas fa-trash fa-lg icn-dlt"></i></a>
                                    <a data-toggle="modal" data-target="#editModal-{{$item->id}}" href="" style="color: #495057"><i class="fas fa-edit fa-lg icn-edt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                     {{ $company->appends(['paged' => $paged])->links() }} 
                   
                </div>
                
                {{--  MODAL  --}}
                {{-- ADD Modal --}}
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
                            <form action="/upload_company/proses_upload_company" method="POST" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                <input class="modal_body mbdy" name="name" type="text" placeholder="Name"> <br>
                                <input class="modal_body mbdy" style="margin-top: 4%" name="email" type="text" placeholder="Email">
                                <input class="modal_body mbdy" style="margin-top: 2%" name="website" type="text" placeholder="Website">
                                <input class="" style="margin-top: 2%" name="logo" type="file" placeholder="Logo">
                                <div class="btnmdl1">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" value="Upload" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                {{--  EDIT Modal  --}}
                @foreach ($company as $edt)
                    {{-- Update Modal --}}
                    <div class="modal fade" id="editModal-{{$edt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Companies</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" style="text-align: center">
                            <form action="{{"/edit{$edt->id}"}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value=" ">
                                <input class="modal_body mbdy" name="name" type="text" id="name" value="{{$edt->name}}"> 
                                <input class="modal_body mbdy" style="margin-top: 4%" name="email" type="text" id="email" value="{{$edt->email}}"> 
                                <input class="modal_body mbdy" style="margin-top: 2%" name="logo" type="file" id="logo" value="{{old('logo')}}"> 
                                <input class="modal_body mbdy" style="margin-top: 2%" name="website" type="text" id="website" value="{{$edt->website}}"> 
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
                {{--  add modal file from excel  --}}
                <!-- Modal -->
                <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import from excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/importCompanies" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <input class="" style="margin-top: 2%" name="file" type="file" >
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" value="upload" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            
            
            <script>
                $(document).ready(function() {
                    var url_param = {!! json_encode(url()->current()) !!} + '?change_timezone='
                
                    $.ajax({
                        url: 'http://worldtimeapi.org/api/timezone',
                        dataType: "json",
                        success: function(data) {
                            var time_data = jQuery.parseJSON(JSON.stringify(data));
                            $.each(time_data, function(k, v) {
                
                                $('#timezone').append($('<option>', {
                                    value: url_param + v
                                }).text(v))
                            })
                        }
                    });
                    $('#date_range').daterangepicker()
                }); 

                $(function(){

                    $('#pagination').on('change', function () {
                        var url = $(this).val(); 
                        if (url) { 
                            window.location = url; 
                        }
                        return false;
                    });
                  });
            </script>
            <script>
            </script>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
@stop
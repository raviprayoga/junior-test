@extends('partials.sidebar')
@section('content')
<body>
    <div class="main-content">
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
                        <form action="/item" type="get">
                            <input class="srch col-md-6" name="query" type="search" placeholder="search" >
                            {{--  <input  hidden  name="paged" value="{{ $paged }}">  --}}
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
                            <button type="button" class="pluss" data-toggle="modal" data-target="#addItemModals">
                                <i class="fas fa-plus-square fa-2x icn-pls"></i>
                            </button>
                        </li>
                    </ul>
                    {{--  <ul class="pull-right">
                        <li class="mt-2">
                            <p type="button" class="btn ImportExcel" data-toggle="modal" data-target="#modalImport">
                                Import From Excel
                            </p>
                        </li>
                    </ul>  --}}
                </div>
            </div>
        </div>
        {{--  end header-area  --}}
        {{--  judul content  --}}
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">{{__('multilang.sells')}}</h4>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="breadcrumbs-area clearfix">
                        <div class="card-tools">
                                <select class="dropdown-item" style="width: 150px; margin-bottom: 6px;color: #fff;background-color: #adb5bd;border-radius: 4px;" name="" id="pagination">
                                    <option value="{{('sells')}}?query={{ request('query') }}&paged=5000">show all</option>
                                    <option value="{{('sells')}}?query={{ request('query') }}&paged=5"@if($paged == 5) selected @endif>5</option>
                                    <option value="{{('sells')}}?query={{ request('query') }}&paged=10"@if($paged == 10) selected @endif>10</option>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="breadcrumbs-area clearfix">
                        {{--  <li class="nav-item" style="list-style: none">
                            <table>
                                <td style="padding: 5px;"> {{__("multilang.time")}} : </td>
                                <td>
                                    <select class="custom-select" id="timezone" name="company" onchange="if (this.value) window.location.href=this.value">
                                        <option value=""> {{ Session::get('timezone') }} </option>
                                    </select>
                                </td>
                            </table>
                        </li>  --}}
                    </div>
                </div>
            </div>
        </div>
        {{--  end judul  --}}
        {{--  content  --}}
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
                        <th>Discount</th>
                        <th>{{__('multilang.price')}}</th>
                        <th>{{__('multilang.item_id')}}</th>
                        <th>{{__('multilang.employe_id')}}</th>
                        <th>{{__('multilang.created')}}</th>
                        <th style="text-align: center">{{__("multilang.action")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;    
                    @endphp
                    @foreach ($sells as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->discount}} %</td>
                        <td>Rp. {{number_format($item->price)}}</td>
                        <td>{{$item->item_id}}</td>
                        <td>{{$item->employe_id}}</td>
                        <td>{{$item->created_at}}</td>
                        <td style="text-align: center">
                            <a href="/hapusSells/{{$item->id}}" style="color: #495057"><i class="fas fa-trash fa-lg icn-dlt"></i></a>
                            <a data-toggle="modal" data-target="#editSellsModal-{{$item->id}}" href="" style="color: #495057"><i class="fas fa-edit fa-lg icn-edt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $sells->appends(['paged' => $paged])->links() }} 
            
        </div>
        {{--  endcontent  --}}
    </div>

    {{--  MODAL  --}}
    {{-- ADD Modal --}}
    <div class="modal fade" id="addItemModals" tabindex="-1" role="dialog" aria-labelledby="addItemModalsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" style="text-align: center">
                <form action="{{route('addSells')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    {{--  <input class="modal_body mbdy" name="price" type="text" placeholder="Price"> <br>  --}}
                    <input class="modal_body mbdy" style="margin-top: 4%" name="discount" type="text" placeholder="Discount">
                    <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="employe_id" name="employe_id">
                        <option value="" selected> Select Employe... </option>
                            @foreach ($employe as $sell_employe)
                                <option value="{{$sell_employe->id}}">{{$sell_employe->first_name}} {{$sell_employe->last_name}}</option>
                            @endforeach
                    </select>
                    <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="item_id" name="item_id">
                        <option value="" selected> Select Items... </option>
                            @foreach ($items as $sell_items)
                                <option value="{{$sell_items->id}}">{{$sell_items->name}}</option>
                            @endforeach
                    </select>
                    <div class="btnmdl1">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" value="Upload" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{--  End Add Modal  --}}
    {{--  Edit Modal  --}}
    @foreach ($sells as $edt)
        {{-- Update Modal --}}
        <div class="modal fade" id="editSellsModal-{{$edt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sells</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" style="text-align: center">
                <form action="/editSells{{$edt->id}}/edit" method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <input class="modal_body mbdy" name="discount" type="text" id="discount" value="{{$edt->discount}}"> 
                    <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="item_id" name="item_id">
                        <option value="{{$edt->id}}" selected > {{$edt->items->name}}</option>
                        @foreach ($items as $edit_item)
                            <option value="{{$edit_item->id}}">{{$edit_item->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="employe_id" name="employe_id">
                        <option value="{{$edt->id}}" selected > {{$edt->employe->first_name}} {{$edt->employe->last_name}}</option>
                        @foreach ($employe as $edit_employe)
                            <option value="{{$edit_employe->id}}">{{$edit_employe->first_name}} {{$sell_employe->last_name}}</option>
                        @endforeach
                    </select>
                        {{--  <input class="modal_body mbdy" style="margin-top: 4%" name="item_id" type="text" id="item_id" value="{{$edt->items->name}}">   --}}
                        {{--  <input class="modal_body mbdy" style="margin-top: 4%" name="employe_id" type="text" id="employe_id" value="{{$edt->employe->first_name}}">    --}}
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
    {{--  End Edit Modal  --}}

    <script>
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
</body>
@endsection
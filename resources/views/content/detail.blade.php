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
                        <form action="/detail/{$id}" type="get">
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
                </div>
            </div>
        </div>
        {{--  end header-area  --}}
        {{--  judul content  --}}
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">{{__('multilang.detail')}}</h4>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="breadcrumbs-area clearfix">
                        <div class="card-tools">
                                <select class="dropdown-item" style="width: 150px; margin-bottom: 6px;color: #fff;background-color: #adb5bd;border-radius: 4px;" name="" id="pagination">
                                    <option value="{{url('/detail/'.$id)}}?query={{ request('query') }}&paged=5000">show all</option>
                                    <option value="{{url('/detail/'.$id)}}?query={{ request('query') }}&paged=5"@if($paged == 5) selected @endif>5</option>
                                    <option value="{{url('/detail/'.$id)}}?query={{ request('query') }}&paged=10"@if($paged == 10) selected @endif>10</option>
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
                <thead>
                    <tr>
                        <th>No</th>
                        <th>{{__('multilang.name_employe')}}</th>
                        <th>{{__('multilang.item_id')}}</th>
                        <th>{{__('multilang.item_name')}}</th>
                        <th>{{__('multilang.price')}}</th>
                        <th>{{__('multilang.discount')}}</th>
                        <th>{{__('multilang.after_discount')}}</th>
                        <th>{{__('multilang.created')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($sells as $s)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$s->employe->first_name}} {{$s->employe->last_name}}</td>
                        <td>{{$s->item_id}}</td>
                        <td>{{$s->items->name}}</td>
                        <td>Rp.{{number_format($s->items->price)}}</td>
                        <td>{{$s->discount}}%</td>
                        <td>Rp.{{number_format($s->price)}}</td>
                        <td>{{$s->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            {{ $sells->appends(['paged' => $paged])->links() }} 
            
        </div>
        {{--  endcontent  --}}
    </div>


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
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
                                <form action="/search" type="get">
                                    <input class="srch col-md-6" name="query" type="search" placeholder="search" >
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
                                <h4 class="page-title pull-left">{{__("companies")}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="breadcrumbs-area clearfix">
                                {{--  <h4 class="page-title pull-left"></h4>  --}}
                                <div class="form-group page-title pull-left">
                                    <select name="state" id="maxRows" class="form-control" style="width: 100px">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>    
                                        <option value="5000">Show all</option>
                                    </select>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="breadcrumbs-area clearfix">
                                <select class="form-control" style="margin-top: 4%; width: 80%;margin-left: 10%;" id="company" name="company">
                                    <option value="" selected> Select Company... </option>
                                        @foreach ($timezone as $time)
                                            <option value="{{$time->id}}">{{$time->name}}</option>
                                        @endforeach
                                </select>
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
                                <th>{{__("name")}}</th>
                                <th>{{__("email")}}</th>
                                <th>{{__("logo")}}</th>
                                <th>created_by_id</th>
                                <th>updated_by_id</th>
                                <th>created_at</th>
                                <th style="text-align: center">{{__("action")}}</th>
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
                                <td>{{$item->logo}}
                                    {{-- <img src="{{ url('/img_company/'.$item->logo) }}" alt="" style="width: 70px; height: 70px;"> --}}
                                </td>
                                <td>{{$item->created_by_id}}</td>
                                <td>{{$item->updated_by_id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td style="text-align: center">
                                    <a href="/upload/delate_company/{{ $item->id }}" style="color: #495057"><i class="fas fa-trash fa-lg icn-dlt"></i></a>
                                    <a data-toggle="modal" data-target="#editModal-{{$item->id}}" href="" style="color: #495057"><i class="fas fa-edit fa-lg icn-edt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <nav>
                            <ul class="pagination">
                                <li class="prev"><a href="#" id="prev">&#139;</a></li>
                                <li class="next"><a href="#" id="next">&#155;</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                {{--  {{ $company->links() }}  --}}
                
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

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            
            <script>            
                let tbody=document.querySelector('tbody');
                let tr=tbody.getElementsByTagName('tr');
                let select=document.querySelector('select')
                let ul=document.querySelector('.pagination');

                let arrayTr=[];

                for (let i = 0; i < tr.length; i++) {
                arrayTr.push(tr[i]);
                }
                select.onchange=rowCount;
                function rowCount(e) {
                let neil= ul.querySelectorAll('.list');
                neil.forEach(n=>n.remove());
                let limit= parseInt(e.target.value);
                displayPage(limit);
                }
                function displayPage(limit) {
                tbody.innerHTML='';
                for (let i = 0; i < limit; i++) {
                    tbody.appendChild(arrayTr[i]);
                }
                buttonGenerator(limit);
                }
                displayPage(5);

                function buttonGenerator(limit) {
                    const nofTr=arrayTr.length;
                    if (nofTr<limit) {
                      ul.style.display='none';
                    }else{
                      ul.style.display='flex';
                      const nofPage=Math.ceil(nofTr/limit);
                      for (i = 1; i <= nofPage; i++) {
                        let li=document.createElement('li');
                        li.className='list';
                        let a=document.createElement('a');
                        a.className='page-link';
                        a.href='#';
                        a.setAttribute('data-page',i);
                        li.appendChild(a);
                        a.innerText=i;
                        ul.insertBefore(li,ul.querySelector('.next'));
                        a.onclick=e=>{
                          let x = e.target.getAttribute('data-page');
                          tbody.innerHTML='';
                          x--;
                          let start=limit*x;
                          let end = start+limit;
                          let page=arrayTr.slice(start,end);
                          for (let i = 0; i < page.length; i++) {
                            let item= page[i];
                            tbody.appendChild(item);
                          }
                        }
                        //
                      }
                    }
                    let z=0;
                    function nextElement() {
                  
                      if (this.id=='next') {
                        z == arrayTr.length - limit ? (z=0) : (z+=limit);
                      }
                      if (this.id=='prev') {
                        z == 0 ? arrayTr.length - limit : (z-=limit);
                      }
                      tbody.innerHTML='';
                      for ( let c = z; c< z+limit; c++) {
                        tbody.appendChild(arrayTr[c]);
                      }
                    }
                    document.getElementById('prev').onclick=nextElement;
                    document.getElementById('next').onclick=nextElement;
                  }
            </script>
    </body>
@stop
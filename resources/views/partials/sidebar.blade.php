<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script> 
    
    {{--  datatables  --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
    <body>
        <div class="page-container">
            {{--  SIDEBAR  --}}
                <div class="sidebar-menu">
                    <div class="sidebar-header">
                        <div class="logo">
                            <a href="#"><img src="{{asset('images/sidebar-logo.png')}}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="main-menu">
                        <div class="menu-inner">
                            <nav>
                                <ul class="metismenu" id="menu">
                                    <li>
                                        <a href="{{('home')}}" aria-expanded="true"><i class="ti-dashboard"></i><span>Companies</span></a>
                                    </li>
                                    <li>
                                        <a href="{{('employe')}}" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Employees</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            {{--  END SIDEBAR  --}}
                
            {{--  CONTENT  --}}
                @yield('content')
            {{--  END CONTENT  --}}

            <footer>
                <div class="footer-area">
                    
                </div>
            </footer>
        </div>

            {{--  script  --}}
        <div>
            <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
            {{--  disable/enable pageination  --}}
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#dtBasicExample').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    "sPagingType": "simple_numbers",
                    "lengthMenu": [ 10 , 15 , 30, ],
                    {{-- "order": [[ 2, "desc" ]] --}}
                    });
                    $('.dataTables_length').addClass('bs-select');
                });
            </script>
            <!-- bootstrap 4 js -->
            <script src="{{asset('js/popper.min.js')}}"></script>
            {{--  <script src="{{asset('js/bootstrap.min.js')}}"></script>  --}}
            <!-- all pie chart -->
            {{--  <script src="{{asset('js/pie-chart.js')}}"></script>  --}}
            <!-- others plugins -->
            <script src="{{asset('js/plugins.js')}}"></script>
            <script src="{{asset('js/scripts.js')}}"></script>
        </div>
    </body>
</html>
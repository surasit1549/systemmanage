<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @include('sweetalert::alert')
    @yield('tabbarcss')
    <title>HOME</title>
    <!-- ICON TITLE -->
    <link rel="icon" type="image/png" href="http://example.com/myicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
    <script src="{{asset('js/app.js')}}"></script>
    <!-- Auto Complete -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="{{asset('js/jquery.mockjax.js')}}"></script>
    <script src="{{asset('js/jquery.autocomplete.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/55a3f2f61c.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>



<body style="background-color:#f1f1f1;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <img class="siderbar-header" style="width:250px" src="{{asset('pic/logo1.png')}}" alt="">
            <ul class="list-unstyled components">
                @if( Auth::user()->role >= 3 && Auth::user()->role <= 5 ) <li>
                    <a href="{{route('mycompany.index')}}" id="teratab">
                        <i style="font-size:20px" class="fas fa-home"></i>&nbsp;&nbsp;
                        บริษัท ธีร่า แอสเสท
                    </a>
                    </li>
                    @endif
                    @if( Auth::user()->role != 1 )
                    <li>
                        <a href="{{route('store.index')}}" id="storetab">
                            <i style="font-size:20px" class="fas fa-store-alt"></i>&nbsp;&nbsp;
                            ร้านค้า
                        </a>
                    </li>
                    <li>
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="checkmenu"><i style="font-size:20px" class="far fa-file-alt"></i>
                            &nbsp;&nbsp;การจัดการสินค้า</a>
                        <ul class="collapse list-unstyled" id="menu">
                            <li>
                                <a id="store_menutab" href="{{route('Product.index')}}">รายการสินค้า</a>
                            </li>
                            <li>
                                <a id="manage_store_manutab" href="{{route('Product_Price.index')}}">จัดการราคาสินค้า</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('transform.index')}}" id="transformtab">
                            <i style="font-size:20px" class="fas fa-map"></i>
                            &nbsp;&nbsp;แปลง</a>
                    </li>
                    @endif
                    @if( Auth::user()->role == 1 || Auth::user()->role == 5 )
                    <li>
                        <a href="{{route('pr_create.index')}}" id="constructtab">
                            <i style="font-size:20px" class="far fa-file-alt"></i>
                            &nbsp;&nbsp;ใบขอสั่งซื้อ</a>
                    </li>
                    @endif
                    @if( Auth::user()->role != 1 )
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="prpo_form"><i style="font-size:20px" class="far fa-file-alt"></i>
                            &nbsp;&nbsp;รายละเอียดการสั่งซื้อ</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a id="prtab" href="{{route('prequest.index')}}">ใบขอสั่งซื้อสินค้า ( PR )</a>
                            </li>
                            <li>
                                <a id="potab" href="{{route('porder.index')}}">ใบสั่งซื้อสินค้า ( PO )</a>
                            </li>
                            <li>
                                <a id="checktab" href="{{route('check.index')}}">ตรวจสอบรายการสินค้า </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if( Auth::user()->role == 5)
                    <li>
                        <a href="{{route('Authorized_person1.index')}}" id="person1">
                            <i style="font-size:20px" class="fas fa-list"></i>
                            &nbsp;&nbsp;ตรวจสอบรายการขอสั่งซื้อ</a>
                    </li>
                    @endif
                    @if( Auth::user()->role == 3)
                    <li>
                        <a href="{{route('Authorized_person1.index')}}" id="person1">
                            <i style="font-size:20px" class="fas fa-list"></i>
                            &nbsp;&nbsp;ตรวจสอบรายการขอสั่งซื้อ</a>
                    </li>
                    @endif
                    @if( Auth::user()->role == 4)
                    <li>
                        <a href="{{route('Authorized_person2.index')}}" id="person2">
                            <i style="font-size:20px" class="fas fa-list"></i>
                            &nbsp;&nbsp;ตรวจสอบรายการขอสั่งซื้อ</a>
                    </li>
                    @endif
                    @if( Auth::user()->role == 5 )
                    <li>
                        <a href="{{route('usermanage.index')}}" id="usertab"><i style="font-size:20px" class="far fa-user"></i>&nbsp;&nbsp;จัดการผู้ใช้งาน</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('profile.index')}}" id="user_profile">
                            <i style="font-size:20px" class="far fa-address-card"></i>
                            &nbsp;&nbsp;ข้อมูลผู้ใช้งาน
                        </a>
                    </li>
                    <li>
                        <a href="/logout" id="exit">
                            <i style="font-size:20px" class="fas fa-sign-out-alt"></i>
                            &nbsp;&nbsp;ออกจากระบบ
                        </a>
                    </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info text-white">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <h5>{{ Auth::user()->firstname }}&nbsp;&nbsp;{{ Auth::user()->lastname }}</h5>
                </div>
            </nav>
            <div>
                @yield('content')
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            var textcontent = '<ul class="nav flex-column">' +
                '<li class="nav-item"><a class="nav-link" href="#"><i style="font-size:15px" class="fas fa-key"></i>&nbsp;&nbsp;เปลี่ยนรหัสผ่าน</a></li>' +
                '<li class="nav-item"><a class="nav-link" href="#"><i style="font-size:15px" class="far fa-id-badge"></i>&nbsp;&nbsp;แก้ไขข้อมูลส่วนตัว</a></li>' +
                '<li class="nav-item"><a class="nav-link" href="#"><i style="font-size:15px" class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;ออกจากระบบ</a></li>' +
                '</ul>';
            $('[data-toggle="popover"]').popover({
                trigger: 'focus',
                placement: 'bottom',
                content: textcontent,
                html: true,
                title: 'สวัสดี ! ณัฐดนัย',
                template: '<div class="popover" role="tooltip" style="font-size:14px"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div><div class="popover-footer text-right"><a href="#">ข้อกำหนดรายละเอียดการใช้งาน</a></div></div>'
            });
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>

</body>

</html>
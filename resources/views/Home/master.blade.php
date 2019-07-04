<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <style>
      header{
        background-color: #666;
        padding: 15px;
        text-align: left;
        font-size: 40px;
        color: yellow;
      }
      section {
        float: left;
        background-color: #ccc;
        padding-left: 30px;
        height: 550px;
        padding: 30px;
      }

    </style>
  </head>
  <body>

    <header class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">KENGJA</a>
    </header>
    <div class="row">
      <nav class="col-md-2 border">
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link" href="{{route('store.index')}}">ร้านค้า</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('transform.index')}}">แปลง</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('prequest.create')}}">ใบขอสั่งซื้อ PR</a></li>
        </ul>
      </nav>
        <div class="col-md-10">
          @yield('content')
        </div>
    </div>
      </body>
  <footer>@yield('footer')</footer>
</html>

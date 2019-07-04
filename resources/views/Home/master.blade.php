<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
    <header>
      <h1>
        Index
      </h1>
    </header>
    <section>
      <ul>
        <li><a href="{{route('store.index')}}">ร้านค้า</a></li>
        <li><a href="{{route('transform.index')}}">แปลง</a></li>
        <li><a href="{{route('prequest.create')}}">ใบขอสั่งซื้อ PR</a></li>
      </ul>
    </section>
      @yield('content')
      </body>
  <footer>@yield('footer')</footer>
</html>

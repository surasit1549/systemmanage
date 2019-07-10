@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {

    $('#iconsearch').click(function() {
      var check = $('#searchform');
      if (check.hasClass('d-none'))
        check.removeClass('d-none');
      else
        check.addClass('d-none');
      $('#searchtext').focus();
    });

    $('#searchtext').keyup(function() {
      $('table tbody tr').filter(function() {
        var existname = $(this).find('.schtext').text().toLowerCase();
        var search = $('#searchtext').val().toLowerCase();
        $(this).toggle(existname.indexOf(search) > -1);
      });
    });
  })
</script>
<div class="container">
  @if(\Session::has('success'))
  <div class="alert alert-success">
    <a>{{\Session::get('success')}}</a>
  </div>
  @endif
  <div class="card">
    <div class="card-header text-white" style="background:#435d7d">
      <div class="row">
        <div class="col-md-9">
          <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;ใบขอสั่งชื้อ (Puchase Request)</h3>
        </div>
        <div class="col-md-3 text-right">
          <a href="#" id="iconsearch"><i style="font-size:18px" class="fas fa-search text-white"></i></a>
          &nbsp;&nbsp;
          <a class="btn btn-success text-white text-right" href="{{route('prequest.create')}}">
            <i class="fas fa-plus"></i>
            สร้างใบขอสั่งชื้อ
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="input-group d-none" id="searchform">
        <div class="input-group-prepend">
          <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" id="searchtext" class="form-control" placeholder="กรอกชื่อเลขที่เอกสารที่ต้องการค้นหา..">
      </div>
      <br>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อเลขที่เอกสาร</th>
            <th>วันที่ขอสั่งซื้อ</th>
            <th>แปลง</th>
            <th>แก้ไขข้อมูล</th>
            <th>ลบ</th>
            <th>พิมพ์</th>
          </tr>
        </thead>
        <tbody>
          @foreach($prequestdb as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td class="schtext">{{$row['keyPR']}}</td>
            <td>{{$row['date']}}</td>
            <td>{{$row['prequestconvert']}}</td>
            <td><a href="{{action('PuchaserequestController@edit',$row['id'])}}" class="btn btn-sm btn-primary">Edit</a></td>
            <td>
              <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row['id'])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
            <td><a href="{{action('PuchaserequestController@show',$row['id'])}}" class="btn btn-primary btn-sm">Show</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
@stop
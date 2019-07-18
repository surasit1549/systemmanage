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

    $('[data-toggle="tooltip"]').tooltip();
    $('.test').click(function() {
      $(this).next('form').submit();
    });

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
      </div>
    </div>
    <div class="card-body">
      <div class="text-right">
        <a href="#" id="iconsearch"><i style="font-size:20px" class="fas fa-search"></i></a>
        &nbsp;&nbsp;
        <a class="btn btn-success text-white text-right" href="{{route('prequest.create')}}">
          <i class="fas fa-plus"></i>
          สร้างใบขอสั่งชื้อ
        </a>
      </div>
      <div class="input-group d-none mt-3" id="searchform">
        <div class="input-group-prepend">
          <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" id="searchtext" class="form-control" placeholder="กรอกชื่อเลขที่เอกสารที่ต้องการค้นหา..">
      </div>
      <br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width:5%">ลำดับ</th>
            <th style="width:15%">วันที่ขอสั่งซื้อ</th>
            <th style="width:30%">ชื่อเลขที่เอกสาร</th>
            <th style="width:15%">ร้านค้า</th>
            <th colspan="3">จัดการ</th>
          </tr>
        </thead>
        <tbody>
          @foreach($prequestdb as $row)
          <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['date']}}</td>
            <td class="schtext">{{$row['keyPR']}}</td>
            <td>{{$row['keystore']}}</td>
            <td colspan="3">
              <a href="{{action('PuchaserequestController@show',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
              &nbsp;&nbsp;
              <a href="{{action('PuchaserequestController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
              &nbsp;&nbsp;
              <a href="#" data-toggle="tooltip" data-placement="top" title="Print"><i style="font-size:20px;" class="fas fa-print"></i></a>
              &nbsp;&nbsp;
              <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
              <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row['id'])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
              </form>
            </td>
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
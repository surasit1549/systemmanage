@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $('#prtable').DataTable();
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
@if(\Session::has('success'))
<div class="alert alert-success">
  <a>{{\Session::get('success')}}</a>
</div>
@endif




<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('prequest.create')}}">
      <i class="fas fa-plus"></i>
      สร้างใบขอสั่งซื้อ
    </a>
  </div>
  <div class="form-group ml-2">
    <a class="btn btn-sm btn-primary text-white" href="#">
      <i class="fas fa-info-circle"></i>
      รายละเอียดการใช้งาน
    </a>
  </div>
</div>

<div class="card">
  <div class="card-header text-white">
    <div class="row">
      <div class="col-md-9">
        <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;ใบขอสั่งชื้อ (Puchase Request)</h3>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="prtable">
      <thead>
        <tr>
          <th style="width:5%">ลำดับ</th>
          <th style="width:15%">วันที่ขอซื้อ</th>
          <th style="width:30%">ชื่อเลขที่เอกสาร</th>
          <th cols="3">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($prequestdb as $row)
        <tr>
          <td>{{$number++}}</td>
          <td>{{$row['date']}}</td>
          <td class="schtext">{{$row['keyPR']}}</td>
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
@stop
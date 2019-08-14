@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #constructtab {
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

  })
</script>
@if(\Session::has('success'))
<div class="alert alert-success">
  <a>{{\Session::get('success')}}</a>
</div>
@endif


<div class="form-row col-md-12">
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('pr_create.create')}}">
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
        <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;การสั่งชื้อผู้รับเหมา</h3>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="prtable">
      <thead>
        <tr>
          <th style="width:5%">ลำดับ</th>
          <th style="width:10%">วันที่ขอซื้อ</th>
          <th style="width:20%">แบบงาน</th>
          <th style="width:15%">แปลง</th>
          <th style="width:15%">ผู้รับเหมา</th>
          <th style="width:20%">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(empty($pr_create))
        @foreach($pr_create as $row)
        <tr>
          <td>{{$number++}}</td>
          <td>{{$row['date']}}</td>
          <td>{{$row['formwork']}}</td>
          <td>{{$row['prequestconvert']}}</td>
          <td>{{$row['contractor']}}</td>
          <td>

          </td>
        </tr>
        @endforeach
        @else
        @foreach($pr_products as $row)
        <tr>
          <td>{{$number++}}</td>
          <td>{{$row[1]}}</td>
          <td>{{$row[3]}}</td>
          <td>{{$row[4]}}</td>
          <td>{{$row[2]}}</td>
          <td>
            <a href="#" data-placement="top" data-toggle="tooltip" title="View"><i style="font-size:20px;color:blue" class="fas fa-eye"></i></a>
            <a class="ml-3" data-placement="top" data-toggle="tooltip" title="Status" href="#"><i style="font-size:20px;color:seagreen" class="far fa-paper-plane"></i></a>
            <a class="ml-3" data-placement="top" data-toggle="tooltip" title="PDF" href="#"><i style="font-size:20px"  class="fas fa-file-pdf text-danger"></i></a>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@stop
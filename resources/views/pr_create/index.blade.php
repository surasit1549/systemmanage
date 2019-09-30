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
    $('#prtable').DataTable({
      'order': [
        [1, 'desc']
      ],
      'columnDefs': [{
        'targets': 5,
        'orderable': false
      }],
      "oLanguage": {
        "sSearch": 'ค้นหา',
        "sInfo": 'จำนวนรายการสั่งซื้อ _TOTAL_ รายการ',
        'sEmptyTable': 'ไม่มีข้อมูลการสั่งซื้อ',
        'sInfoEmpty': 'ไม่พบรายการสั่งซื้อ',
        'sZeroRecords': 'ไม่พบคำที่ต้องการค้นหา',
        "oPaginate": {
          "sPrevious": 'ก่อนหน้า',
          "sNext": 'ถัดไป'
        },
        "sInfoFiltered": '( จากทั้งหมด _MAX_ รายการ )',
        "sLengthMenu": 'แสดงข้อมูล <select class="custom-select custom-select-sm">' +
          '<option value="10">10</option>' +
          '<option value="30">30</option>' +
          '<option value="50">50</option>' +
          '<option value="-1">ทั้งหมด</option>' +
          '</select> รายการ'

      }
    });
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
    <table cellspacing="0" width="100%" class="table table-bordered display responsive nowrap" id="prtable">
      <thead>
        <tr>
          <th style="width:15%">เลขที่ใบขอซื้อ</th>
          <th style="width:15%">วันที่ขอซื้อ</th>
          <th style="width:25%">แบบงาน</th>
          <th style="width:15%">แปลง</th>
          <th style="width:15%">กำลังดำเนินการ</th>
          <th style="width:15%">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(empty($pr_create))
        @else
        @foreach($pr_products as $row)
        <tr>
          <td>{{$row[5]}}</td>
          <td>{{$row[1]}}</td>
          <td>{{$row[3]}}</td>
          <td>{{$row[4]}}</td>
          <td>
            @if( $row[6] == '0' )
            <button class="btn btn-sm btn-primary">ฝ่ายจัดซื้อ</button>
            @elseif( $row[6] == '1' )
            <button class="btn btn-sm btn-warning">ผู้มีอำนาจ 1</button>
            @elseif( $row[6] == '2' )
            <button class="btn btn-sm btn-danger">ผู้มีอำนาจ 2</button>
            @elseif( $row[6] == '3' )
            <button class="btn btn-sm btn-success">เสร็จสมบูรณ์</button>
            @endif
          </td>
          <td>
            <a class="btn btn-sm btn-info text-white" href="{{action('pr_createController@show',$row[0])}}" data-placement="top">ข้อมูลเพิ่มเติม</a>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@stop
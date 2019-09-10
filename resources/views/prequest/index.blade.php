@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
@stop
@section('content')
<script>
  $(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $('#prtable').DataTable({
      'columnDefs': [{
        'orderable': false,
        'targets': 6
      }],
      "oLanguage": {
        "sSearch": 'ค้นหา',
        "sInfo": 'ใบสั่งซื้อทั้งหมด _TOTAL_ รายการ',
        'sEmptyTable': 'ไม่มีข้อมูลใบขอสั่งซื้อ',
        'sInfoEmpty': 'ไม่พบรายการขอสั่งซื้อ',
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
    <table cellspacing="0" width="100%" class="table table-bordered display responsive nowrap" id="prtable">
      <thead>
        <tr>
          <th>&nbsp;&nbsp;เลขที่เอกสาร</th>
          <th>วันที่ขอซื้อ</th>
          <th>ผู้รับเหมา</th>
          <th>แบบงาน</th>
          <th>แปลง</th>
          <th>สถานะ</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(empty($pr_create))
        @else
        @foreach($PR_creates as $row)
        <tr>
          <td>&nbsp;&nbsp;{{$row[1]}}</td>
          <td>{{$row[2]}}</td>
          <td>{{$row[3]}}</td>
          <td>{{$row[4]}}</td>
          <td>{{$row[5]}}</td>
          <td>{{$status}}</td>
          <td>
            &nbsp;&nbsp;
            <a href="{{action('PuchaserequestController@edit',$row[0])}}" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            @if($status === 'สมบูรณ์')
            <a href="{{action('PuchaserequestController@show',$row[0])}}" data-toggle="tooltip" data-placement="top" title="PDF"><i style="font-size:20px" class="text-danger fas fa-file-pdf"></i></a>
            @endif
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="ยกเลิกใบขอซื้อ"><i style="font-size:20px;" class="text-danger fas fa-times-circle"></i></a>
            <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row[0])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@stop
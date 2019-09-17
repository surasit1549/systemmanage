@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #person2 {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
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
  });
</script>

@if(\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show">
  <a><i class="fas fa-check"></i>&nbsp;&nbsp;{{\Session::get('success')}}</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
  <div class="card-header">
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;ผู้มีอำนาจคนที่ 2</h3>
  </div>
  <div class="card-body">

    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th style="width:20%;">เลขที่ใบขอสั่งซื้อ</th>
          <th style="width:20%;">วัน/เดือน/ปี</th>
          <th style="width:30%;">แบบงาน</th>
          <th style="width:15%;">แปลง</th>
          <th style="width:15%;">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$row['keyPR']}}</td>
          <td>{{$row['date']}}</td>
          <td>{{$row['formwork']}}</td>
          <td>{{$row['prequestconvert']}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('mastertwoController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('mastertwoController@destroy',$row['id'])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        'columnDefs': [{
          'orderable': false,
          'targets': 4
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
    });
  </script>
  @stop
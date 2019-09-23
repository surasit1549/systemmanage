@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #transformtab {
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
  <div class="form-group">
    <a class="btn btn-sm btn-success text-white" href="{{route('transform.create')}}">
      <i class="fas fa-plus"></i>
      สร้างแปลง
    </a>
  </div>
</div>


<div class="card">
  <div class="card-header">
    <h3 class="text-white"><i class="fas fa-map"></i>&nbsp;&nbsp;แปลง</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th style="width:30%;">ชื่อแปลง</th>
          <th style="width:40%;">ขนาด ( ตารางวา )</th>
          <th style="width:30%;">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transform as $row)
        <tr>
          <td>{{$row['convertname']}}</td>
          <td>{{$row['size']}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('TransformController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
            &nbsp;&nbsp;
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('TransformController@destroy',$row['id'])}}">
              @csrf
              <input type="hidden" name="convertname" value="{{$row['convertname']}}">
              <input type="hidden" name="_method" value="DELETE" />
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        'columnDefs' : [
          { 'orderable' : false , 'targets' : 2 }
        ]
        ,
        "oLanguage": {
          "sSearch": 'ค้นหา',
          "sInfo": 'แปลงทั้งหมดจำนวน _TOTAL_ รายการ',
          'sEmptyTable': 'ไม่มีข้อมูลแปลง',
          'sInfoEmpty': 'ไม่พบรายการที่ต้องการ',
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
@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #product_menu {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }
</style>
<style>
  #person1 {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }

  #master {
    padding: 1%;
  }

  #a1 {
    position: absolute;
    color: black;
    border: 1px solid black;
    width: 150px;
    height: 50px;
    padding: 1%;
    left: 20px;
    text-align: center;
  }

  #a2 {
    position: absolute;
    color: white;
    border: 1px solid black;
    background: #4A708B;
    top: 73px;
    width: 150px;
    height: 50px;
    padding: 1%;
    left: 170px;
    text-align: center;
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {

    $('#master_menu').click();

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

<div class="card">
  <div class="card-header">
    <h3 class="text-white"><i style="font-size:20px" class="fas fa-list"></i>&nbsp;&nbsp;ตรวจสอบรายการใบขอสั่งซื้อ</h3>
  </div>
  @if( Auth::user()->role == 'แอดมิน')
  <div id="master">
    <p><b><a id="a1" href="{{route('Authorized_person1.index')}}">ผู้มีอำนาจคนที่ 1</a></b></p>
    <p><b><a id="a2" href="{{route('Authorized_person2.index')}}">ผู้มีอำนาจคนที่ 2</a></b></p>
  </div><br>
  @endif
  <div class="card-body">
    <table class="table table-bordered display responsive nowrap" cellspacing="0" width="100%" id="example">
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
        @if(empty($master))
        @else
        @foreach($datas as $row)
        <tr>
          <td>{{$row[1]}}</td>
          <td>{{$row[2]}}</td>
          <td>{{$row[3]}}</td>
          <td>{{$row[4]}}</td>
          <td>
            @if($row[6] === "ตรวจสอบ")
            &nbsp;&nbsp;<a href="{{action('masteroneController@edit',$row[1])}}" data-toggle="tooltip" data-placement="top" title="Check"><i style="font-size:20px" class="fas fa-pen-alt"></i></a>
            &nbsp;&nbsp;
            @endif
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Rejected"><i style="font-size:20px" class="fas fa-ban text-danger"></i></a>
            <form method="post" class="delete_form" action="{{action('masteroneController@destroy',$row[0])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
        </tr>
        @endforeach
        @endif
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
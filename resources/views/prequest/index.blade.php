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

    $('#prpo_form').click();

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

    $('#denyprequest').click(function(e) {
      e.stopPropagation();
      e.preventDefault();
      var form = $(this).parent('form');
      var bill = $(this).parents().eq(3).find('td:first').text();
      Swal.fire({
        type: 'question',
        title: 'ต้องการยกเลิกบิล<br>' + bill,
        text: 'เมื่อบิลถูกยกเลิกแล้วจะไม่สามารถนำกลับมาได้',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        showCancelButton: true,
        focusCancel: true,
      }).then((result) => {
        if (result.value) {
          form.submit();
        }
      });
    });


  })
</script>
@if(\Session::has('success'))
<div class="alert alert-success">
  <a>{{\Session::get('success')}}</a>
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
  <i style="font-size:20px" class="fas fa-check-circle"></i>&nbsp;&nbsp;{{ session('status') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

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
          <td>
            @if( $row[6] == 'เสร็จสมบูรณ์' )
            <button class="btn btn-success btn-sm"><i class="fas fa-check"></i>&nbsp;&nbsp;เสร็จสมบูรณ์</button>
            @elseif( $row[6] == 'รอการตรวจสอบ')
            <button class="btn btn-primary btn-sm text-white"><i class="fas fa-spin fa-spinner"></i>&nbsp;&nbsp;รอการตรวจสอบ</button>
            @elseif( $row[6] == 'อยู่ระหว่างดำเนินการ')
            <button class="btn btn-warning btn-sm"><i class="fas fa-running"></i>&nbsp;&nbsp;อยู่ระหว่างดำเนินการ</button>
            @elseif( $row[6] == 'ถูกยกเลิก')
            <button class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&nbsp;&nbsp;ถูกยกเลิก</button>
            @endif
          </td>
          <td>
            <div class="row">
              @if(empty($row[7]))
              <a href="{{action('PuchaserequestController@edit',$row[0])}}" class="btn btn-sm btn-info ml-2"><i style="font-size:20px" class="fas fa-spell-check text-info"></i>&nbsp;&nbsp;ตรวจสอบ</a>
              @endif
              @if($row[6] === "เสร็จสมบูรณ์" )
              <a href="{{action('PuchaserequestController@show',$row[1])}}" class="btn btn-sm btn-danger ml-2"><i style="font-size:20px" class="fas fa-file-pdf"></i>&nbsp;&nbsp;PDF</a>
              @endif
              <form action="prequest/closePR" method="post">
                @csrf
                <input type="hidden" name="pr" value="{{$row[1]}}">
                <button class="test btn btn-sm btn-secondary ml-2" id="denyprequest" href="#"><i style="font-size:20px" class="fas fa-window-close"></i>&nbsp;&nbsp;ยกเลิก</button>
              </form>
              <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row[1])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@stop
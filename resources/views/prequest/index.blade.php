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

    $('#main_table').DataTable({

      'order' : [
        [1,'desc']
      ],

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
      $('#passcode_confirm').find('#trythis').val($(this).data('id'));
    });


    $('#passcode_confirm').on('shown.bs.modal', function() {
      $(this).find('input[name=passkey]').focus();
    }).on('hidden.bs.modal', function() {
      $(this).find('input[name=passkey]').val();
    });

    $('#sub_confirm').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      var id = $(this).prev('input[type=hidden]').val();
      $.ajax({
        type: 'POST',
        url: 'Product/checkpasscode',
        data: {
          _token: '{{csrf_token()}}',
          passkey: $('input[name=passkey]').val()
        },
        success: function(data) {
          if (data.msg) {
            $('#main_table').find('a[data-id=' + id + ']').parent().next('form').submit();
          } else {
            Swal.fire({
              type: 'error',
              title: 'รหัสลับไม่ถูกต้อง',
              text: 'กรอกรหัสลับอีกครั้ง',
              confirmButtonText: 'ตกลง',
              onAfterClose: () => {
                $('input[name=passkey]').val('').focus();
              }
            })
          }
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
    <table cellspacing="0" width="100%" class="table table-bordered display responsive nowrap" id="main_table">
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
              @if($row[8][0]['status'] != "Rejected")
              @if(empty($row[7]))
              <a href="{{action('PuchaserequestController@edit',$row[0])}}" class="btn btn-sm btn-info ml-2 text-white"><i class="fas fa-spell-check"></i>&nbsp;&nbsp;ตรวจสอบ</a>
              @endif
              @if($row[6] === "เสร็จสมบูรณ์" )
              <a href="{{action('PuchaserequestController@show',$row[1])}}" class="btn btn-sm btn-danger ml-2"><i style="font-size:20px" class="fas fa-file-pdf"></i>&nbsp;&nbsp;PDF</a>
              @endif
              @if($row[6] != "เสร็จสมบูรณ์")
              <span data-toggle="tooltip" data-placement="top" title="ยกเลิก">
                <a class="test btn btn-sm btn-secondary ml-2" href="#" data-id="{{$row[0]}}" data-toggle="modal" data-target="#passcode_confirm"><i class="fas fa-times"></i>&nbsp;&nbsp;ยกเลิก</a>
              </span>
              <form action="prequest/closePR" method="post">
                @csrf
                <input type="hidden" name="pr" value="{{$row[1]}}">
              </form>
              @endif
              @else
              <a href="{{action('PuchaserequestController@edit',$row[0])}}" class="btn btn-sm btn-danger ml-2"><i style="font-size:20px" class="fas fa-file-pdf"></i>&nbsp;&nbsp;ข้อมูล</a>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="passcode_confirm">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5><i style="font-size:20px" class="fas fa-key mr-2 text-danger"></i>กรอกรหัสลับ</h5>
        <button data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'checkpasscode']) !!}
        <div class="form-group">
          {!! Form::label('รหัสลับ') !!}
          {!! Form::password('passkey',['class' => 'form-control','maxlength' => 4]) !!}
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="trythis">
        {!! Form::submit('ยืนยัน',['class' => 'btn btn-success','id' => 'sub_confirm']) !!}
        <a class="btn btn-secondary" data-dismiss="modal" href="#">ยกเลิก</a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


@stop
@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #manage_product_manu {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }

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
    color: white;
    border: 0.5px solid black;
    background: #4A708B;
    text-shadow: 2px 2px 4px #000000;
    font-size: 18px;
    width: 150px;
    height: 50px;
    padding: 1%;
    right: 0px;
    top: 63px;
    text-align: center;
  }

  #a2 {
    position: absolute;
    color: black;
    text-shadow: 2px 2px 4px #000000;
    font-size: 25px;
    top: 73px;
    width: 200px;
    height: 50px;
    padding: 1%;
    left: 15px;
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
  @if( Auth::user()->role == '5')
  <div class="list-group list-group-horizontal">
    <a class="list-group-item list-group-item-action text-center" href="{{route('Authorized_person1.index')}}">
      <h3>ผู้มีอำนาจคนที่ 1</h3>
    </a>
    <a class="list-group-item list-group-item-action text-danger text-center" href="#">
      <h3>ผู้มีอำนาจคนที่ 2</h3>
    </a>
  </div>

  @endif
  <div class="card-body">
    <table class="table table-bordered" id="main_table">
      <thead>
        <tr>
          <th style="width:20%;">เลขที่ใบขอสั่งซื้อ</th>
          <th style="width:20%;">วัน/เดือน/ปี</th>
          <th style="width:15%;">แบบงาน</th>
          <th style="width:15%;">แปลง</th>
          <th style="width:15%;">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(empty($data))
        @else
        @foreach($datas as $index=>$row)
        <tr>
          <td>{{$row[2]}}</td>
          <td>{{$row[3]}}</td>
          <td>{{$row[4]}}</td>
          <td>{{$row[5]}}</td>

          <td>
            <a class="text-info" href="{{action('mastertwoController@show',$row[2])}}" data-toggle="tooltip" data-placement="top" title="show"><i style="font-size:20px" class="fas fa-eye"></i></a>
            @if($row[7] === "ตรวจสอบ")
            &nbsp;&nbsp;<a href="{{action('mastertwoController@edit',$row[2])}}" data-toggle="tooltip" data-placement="top" title="Check"><i style="font-size:20px" class="fas fa-marker"></i></a>
            &nbsp;&nbsp;
            <span data-toggle="tooltip" data-placement="top" title="Rejected">
              <a class="test" href="#" data-id="{{$row[0]}}" data-toggle="modal" data-target="#passcode_confirm"><i style="font-size:20px" class="fas fa-ban text-danger"></i></a>
            </span>
            <form method="post" class="delete_form" action="{{action('mastertwoController@destroy',$row[2])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
            </form>
            @endif
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
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



  <script>
    $(document).ready(function() {
      $('#main_table').DataTable({
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
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
    <table class="table table-bordered" id="main_table">
      <thead>
        <tr>
          <th style="width:30%;">ชื่อแปลง</th>
          <th style="width:40%;">ประเภทบ้าน</th>
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
            <span data-toggle="tooltip" data-placement="top" title="Remove">
              <a class="test" data-id="{{$row['id']}}" href="#" data-toggle="modal" data-target="#passcode_confirm"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            </span>
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
          'targets': 2
        }],
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
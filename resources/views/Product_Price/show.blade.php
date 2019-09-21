@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<script>
  $(document).ready(function() {

    $('[data-toggle=tooltip]').tooltip();

    $('.test').click(function() {
      $(this).next('form').submit();
    });

    $('#thisone').DataTable({
      "oLanguage": {
        "sSearch": 'ค้นหา',
        'sLengthMenu': 'แสดง <select class="custom-select custom-select-sm">' +
          '<option value="10">10</option>' +
          '<option value="30">30</option>' +
          '<option value="50">50</option>' +
          '<option value="-1">ทั้งหมด</option>' +
          '</select> แถว',
        "sInfo": 'จำนวนสินค้าทั้งหมด _TOTAL_ รายการ',
        'sEmptyTable': 'ไม่มีข้อมูลสินค้า',
        'sInfoEmpty': 'ไม่พบรายการสินค้า',
        'sZeroRecords': 'ไม่พบคำที่ต้องการค้นหา',
        'oPaginate': {
          'sPrevious': 'ก่อนหน้า',
          'sNext': 'ถัดไป'
        }
      }
    });

  });
</script>
<div class="row mb-2">
  <div class="col-form-label col-md-6">
    <h4 class="d-inline shadow-sm bg-light" style="padding:10px"><label class="text-danger">&nbsp;ร้านค้า {{$data[0]['name']}}</label></h4>
  </div>
</div>
<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
  </div>
  <div class="card-body">
    <table id="thisone" class="table table-hover table-bordered">
      <thead class="text-center">
        <tr>
          <th>ลำดับที่</th>
          <th>รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>ราคาสินค้า (บาท)</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$number++}}</td>
          <td>{{$row['Product']}}</td>
          <td>{{$row['Product_name']}}</td>
          <td>{{$row['Price']}}</td>
          <td>
            &nbsp;&nbsp;<a href="{{action('ProductPriceController@edit',$row['Cat_ID'])}}" data-toggle="tooltip" data-placement="top" title="อัพเดท"><i style="font-size:20px" class="text-info fas fa-file-signature"></i></a>
            <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
            <form method="post" class="delete_form" action="/Product_Price/deletename">
              {{csrf_field()}}
              <input type="hidden" name="Cat_ID" value="{{$row['Cat_ID']}}">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <br>
    <div class="text-center">
      <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
    </div>
  </div>
</div>

@endsection
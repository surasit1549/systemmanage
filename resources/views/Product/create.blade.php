@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('content')
<div class="container">
  <div class="card" style="width:25rem">
    <div class="card-header">
      <h3 class="text-white card-title"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เพิ่มข้อมูลสินค้า</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url('Product')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">รหัสสินค้า</label>
          <input id="disabletext" style="background-color:#f1f1f1;cursor:no-drop" type="text" name="Product_ID" class="form-control" value="{{$key}}" autocomplete="off">
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสสินค้า
          </label>
        </div>
        <div class="form-group">
          <label for="">ชื่อสินค้า</label>
          <input type="text" name="Product_name" class="form-control" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="">หน่วยสินค้า</label>
          <input type="text" name="unit" list="units" class="form-control" autocomplete="off" required>
          <datalist id="units">
            <option value="กล่อง">
            <option value="ถุง">
            <option value="เส้น">
            <option value="ถัง">
            <option value="กระสอบ">
            <option value="ชิ้น">
          </datalist>
        </div>
    </div>
    <div class="form-group text-center">
      <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
      <button id="subform" type="submit" class="btn btn-success ml-2" value="Update"><i class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {

    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });

    $('#disabletext').focus(function(){
      $(this).blur();
      Swal.fire({
        type : 'warning',
        title : 'รหัสสินค้าไม่สามารถเปลี่ยนแปลงได้',
        text : 'ไม่สามารถแก้ไขข้อมูลส่วนนี้ได้',
        confirmButtonText : 'ตกลง',
      });
    });

  });
</script>
@endsection
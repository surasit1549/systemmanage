@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
@section('tabbarcss')
<style>
  #storetab {
    border-right: 5px solid rgb(41, 207, 219);
  }
  }
</style>
@stop
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white">
          <h3><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เพิ่มข้อมูลร้านค้า</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{url('store')}}" class="needs-validation" novalidate>
            {{csrf_field()}}
            <h3>Company Information</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class='form-group col-md-3'>
                <input type="text" name="keystore" class="form-control" placeholder="รหัสร้านค้า" autocomplete="off" required>
                <label class="invalid-feedback">กรอกรหัสร้านค้า</label>
              </div>
              <div class="form-group col-md-9">
                <input type="text" name="name" class="form-control" placeholder="ชื่อร้านค้า" autocomplete="off" required>
                <label class="invalid-feedback">กรอกชื่อร้านค้า</label>
              </div>
            </div>

            <div class="form-group">
              <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" autocomplete="off" required></textarea>
              <label class="invalid-feedback">กรอกที่อยู่ปัจจุบัน</label>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์</label>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="fax" class="form-control" placeholder="เบอร์โทรสาร" autocomplete="off" pattern="[0-9]{9}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรสาร/label>
              </div>
            </div>
            <br>
            <h3>Contact with</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="contect" placeholder="ชื่อผู้ติดต่อ" class="form-control" autocomplete="off" required>
                <label class="invalid-feedback">กรอกชื่อผู้ติดต่อ</label>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="cellphone" class="form-control" placeholder="เบอร์โทรผู้ติดต่อ" autocomplete="off" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ผู้ติดต่อ</label>
              </div>
            </div>
            <br>
            <div class="form-group text-right">
              <a class="btn btn-danger" href="{{route('store.index')}}"><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
              <button id="subform" type="submit" class="btn btn-success ml-2"><i style="font-size:18px;" class="far fa-save"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
            </div>
          </form>
        </div>
      </div>
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

  });
</script>

@endsection
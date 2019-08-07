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

<<<<<<< HEAD

=======
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white">
          <h3><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เพิ่มข้อมูลร้านค้า</h3>
        </div>
        <div class="card-body">
<<<<<<< HEAD
          <form method="post" action="{{url('store')}}" class="need-validation" novalidate>
=======
          <form method="post" action="{{url('store')}}" class="needs-validation" novalidate>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
            {{csrf_field()}}
            <h3>Company Information</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class='form-group col-md-3'>
                <input type="text" name="keystore" class="form-control" placeholder="รหัสร้านค้า" autocomplete="off" required>
<<<<<<< HEAD
                <div class="invalid-feedback">
                  กรอกรหัสร้านค้า
                </div>
              </div>
              <div class="form-group col-md-9">
                <input type="text" name="name" class="form-control" placeholder="ชื่อร้านค้า" autocomplete="off" required>
                <div class="invalid-feedback">
                  กรอกชื่อร้านค้า
                </div>
=======
                <label class="invalid-feedback">กรอกรหัสร้านค้า</label>
              </div>
              <div class="form-group col-md-9">
                <input type="text" name="name" class="form-control" placeholder="ชื่อร้านค้า" autocomplete="off" required>
                <label class="invalid-feedback">กรอกชื่อร้านค้า</label>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
              </div>
            </div>

            <div class="form-group">
              <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" autocomplete="off" required></textarea>
<<<<<<< HEAD
              <div class="invalid-feedback">
                กรอกที่อยู่ปัจจุบัน
              </div>
=======
              <label class="invalid-feedback">กรอกที่อยู่ปัจจุบัน</label>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
<<<<<<< HEAD
                <input type="text" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off" required>
                <div class="invalid-feedback">
                  กรอกเบอร์โทรศัพท์
                </div>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="fax" class="form-control" placeholder="เบอร์โทรสาร" autocomplete="off" required>
                <div class="invalid-feedback">
                  กรอกเบอร์โทรสาร
                </div>
=======
                <input type="text" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="fax" class="form-control" placeholder="เบอร์โทรสาร" autocomplete="off" pattern="[0-9]{9}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรสารให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 053894659</label>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
              </div>
            </div>
            <br>
            <h3>Contact with</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="contect" placeholder="ชื่อผู้ติดต่อ" class="form-control" autocomplete="off" required>
<<<<<<< HEAD
                <div class="invalid-feedback">
                  กรอกชื่อผู้ติดต่อ
                </div>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="cellphone" class="form-control" placeholder="เบอร์โทรผู้ติดต่อ" autocomplete="off" required>
                <div class="invalid-feedback">
                  กรอกเบอร์ผู้ติดต่อ
                </div>
=======
                <label class="invalid-feedback">กรอกชื่อผู้ติดต่อ</label>
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="cellphone" class="form-control" placeholder="เบอร์โทรผู้ติดต่อ" autocomplete="off" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ผู้ติดต่อให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
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
<<<<<<< HEAD

    $('#subform').click(function() {
      if( $('form')[0].checkValidity() == false ){
=======
    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });
<<<<<<< HEAD

  });
</script>


=======
  });
</script>

>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
@endsection
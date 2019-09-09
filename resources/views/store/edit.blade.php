@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
@section('tabbarcss')
<style>
  #storetab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white">
          <h3><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลร้านค้า</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{action('StoreController@update', $id)}}" class="needs-validation" novalidate>
            {{csrf_field()}}
            <br>
            <h3>Store Information</h3>
            <hr class="line">
            <br>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>รหัสร้านค้า</label>
                <input type="text" name="keystore" class="form-control" value="{{$store->keystore}}" required>
                <label class="invalid-feedback">กรอกรหัสร้านค้า</label>
              </div>

              <div class="form-group col-md-9">
                <label>ชื่อร้านค้า</label>
                <input type="text" name="name" class="form-control" placeholder="ป้อนร้านค้า" value="{{$store->name}}" required>
                <label class="invalid-feedback">กรอกชื่อร้านค้า</label>
              </div>
            </div>

            <div class="form-group">
              <label>ที่อยู่ในปัจจุบัน</label>
              <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" required>{{$store->address}}</textarea>
              <label class="invalid-feedback">กรอกที่อยู่ปัจจุบัน</label>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label>โทรศัทท์</label>
                <input type="text" name="phone" class="form-control" value="{{$store->phone}}" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
              </div>

              <div class="form-group col-md-6">
                <label>โทรสาร</label>
                <input type="text" name="fax" class="form-control" value="{{$store->fax}}" pattern="[0-9]{9}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรสารให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 053894659</label>
              </div>

            </div>
            <br>
            <h3>Contact With</h3>
            <hr class="line">
            <br>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>ชื่อผู้ติดต่อ</label>
                <input type="text" name="contect" class="form-control" placeholder="ชื่อ - นามสกุล" value="{{$store->contect}}" required>
                <label class="invalid-feedback">กรอกชื่อผู้ติดต่อ</label>
              </div>

              <div class="form-group col-md-6">
                <label>โทรศัพท์ผู้ติดต่อ</label>
                <input type="text" name="cellphone" class="form-control" value="{{$store->cellphone}}" pattern="[0-9]{10}" required>
                <label class="invalid-feedback">กรอกเบอร์โทรศัพท์ผู้ติดต่อให้ถูกต้องไม่ต้องมี (-) ตัวอย่าง 0234567895</label>
              </div>
            </div>

            <div class="form-group text-right mt-3">
              <button id="subform" type="submit" class="btn btn-success ml-2"><i class="far fa-edit"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
              <a class="ml-2 btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
            </div>
            <input type="hidden" name="_method" value="PATCH" />
            <input type="hidden" name="store_id" value="{{$id}}">
          </form>
        </div>
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
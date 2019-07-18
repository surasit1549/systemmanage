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
        <div class="card-header text-white" style="background-color:#435d7d">
          <h3><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เพิ่มข้อมูลร้านค้า</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{url('store')}}">
            {{csrf_field()}}
            <hr>
            <h3>Company Information</h3>
            <hr>
            <div class="form-row">
              <div class='form-group col-md-3'>
                <input type="text" name="keystore" class="form-control" placeholder="รหัสร้านค้า" autocomplete="off" />
              </div>
              <div class="form-group col-md-9">
                <input type="text" name="name" class="form-control" placeholder="ชื่อร้านค้า" autocomplete="off" />
              </div>
            </div>

            <div class="form-group">
              <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" autocomplete="off"></textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off" />
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="fax" class="form-control" placeholder="เบอร์โทรสาร" autocomplete="off" />
              </div>
            </div>

            <hr>
            <h3>Contact with</h3>
            <hr>

            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="contect" placeholder="ชื่อผู้ติดต่อ" class="form-control" autocomplete="off" />
              </div>

              <div class="form-group col-md-6">
                <input type="text" name="cellphone" class="form-control" placeholder="เบอร์โทรผู้ติดต่อ" autocomplete="off" />
              </div>
            </div>

            <br>
            <div class="form-group text-right">
              <a class="btn btn-danger" href="{{route('store.index')}}"><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
              <button type="submit" class="btn btn-success ml-2"><i style="font-size:18px;" class="far fa-save"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
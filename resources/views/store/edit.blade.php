@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
@section('tabbarcss')
  <style>
    #storetab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="card">
      <div style="background-color:#435d7d" class="card-header text-white">
        <h3><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลร้านค้า</h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{action('StoreController@update', $id)}}">
          {{csrf_field()}}
              <hr>
              <h3>Store Information</h3>          
              <hr>

              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>รหัสร้านค้า</label>
                  <input type="text" name="keystore" class="form-control" value="{{$store->keystore}}"/>
                </div>
                
                <div class="form-group col-md-9">
                  <label>ชื่อร้านค้า</label>
                  <input type="text" name="name" class="form-control"  placeholder="ป้อนร้านค้า" value="{{$store->name}}"/>
                </div>
              </div>
                
              <div class="form-group">
                <label>ที่อยู่ในปัจจุบัน</label>
                <textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน">{{$store->address}}</textarea>
              </div>
            
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label>โทรศัทท์</label>
                  <input type="text" name="phone" class="form-control" value="{{$store->phone}}"/>
                </div>
                
                <div class="form-group col-md-6">
                  <label>โทรสาร</label>
                  <input type="text" name="fax" class="form-control" value="{{$store->fax}}"/>
                </div>
                
              </div>
              <hr>
              <h3>Contact With</h3>
              <hr>

              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>ผู้ติดต่อ</label>
                    <input type="text" name="contect" class="form-control" placeholder="ชื่อ - นามสกุล" value="{{$store->contect}}"/>
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>โทรศัพท์ผู้ติดต่อ</label>
                    <input type="text" name="cellphone" class="form-control"  value="{{$store->cellphone}}"/>
                  </div>
              </div>

              <div class="form-group text-right mt-3">
                <a class="btn btn-danger" href="{{route('store.index')}}" ><i style="font-size:18px;" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                <button type="submit" class="btn btn-success ml-2" ><i class="far fa-edit"></i>&nbsp;&nbsp;Update</button>
              </div>
                <input type="hidden" name="_method" value="PATCH"/>
          </div>


        </form>

      </div>
    </div>
    </div>
  </div>
</div>
@endsection

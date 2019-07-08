@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
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
          <div class="form-group">
            <table style="width:100%">
              <tr>
                <td>
                  <h>รหัสร้านค้า :</h>
                  <td><input type="text" name="keystore" value="{{$store->keystore}}"/></td>
                </td>
              </tr>
              <tr>
                <div class="form-group">
                  <td><h>ร้านค้า :</h></td>
                  <td><input type="text" name="name" class="form-control"  placeholder="ป้อนร้านค้า" value="{{$store->name}}"/></td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td><h>ที่อยู่ :</h></td>
                  <td><textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน" value="{{$store->address}}"></textarea></td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td><h>โทรศัทท์ :</h></td>
                  <td><input type="text" name="phone" value="{{$store->phone}}"/></td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td><h>โทรสาร :</h></td>
                  <td><input type="text" name="fax" value="{{$store->fax}}"/></td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td>
                    <h>ผู้ติดต่อ :</h>
                    <td>
                      <input type="text" name="contect"  placeholder="ชื่อ - นามสนุก" value="{{$store->contect}}"/>
                    </td>
                  </td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td><h>โทรศัพท์ผู้ติดต่อ :</h></td>
                  <td><input type="text" name="cellphone"  value="{{$store->cellphone}}"/></td>
                </div>
              </tr>
            </table>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update" />
          </div>
            <input type="hidden" name="_method" value="PATCH"/>
        </form>

      </div>
    </div>
    </div>
  </div>
</div>
@endsection

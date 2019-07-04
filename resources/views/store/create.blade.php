@extends('Home.master')
@section('title','จัดการฐานข้อมูล')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">เพิ่มข้อมูลผู้ใช้ระบบ</h3> <br />
      <form method="post" action="{{url('store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <table style="width:100%">
            <tr>
              <td>
                <h>หรัสร้านค้า :</h>
                <td><input type="text" name="keystore" /></td>
              </td>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ร้านค้า :</h></td>
                <td><input type="text" name="name" class="form-control"  placeholder="ป้อนร้านค้า" /></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ที่อยู่ :</h></td>
                <td><textarea type="text" name="address" class="form-control" cols="70" placeholder="ที่อยู่ปัจจุบัน"></textarea></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>โทรศัทท์ :</h></td>
                <td><input type="text" name="phone" /></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>โทรสาร :</h></td>
                <td><input type="text" name="fax" /></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td>
                  <h>ผู้ติดต่อ :</h>
                  <td>
                    <input type="text" name="contect"  placeholder="ชื่อ - นามสนุก" />
                  </td>
                </td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>โทรศัพท์ผู้ติดต่อ :</h></td>
                <td><input type="text" name="cellphone"  /></td>
              </div>
            </tr>
          </table>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="save" />
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

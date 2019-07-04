@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">แก้ไขใบขอสั่งซื้อ</h3> <br />
      <form method="post" action="{{action('PuchaserequestController@update', $id)}}">
        {{csrf_field()}}
        <div class="form-group">
          <table style="width:100%">
            <tr>
              <td>
                <h>เลขที่เอกสาร :</h>
                <td><input type="text" name="keyPR" class="form-control" value="{{$prequest->keyPR}}"/></td>
              </td>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>วันที่ขอสั่งชื้อ :</h></td>
                <td><input type="date" name="date" class="form-control" value="{{$prequest->date}}"/></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ชื้อผู้รับเหมา :</h></td>
                <td><input type="text" name="contractor" class="form-control" placeholder="ชื่อ - นามสนุก" value="{{$prequest->namtractor}}"/></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>แปลง :</h></td>
                <td>
                  <select name="prequest" >
                    @foreach($prequest as $row)
                      <option value="{{$row['id']}}">{{$row['convertname']}}</option>
                    @endforeach
                </td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>แบบงาน :</h></td>
                <td>
                  <input list="formwork" name="formwork" value="{{$prequest->formwork}}"/>
                  <datalist id="formwork">
                    <option value="งานโครงสร้างอาคาร">
                    <option value="งานโครงสร้างหลังคา/หลังคา">
                    <option value="งานผนัง">
                    <option value="งานผิวพื้น">
                    <option value="งานฝ้าเพดาน">
                    <option value="งานรั้ว">
                    <option value="งานไฟฟ้า">
                    <option value="งานประปา/สุขาภิบาล">
                    <option value="งานเบ็ดเตล็ด">
                    <option value="งานสุขาภิบาลภายนอก">
                  </datalist>
                </td>
              </div>
            </tr>
          </table>
          <table class="table table-hover" style="width : 100%">
              <tr>
                <th>ลำดับ</th>
                <th>รายการขอสั่งซื้อสินค้า</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ร้านค้า</th>
                <th>ราคา</th>
                <th>จำนวนเงิน</th>
              </tr>
              <tr>
                  <td><input type="submit" name="id" class="btn btn-primary" value="เพิ่ม" > </td>
                  <td><input type="text" name="productname" class="form-control" value="{{$prequest->productname}}"/> </td>
                  <td>
                    <input type="number" name="numberproduct" class="form-control" value="{{$prequest->numberproduct}}" />
                  </td>
                  <td><input type="text" name="unit" class="form-control" value="{{$prequest->unit}}"/> </td>
                  <td> </td>
                  <td>
                    <input type="number" name="price" class="form-control" value="{{$prequest->price}}"/>
                  </td>
                  <td></td>
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
@endsection

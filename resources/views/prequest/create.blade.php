@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <br>
      <h3 align="center">เพิ่มข้อมูลใบสั่งซื้อ</h3> 
      <br>
      <form method="post" action="{{url('prequest')}}">
        {{csrf_field()}}
        <div class="form-group">
        
          <table style="width:100%">
            <tr>
              <td>
                <h>เลขที่เอกสาร :</h>
                <td><input type="text" name="keyPR" class="form-control"/></td>
              </td>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>วันที่ขอสั่งชื้อ :</h></td>
                <td><input type="date" name="date" class="form-control"/></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ชื้อผู้รับเหมา :</h></td>
                <td><input type="text" name="contractor" class="form-control" placeholder="ชื่อ - นามสนุก"/></td>
              </div>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>แปลง :</h></td>
                <td>
                  <select name="prequest" class="form-control">
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
                  <select class="form-control" name="formwork" >
                    <option value="งานโครงสร้างอาคาร">งานโครงสร้างอาคาร</option>
                    <option value="งานโครงสร้างหลังคา/หลังคา">งานโครงสร้างหลังคา/หลังคา</option>
                    <option value="งานผนัง">งานผนัง</option>
                    <option value="งานผิวพื้น">งานผิวพื้น</option>
                    <option value="งานฝ้าเพดาน">งานฝ้าเพดาน</option>
                    <option value="งานรั้ว">งานรั้ว</option>
                    <option value="งานไฟฟ้า">งานไฟฟ้า</option>
                    <option value="งานประปา/สุขาภิบาล">งานประปา/สุขาภิบาล</option>
                    <option value="งานเบ็ดเตล็ด">งานเบ็ดเตล็ด</option>
                    <option value="งานสุขาภิบาลภายนอก">งานสุขาภิบาลภายนอก</option>
                  </select>
                </td>
              </div>
            </tr>
            
          </table>
          <br><br><br>

           <!-- การเพิ่มสินค้า  -->
          <script type="text/javascript">
            $(document).ready(function(){
              $(".add-row").click(function(){
                var productname = $("#productname").val();
                var productnumber = $("#productnumber").val();
                var unit = $("#unit").val();
                var store = $("#store").val();
                var price = $("#price").val();
                var sum = $("#sum").val();
                var markup = "<tr><td><input type='checkbox' name='record'></td><td>"
                            + productname + "</td><td>" 
                            + productnumber + "</td><td>"
                            + unit + "</td><td>"
                            + store + "</td><td>"
                            + price + "</td><td>"
                            + sum + "</td></tr>";
                $("table tbody").append(markup);
              });
            });
          </script>

          <!-- สินค้าที่ขอสั่งซื้อ -->
          <form>
            <br><br>
            <input type="text" id="productname" placeholder="ชื่อสินค้า" ><br>
            <input type="number" id="productnumber" placeholder="จำนวน"><br>
            <input type="text" id="unit" placeholder="หน่วย"><br>
            <input type="text" id="store" ><br>
            <input type="number" id="price" ><br>
            <input type="number" id="sum" ><br><br>
            <input type="button" class="add-row" value="Add"><br><br>
          </form>

          <table class="table table-hover" >
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

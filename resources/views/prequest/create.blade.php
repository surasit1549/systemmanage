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
          <h>เลขที่เอกสาร :</h>
          <input type="text" name="keyPR" class="form-control"/>

          <h>วันที่ขอสั่งชื้อ :</h>
          <input type="date" name="date" class="form-control"/>

          <h>ชื้อผู้รับเหมา :</h>
          <input type="text" name="contractor" class="form-control" placeholder="ชื่อ - นามสนุก"/>

          <h>แบบงาน :</h>
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

          <h>แปลง :</h>
            <select name="prequestconvert" class="form-control">
              @foreach($prequestconvert as $row)
                <option value="{{$row['id']}}">{{$row['convertname']}}</option>
              @endforeach
            </select>
          <br>

           <!-- การเพิ่มสินค้า  -->
          <script type="text/javascript">
            $(document).ready(function(){
              $(".add-row").click(function(){
                var productname = $("#productname").val();
                var productnumber = $("#productnumber").val();
                var unit = $("#unit").val();
                var store = $("#keystore").val();
                console.log(store);
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

              // ไม่ต้องการสินค้า
              $(".delete-row").click(function(){
                $("table tbody").find('input[name="record"]').each(function(){
            	    if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                  }
                });
              });
            });
          </script>

          <!-- สินค้าที่ขอสั่งซื้อ -->
          <form>
            <br>
            <h>ชื้อสินค้า</h>&emsp;                 <input type="text" id="productname" name='productname' placeholder="ชื่อสินค้า" >&emsp;&emsp;
            <h>จำนวนสินค้า</h>&emsp;              <input type="number" id="productnumber" name='productnumber' placeholder="จำนวน">&emsp;
            <h>หน่วย</h>&emsp;                   <input type="text" id="unit" name='unit' placeholder="หน่วย"><br><br>
            <h>ร้านค้า</h>&emsp;&emsp;             
            <select type="text" id="keystore" name='keystore' >
              @foreach($prequeststore as $row)
                <option value="{{$row['keystore']}}">{{$row['keystore']}}</option>
              @endforeach
            </select>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <h>ราคา</h>&emsp;&emsp;&emsp;&emsp; <input type="number" id="price" name='price' ><br><br>
            <h>จำนวนเงิน</h>&emsp;                <input type="number" id="sum" name='sum' ><br><br>
            <input  type="button"  class="add-row" value="เพิ่มสินค้า">&emsp;&emsp;
          </form>
          <button type="button" class="delete-row"> ลบรายการสินค้า</button><br><br> 


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

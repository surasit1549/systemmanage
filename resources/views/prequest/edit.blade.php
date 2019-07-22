@extends('Home.master')
@section('title','แก้ไขแปลง')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลใบขอสั่งซื้อ ( RP )</h3>
    </div>
    <div class="card-body">
      <form method=" post" action="{{action('PuchaserequestController@update', $id)}}">
        {{csrf_field()}}
        <div class="form-group text-right">
          <label>วันที่ขอสั่งชื้อ</label>
          <input type="text" name="date" class="form-control" value="{{$prequestdb->date}}" size="8" />
          <input type="text" name="newdate" class="form-control" value="{{ date('d-m-Y') }}" size="8" />
        </div>
        <div class="form-group">
          <label>เลขที่เอกสาร</label>
          <input type="text" name="keyPR" class="form-control" value="{{$prequestdb->keyPR}}" />
        </div>
        <div class="form-group">
          <label>ชื้อผู้รับเหมา</label>
          <input type="text" name="contractor" class="form-control" placeholder="ชื่อ - นามสนุก" value="{{$prequestdb->contractor}}" />
        </div>
        <div class="form-group">
          <label>แบบงาน</label>
            <select class="form-control" name="formwork" value="{{$prequestdb->formwork}}">
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
        </div>
        <div class="form-group">
          <label>แปลง</label>
          <select name="prequestconvert" class="form-control" value="{{$prequestdb->prequestconvert}}">
            @foreach($prequestconvert as $row)
            <option value="{{$row['id']}}">{{$row['convertname']}}</option>
            @endforeach
          </select>
        </div>

        <!-- การเพิ่มสินค้า  -->
        <script type="text/javascript">
          $(document).ready(function() {
            $(".add-row").click(function() {
              var productname = $("#productname").val();
              var productnumber = $("#productnumber").val();
              var unit = $("#unit").val();
              var store = $("#keystore").val();
              console.log(store);
              var price = $("#price").val();
              var sum = $("#sum").val();
              var markup = "<tr><td><input type='checkbox' name='record'></td><td>" +
                productname + "</td><td>" +
                productnumber + "</td><td>" +
                unit + "</td><td>" +
                store + "</td><td>" +
                price + "</td><td>" +
                sum + "</td></tr>";
              $("table tbody").append(markup);
            });

            // ไม่ต้องการสินค้า
            $(".delete-row").click(function() {
              $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                  $(this).parents("tr").remove();
                }
              });
            });
          });
        </script>

        <!-- สินค้าที่ขอสั่งซื้อ -->
        <br>
        <label>ชื้อสินค้า</label>&emsp; <input type="text" id="productname" name='productname' placeholder="ชื่อสินค้า" value="{{$prequestdb->productname}}">&emsp;&emsp;
        <label>จำนวนสินค้า</label>&emsp; <input type="number" id="productnumber" name='productnumber' placeholder="จำนวน" value="{{$prequestdb->productnumber}}">&emsp;
        <label>หน่วย</label>&emsp; <input type="text" id="unit" name='unit' placeholder="หน่วย" value="{{$prequestdb->unit}}"><br><br>
        <label>ร้านค้า</label>&emsp;&emsp;
        <select type="text" id="keystore" name='keystore' value="{{$prequestdb->keystore}}">
          @foreach($prequeststore as $row)
            <option value="{{$row['keystore']}}">{{$row['keystore']}}</option>
          @endforeach
        </select>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <label>ราคา</label>&emsp;&emsp;&emsp;&emsp; <input type="number" id="price" name='price' value="{{$prequestdb->price}}"><br><br>
        <label>จำนวนเงิน</label>&emsp; <input type="number" id="sum" name='sum' value="{{$prequestdb->sum}}"><br><br>
        <input type="button" class="add-row" value="เพิ่มสินค้า">&emsp;&emsp;

        <button type="button" class="delete-row"> ลบรายการสินค้า</button><br><br>


        <table class="table table-hover">
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
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Update" />
        </div>
          <input type="hidden" name="_method" value="PATCH" />
      </form>
    </div>
  </div>
</div>
@endsection
@extends('Home.master')
@section('title','แก้ไขใบขอสั่งซื้อ')
@section('content')
<div class="">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;แก้ไขข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url(action('PuchaserequestController@update',$id))}}">
        {{csrf_field()}}
        <div class="form-group text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <input type="text" name="date" value="{{$prequestdb->date}}" class="border-0" size="8">
          <!--<input type="text" name="newdate" value="21/65/7" size="8">
            <p type="text" name="date" value=" {{ date('d-m-Y') }}">{{ date("d-m-Y") }}</p> -->
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>เลขที่เอกสาร</label>
            <input type="text" name="keyPR" class="form-control" placeholder="กรอกเลขที่เอกสาร.." value="{{$prequestdb->keyPR}}"/>
          </div>
          <div class="form-group col-md-8">
            <label>ชื่อผู้รับเหมา</label>
            <input type="text" name="contractor" class="form-control" placeholder="กรอกชื่อผู้รับเหมา.." value="{{$prequestdb->contractor}}" />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>แบบงาน</label>
            <select class="form-control" name="formwork" value="{{$prequestdb->formwork}}">
              <option value="#">{{$prequestdb->formwork}}</option>
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
          <div class="form-group col-md-6">
            <label>แปลง</label>
            <select name="prequestconvert" class="form-control" >
              <option value="#">{{$prequestdb->prequestconvert}}</option>
              @foreach($prequestconvert as $row)
              <option value="{{$row['convertname']}}">{{$row['convertname']}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- สินค้าที่ขอสั่งซื้อ -->
        <label>ชื้อสินค้า</label>&emsp; <input type="text" id="productname" name='productname' placeholder="ชื่อสินค้า">&emsp;&emsp;
        <label>จำนวนสินค้า</label>&emsp; <input type="number" id="productnumber" name='productnumber' placeholder="จำนวน">&emsp;
        <label>หน่วย</label>&emsp; <input type="text" id="unit" name='unit' placeholder="หน่วย"><br><br>
        <label>ร้านค้า</label>&emsp;&emsp;
        <select type="text" id="keystore" name='keystore'>
          <option value="#">กรุณากรอกรหัสร้านค้า..</option>
          @foreach($prequeststore as $row)
          <option value="{{$row['keystore']}}">{{$row['keystore']}}</option>
          @endforeach
        </select>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <label>ราคา</label>&emsp;&emsp;&emsp;&emsp; <input type="number" id="price" name='price'><br><br>
        <label>จำนวนเงิน</label>&emsp; <input type="number" id="sum" name='sum'><br><br>
        <input type="button" class="add-row" value="เพิ่มสินค้า">&emsp;&emsp;
        <button type="button" class="delete-row"> ลบรายการสินค้า</button><br><br>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>รายการขอสั่งซื้อสินค้า</th>
              <th>จำนวน</th>
              <th>หน่วย</th>
              <th>ร้านค้า</th>
              <th>ราคา</th>
              <th>จำนวนเงิน</th>
            </tr>
          </thead>
          @foreach($prequestproduct as $row)
            @if($prequestdb->keyPR === $row['keyPR'])
              @if($prequestdb->formwork === $row['formwork'])
                <tbody>
                  <td style="width:5%"><input type='checkbox' name='record'></td>
                  <td style="width:20%">{{$row['productname']}}</td>
                  <td style="width:10%">{{$row['productnumber']}}</td>
                  <td style="width:10%">{{$row['unit']}}</td>
                  <td style="width:10%">{{$row['keystore']}}</td>
                  <td style="width:10%">{{$row['price']}}</td>
                  <td style="width:10%">{{$row['sum']}}</td>
                </tbody>
              @endif
            @endif
          @endforeach
        </table>

        <div class="form-group">
          <a class="btn btn-danger" href="{{route('prequest.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          &nbsp;
          <input id="subbutton" type="submit" class="btn btn-primary" value="Update" />
        </div>
        <input type="hidden" name="_method" value="PATCH"/>
      </form>
    </div>
  </div>
</div>

<!-- การเพิ่มสินค้า  -->
<script type="text/javascript">
  $(document).ready(function() {

    $(".add-row").click(function() {
      var productname = $("#productname").val();
      var productnumber = $("#productnumber").val();
      var unit = $("#unit").val();
      var store = $("#keystore").val();
      var price = $("#price").val();
      var sum = $("#sum").val();
      var markup = "<tr><td><input type='checkbox' name='record'></td><td class='name'>" +
        productname + "</td><td class='num'>" +
        productnumber + "</td><td class='units'>" +
        unit + "</td><td class='store'>" +
        store + "</td><td class='price'>" +
        price + "</td><td class='sum'>" +
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

    $('#subbutton').click(function(e) {
      e.preventDefault();
      var name = [];
      var num = [];
      var units = [];
      var store = [];
      var price = [];
      var sum = [];
      $('table tbody tr').each(function(index, value) {
        name.push($('td.name', this).text());
        num.push($('td.num', this).text());
        units.push($('td.units', this).text());
        store.push($('td.store', this).text());
        price.push($('td.price', this).text());
        sum.push($('td.sum', this).text());
      });

      $.ajax({
        type: 'post',
        url: 'index',
        data: {
          _token: '{{csrf_token()}}',
          name: name,
          num: num,
          units: units,
          store: store,
          price: price,
          sum: sum,
          keyPR: $('input[name=keyPR]').val(),
          date: $('input[name=date]').val(),
          contractor: $('input[name=contractor]').val(),
          formwork: $('select[name=formwork]').val(),
          prequestconvert: $('select[name=prequestconvert]').val()
        },
        success: function(data) {
          console.log(data.message);
        }
      });

    });
  });
</script>
@endsection
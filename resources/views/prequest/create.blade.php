@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('content')
<div class="">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลใบสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url('prequest')}}">
        {{csrf_field()}}
        <div class="form-group text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <input type="text" name="date" value="{{ date('d-m-Y') }}" class="border-0" size="8">
          <!--<input type="text" name="newdate" value="21/65/7" size="8">
            <p type="text" name="date" value=" {{ date('d-m-Y') }}">{{ date("d-m-Y") }}</p> -->
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>เลขที่เอกสาร</label>
            <input type="text" name="keyPR" class="form-control" placeholder="กรอกเลขที่เอกสาร.." />
          </div>
          <div class="form-group col-md-8">
            <label>ชื่อผู้รับเหมา</label>
            <input type="text" name="contractor" class="form-control" placeholder="กรอกชื่อผู้รับเหมา.." />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>แบบงาน</label>
            <select class="form-control" name="formwork">
              <option value="#">กรุณาเลือกแบบงาน..</option>
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
            <select name="prequestconvert" class="form-control">
              <option value="#">กรุณากรอกแปลง..</option>
              @foreach($prequestconvert as $row)
              <option value="{{$row['convertname']}}">{{$row['convertname']}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- สินค้าที่ขอสั่งซื้อ -->
        <br>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>รายการสินค้า</th>
              <th>จำนวน</th>
              <th>หน่วย</th>
              <th>ร้านค้า</th>
              <th>ราคา</th>
              <th>รวม</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center"><label class="col-form-label">1</label></td>
              <td><input type="text" class="form-control" name="" id="productname"></td>
              <td><input type="number" min="1" class="form-control" name="" id="productnumber"></td>
              <td><input type="text" class="form-control" name="" id="unit"></td>
              <td><input type="text" class="form-control" name="" id="keystore"></td>
              <td><input type="number" min="1" class="form-control" name="" id="price"></td>
              <td class="text-center"><label class="sum col-form-label">0</label></td>
            </tr>
          </tbody>
        </table>
        <div id="clickthis" class="text-left">
          <button id="addrow" class="close" style="text-left"><i style="font-size:25px" class="fas fa-plus-square"></i></button>
        </div>
        <hr>
        <div class="form-group">
          <a class="btn btn-danger" href="{{route('prequest.index')}}"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          <input type="submit" class="btn btn-success" id="subbutton" value='บันทึก'>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- การเพิ่มสินค้า  -->
<script type="text/javascript">
  $(document).ready(function() {

    var index = 1;

    $('#point').click(function(e) {
      e.preventDefault();
      $('#subbutton').click();
    });

    $('tbody').on('click',function(){
      alert(1);
    });

    $('#addrow').click(function(e) {
      e.preventDefault();
      $('tbody').append('<tr><td class="text-center"><label class="col-form-label">'+(++index)+'</label></td><td>' +
        '<input type="text" class="form-control"></td>' +
        '<td><input type="number" min="1" class="form-control"></td>' +
        '<td><input type="text" class="form-control"></td>' +
        '<td><input type="text" class="form-control"></td>' +
        '<td><input type="number" class="form-control"></td>' +
        '<td class="text-center"><label class="sum col-form-label">0</label></td></tr>');
    });

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
        name.push($('td.name', this).val());
        num.push($('td.num', this).val());
        units.push($('td.units', this).val());
        store.push($('td.store', this).val());
        price.push($('td.price', this).val());
        sum.push($('td.sum', this).val());
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
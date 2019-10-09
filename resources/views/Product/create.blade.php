@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>
  #store_menutab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')

<script>
  $(document).ready(function) {

  });
</script>
<div class="card" style="width:25rem">
  <div class="card-header">
    <h3 class="text-white card-title"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;เพิ่มข้อมูลสินค้า</h3>
  </div>
  <div class="card-body">
    <form method="post" action="{{url('Product')}}" class="needs-validation" novalidate>
      {{csrf_field()}}
      @if(empty($small_check))
      <div class="form-group">
        <label for="">รหัสสินค้า</label><br>
        <div class="row col-md-12 text-center">
          <input class="col-md-3 form-control" id="product1" type="text" name="Product_ID1" maxlength="3" placeholder="หมู่หลัก">&nbsp;&nbsp;<span class="col-form-label">-</span>&nbsp;&nbsp;
          <input class="col-md-3 form-control" id="product2" type="text" name="Product_ID2" maxlength="3" placeholder="หมู่ย่อย">
        </div>
        <label for="" class="invalid-feedback">
          กรอกชื่อรหัสสินค้า
        </label>
      </div>
      @else
      <div class="form-group">
        <label for="">รหัสสินค้า</label><br>
        <div class="row col-md-12 text-center">
          <input class="col-md-3 form-control select_small" list="list" id="product1" type="text" name="Product_ID1" maxlength="3" placeholder="หมู่หลัก">&nbsp;&nbsp;<span class="col-form-label">-</span>&nbsp;&nbsp;
          <datalist id="list">
            @foreach($small_check as $row)
            <option value="{{$row['Main_group']}}">
              @endforeach
          </datalist>
          <input class="col-md-3 form-control small_list" list="list_small" id="product2" type="text" name="Product_ID2" maxlength="3" placeholder="หมู่ย่อย">
          <datalist id="list_small" class="check_small" >
            
          </datalist>
        </div>
        <label for="" class="invalid-feedback">
          กรอกชื่อรหัสสินค้า
        </label>
      </div>
      @endif
      <div class="form-group">
        <label for="">ชื่อสินค้า</label>
        <input type="text" name="Product_name" class="form-control p_name" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label for="">หน่วยสินค้า</label>
        <input type="text" name="unit" list="units" class="form-control" autocomplete="off" required>
        <datalist id="units">
          <option value="กล่อง">
          <option value="ถุง">
          <option value="เส้น">
          <option value="ถัง">
          <option value="กระสอบ">
          <option value="ชิ้น">
        </datalist>
      </div>
  </div>
  <div class="form-group text-center">
    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
    <button id="subform" type="submit" class="btn btn-success ml-2" value="Update"><i class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
  </div>
  </form>
</div>

<script>
  $(document).ready(function() {

    $('#product1').focus();

    $('#product1').keyup(function() {
      if ($(this).val().length == 3) {
        $('#product2').focus();
      }
    });

    $('#product2').keyup(function() {
      if ($(this).val().length == 3) {
        $('.p_name').focus();
      }
    });

    $('#checkmenu').click();



    function check(id){
      console.log(id);
    }

    $('.select_small').change(function() {
      var main_group = $('input[name=Product_ID1]').val();
      console.log(main_group);
      $.ajax({
        url: '/Product/check',
        type: 'post',
        data: {
          _token: '{{csrf_token()}}',
          Main_group: main_group,
        },
        success: function(data) {
          console.log(data.msg);
          data = data.msg;
          var infor = [];
          for (i = 0; i < data['length']; i++) {
            infor = data[i]['Small_group'];
          $('#list_small').append('<option value="'+ infor + '">');
          }
          //check(infor);
          //$('.small_list').val(infor);
          console.log(infor);
        }
      });
    });

    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });

    $('#disabletext').focus(function() {
      $(this).blur();
      Swal.fire({
        type: 'warning',
        title: 'รหัสสินค้าไม่สามารถเปลี่ยนแปลงได้',
        text: 'ไม่สามารถแก้ไขข้อมูลส่วนนี้ได้',
        confirmButtonText: 'ตกลง',
      });
    });

  });
</script>
@endsection
@extends('Home.master')
@section('title','แก้ไขแปลง')
@section('content')
<div class="container">
  <div class="card" style="width:25rem;">
    <div class="card-header text-white">
      <h3><i class="far fa-file"></i>&nbsp;&nbsp;แก้ไขข้อมูลสินค้า</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('ProductController@update', $id)}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">รหัสสินค้า</label>
          <input type="text" name="Product_ID" class="form-control" value="{{$product->Product_ID}}" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสสินค้า
          </label>
        </div>
        <table>
          <td>
            <div class="form-group">
              <label for="">ชื่อสินค้า</label>
              <input type="text" name="Product_name" class="form-control" value="{{$product->Product_name}}" autocomplete="off" required>
            </div>
          </td>
          <td>
            <div class="form-group">
              <label for="">หน่วย</label>
              <input type="text" name="unit" list="units" class="form-control" value="{{$product->unit}}" autocomplete="off" required>
              <datalist id="units">
                <option value="กล่อง">
                <option value="ถุง">
                <option value="เส้น">
                <option value="ถัง">
                <option value="กระสอบ">
                <option value="ชิ้น">
              </datalist>
            </div>
          </td>
        </table>
        <br>
        <div class="form-group text-center">
          <a class="btn btn-danger" href="{{route('Product.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          &nbsp;
          <button id="subform" type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
        </div>
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="product_id" value="{{$product->id}}">
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });
  });
</script>

@endsection
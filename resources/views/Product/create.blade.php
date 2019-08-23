@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>
  #transformtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="card" style="width:25rem;">
    <div class="card-body">
      <form method="post" action="{{url('Product')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">รหัสสินค้า</label>
          <input type="text" name="Product_ID" class="form-control" value="{{$key}}" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสสินค้า
          </label>
        </div>
        <table>
          <td>
            <div class="form-group">
              <label for="">ชื่อสินค้า</label>
              <input type="text" name="Product_name" class="form-control" autocomplete="off" required>
            </div>
          </td>
          <td>
            <div class="form-group">
              <label for="">หน่วย</label>
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
          </td>
        </table>
        </div>
        <div class="form-group text-center">
          <a class="btn btn-danger" href="{{route('Product.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          <button id="subform" type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
        </div>
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
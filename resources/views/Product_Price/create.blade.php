@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>

</style>
@stop
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <form method="post" action="{{url('Product_Price')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">ร้านค้า</label>
          <input type="text" name="store_name" list="store" class="form-control" autocomplete="off" required>
          <datalist id="store">
            @foreach($store as $row)
            <option value="{{$row['name']}}"></option>
            @endforeach
          </datalist>
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสร้านค้า
          </label>
        </div>
        <table class="table table-hover table-bordered border-dark table-border-dark" id="detailmenu">
          <thead>
            <tr class="text-center">
              <th style="width:20%;">รายการสินค้า</th>
              <th style="width:10%;">หน่วย</th>
              <th style="width:10%;">ราคา</th>
              <th style="width:10%;">ลบ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <input type="text" list="product" name="product[]" class="form-control productname" required>
                <datalist id="product">
                  @foreach($product as $row)
                  <option value="{{$row['Product_name']}}">{{$row['Product_name']}}</option>
                  @endforeach
                </datalist>
              </td>
              <td>
                <input type="text" list="unit" class="form-control unit" name="unit[]" required>
                <datalist id="unit">
                  @foreach($unit as $row)
                  <option value="{{$row['unit']}}">{{$row['unit']}}</option>
                  @endforeach
                </datalist>
              </td>
              <td><input type="text" class="form-control price" name="Price[]" required></td>
              <td class="text-center"><a class="btn btn-outline-danger delete"><i style="font-size:18px" class="far fa-trash-alt"></i></a></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5"><button class="btn btn-sm btn-primary" id="addrow"><i class="fas fa-plus"></i>&nbsp;&nbsp;เพิ่มรายการสินค้า</button></th>
            </tr>
          </tfoot>
        </table>
    </div>
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{route('Product_Price.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
      <button type="submit" id="subform" class="btn btn-success"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });
    $('#addrow').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('#detailmenu tbody').append('<tr></label></td><td>' +
        '<input type="text" list="product" name="product[]" class="form-control productname" required>' +
        '<td><input type="text" list="unit" class="form-control unit" name="unit[]" required></td>' +
        '<td><input type="text" class="form-control price" name="Price[]" required></td>' +
        '<td class="text-center"><a class="btn btn-outline-danger delete"><i style="font-size:18px" class="far fa-trash-alt"></i></a></td></tr>');
      $('#detailmenu tbody tr:last .productname').focus();

      $(".delete").click(function() {
        console.log(321);
        $(this).parents("tr").remove();
      });
    });
  })
</script>
@endsection
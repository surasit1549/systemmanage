@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>
  #manage_store_manutab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h3 class="text-white"><i class="fas fa-tag"></i>&nbsp;&nbsp;เพิ่มราคาสินค้า</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url('Product_Price')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <select name="store_name" id="store">
            <option value=""></option>
            @foreach($store as $row)
            <option value="{{$row['name']}}">{{$row['name']}}</option>
            @endforeach
          </select>
          <label for="" class="invalid-feedback">
            กรอกชื่อรหัสร้านค้า
          </label>
        </div>
        <table class="table table-hover table-bordered border-dark table-border-dark" id="detailmenu">
          <thead>
            <tr class="text-center">
              <th style="width:20%;">รายการสินค้า</th>
              <th style="width:10%;">ราคา</th>
              <th style="width:10%;">ลบ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="item_auto">
                  <select name="productname[]" class="choseitems" data-placeholder="เลือกสินค้า..">
                    <option value=""></option>
                    @foreach( $product as $products )
                    <option value="{{$products['Product_ID']}}">
                      <div class="text-right">{{$products['Product_ID']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$products['Product_name']}}&nbsp;/&nbsp;{{$products['unit']}}</div>
                    </option>
                    @endforeach
                  </select>
                </div>
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
      <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
      <button type="submit" id="subform" class="btn btn-success ml-2"><i class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $('#store').chosen({
      no_results_text: 'ไม่พบร้านค้า',
      placeholder_text_single: 'เลือกร้านค้า',
      width: "95%"
    });

    $('.choseitems').chosen({
      no_results_text: 'ไม่พบรายการสินค้า',
      placeholder_text_single: 'เลือก',
      width: "95%"
    });

    $('#checkmenu').click();

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
      var txt = '<select name="productname[]" class="choseitems" data-placeholder="เลือกสินค้า..">' + $('.item_auto select').html() + '</div>';
      $('#detailmenu tbody').append('<tr></label></td><td>' + txt +
        '<td><input type="text" class="form-control price" name="Price[]" required></td>' +
        '<td class="text-center"><a class="btn btn-outline-danger delete"><i style="font-size:18px" class="far fa-trash-alt"></i></a></td></tr>');
      $('#detailmenu tbody tr:last .productname').focus();
      $('.choseitems').chosen({
        no_results_text: 'ไม่พบรายการสินค้า',
        placeholder_text_single: 'เลือก..',
        width: "95%"
      });
      $(".delete").click(function() {
        $(this).parents("tr").remove();
      });
    });
  })
</script>
@endsection
@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>
    #manage_store_manutab {
        border-right: 5px solid rgb(41, 207, 219);
    }
</style>
<script>
    $(document).ready(function() {
        $('#checkmenu').click();
    });
</script>
@stop
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{action('ProductPriceController@update', $id)}}" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="">ร้านค้า</label>
                    <input type="text" name="store_name" class="form-control" value="{{$data[0]->name}}" autocomplete="off" required>
                    <input type="hidden" name="Cat_ID" value="{{$data[0]->Cat_ID}}" required>
                    <input type="hidden" name="store_id" value="{{$data[0]->Store}}" required>
                </div>
                <table class="table table-hover table-bordered border-dark table-border-dark" id="detailmenu">
                    <thead>
                        <tr class="text-center">
                            <th style="width:20%;">รายการสินค้า</th>
                            <th style="width:10%;">หน่วย</th>
                            <th style="width:10%;">ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" name="product" class="form-control productname" value="{{$data[0]->Product_name}}" required>
                                <input type="hidden" name="product_id" value="{{$data[0]->Product}}" required>
                            </td>
                            <td>
                                <input type="text" class="form-control unit" name="unit" value="{{$data[0]->unit}}" required>
                            </td>
                            <td><input type="text" class="form-control price" name="Price" value="{{$data[0]->Price}}" required></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-center">
                    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                    <button id="subform" type="submit" class="ml-2 btn btn-success" value="Update"><i class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
            </form>
        </div>
    </div>
</div>
@endsection
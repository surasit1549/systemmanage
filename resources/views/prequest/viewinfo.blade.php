@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('tabbarcss')
<style>
    #prtab {
        border-right: 5px solid rgb(41, 207, 219);
    }
</style>
@stop
@section('content')

<script>
    $(document).ready(function() {
        $('#prpo_form').click();
    });
</script>
<div class="card">
    <div class="card-header text-white">
        <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12 text-right">
                <label>วันที่ขอสั่งชื้อ</label><br>
                <input type="text" name="date" value="{{$pr_create['date']}}" class="border-0 bg-light" size="8">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>เลขที่เอกสาร</label>
                <input type="text" name="keyPR" class="form-control" value="{{$pr_create['key']}}" autocomplete="off" disabled>
            </div>
            <div class="form-group col-md-8">
                <label>ชื่อผู้รับเหมา</label>
                <input type="text" name="contractor" class="form-control" value="{{$pr_create['contractor']}}" autocomplete="off" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>แบบงาน</label>
                <input type="text" name="formwork" class="form-control" value="{{$pr_create['formwork']}}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>แปลง</label>
                <input type="text" name="prequestconvert" class="form-control" value="{{$pr_create['prequestconvert']}}" disabled>
            </div>
        </div>
        <!-- สินค้าที่ขอสั่งซื้อ -->
        <br>

        <table class="table table-hover table-bordered border-dark table-border-dark">
            <thead>
                <tr>
                    <th colspan="4" class="text-center">จัดการสินค้า</th>
                    <th colspan="4" class="text-center">จัดซื้อสินค้า</th>
                </tr>
                <tr class="text-center">
                    <th style="width:5%;">ลำดับ</th>
                    <th style="width:20%;">รายการสินค้า</th>
                    <th style="width:10%;">จำนวน</th>
                    <th style="width:10%;">หน่วย</th>
                    <th style="width:20%;">ร้านค้า</th>
                    <th style="width:10%;">ราคาต่อหน่วย</th>
                    <th style="width:15%;">รวม</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $index=>$products)
                <tr>
                    <td class="text-center"><label class="col-form-label">{{$index+1}}</label></td>
                    <td class="text-center result"><label class="form-control productname border-0">{{$products->Product_name}}</label></td>
                    <td class="text-center result"><label min="1" class="form-control productnumber border-0">{{$products->Product_number}}</label></td>
                    <td class="text-center result"><label class="form-control unit border-0">{{$products->unit}}</label></td>
                    <td>{{ $products->Store }}</td>
                    <td class="text-center result">{{ $products->price }}</td>
                    <td class="text-center result">{{ $products->product_sum }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th class="text-right" colspan="5">รวมเป็นเงิน</th>
                    <th class="text-center"><label class="text-danger">{{ $products->sumallprice }}</label></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="form-group text-center">
        <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
    </div>
</div>

@endsection
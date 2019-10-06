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

<script type="text/javascript">
    $(document).ready(function() {

        $('#subform').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            var d = new Date();
            var now = new Date(d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2));
            var format = $('#updated_product').val().split('-');
            var gettime = new Date(format[0] + '-' + format[1] + '-' + format[2]);

            if (gettime > now) {
                Swal.fire({
                    type: 'error',
                    title: 'กรุณาตั้งเวลาลงสินค้าให้ถูกต้อง',
                    text: 'ไม่สามารถตั้งเวลาลงสินค้าล่วงหน้าได้',
                    confirmButtonText: 'ตกลง',
                    onAfterClose: () => {
                        $('#updated_product').val('');
                    }
                })
            } else {
                $('#forminput').submit();
            }
        });

        $('#checkmenu').click();

        $('#passcode_confirm').on('shown.bs.modal', function() {
            $(this).find('input[name=passkey]').focus();
        }).on('hidden.bs.modal', function() {
            $(this).find('input[name=passkey]').val('');
        });

        $('#sub_confirm').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                type: 'POST',
                url: 'checkpasscode',
                data: {
                    _token: '{{csrf_token()}}',
                    passkey: $('input[name=passkey]').val()
                },
                success: function(data) {
                    if (data.msg) {
                        $('#forminput').submit();
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'รหัสลับไม่ถูกต้อง',
                            text: 'กรอกรหัสลับอีกครั้ง',
                            confirmButtonText: 'ตกลง',
                            onAfterClose: () => {
                                $('input[name=passkey]').val('').focus();
                            }
                        })
                    }
                }
            });
        });
    })
</script>

<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="post" id="forminput" action="{{action('ProductPriceController@update', $id)}}" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="">ร้านค้า</label>
                    <input type="text" name="store_name" class="form-control" value="{{$data[0]->name}}" autocomplete="off" disabled>
                    <input type="hidden" name="Cat_ID" value="{{$data[0]->Cat_ID}}">
                    <input type="hidden" name="store_id" value="{{$data[0]->Store}}">
                </div>
                <div class="form-group">
                    <label for="">เวลา</label>
                    <input type="date" class="form-control" id="updated_product" name="updated_product">
                </div>
                <table class="table table-hover table-bordered border-dark table-border-dark" id="detailmenu">
                    <thead>
                        <tr class="text-center">
                            <th style="width:20%;">รหัสสินค้า</th>
                            <th style="width:20%;">รายการสินค้า</th>
                            <th style="width:10%;">หน่วย</th>
                            <th style="width:10%;">ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control" type="text" value="{{$data[0]->Product}}" disabled>
                                <input type="hidden" name="product_id" value="{{$data[0]->Product}}">
                            </td>
                            <td>
                                <input type="text" name="product" class="form-control productname" value="{{$data[0]->Product_name}}" disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control unit" name="unit" value="{{$data[0]->unit}}" disabled>
                            </td>
                            <td><input id="price" type="number" class="form-control price" name="Price" value="{{$data[0]->Price}}"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-center">
                    <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                    <button id="subform" class="btn btn-success ml-2"><i style="font-size:18px" class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</button>
                </div>
                <input type="hidden" name="_method" value="PATCH" />
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="passcode_confirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i style="font-size:20px" class="fas fa-key mr-2 text-danger"></i>กรอกรหัสลับ</h5>
                <button data-dismiss="modal" class="close">&times;</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/checkpasscode']) !!}
                <div class="form-group">
                    {!! Form::label('รหัสลับ') !!}
                    {!! Form::password('passkey',['class' => 'form-control','maxlength' => 4]) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('ยืนยัน',['class' => 'btn btn-success','id' => 'sub_confirm']) !!}
                <a class="btn btn-secondary" data-dismiss="modal" href="#">ยกเลิก</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
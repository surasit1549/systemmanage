@extends('Home.master')
@section('title','Crate PR')
@section('tabbarcss')
<style>
    #constructtab {
        border-right: 5px solid rgb(41, 207, 219);
    }

    .swal2-modal {
        min-height: 400px;
    }

    #export {
        font-size: 18px;
    }

    #export th {
        text-align: center !important;
    }

    #export th,
    #export td {
        padding: 5px;
    }
</style>
@stop
@section('content')

<div class="card">
    <div class="card-header text-white">
        <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
    </div>
    <div class="card-body">
        <form method="post" id="forminput" class="needs-validation" action="{{url('pr_create')}}" novalidate>
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-info text-white" onclick="location.reload();"><i style="font-size:18px" class="fas fa-eraser"></i>&nbsp;&nbsp;ล้างข้อมูล</a>
                </div>
                <div class="form-group col-md-6 text-right">
                    <input type="text" id="datetime" name="date" value="{{ date('d-m-Y') }}" class="border-0" size="8" autocomplete="off">
                </div>
                <div class="form-group col-md-6 text-right">
                    <a class="d-none" id="keyja">{{$key}}</a>
                    <input type="hidden" name="key" value="{{ $key }}" class="border-0" size="8" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>แบบงาน</label>
                    <select class="custom-select" name="formwork" required>
                        <option value="">กรุณาเลือกแบบงาน..</option>
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
                    <div class="invalid-feedback">
                        กรุณาเลือกรูปแบบงานที่ต้องการสั่งซื้อ
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>แปลง</label>
                    <select name="prequestconvert" id="convert" class="custom-select" required>
                        <option value="">กรุณากรอกแปลง..</option>
                        @foreach($prequestconvert as $row)
                        <option value="{{$row['convertname']}}">{{$row['convertname']}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        กรุณาเลือกแบบแปลง
                    </div>
                </div>
            </div>
            <!-- สินค้าที่ขอสั่งซื้อ -->
            <br>

            <table class="table table-hover table-bordered border-dark table-border-dark" id="detailmenu">
                <thead>
                    <tr class="text-center">
                        <th style="width:5%;">ลำดับ</th>
                        <th style="width:20%;">รายการสินค้า</th>
                        <th style="width:10%;">จำนวน</th>
                        <th style="width:10%;">หน่วย</th>
                        <th style="width:10%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><label class="col-form-label">1</label></td>
                        <td>
                            <input type="text" list="product" name="productname[]" class="form-control productname" required>
                            <datalist id="product">
                                @foreach($product as $row)
                                <option value="{{$row['Product_name']}}">{{$row['Product_name']}}</option>
                                @endforeach
                            </datalist>
                        </td>
                        <td><input type="number" name="productnumber[]" min="1" class="form-control productnumber" required></td>
                        <td>
                            <input type="text" name="unit[]" list="unit" class="form-control unit" required>
                            <datalist id="unit">
                                @foreach($unit as $row)
                                <option value="{{$row['unit']}}">{{$row['unit']}}</option>
                                @endforeach
                            </datalist>
                        </td>
                        <td class="text-center"><a class="btn btn-outline-danger delete"><i style="font-size:18px" class="far fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><button class="btn btn-sm btn-primary" id="addrow"><i class="fas fa-plus"></i>&nbsp;&nbsp;เพิ่มรายการสินค้า</button></th>
                    </tr>
                </tfoot>
            </table>

            <div class="form-group text-center">
                <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                <a href="#" id="subform" data-toggle="modal" data-target="#passcode_confirm" class="btn btn-success ml-2"><i style="font-size:18px" class="fas fa-save"></i>&nbsp;&nbsp;บันทึก</a>
            </div>
        </form>
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


    <script type="text/javascript">
        $(document).ready(function() {

            $('#passcode_confirm').on('shown.bs.modal', function() {
                $(this).find('input[name=passkey]').focus();
            }).on('hidden.bs.modal',function(){
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
                        }else{
                            Swal.fire({
                                type : 'error',
                                title : 'รหัสลับไม่ถูกต้อง',
                                text : 'กรอกรหัสลับอีกครั้ง',
                                confirmButtonText : 'ตกลง',
                                onAfterClose : () => {
                                    $('input[name=passkey]').val('').focus();
                                }
                            })
                        }
                    }
                });
            });

            var index = 2,
                array = [];
            $('#addrow').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log(index);
                if (index < 1) {
                    index = 1;
                }
                if (index <= 10) {
                    $('#detailmenu tbody').append('<tr><td class="text-center"><label class="col-form-label">' + (index++) + '</label></td><td>' +
                        '<input type="text" list="product" name="productname[]" class="form-control productname" required>' +
                        '<td><input type="number" name="productnumber[]" min="1"class="form-control productnumber" required></td>' +
                        '<td><input type="text" name="unit[]" list="unit" class="form-control unit" required></td>' +
                        '<td class="text-center"><a class="btn btn-outline-danger delete"><i style="font-size:18px" class="far fa-trash-alt"></i></a></td></tr>');
                    $('#detailmenu tbody tr:last .productname').focus();
                    $(".delete").click(function() {
                        $(this).parents("tr").remove();
                        index--;
                    });
                }

            });
        })
    </script>
    @stop
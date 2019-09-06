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
                        <th style="width:20%;">รายการสินค้า</th>
                        <th style="width:10%;">จำนวน</th>
                        <th style="width:10%;">หน่วย</th>
                        <th style="width:10%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                        <td class="text-center"><button class="btn btn-outline-danger"><i style="font-size:18px" class="far fa-trash-alt"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"><button class="btn btn-sm btn-primary" id="addrow"><i class="fas fa-plus"></i>&nbsp;&nbsp;เพิ่มรายการสินค้า</button></th>
                    </tr>
                </tfoot>
            </table>

            <div class="modal fade" id="signature">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i style="font-size:18px" class="fas fa-signature"></i>&nbsp;&nbsp;กรอกลายเซ็น
                            </h5>
                            <button class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="wrapper text-center">
                                <canvas id="signature-pad" class="signature-pad" width=460 height=200 style="border: 2px dashed #888"></canvas>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" id="clearsig"><i style="font-size:18px" class="fas fa-eraser"></i>&nbsp;&nbsp;ล้าง</button>
                            <button class="btn btn-success" id="confirm"><i style="font-size:18px" class="fas fa-check"></i>&nbsp;&nbsp;ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                <button type="submit" class="btn btn-success ml-2" id="subform"><i style="font-size:18px" class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
            </div>
        </form>
    </div>

    <div id="filepdf" class="d-none">
        <div id="heading">
            <h3 style="text-align:center">ใบขอสั่งซื้อ<br>PURCHASE REQUEST</h3>
        </div>
        <div id="tabletop">
            <table>
                <tr>
                    <th>เลขที่เอกสาร</th>
                    <td id="prcode_ex"></td>
                </tr>
                <tr>
                    <th>วันที่ขอสั่งซื้อ</th>
                    <td id="date_ex"></td>
                </tr>
            </table>
        </div>
        <div id="exporta">
            <table id="tableexa">
                <tbody>
                    <tr>
                        <th>TO :</th>
                        <td>THERA ASSET CO.,LTD</td>
                        <th style="padding-left:30px">งวดงานที่</th>
                        <td>18</td>
                    </tr>
                    <tr>
                        <th>ชื่อผู้รับเหมา</th>
                        <td id="name_ex">คุณ เก่ง</td>
                        <th style="padding-left:30px">แปลง</th>
                        <td id="transform_ex"></td>
                    </tr>
                    <tr>
                        <th>แบบงาน</th>
                        <td id="work_ex"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table id="exportb">
            <thead>
                <tr>
                    <th id="no_exb">ลำดับ</th>
                    <th id="detail_exb">รายการสินค้า</th>
                    <th id="num_exb">จำนวน</th>
                    <th id="unit_exb">หน่วย</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div id="signature">
            <img id="signatureimg" src="{{Auth::user()->signature}}" alt="">
            <h4>{{ Auth::user()->firstname }}&nbsp;&nbsp;{{ Auth::user()->lastname }}<br>{{ Auth::user()->role }}<br>วันที่ {{ date('d-m-Y') }}</h4>
        </div>
    </div>

    <input type="hidden" id="signature" value="{{ Auth::user()->signature }}">

    <script type="text/javascript">
        $('#confirm').click(function() {

            event.stopPropagation();
            event.preventDefault();
            console.log(123);
            if (!signaturePad.isEmpty()) {
                var name = [];
                var num = [];
                var units = [];
                var store = [];
                var price = [];
                var sum = [];
                var image = signaturePad.toDataURL();
                var key = $('#convert').val() + '-' + $('#keyja').text();

                $('#prcode_ex').text(key);
                $('#confirm').html('<div class="spinner-border spinner-border-sm text-light" role="status"> <span class = "sr-only" > รอสักครู่ < /span></div>&nbsp;&nbsp;รอสักครู่')

                $('table tbody tr').each(function(index, value) {
                    name.push($('td .productname', this).val());
                    num.push($('td .productnumber', this).val());
                    units.push($('td .unit', this).val());
                });

                $('#date_ex').text($('#datetime').val());
                $('#work_ex').text($('select[name=formwork]').val());
                $('#transform_ex').text($('select[name=prequestconvert]').val());

                $('#detailmenu tbody tr').each(function(index) {
                    productname = $(this).find('.productname').val();
                    productnumber = $(this).find('.productnumber').val();
                    unit = $(this).find('.unit').val();
                    $('#exportb tbody').append('<tr><td>' + (index + 1) + '</td><td>' + productname + '</td><td>' + productnumber + '</td><td>' + unit + '</td></tr>');
                });

                $.ajax({
                    type: 'post',
                    url: 'index',
                    data: {
                        _token: '{{csrf_token()}}',
                        key: key,
                        image: image,
                        productname: name,
                        productnumber: num,
                        units: units,
                        date: $('input[name=date]').val(),
                        contractor: 'คุณ เก่ง',
                        formwork: $('select[name=formwork]').val(),
                        prequestconvert: $('select[name=prequestconvert]').val(),
                        filepdf: $('#filepdf').html()
                    },
                    success: function(data) {
                        console.log(data.msg);
                        $('#signature').modal('hide');
                        swal.fire({
                            showCancelButton: true,
                            confirmButtonText: 'ไปยังหน้า PR',
                            cancelButtonText: 'สร้าง PR ใหม่',
                            focusConfirm: true,
                            width: 600,
                            heightAuto: true,
                            type: 'success',
                            title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                            text: 'สามารถตรวจสอบข้อมูลได้ที่ตาราง PR'
                        }).then((result) => {
                            if (result.value)
                                window.location.replace('./');
                            else
                                location.reload();
                        })
                    }
                });
            } else {
                Swal.fire({
                    title: 'กรุณากรอกลายเซ็น',
                    text: 'กรอกลายเซ็นก่อนกดตกลง',
                    confirmButtonText: 'เข้าใจแล้ว',
                    type: 'warning'
                })
            }
        });

        $('#subform').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            if ($('form')[0].checkValidity() == false) {
                $('form').addClass('was-validated');
            }
            if ($('#signature').val() == '-') {
                Swal.fire({
                    type: 'error',
                    title: 'ไม่สามารถดำเนินการต่อได้',
                    text: 'ต้องใส่ลายเซ็นในหมวดโปรไฟล์',
                    confirmButtonText: 'ยอมรับ'
                })
            } else {
                $('#forminput').submit();
            }
        });
        $('#addrow').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#detailmenu tbody').append('<tr></label></td><td>' +
                '<input type="text" list="product" name="productname[]" class="form-control productname" required>' +
                '<td><input type="number" name="productnumber[]" min="1"class="form-control productnumber" required></td>' +
                '<td><input type="text" name="unit[]" list="unit" class="form-control unit" required></td>' +
                '<td class="text-center"><button class="btn btn-outline-danger"><i style="font-size:18px" class="far fa-trash-alt"></i></button></td></tr>');
            $('#detailmenu tbody tr:last .productname').focus();

        });
    </script>

    <div id="exportpdf" class="d-none">
        <div style="position:absolute">
        </div>
        <div style="text-align:center">

        </div>
        <div style="position:absolute;top:140px;left:47%;text-align:center">
            <h4>ใบสั่งซื้อ</h4>
        </div>
        <div id="number_doc">
            <h4>เลขที่เอกสาร PO <span style="color:red">123</span></h4>
        </div>
        <div class="pd_table">
            <table class="main_detail_po">
                <tr>
                    <td style="width:5%">12</td>
                    <td style="width:30%">12</td>
                    <td style="width:15%">32</td>
                    <td style="width:15%">42</td>
                    <td style="width:15%">23</td>
                    <td style="width:20%">44</td>
                    <td>
                        <table class="detail_po">
                            <tr>
                                <th style="text-align:left">ผู้ขาย :</th>
                                <td style="width:290px">23</td>
                            </tr>
                            <tr>
                                <th style="text-align:left">โทรศัทพ์ :</th>
                                <td style="width:290px">55</td>
                            </tr>
                            <tr>
                                <th style="text-align:left;vertical-align:top">ที่อยู่ :</th>
                                <td style="width:290px">22</td>
                            </tr>
                            <tr>
                                <th style="text-align:left">โทรสาร :</th>
                                <td style="width:290px">55</td>
                            </tr>
                        </table>
                    </td>
                    <td>

            </table>
        </div>


        @stop
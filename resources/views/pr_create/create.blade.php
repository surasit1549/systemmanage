@extends('Home.master')
@section('title','Crate PR')
@section('tabbarcss')
<style>
    #constructtab {
        border-right: 5px solid rgb(41, 207, 219);
    }
</style>
@stop
@section('content')


<div class="card">
    <div class="card-header text-white">
        <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation" novalidate action="{{url('pr_create')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-6">
                    <a class="btn btn-info text-white" onclick="location.reload();">Refresh</a>
                </div>
                <div class="form-group col-md-6 text-right">
                    <input type="text" name="date" value="{{ date('d-m-Y') }}" class="border-0" size="8" autocomplete="off">
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
                    <select name="prequestconvert" class="custom-select" required>
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

            <table class="table table-hover table-bordered border-dark table-border-dark">
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
                        <td><input type="text" class="form-control productname" name="" required></td>
                        <td><input type="number" min="1" class="form-control productnumber" name="" required></td>
                        <td><input type="text" class="form-control unit" name="" required></td>
                        <td class="text-center"><button class="btn btn-outline-danger"><i style="font-size:18px" class="far fa-trash-alt"></i></button></td>
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
<<<<<<< HEAD
        <a class="btn btn-danger" href="{{route('prequest.index')}}"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        <button type="submit" class="btn btn-success ml-2" id="subbutton"><i style="font-size:18px" class="fas fa-share"></i>&nbsp;&nbsp;ยืนยัน</button>
=======
        <a class="btn btn-danger" href="{{route('pr_create.index')}}"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        <button type="submit" class="btn btn-success" id="subbutton"><i style="font-size:18px" class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
>>>>>>> 171def28955133ebc42c56d17792b1294cc7f5ce
    </div>
    </form>
</div>



<!-- การเพิ่มสินค้า  -->
<script type="text/javascript">

    $(document).ready(function() {
        $('input.unit').autocomplete({
            lookup: [{
                    value: 'เส้น',
                    data: 'เส้น'
                },
                {
                    value: 'ชิ้น',
                    data: 'ชิ้น'
                },
                {
                    value: 'แผ่น',
                    data: 'แผ่น'
                },
                {
                    value: 'ลัง',
                    data: 'แมม'
                },
                {
                    value: 'กล่อง',
                    data: 'แนน'
                },
                {
                    value: 'หีบ',
                    data: 'แสส'
                },
                {
                    value: 'ตัว',
                    data: 'แสส'
                },
                {
                    value: 'ชุด',
                    data: 'แสส'
                },
                {
                    value: 'กระป๋อง',
                    data: 'แสส'
                },
                {
                    value: 'ปิ๊บ',
                    data: 'แสส'
                },
                {
                    value: 'อัน',
                    data: 'แสส'
                }
            ],
            autoSelectFirst: true
        });
        var index = 2,
            arr = [];
        $('#getstore li').each(function(index) {
            arr.push({
                value: $(this).text(),
                data: $(this).text()
            });
        });
        $('.namestore').autocomplete({
            lookup: arr,
            autoSelectFirst: true
        });

        function sumallprice() {
            var sum = 0;
            $('tbody tr').each(function() {
                sum += parseInt($(this).find('.sum').text());
            });
            $('#sumofprice').text(parseInt(sum).toFixed(2));
        }

        function changeSum(pointing) {
            var pd = parseInt(pointing.parents().eq(1).find('.productnumber').val());
            var p = parseFloat(pointing.parents().eq(1).find('.price').val());
            pointing.parents().eq(1).find('.sum').text((pd * p).toFixed(2));
        }
        $('tbody').on('keyup', 'input[type=number]', function() {
            var point = $(this).parents().eq(1);
            if (!point.find('.productnumber').val() || !point.find('.price').val())
                point.find('.sum').val(0);
            else {
                changeSum($(this));
            }
        }).on('blur', 'input[type=number]', function() {
            var point = $(this).parents().eq(1);
            if ($(this).hasClass('price') && ($(this).val().toString().indexOf('.') == -1))
                $(this).val(parseInt($(this).val()).toFixed(2));
            if (!point.find('.productnumber').val() || !point.find('.price').val())
                point.find('.sum').val(0);
            else
                changeSum($(this));
            sumallprice();
        });
        $('#addrow').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('tbody').append('<tr><td class="text-center"><label class="col-form-label">' + (index++) + '</label></td><td>' +
                '<input type="text" class="form-control productname" required></td>' +
                '<td><input type="number" min="1" class="form-control productnumber" required></td>' +
                '<td><input type="text" class="form-control unit" required></td>' +
                '<td class="text-center"><button class="btn btn-outline-danger"><i style="font-size:18px" class="far fa-trash-alt"></i></button></td></tr>');
            $('tbody tr:last .productname').focus();
            $('input.unit').autocomplete({
                lookup: [{
                        value: 'เส้น',
                        data: 'เส้น'
                    },
                    {
                        value: 'ชิ้น',
                        data: 'ชิ้น'
                    },
                    {
                        value: 'แผ่น',
                        data: 'แผ่น'
                    },
                    {
                        value: 'ลัง',
                        data: 'แมม'
                    },
                    {
                        value: 'กล่อง',
                        data: 'แนน'
                    },
                    {
                        value: 'หีบ',
                        data: 'แสส'
                    },
                    {
                        value: 'ตัว',
                        data: 'แสส'
                    },
                    {
                        value: 'ชุด',
                        data: 'แสส'
                    },
                    {
                        value: 'กระป๋อง',
                        data: 'แสส'
                    },
                    {
                        value: 'ปิ๊บ',
                        data: 'แสส'
                    },
                    {
                        value: 'อัน',
                        data: 'แสส'
                    }
                ],
                autoSelectFirst: true
            });
            $('.namestore').autocomplete({
                lookup: arr,
                autoSelectFirst: true
            });
        });

        function SortIndex() {
            index = 1;
            $('tbody tr').each(function() {
                $('td:first', this).text(index++);
            });
        }
        // Remove Record on the table 
        $('tbody').on('click', '.btn-outline-danger', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (index == 2)
                swal.fire({
                    title: 'ไม่สามารถลบข้อมูลได้',
                    type: 'error',
                    text: 'ต้องมีรายการอย่างน้อยหนึ่งรายการ',
                    confirmButtonText: 'ตกลง'
                })
            else {

                var productname = $(this).parents().eq(1).find('.productname').val();
                var productnumber = $(this).parents().eq(1).find('.productnumber').val();
                var unit = $(this).parents().eq(1).find('.unit').val();
                var keystore = $(this).parents().eq(1).find('.keystore').val();
                var price = $(this).parents().eq(1).find('.price').val();
                if (productname || productnumber || unit || keystore || price) {
                    swal.fire({
                        title: 'คำเตือน',
                        type: 'warning',
                        text: 'เนื่องจากยังมีข้อมูล ต้องการลบข้อมูลหรือไม่',
                        confirmButtonText: 'ตกลง',
                        showCancelButton: true,
                        showCloseButton: true,
                        cancelButtonText: 'ยกเลิก',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $(this).parents().eq(1).remove();
                            SortIndex();
                        }
                    })
                } else {
                    $(this).parents().eq(1).remove();
                    SortIndex();
                }
            }
        });

        $('#subbutton').click(function(e) {

            e.preventDefault();
            e.stopPropagation();

            if ($('form')[0].checkValidity() == false) {
                $('form').addClass('was-validated');
            } else {

                var name = [];
                var num = [];
                var units = [];
                var store = [];
                var price = [];
                var sum = [];
                $('table tbody tr').each(function(index, value) {
                    name.push($('td .productname', this).val());
                    num.push($('td .productnumber', this).val());
                    units.push($('td .unit', this).val());
                });

                $.ajax({
                    type: 'post',
                    url: 'index',
                    data: {
                        _token: '{{csrf_token()}}',
                        name: name,
                        num: num,
                        units: units,
                        keyPR: $('input[name=keyPR]').val(),
                        date: $('input[name=date]').val(),
                        contractor: $('input[name=contractor]').val(),
                        formwork: $('select[name=formwork]').val(),
                        prequestconvert: $('select[name=prequestconvert]').val()
                    },
                    success: function(data) {
                        console.log(data.msg);
                        swal.fire({
                            showCancelButton: true,
                            cancelButtonText: 'สร้าง PR ใหม่',
                            confirmButtonText: 'ไปยังหน้า PR',
                            focusConfirm: true,
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
            }
        });
    });
</script>
@stop

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
        <form method="post" class="needs-validation" novalidate action="{{url('pr_create')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-6">
                    <a class="btn btn-info text-white" onclick="location.reload();">Refresh</a>
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
                        <td><input type="number" name="productnumber[]" min="1"class="form-control productnumber" required></td>
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
                <a class="btn btn-danger" href="{{route('pr_create.index')}}"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                <button type="submit" class="btn btn-success ml-2" id="subbutton"><i style="font-size:18px" class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
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
            <img id="signatureimg" src="https://s3.ap-southeast-1.amazonaws.com/document-flow-s3/signature/test" alt="">
            <h4>( ณัฐดนัย จำปาศรี )<br>ผู้รับเหมา<br>วันที่ {{ date('d-m-Y') }}</h4>
        </div>
    </div>
<script type="text/javascript">
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
          '<input type="text" list="product" name="productname[]" class="form-control productname" required>' +
          '<td><input type="number" name="productnumber[]" min="1"class="form-control productnumber" required></td>' +
          '<td><input type="text" name="unit[]" list="unit" class="form-control unit" required></td>' +
          '<td class="text-center"><button class="btn btn-outline-danger"><i style="font-size:18px" class="far fa-trash-alt"></i></button></td></tr>');
      $('#detailmenu tbody tr:last .productname').focus();
      
  });
</script>
@stop
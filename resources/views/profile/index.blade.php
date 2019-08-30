@extends('Home.master')
@section('title','Profile')
@section('tabbarcss')
<style>
    #user_profile {
        border-right: 5px solid rgb(41, 207, 219);
    }

    #searchtext:focus {
        outline: none !important;
        box-shadow: none;
    }

    th {
        background-color: #f1f1f1;
    }
</style>
@stop
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="text-white"><i style="font-size:25px" class="far fa-address-card"></i>&nbsp;&nbsp;ข้อมูลผู้ใช้งาน</h5>
    </div>
    <div class="card-body">
        <div class="container mb-3">
            <div class="mb-3">
                <a class="btn btn-success" href="{{route('profile.edit',Auth::id())}}"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลส่วนตัว</a>
                <button class="btn btn-primary text-white ml-2"><i class="fas fa-key"></i>&nbsp;&nbsp;เปลี่ยนพาสเวิร์ด</button>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>ชื่อ</th>
                    <td>{{ Auth::user()->firstname }}</td>
                </tr>
                <tr>
                    <th>นามสกุล</th>
                    <td>{{ Auth::user()->lastname }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ Auth::user()->username }}</td>
                </tr>
                <tr>
                    <th>ตำแหน่ง</th>
                    <td>{{ Auth::user()->role }}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>เบอร์โทรติดต่อ</th>
                    <td>{{ Auth::user()->phone }}</td>
                </tr>
                <tr>
                    <th>ที่อยู่ปัจจุบัน</th>
                    <td>{{ Auth::user()->address }}</td>
                </tr>
                <tr>
                    <th>
                        <div class="col-form-label">
                            ลายเซ็น
                        </div>
                    </th>
                    <td>
                        @if( Auth::user()->signature != '-' )
                        <button class="btn btn-sm btn-info text-white">ดูลายเซ็น</button>
                        @endif
                        <button data-toggle="modal" data-target="#signature" class="btn btn-sm btn-success ml-1">กำหนด</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

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

<script>
    $(document).ready(function() {
        // Signature
        var canvas = $('#signature-pad')[0];
        var signaturePad = new SignaturePad(canvas, {
            penColor: "blue"
        });

        $('#confirm').click(function() {

            event.stopPropagation();
            event.preventDefault();

            if (!signaturePad.isEmpty()) {

                
            }else{
                Swal.fire({
                  type : 'error',
                  title : 'กรุณาเซ็นลายเซ็น',
                  text : 'ไม่สามารถบันทึกได้เนื่องจากยังไม่ได้เซ็นลายเซ็น',
                  confirmButtonText : 'ตกลง'  
                })
            }
        });

        $('#clearsig').click(function() {
            event.stopPropagation();
            event.preventDefault();
            signaturePad.clear();
        });

        $('#signature').on('hide.bs.modal', function() {
            signaturePad.clear();
        });
        // End Signature
    });
</script>

@stop
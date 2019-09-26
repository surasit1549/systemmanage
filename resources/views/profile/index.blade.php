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


@if(\Session::has('msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><i style="font-size:20px" class="fas fa-check-circle"></i>&nbsp;&nbsp;เปลี่ยนรหัสลับสำเร็จ ! </strong>สามารถกรอกรหัสลับเมื่อยืนยันรายการครั้งต่อไปได้ทันที
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if( Auth::user()->signature == '-' )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i style="font-size:20px" class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;ยังไม่มีลายเซ็น</strong>&nbsp;กรุณาเซ็นรายเซ็นเพื่อดำเนินการต่อ
</div>
@endif

@if( Auth::user()->passcode == '-' )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i style="font-size:20px" class="fas fa-exclamation-circle"></i></i>&nbsp;&nbsp;ยังไม่มีรหัสลับ</strong>&nbsp;กรอกรหัสลับเพื่อดำเนินการต่อ
</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="text-white card-title"><i class="far fa-address-card"></i>&nbsp;&nbsp;ข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <div class="container mb-3">
            <div class="mb-3">
                <a class="btn btn-success" href="{{route('profile.edit',Auth::id())}}"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูลส่วนตัว</a>
                <button class="btn btn-primary text-white ml-2" data-toggle="modal" data-target="#changepassword"><i class="fas fa-key"></i>&nbsp;&nbsp;เปลี่ยนพาสเวิร์ด</button>
                <button class="btn btn-secondary text-white ml-2" data-toggle="modal" data-target="#passcheck"><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp;รหัสลับ</button>
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
                        <button class="btn btn-sm btn-info text-white" id="viewsignature" data-toggle="modal" data-target="#viewsig">ดูลายเซ็น</button>
                        @endif
                        <button data-toggle="modal" data-target="#signature" class="btn btn-sm btn-success ml-1">กำหนด</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="viewsig">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i style="font-size:20px" class="fas fa-file-signature"></i>&nbsp;&nbsp;ลายเซ็น</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color:#f1f1f1">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-secondary">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="passcheck">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i style="font-size:20px" class="fas fa-unlock-alt"></i>&nbsp;&nbsp;รหัสลับ</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'profile/passcode','id' => 'passcode_form']) !!}
                <div class="form-group">
                    {!! Form::label('Passcode') !!}
                    <small class="text-danger">* รหัสลับ 4 ตัว</small>
                    {!! Form::password('passcode',['maxlength' => '4','class' => 'form-control','id' => 'passcode']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Re Passcode') !!}
                    {!! Form::password('repasscode',['maxlength' => '4','class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Password') !!}
                    {!! Form::password('passwordcheck',['class' => 'form-control','id' => 'passwordcheck']) !!}
                </div>
                <div class="text-center">
                    {!! Form::submit('บันทึก',['class' => 'btn btn-success']) !!}
                    <a href="#" class="btn btn-secondary ml-2" data-dismiss="modal">ยกเลิก</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changepassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i style="font-size:20px" class="fas fa-key"></i>&nbsp;&nbsp;เปลี่ยนพาสเวิร์ด</h5>
                <button data-dismiss="modal" class="close">&times;</button>
            </div>
            <form id="changepassword_form" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old-password">Password</label>
                        <input type="password" class="form-control" name="oldpassword" id="oldpassword">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="passwordagain">New Password again</label>
                        <input type="password" class="form-control" name="passwordagain" id="passwordagain">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="confirm_changepassword"><i class="fas fa-check"></i>&nbsp;&nbsp;ยืนยัน</button>
                    <a href="#" data-dismiss="modal" class="btn btn-secondary ml-2"><i class="fas fa-times"></i>&nbsp;&nbsp;ยกเลิก</a>
                </div>
            </form>
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

                $(this).html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;รอสักครู่');

                $.ajax({
                    url: 'profile/createSignature',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        image: signaturePad.toDataURL()
                    },
                    success: function(data) {
                        location.reload();
                    }
                })

            } else {
                Swal.fire({
                    type: 'error',
                    title: 'กรุณาเซ็นลายเซ็น',
                    text: 'ไม่สามารถบันทึกได้เนื่องจากยังไม่ได้เซ็นลายเซ็น',
                    confirmButtonText: 'ตกลง'
                })
            }
        });


        $('#changepassword_form').validate({
            rules: {
                oldpassword: 'required',
                password: 'required',
                passwordagain: {
                    'required': true,
                    'equalTo': '#password'
                }
            },
            messages: {
                oldpassword: {
                    'required': 'กรอกรหัสผ่านเก่า'
                },
                password: {
                    'required': 'กรอกรหัสผ่านใหม่'
                },
                passwordagain: {
                    'required': 'กรอกรหัสผ่านใหม่อีกครั้ง',
                    'equalTo': 'กรอกรหัสผ่านให้ตรงกัน'
                }
            },
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            submitHandler: function(form, e) {
                var oldpassword = $('#changepassword_form').find('#oldpassword').val();
                var newpassword = $('#changepassword_form').find('#password').val();
                $.ajax({
                    url: 'profile/changpassword',
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        previous_password: oldpassword,
                        new_password: newpassword
                    },
                    success: function(data) {
                        if (data.msg == 'fail') {
                            Swal.fire({
                                type: 'error',
                                title: 'ไม่สามารถดำเนินการต่อได้',
                                text: 'กรอกรหัสผ่านเดิมให้ถูกต้อง',
                                confirmButtonText: 'ตกลง'
                            })
                        } else {
                            Swal.fire({
                                type: 'success',
                                title: 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว',
                                text: 'สามารถเข้าสู่ระบบโดยใช้รหัสผ่านใหม่ได้ทันที',
                                showConfirmButton: false,
                                timer: 1500,
                                onAfterClose: () => {
                                    location.reload();
                                }
                            })
                        }
                    }
                });
                return false;
            }
        });


        $('#passcheck').on('shown.bs.modal', function() {
            $(this).find('[name=passcode]').focus();
        }).on('hide.bs.modal', function() {
            var form = $('#passcode_form');
            form.validate().resetForm();
            form.find('input').removeClass('is-invalid is-valid');
            form.find('input:password').val('');
        });

        $('#passcode_form').validate({
            rules: {
                passcode: {
                    'required': true,
                    'minlength': 4
                },
                repasscode: {
                    'required': true,
                    'equalTo': '#passcode'
                },
                passwordcheck: 'required'
            },
            messages: {
                passcode: {
                    'required': 'กรอกรหัสลับ',
                    'minlength': 'กรอกรหัสลับให้ครบ 4 ตัว'
                },
                repasscode: {
                    'required': 'กรอกรหัสลับอีกครั้ง',
                    'equalTo': 'กรอกให้ตรงกัน'
                },
                passwordcheck: 'กรอกรหัสผ่าน'
            },
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            submitHandler: function(form, e) {
                var pass = $('#passcode_form').find('[name=passwordcheck]').val();
                $.ajax({
                    type: 'POST',
                    url: '/profile/passwordcheck',
                    data: {
                        _token: '{{csrf_token()}}',
                        password: pass
                    },
                    success: function(data) {
                        if (data.status) {
                            form.submit();
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'ไม่สามารถดำเนินการต่อได้',
                                text: 'ใส่รหัสผ่านให้ถูกต้อง',
                                confirmButtonText: 'ตกลง'
                            })
                        }
                    }
                });
            }

        });

        $('#changepassword').on('shown.bs.modal', function() {
            $(this).find('#oldpassword').focus();
        }).on('hide.bs.modal', function() {
            $(this).find('input').val('');
            var $alertas = $('#changepassword_form');
            $alertas.validate().resetForm();
            $alertas.find('input').removeClass('is-invalid is-valid');
        });;


        $('#clearsig').click(function() {
            event.stopPropagation();
            event.preventDefault();
            signaturePad.clear();
        });

        $('#signature').on('hide.bs.modal', function() {
            signaturePad.clear();
        });

        $('#viewsig').on('show.bs.modal', function() {
            var mod = $(this).find('.modal-body');
            $.ajax({
                type: 'POST',
                url: 'profile/viewSignature',
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function(data) {
                    mod.html('<img src="' + data.msg + '"></img>');
                }
            });
        });

        // End Signature
    });
</script>

@stop
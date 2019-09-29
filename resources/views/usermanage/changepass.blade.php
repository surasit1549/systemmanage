@extends('Home.master')
@section('title','Users Information')
@section('tabbarcss')
<style>
    #usertab {
        border-right: 5px solid rgb(41, 207, 219);
    }

    #searchtext:focus {
        outline: none !important;
        box-shadow: none;
    }
</style>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-white card-title"><i class="fas fa-users"></i>&nbsp;&nbsp;เปลี่ยนรหัสผ่าน</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['url' => '/usermanage/changepassword','id' => 'forminput']) !!}
        {!! Form::hidden('id',$id) !!}
        <div class="form-group">
            {!! Form::label('Password') !!}
            {!! Form::password('password',['class' => 'form-control','id' => 'password']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Re-Password') !!}
            {!! Form::password('repassword',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <a class="mr-2 btn btn-secondary text-white" onclick="window.history.back()">ย้อนกลับ</a>
            {!! Form::submit('ตกลง' , ['class' => 'btn btn-success']) !!}
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


<script>
    $('document').ready(function() {
        $('#forminput').validate({
            rules: {
                password: {
                    'required': true,
                    'minlength': 5
                },
                repassword: {
                    'minlength': 5,
                    'required': true,
                    'equalTo': '#password'
                }
            },
            messages: {
                password: {
                    'minlength': 'ต้องมีอย่างน้อย 5 ตัวอักษร',
                    'required': 'กรอกรหัสผ่านใหม่'
                },
                repassword: {
                    'required': 'กรอกรหัสผ่านใหม่อีกครั้ง',
                    'minlength': 'ต้องมีอย่างน้อย 5 ตัวอักษร',
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
            submitHandler: function(form) {
                $('#passcode_confirm').modal('show');
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
                                form.submit();
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
            }
        });


        $('#passcode_confirm').on('shown.bs.modal', function() {
            $(this).find('input[name=passkey]').focus();
        }).on('hidden.bs.modal', function() {
            $(this).find('input[name=passkey]').val('');
        });



    });
</script>
@stop
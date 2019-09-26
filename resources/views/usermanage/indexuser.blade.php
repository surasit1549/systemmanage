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

<div class="form-row col-md-12">
    <div class="form-group">
        <a class="btn btn-sm btn-success text-white" href="{{action('UsermanageController@create')}}">
            <i class="fas fa-plus"></i>
            เพิ่มผู้ใช้งาน
        </a>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="text-white card-title"><i class="fas fa-users"></i>&nbsp;&nbsp;จัดการข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="user_table" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap">#</th>
                    <th class="text-nowrap">ชื่อจริง</th>
                    <th class="text-nowrap">นามสกุล</th>
                    <th class="text-nowrap">Username</th>
                    <th class="text-nowrap">ตำแหน่ง</th>
                    <th class="text-nowrap">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $user as $index=>$users )
                <tr>
                    <input type="hidden" class="email" value="{{$users['email']}}">
                    <input type="hidden" class="phone" value="{{$users['phone']}}">
                    <input type="hidden" class="address" value="{{$users['address']}}">
                    <td style="cursor:pointer" class="text-nowrap details-control text-center"><i style="font-size:20px" class="fa fa-plus-square text-success" aria-hidden="true"></i></td>
                    <td class="text-nowrap">{{$users['firstname']}}</td>
                    <td class="text-nowrap">{{$users['lastname']}}</td>
                    <td class="text-nowrap">{{$users['username']}}</td>
                    <td class="text-nowrap checkrole">{{$users['role']}}</td>
                    <td class="text-nowrap">
                        <a href="{{action('UsermanageController@edit',$users['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
                        &nbsp;&nbsp;
                        <a class="delete_user" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
                        <form method="post" class="delete_form" action="{{action('UsermanageController@destroy',$users['id'])}}">
                            @csrf
                            <input type="hidden" name="username" value="{{$users['username']}}">
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#user_table').DataTable({
                'scrollX': true,
                order: [
                    [1, 'desc']
                ],
                'columns': [{
                        'orderable': false,
                        'width': '5%'
                    },
                    null,
                    null,
                    null,
                    null,
                    {
                        'orderable': false
                    }
                ],
                "oLanguage": {
                    "sSearch": 'ค้นหา',
                    "sInfo": 'ผู้ใช้งานจำนวน _TOTAL_ ไอดี',
                    'sEmptyTable': 'ไม่มีข้อมูลผู้ใช้งาน',
                    'sInfoEmpty': 'ไม่พบรายการที่ต้องการ',
                    'sZeroRecords': 'ไม่พบคำที่ต้องการค้นหา',
                    "oPaginate": {
                        "sPrevious": 'ก่อนหน้า',
                        "sNext": 'ถัดไป'
                    },
                    "sInfoFiltered": '( จากทั้งหมด _MAX_ รายการ )',
                    "sLengthMenu": 'แสดงข้อมูล <select class="custom-select custom-select-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="30">30</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">ทั้งหมด</option>' +
                        '</select> รายการ'
                }
            });
            $('[data-toggle="tooltip"]').tooltip();

            function format(email, phone, address) {
                // `d` is the original data object for the row
                return '<table class="table table-light"><tr><th>อีเมล</th><td>' + email + '</td><th>เบอร์โทรศัพท์</th><td>' + phone + '</td></tr><tr><th>ที่อยู่</th><td>' + address + '</td></tr></table>';
            }

            $('#user_table tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var tdi = tr.find('i.fa');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square text-danger');
                    tdi.first().addClass('fa-plus-square text-success');
                } else {
                    // Open this row
                    var email = $(this).parent().find('.email').val();
                    var phone = $(this).parent().find('.phone').val();
                    var address = $(this).parent().find('.address').val();
                    row.child(format(email, phone, address)).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square text-success');
                    tdi.first().addClass('fa-minus-square text-danger');
                }
            });

            $('.delete_user').click(function() {
                var check = $(this).parent().prev().text();
                Swal.fire({
                    title: 'ต้องการลบผู้ใช้งานหรือไม่',
                    text: 'เมื่อลบผู้ใช้งานแล้วจะไม่สามารถกู้กลับมาได้',
                    type: 'warning',
                    confirmButtonText: 'ตกลง',
                    showCancelButton: true,
                    cancelButtonText: 'ยกเลิก',
                    focusCancel: true
                }).then((result) => {
                    if (result.value) {
                        if (check == 'แอดมิน') {
                            var n = 0;
                            $('.checkrole').each(function() {
                                if ($(this).text() == 'แอดมิน') {
                                    if (++n > 1) {
                                        return false;
                                    }
                                }
                            });
                            if (n <= 1) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'ไม่สามารถลบได้',
                                    text: 'ต้องมีแอดมินในระบบอย่างน้อยหนึ่งคน',
                                    confirmButtonText: 'ตกลง'
                                })
                            } else {
                                Swal.fire({
                                    title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                    type: 'success',
                                    timer: 1500,
                                    showConfirmButton: false,
                                    onAfterClose: () => {
                                        $(this).next('form').submit();
                                    }
                                })
                            }
                        } else {
                            Swal.fire({
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: false,
                                onAfterClose: () => {
                                    $(this).next('form').submit();
                                }
                            })
                        }
                    }
                })
            });

        });
    </script>

    @stop
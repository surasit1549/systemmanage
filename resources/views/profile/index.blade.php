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
                <a class="btn btn-success" href="{{route('profile.edit',$user['id'])}}"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูล</a>
                <button class="btn btn-primary text-white ml-2"><i class="fas fa-key"></i>&nbsp;&nbsp;เปลี่ยนพาสเวิร์ด</button>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>ชื่อ</th>
                    <td>{{ $user['first_name'] }}</td>
                </tr>
                <tr>
                    <th>นามสกุล</th>
                    <td>{{ $user['last_name'] }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $user['username'] }}</td>
                </tr>
                <tr>
                    <th>ตำแหน่ง</th>
                    <td>{{ $user['role'] }}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{ $user['email'] }}</td>
                </tr>
                <tr>
                    <th>เบอร์โทรติดต่อ</th>
                    <td>{{ $user['phone'] }}</td>
                </tr>
                <tr>
                    <th>ที่อยู่ปัจจุบัน</th>
                    <td>{{ $user['address'] }}</td>
                </tr>
                <tr>
                    <th>
                        <div class="col-form-label">
                            ลายเซ็น
                        </div>
                    </th>
                    <td>
                        <button class="btn btn-sm btn-info text-white">ดูลายเซ็น</button>
                        <button class="btn btn-sm btn-success ml-1">กำหนด</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@stop
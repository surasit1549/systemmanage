<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkpassword(Request $request)
    {
        if (Auth::user()->password == Hash::make($request->oldpassword)) {
            return response()->json(['msg' => true]);
        }
        return response()->json(['msg' => false]);
    }

    public function viewSignature(Request $request)
    {
        $file = Auth::user()->signature;
        return response()->json(['msg' => $file]);
    }

    public function changepassword(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        User::find(Auth::id())->update($request->toArray());
        return redirect()->route('profile.index')->with('msg', 'เปลี่ยนรหัสผ่านเรียนร้อยแล้ว');
    }

    public function createSignature(Request $request)
    {

        // GET SIGNATURE FROM USER

        $data_uri = $request->input('image');
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        file_put_contents("signature/test.png", $decoded_image);

        // SENT SIGNATURE TO S3
        $img_path = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/signature/' . Auth::user()->email;
        $path = "C:/xampp/htdocs/project/public/";
        $s3 = Storage::disk('s3');
        $s3->delete($img_path);
        $s3->put('signature/' . Auth::user()->email, file_get_contents($path . 'signature/test.png'), 'public');
        $arr = array("signature" => $img_path);
        User::find(Auth::id())->update($arr);
        return response()->json(['msg' => $img_path]);
    }

    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->update($request->toArray());
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        //cek apakah ada gambar, jika ada maka simpan sementara di folder storage/img/payment-method/tmp
        if($request->hasFile('gambar')){
            $folder = uniqid() . "-" . now()->timestamp;
            $filename = $request->file('gambar')->getClientOriginalName();
            $image = $request->file('gambar')->storeAs("tmp/".$folder, $filename);
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }

        return '';
    }

    public function destroy(Request $request)
    {
        return dd($request->getContent());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use Validator;
use App\Events\send_koordinat;

class Broadcast_controller extends Controller
{
    public function lokasi(Request $request)
    {
        
        if ($request->expectsJson()) {
            $data = Lokasi::latest()->get();
            return response()->json(['data' => $data], 200);
        }

        return view('lokasi')->with([
            'data' => Lokasi::all(),
        ]);
    }

    public function send_koordinat(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'user' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        if($validator->fails()){      
            return response()->json(['status'=>false,'message'=>'Parameter inputan ada yang kosong']);
        }

        $data=Lokasi::create([
            'user' => $data->user,
            'longitude' => $data->longitude,
            'latitude' => $data->latitude,
        ]);

        if($data){
            // event(new \App\Events\SendMessage(123));
            send_koordinat::dispatch();
            return response()->json(['status'=>true,'message'=>'Berhasil']);
        }else{
            return response()->json(['status'=>false,'message'=>'Gagal']);
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\VoiceReader;

class VoiceReaders extends Controller
{
    public function read(Request $request){
        $tts=new VoiceReader();
        return $tts->loadText($request->filename,$request->text);
            
    }
}

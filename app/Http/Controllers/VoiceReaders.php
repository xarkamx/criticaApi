<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\VoiceReader;

class VoiceReaders extends Controller
{
    public function read(Request $request){
        $tts=new VoiceReader();
        return response($tts->loadText($request->filename,$request->text))
            ->header("Content-Type", "audio/mpeg")
            ->header('Content-Disposition', 'inline;filename="test.mp3"')
            ->header('Cache-Control','no-cache')
            ->header("Content-Transfer-Encoding","chunked");
    }
}

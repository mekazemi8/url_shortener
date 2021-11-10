<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        $length = 3;
        if (empty($request->short_url)){
            do {
                $request['short_url'] = $this->generateRandomString($length);
                $validator = Validator::make($request->all(), [
                    'short_url' => 'required|min:3|unique:urls',
                ]);
            } while ($validator->fails());
            $request->validate([
                 'long_url' => 'required|url|active_url'
            ]);
        } else {
            $request->validate([
                'short_url' => 'required|min:3|unique:urls',
                'long_url' => 'required|url|active_url|'
            ]);
        }

        auth()->user()->url()->create([
            'short_url' => $request->short_url,
            'long_url' => $request->long_url
        ]);

        return back()->with('success', 'لینک کوتاه شما با موفقیت ساخته شد');
    }
}

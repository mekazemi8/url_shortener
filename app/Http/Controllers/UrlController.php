<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    function generateRandomString($length = 10)
    {
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
        if (empty($request->short_url)) {
            do {
                $request['short_url'] = $this->generateRandomString($length);
                $validator = Validator::make($request->all(), [
                    'short_url' => 'required|unique:urls',
                ]);
            } while ($validator->fails());
            $request->validate([
                'long_url' => 'required|url|active_url'
            ]);
        } else {
            $request->validate([
                'short_url' => 'required|unique:urls',
                'long_url' => 'required|url|active_url|'
            ]);
        }

        $long_url = $request->long_url;

        // UTM Maker
        if (!empty($request->utm_source) or !empty($request->utm_medium) or !empty($request->utm_campaign) or !empty($request->utm_term) or !empty($request->utm_content)) {
            $long_url .= '?';
            $counter = 0;
            if (!empty($request->utm_source)) {
                $long_url .= 'utm_source=' . $request->utm_source;
                $counter++;
            }
            if (!empty($request->utm_medium)) {
                if ($counter != 0)
                    $long_url .= '&';
                $long_url .= 'utm_medium=' . $request->utm_medium;
                $counter++;
            }
            if (!empty($request->utm_campaign)) {
                if ($counter != 0)
                    $long_url .= '&';
                $long_url .= 'utm_campaign=' . $request->utm_campaign;
                $counter++;
            }
            if (!empty($request->utm_term)) {
                if ($counter != 0)
                    $long_url .= '&';
                $long_url .= 'utm_term=' . $request->utm_term;
                $counter++;
            }
            if (!empty($request->utm_content)) {
                if ($counter != 0)
                    $long_url .= '&';
                $long_url .= 'utm_content=' . $request->utm_content;
                $counter++;
            }
        }

        if (Auth::check()) {
            $url = auth()->user()->url()->create([
                'short_url' => $request->short_url,
                'long_url' => $long_url
            ]);
        } else {
            $url = Url::create([
                'short_url' => $request->short_url,
                'long_url' => $long_url
            ]);
        }

        Cookie::queue('short_url', $url->short_url, 0.2);

        return back()->with('success', 'لینک کوتاه شما با موفقیت ساخته شد');
    }

    public function goto($short_url)
    {
        $url = Url::where('short_url', $short_url)->first();
        $url->update([
            'views' => $url->views + 1,
        ]);
        return redirect($url->long_url);
    }

    public function show_views_count(Request $request)
    {
        $request->validate([
            'short_url' => 'required|min:3',
        ]);

        $url_view_count = Url::where('short_url', $request->short_url)->first();

        Cookie::queue('url_view_count', $url_view_count->views, 0.2);
        Cookie::queue('long_url', $url_view_count->long_url, 0.2);
        return back();
    }

    public function destroy($id)
    {
        $url = Url::find($id);
        if ($url->user_id == Auth::id()) {
            $url->delete();
        }
        return back()->with('success', 'لینک کوتاه با موفقیت حذف شد');
    }
}

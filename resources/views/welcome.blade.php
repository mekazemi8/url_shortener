@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="direction: rtl">

            @if(session()->has('success'))
                <div class="alert alert-success col-md-8">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (Cookie::get('short_url') !== null)
                <div class="col-md-12">
                    <div class="text-center mt-2 text-dark">لینک کوتاه ساخته شده برای شما کاربر گرامی</div>
                    <div class="text-center text-danger shorted_url">{{\Illuminate\Support\Facades\URL::to('/')}}/{{Cookie::get('short_url')}}</div>
                    <button onclick="copyToClipboard('.shorted_url')" class="btn mx-auto d-block btn-info copy-text text-center col-md-2 mb-2">کپی کردن لینک</button>
                </div>
            @endif

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header text-center">
                        ساخت لینک کوتاه
                    </div>

                    <div class="card-body">
                        {{--                    @if ($errors->any())--}}
                        {{--                        <div class="alert alert-danger">--}}
                        {{--                            <ul>--}}
                        {{--                                @foreach ($errors->all() as $error)--}}
                        {{--                                    <li>{{ $error }}</li>--}}
                        {{--                                @endforeach--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                        {{--                    @endif--}}
                        <form action="{{route('make-url')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="main_link" class="float-right">لینک خود را وارد کنید</label>
                                <input type="text" class="form-control" placeholder="لینک کوتاه نشده را وارد کنید" id="main_link" name="long_url" style="direction:ltr">
                                @error('long_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </form>
                    </div>
                </div>

                <h4 class="text-center mt-3 text-info">مشاهده تعداد بازدید لینک کوتاه شما</h4>
                <div class="card">
                    <div class="card-header text-center">
                        نمایش تعداد بازدید
                    </div>

                    <div class="card-body">
                        <form action="{{route('show-views-count')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="short_link" class="float-right">لینک کوتاه را وارد کنید</label>
                                <div class="input-group mb-3" style="direction: ltr">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">pzly.ir/</span>
                                    </div>
                                    <input type="text" class="form-control" maxlength="10" placeholder="لینک کوتاه سه حرفی را وارد کنید" name="short_url">
                                </div>
                                @error('short_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @if (Cookie::get('url_view_count') !== null)
                <div class="col-md-12">
                    <div class="text-center mt-2 text-dark">تعداد بازدید لینک شما</div>
                    <div class="text-center text-danger shorted_url">{{Cookie::get('url_view_count')}}</div>
                    <h5 class="text-center text-dark">لینک اصلی</h5>
                    <a class="text-center d-block" href="{{Cookie::get('long_url')}}">{{Cookie::get('long_url')}}</a>
                </div>
            @endif
        </div>
    </div>
@endsection

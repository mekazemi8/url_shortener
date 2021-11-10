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
            </div>

        </div>
    </div>
@endsection

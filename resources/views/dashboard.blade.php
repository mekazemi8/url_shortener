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
                    <button onclick="copyToClipboard('.shorted_url')" class="btn mx-auto d-block btn-info copy-text text-center col-md-2 mb-2">کپی
                        کردن لینک
                    </button>
                </div>
            @endif

            {{--Admin--}}
            @if(Auth::user()->admin == 1)
                <div class="col-md-8 text-center mb-3">
                    <h6>
                        مجموع تعداد کاربران سایت: {{$users_count}}
                    </h6>
                    <h6>
                        مجموع تعداد لینک های کوتاه: {{$urls_count}}
                    </h6>
                    <h6>
                        مجموع بازدید لینک های کوتاه: {{$url_views}}
                    </h6>
                </div>
            @endif
            {{--End Amin--}}

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
                                <label for="short_link" class="float-right">لینک کوتاه</label>
                                <div class="input-group mb-3" style="direction: ltr">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">pzly.ir/</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="لینک کوتاه" name="short_url">
                                </div>
                                @error('short_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="main_link" class="float-right">لینک اصلی</label>
                                <input type="text" class="form-control" placeholder="لینک کوتاه نشده را وارد کنید" id="main_link" name="long_url"
                                       style="direction:ltr">
                                @error('long_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary mx-auto d-block mb-2" data-toggle="collapse" data-target="#UTM">اضافه کردن UTM</button>

                            <div id="UTM" class="collapse">
                                <div class="form-group">
                                    <label for="utm_source" class="float-right">منبع کمپین</label>
                                    <input type="text" class="form-control" placeholder="pzly" name="utm_source" id="utm_source" style="direction: ltr;">
                                </div>
                                <div class="form-group">
                                    <label for="utm_medium" class="float-right">نوع کمپین</label>
                                    <input type="text" class="form-control" placeholder="banner" name="utm_medium" id="utm_medium" style="direction: ltr;">
                                </div>
                                <div class="form-group">
                                    <label for="utm_campaign" class="float-right">نام کمپین</label>
                                    <input type="text" class="form-control" placeholder="sample" name="utm_campaign" id="utm_campaign" style="direction: ltr;">
                                </div>
                                <div class="form-group">
                                    <label for="utm_term" class="float-right">عبارت کلیدی</label>
                                    <input type="text" class="form-control" name="utm_term" id="utm_term" style="direction: ltr;">
                                </div>
                                <div class="form-group">
                                    <label for="utm_content" class="float-right">محتوای کمپین</label>
                                    <input type="text" class="form-control" name="utm_content" id="utm_content" style="direction: ltr;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">ساخت لینک</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-3" style="direction: ltr;">
                <h3 class="text-center text-info">لیست لینک های شما</h3>

                <table class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">لینک کوتاه شده</th>
                        <th class="text-center">بازدید</th>
                        <th class="text-center">تاریخ ساخت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$url->id}}">
                                    pzly.ir/{{$url->short_url}}
                                </button>
                                <div class="modal fade" id="myModal{{$url->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-muted"><a href="https://puzzley.ir" target="_blank">اپلیکیشن ساز آنلاین
                                                        پازلی</a></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body bg-light">
                                                <a href="{{URL::to('/')}}/{{$url->short_url}}">{{URL::to('/')}}/{{$url->short_url}}</a>
                                                <br><br>
                                                <h6 class="text-center text-primary">لینک اصلی</h6>
                                                <a style="overflow-wrap: break-word;" href="{{$url->long_url}}">{{$url->long_url}}</a>

                                                <div class="card mt-4" style="max-width: 200px; margin: 0 auto;">
                                                    <div class="card-header text-dark">بازدید کل</div>
                                                    <div class="card-body text-dark">{{$url->views}}</div>
                                                </div>

                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <div class="btn-group" style="margin: 0 auto">
                                                    <a href="{{URL::to('/')}}/delete/{{$url->id}}" class="btn btn-danger">حذف</a>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{$url->views}}</td>
                            <td class="text-center">{{$url->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{--Admin--}}
            @if (Auth::user()->admin == 1)
            <div class="col-md-8 mt-3" style="direction: rtl;">
                <h3 class="text-center text-success">لیست کاربران</h3>

                <table class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">نام</th>
                        <th class="text-center">ایمیل</th>
                        <th class="text-center">تعداد لینک ها</th>
                        <th class="text-center">عضویت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{$user->name}}</td>
                            <td class="text-center">
                                <a href="mailto:{{$user->email}}">
                                    {{$user->email}}
                                </a>
                            </td>
                            <td class="text-center">{{$user->url()->count()}}</td>
                            <td class="text-center" style="direction: ltr">{{Str::substr($user->created_at, 0, 16)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @endif
            {{--End Admin--}}

        </div>
    </div>
@endsection

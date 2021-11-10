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
                                        <h4 class="modal-title text-muted"><a href="https://puzzley.ir" target="_blank">اپلیکیشن ساز آنلاین پازلی</a></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body bg-light">
                                        <a href="https://pzly.ir/{{$url->short_url}}">pzly.ir/{{$url->short_url}}</a>
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
                                            <button type="button" class="btn btn-primary">ویرایش</button>
                                            <button type="button" class="btn btn-danger">حذف</button>
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
    </div>
</div>
@endsection

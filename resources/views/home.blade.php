@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="direction: rtl">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center">
                    ساخت لینک کوتاه
                </div>

                <div class="card-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="short_link" class="float-right">لینک کوتاه</label>
                            <div class="input-group mb-3" style="direction: ltr">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">pzly.ir/</span>
                                </div>
                                <input type="text" class="form-control" placeholder="لینک کوتاه" name="short_link">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="main_link" class="float-right">لینک اصلی</label>
                            <input type="text" class="form-control" placeholder="لینک کوتاه نشده را وارد کنید" id="main_link" name="main_link">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

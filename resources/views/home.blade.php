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
                            <input type="text" class="form-control" placeholder="لینک کوتاه نشده را وارد کنید" id="main_link" name="main_link" style="direction:ltr">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="direction: ltr;">
            <h2 class="text-center">لیست لینک های شما</h2>

            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">لینک کوتاه شده</th>
                        <th class="text-center">بازدید</th>
                        <th class="text-center">تاریخ ساخت</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                pzly.ir/iranpuzzley
                            </button>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title text-muted"><a href="https://puzzley.ir" target="_blank">اپلیکیشن ساز آنلاین پازلی</a></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body bg-light">
                                        <a href="pzly.ir/iranpuzzley">pzly.ir/iranpuzzley</a>
                                        <br><br>
                                        <h4 class="text-center text-primary">لینک اصلی</h4>
                                        <a style="overflow-wrap: break-word;" href="puzzley.ir/sdf/dsfsdfsdfjad/f/sdf/sdfSdf.sdf.sdf.sdf.sd.fsdflads;f">puzzley.ir/sdf/dsfsdfsdfjad/f/sdf/sdfSdf.sdf.sdf.sdf.sd.sdfSdf.sdf.sdf.sdf.sd.sdfSdf.sdf.sdf.sdf.sd.sdfSdf.sdf.sdf.sdf.sd.fsdflads;f</a>

                                        <div class="card mt-4" style="max-width: 200px; margin: 0 auto;">
                                            <div class="card-header text-dark">بازدید کل</div>
                                            <div class="card-body text-dark">156</div>
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
                        <td class="text-center">123</td>
                        <td class="text-center">23 خرداد 1400</td>
                    </tr>                
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

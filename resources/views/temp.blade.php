@extends('layouts.app')

@section('content')
    <h1 class="text-center text-warning bg-dark mt-5 p-5">اپلیکیشن ساز آنلاین پازلی</h1>
    <h1 class="text-center text-warning bg-dark p-5">همین الان اپلیکیشن خودت رو بساز</h1>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var divsToHide = document.getElementsByClassName("navbar")
        for(var i = 0; i < divsToHide.length; i++){
            divsToHide[i].style.visibility = "hidden";
            divsToHide[i].style.display = "none";
        }
        setTimeout(() => { window.location.href = "http://www.puzzley.ir"; }, 5000);
    }, false);


</script>

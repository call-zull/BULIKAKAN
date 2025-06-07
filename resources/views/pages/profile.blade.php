@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="flex flex-col w-full">
    <div class="flex w-full mt-8 flex-col items-center justify-center">
        <img src="{{ asset('logo/loop-nobg.png') }}" class="" width="210" alt="logo bulikakan">
        <h1 class="-mt-8 font-bold font-jomhuria text-3xl text-biruPrimary">BULIKAKAN</h1>
    </div>
    <div class="flex flex-col items-center gap-y-3 w-full mt-2.5">
        <h2 class="font-jomhuria text-sm">Silahkan Login / Register Terlebih Dahulu</h2>
        <div class="flex gap-x-5 justify-between">
            <a class="bg-biruPrimary text-white px-4 py-2 w-24 text-center rounded-md font-semibold font-jomhuria" href="{{ route('login') }}">Login</a>
            <a class="bg-biruPrimary text-white px-4 py-2 w-24 text-center rounded-md font-semibold font-jomhuria" href="{{ route('register') }}">Register</a>
        </div>
    </div>

</div>
@endsection
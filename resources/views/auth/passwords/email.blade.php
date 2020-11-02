@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="text-white text-3xl pt-2">Oh no!</h1>
        <h2 class="text-blue-300">Enter your email to reset password</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="email" class="uppercase text-blue-500 font-bold absolute pl-3 pt-2">E-Mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" placeholder="your@email.com" class="pt-8 w-full p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700 rounded" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="text-red-600 text-sm pt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full bg-gray-400 py-2 px-3 text-left rounded uppercase text-blue-800 font-bold">
                    Send Password Reset Link
                </button>
            </div>

            <div class="flex justify-between pt-8 text-white text-sm font-bold">
                <a class="" href="{{ route('login') }}">
                    Login
                </a>
                <a class="" href="{{ route('register') }}">
                    Register
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

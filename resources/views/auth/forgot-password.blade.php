@extends('layout')

@section('content')
<div class="flex flex-col justify-center min-h-[90vh] px-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Lupa Password?</h2>
        <p class="text-sm text-gray-500 mt-2">Masukkan email Anda, kami akan mengirimkan link reset.</p>
    </div>

    @if(session('success')) <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm text-center">{{ session('success') }}</div> @endif
    @if ($errors->any()) <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div> @endif

    <form action="{{ url('/forgot-password') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-xs font-bold text-gray-600 mb-1">Email Terdaftar</label>
            <input type="email" name="email" class="input-mockup" placeholder="email@unikom.ac.id" required>
        </div>
        <button type="submit" class="btn-black mb-4 shadow-lg">KIRIM LINK RESET</button>
        <div class="text-center text-xs mt-4"><a href="{{ url('/login') }}" class="font-bold text-black hover:underline">Kembali ke Login</a></div>
    </form>
</div>
@endsection
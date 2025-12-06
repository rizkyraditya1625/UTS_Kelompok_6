@extends('layout')

@section('content')
<div class="flex flex-col justify-center min-h-[90vh] px-8">
    <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">Password Baru</h2>

    @if(session('error')) <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center">{{ session('error') }}</div> @endif
    
    <form action="{{ url('/reset-password') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="mb-3">
            <label class="block text-xs font-bold text-gray-600 mb-1">Email Anda</label>
            <input type="email" name="email" class="input-mockup" value="{{ request()->email }}" readonly>
        </div>

        <div class="mb-3">
            <label class="block text-xs font-bold text-gray-600 mb-1">Password Baru</label>
            <input type="password" name="password" class="input-mockup" placeholder="Minimal 6 karakter" required>
        </div>

        <div class="mb-6">
            <label class="block text-xs font-bold text-gray-600 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="input-mockup" placeholder="Ulangi password" required>
        </div>

        <button type="submit" class="btn-black mb-4 shadow-lg">UBAH PASSWORD</button>
    </form>
</div>
@endsection
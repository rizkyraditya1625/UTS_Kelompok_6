@extends('layout')

@section('content')
<div class="flex flex-col justify-center min-h-[90vh] px-8 py-10">
    
    <div class="flex justify-center mb-8">
        <div class="relative w-24 h-24">
            <div class="absolute top-1 left-1 w-full h-full border-4 border-black rounded-xl bg-black"></div>
            
            <div class="relative w-full h-full border-4 border-black rounded-xl flex items-center justify-center bg-white shadow-lg z-10">
                <i class="fas fa-search-location text-5xl text-black"></i>
            </div>
        </div>
    </div>
    <h2 class="text-center text-2xl font-bold mb-6 text-gray-800">Register</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-xs">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="block text-xs font-bold text-gray-600 mb-1">Nama Lengkap</label>
            <input type="text" name="name" class="input-mockup" placeholder="Nama Anda" required>
        </div>

        <div class="mb-3">
            <label class="block text-xs font-bold text-gray-600 mb-1">NIM</label>
            <input type="text" name="nim" class="input-mockup" placeholder="101XXXXX" required>
        </div>

        <div class="mb-3">
            <label class="block text-xs font-bold text-gray-600 mb-1">Email</label>
            <input type="email" name="email" class="input-mockup" placeholder="email@unikom.ac.id" required>
        </div>

        <div class="mb-5">
            <label class="block text-xs font-bold text-gray-600 mb-1">Password</label>
            <input type="password" name="password" class="input-mockup" placeholder="******" required>
        </div>

        <div class="flex items-center mb-6">
            <input id="terms" type="checkbox" required class="w-4 h-4 border-gray-300 rounded text-black focus:ring-black">
            <label for="terms" class="ml-2 text-sm font-medium text-gray-900">Terms & Conditions</label>
        </div>

        <button type="submit" class="btn-black mb-4 shadow-lg">
            Register
        </button>

        <div class="text-center text-xs mt-4">
            <span class="text-gray-500">Sudah punya akun?</span>
            <a href="{{ url('/login') }}" class="font-bold text-black ml-1 hover:underline">Sign In</a>
        </div>
    </form>
</div>
@endsection
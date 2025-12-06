@extends('layout')

@section('content')
<div class="flex flex-col justify-center items-center min-h-[90vh] px-8 text-center">
    
    <div class="mb-8 relative">
        <div class="absolute top-1 left-1 w-24 h-24 border-4 border-black rounded-xl bg-black"></div>
        <div class="relative w-24 h-24 border-4 border-black rounded-xl flex items-center justify-center bg-white shadow-lg z-10">
            <i class="fas fa-search-location text-5xl text-black"></i>
        </div>
    </div>

    <h1 class="text-4xl font-black uppercase tracking-tighter mb-2 leading-none">
        LOST & <br> <span class="text-stroke-cream">FOUND</span>
    </h1>
    
    <p class="text-sm text-gray-600 font-medium mb-10 px-4">
        Temukan barangmu yang hilang atau bantu temanmu menemukannya di lingkungan kampus.
    </p>

    <div class="w-full space-y-4">
        <a href="{{ url('/login') }}" class="block w-full bg-black text-white font-bold py-4 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(100,100,100,0.5)] hover:translate-y-1 hover:shadow-none transition-all uppercase tracking-widest">
            Masuk Sekarang
        </a>
        
        <a href="{{ url('/register') }}" class="block w-full bg-white text-black font-bold py-4 rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1 hover:shadow-none transition-all uppercase tracking-widest">
            Buat Akun Baru
        </a>
    </div>

    <div class="mt-12 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
        © 2025 KELOMPOK PTI
    </div>
</div>
@endsection
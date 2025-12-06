@extends('layout')

@section('content')
<div class="p-4 flex items-center mb-2 relative border-b border-gray-300">
    <a href="{{ url('/home') }}" class="flex flex-col items-center absolute left-4 group cursor-pointer">
        <div class="border-2 border-black p-1 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition-all">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    <h1 class="flex-1 text-center text-xl font-black tracking-widest uppercase">AKUN</h1>
</div>

<div class="px-6 flex flex-col items-center w-full">
    @if(session('success'))
        <div class="w-full bg-green-100 border-2 border-green-600 text-green-800 px-3 py-2 rounded mb-4 text-center text-xs font-bold">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="w-full bg-red-100 border-2 border-red-600 text-red-800 px-3 py-2 rounded mb-4 text-center text-xs font-bold">
            Upload Gagal! File max 10MB.
        </div>
    @endif

    <div class="mb-6 text-center relative w-full flex flex-col items-center">
        <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4 border-4 border-black overflow-hidden shadow-lg">
            @if($user->profile_photo)
                <img src="{{ asset('uploads/profiles/'.$user->profile_photo) }}" class="w-full h-full object-cover">
            @else
                <i class="fas fa-user text-6xl text-gray-400"></i>
            @endif
        </div>

        <form action="{{ url('/profile/photo') }}" method="POST" enctype="multipart/form-data" id="form-photo">
            @csrf
            <input type="file" name="profile_photo" id="file-input" class="hidden" accept="image/*" onchange="document.getElementById('form-photo').submit()">
            
            <button type="button" onclick="document.getElementById('file-input').click()" 
                class="bg-white border-2 border-black px-6 py-2 text-xs font-bold uppercase tracking-wider shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-y-[2px] active:shadow-none transition-all hover:bg-gray-50">
                GANTI PROFILE
            </button>
        </form>
    </div>

    <div class="w-full space-y-5">
        
        <div class="text-center border-b-2 border-black pb-2">
            <h2 class="text-2xl font-black uppercase tracking-tighter truncate">
                HI, {{ Str::limit(strtoupper($user->name), 15) }}
            </h2>
        </div>

        <div class="w-full">
            <p class="text-[10px] font-extrabold text-gray-500 tracking-widest uppercase mb-1">USERNAME:</p>
            <div class="text-lg font-bold border-b-2 border-gray-300 pb-1 w-full">
                {{ $user->email }}
            </div>
        </div>

        <div class="w-full">
            <p class="text-[10px] font-extrabold text-gray-500 tracking-widest uppercase mb-1">ID:</p>
            <div class="text-lg font-bold border-b-2 border-gray-300 pb-1 w-full">
                {{ $user->nim }}
            </div>
        </div>

        <div class="w-full">
            <p class="text-[10px] font-extrabold text-gray-500 tracking-widest uppercase mb-1">ROLE:</p>
            <div class="text-lg font-bold border-b-2 border-gray-300 pb-1 w-full">
                {{ $user->role }}
            </div>
        </div>
        
        <a href="{{ url('/about') }}" class="block w-full text-center border-2 border-black bg-white text-black py-3 font-bold hover:bg-gray-100 transition uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-y-[2px] active:shadow-none mt-6">
            <i class="fas fa-users mr-2"></i> TENTANG KAMI
        </a>

        <form action="{{ url('/logout') }}" method="POST" class="pt-4 pb-4 w-full">
            @csrf
            <button type="submit" class="w-full bg-white border-2 border-black text-red-600 py-3 font-black text-sm uppercase tracking-[0.2em] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-y-[2px] active:shadow-none hover:bg-red-50 transition-all">
                LOG OUT
            </button>
        </form>

    </div>
</div>
@endsection
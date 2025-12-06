@extends('layout')

@section('content')
<div class="p-4 flex items-center mb-2 relative border-b border-gray-300 bg-[#FDF5E6]">
    <a href="javascript:history.back()" class="flex flex-col items-center absolute left-4 group cursor-pointer">
        <div class="border-2 border-black p-1 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition-all">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    <h1 class="flex-1 text-center text-xl font-black tracking-widest uppercase">PROFIL PENGGUNA</h1>
</div>

<div class="px-6 flex flex-col items-center w-full mt-10">

    <div class="mb-6 text-center relative w-full flex flex-col items-center">
        <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4 border-4 border-black overflow-hidden shadow-lg">
            @if($user->profile_photo)
                <img src="{{ asset('uploads/profiles/'.$user->profile_photo) }}" class="w-full h-full object-cover">
            @else
                <i class="fas fa-user text-6xl text-gray-400"></i>
            @endif
        </div>
    </div>

    <div class="w-full space-y-5">
        
        <div class="text-center border-b-2 border-black pb-2">
            <h2 class="text-2xl font-black uppercase tracking-tighter truncate">
                {{ Str::limit(strtoupper($user->name), 20) }}
            </h2>
            <span class="text-xs font-bold bg-black text-white px-2 py-1 rounded">{{ $user->role }}</span>
        </div>

        <div class="w-full">
            <p class="text-[10px] font-extrabold text-gray-500 tracking-widest uppercase mb-1">NIM / ID:</p>
            <div class="text-lg font-bold border-b-2 border-gray-300 pb-1 w-full">
                {{ $user->nim }}
            </div>
        </div>

        <div class="w-full">
            <p class="text-[10px] font-extrabold text-gray-500 tracking-widest uppercase mb-1">EMAIL:</p>
            <div class="text-lg font-bold border-b-2 border-gray-300 pb-1 w-full">
                {{ $user->email }}
            </div>
        </div>

    </div>
</div>
@endsection
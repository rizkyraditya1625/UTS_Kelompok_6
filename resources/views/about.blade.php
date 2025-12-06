@extends('layout')

@section('content')
<div class="p-4 flex items-center border-b-2 border-black mb-6 bg-[#FDF5E6] sticky top-0 z-40">
    <a href="{{ url('/profile') }}" class="flex flex-col items-center mr-4 group">
        <div class="border-2 border-black p-1 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition-all">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    <h1 class="flex-1 text-center text-xl font-black tracking-widest uppercase">TENTANG KAMI</h1>
</div>

<div class="px-6 pb-24">
    
    <div class="text-center mb-8">
        <h2 class="text-lg font-bold">KELOMPOK</h2>
        <p class="text-xs text-gray-500">Pnerapan Teknologi Internet</p>
    </div>

    <div class="space-y-5">
        
        <div class="flex items-center bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center overflow-hidden mr-4">
                <i class="fas fa-user text-2xl text-gray-400"></i>
                </div>
            <div>
                <h3 class="font-bold text-sm uppercase">Muhammad Arasy</h3>
                <p class="text-xs text-gray-600 font-mono">10123354</p>
            </div>
        </div>

        <div class="flex items-center bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center overflow-hidden mr-4">
                <i class="fas fa-user text-2xl text-gray-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm uppercase">Mochamad Rizky R</h3>
                <p class="text-xs text-gray-600 font-mono">10123359</p>
            </div>
        </div>

        <div class="flex items-center bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center overflow-hidden mr-4">
                <i class="fas fa-user text-2xl text-gray-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm uppercase">Muhammad Hizkia</h3>
                <p class="text-xs text-gray-600 font-mono">10123370</p>
            </div>
        </div>

        <div class="flex items-center bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center overflow-hidden mr-4">
                <i class="fas fa-user text-2xl text-gray-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm uppercase">Fariz Rahman Hakim</h3>
                <p class="text-xs text-gray-600 font-mono">10123374</p>
            </div>
        </div>

        <div class="flex items-center bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center overflow-hidden mr-4">
                <i class="fas fa-user text-2xl text-gray-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm uppercase">Rif'at Renjiro</h3>
                <p class="text-xs text-gray-600 font-mono">10123383</p>
            </div>
        </div>

    </div>
</div>
@endsection
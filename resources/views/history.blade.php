@extends('layout')

@section('content')
<div class="p-4 flex items-center mb-4 border-b-2 border-black sticky top-0 bg-[#FDF5E6] z-40">
    <div class="flex-1 text-center">
        <h1 class="text-xl font-black tracking-widest uppercase">RIWAYAT SELESAI</h1>
    </div>
    @if(Auth::user()->role == 'ADMIN')
        <div class="absolute right-4 bg-black text-white text-[10px] px-2 py-1 font-bold rounded">
            MODE ADMIN
        </div>
    @endif
</div>

<div class="px-4 pb-24 space-y-4">
    
    @if(session('success'))
        <div class="bg-green-100 border-2 border-green-600 text-green-800 px-4 py-2 rounded mb-4 text-xs font-bold text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-2 border-red-600 text-red-800 px-4 py-2 rounded mb-4 text-xs font-bold text-center">
            {{ session('error') }}
        </div>
    @endif

    @forelse($histories as $history)
    <div class="bg-white border-2 border-black p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden hover:translate-y-[-2px] transition-all">
        
        <div class="absolute right-0 top-0 bg-green-600 text-white px-3 py-1 text-[10px] font-bold uppercase rounded-bl-lg z-10">
            SELESAI
        </div>

        <div class="flex gap-3">
            <div class="w-24 h-24 border-2 border-black bg-gray-200 flex-shrink-0 overflow-hidden">
                @if($history->image_path)
                    <img src="{{ asset('uploads/'.$history->image_path) }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-2xl"></i>
                    </div>
                @endif
            </div>

            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm uppercase mb-1">{{ $history->title }}</h3>
                    <p class="text-[10px] text-gray-600 line-clamp-2 leading-tight mb-2">
                        {{ $history->description }}
                    </p>
                    
                    <div class="flex items-center text-[10px] font-bold text-black mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-red-500"></i>
                        <span class="truncate max-w-[150px]">{{ $history->location }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 pt-2 border-t border-dashed border-gray-400">
            <div class="bg-gray-100 p-2 text-[10px] border border-gray-300 rounded mb-2">
                <p class="mb-1">
                    <span class="text-gray-500">Pelapor:</span> 
                    @if($history->reporter_id)
                        <a href="{{ url('/user/'.$history->reporter_id) }}" class="font-bold text-black hover:underline">{{ $history->reporter_name }}</a>
                    @else
                        <span class="font-bold">{{ $history->reporter_name }}</span>
                    @endif
                </p>
                <p class="mb-1">
                    <span class="text-gray-500">Diselesaikan:</span> 
                    @if($history->resolver_id)
                        <a href="{{ url('/user/'.$history->resolver_id) }}" class="font-bold text-blue-600 hover:underline">{{ $history->resolver_name }}</a>
                    @else
                        <span class="font-bold text-blue-600">{{ $history->resolver_name }}</span>
                    @endif
                </p>
                <p class="text-gray-400 text-[9px] mt-2 text-right">
                    {{ \Carbon\Carbon::parse($history->completed_at)->format('d M Y, H:i') }}
                </p>
            </div>

            @if(Auth::user()->role == 'ADMIN')
                <form action="{{ url('/history/delete/'.$history->id) }}" method="POST" onsubmit="return confirm('HAPUS PERMANEN? Data ini tidak bisa dikembalikan.')">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 text-[10px] uppercase tracking-widest hover:bg-red-700 transition border border-black">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Data (Admin)
                    </button>
                </form>
            @endif
        </div>

    </div>
    @empty
    
    <div class="flex flex-col items-center justify-center py-20 text-center opacity-50">
        <i class="fas fa-history text-5xl mb-3 text-gray-400"></i>
        <h3 class="font-bold text-gray-600">Belum ada riwayat</h3>
    </div>
    @endforelse

</div>
@endsection
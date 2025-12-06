@extends('layout')

@section('content')
<div class="p-4 sticky top-0 bg-[#FDF5E6] z-40 border-b border-gray-300 shadow-sm">
    <div class="flex gap-2 items-center">
        
        <form action="{{ url('/home') }}" method="GET" class="flex-1">
            @if(request('status')) 
                <input type="hidden" name="status" value="{{ request('status') }}"> 
            @endif
            
            <div class="bg-white border-2 border-black rounded-lg px-3 py-2 flex items-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <button type="submit" class="mr-2 text-black">
                    <i class="fas fa-search"></i>
                </button>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="bg-transparent outline-none w-full text-sm font-medium placeholder-gray-400">
                @if(request('search'))
                    <a href="{{ url('/home') }}" class="text-gray-500 ml-2"><i class="fas fa-times"></i></a>
                @endif
            </div>
        </form>

        <a href="{{ url('/history') }}" class="bg-white border-2 border-black rounded-lg p-2 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition text-black flex items-center justify-center w-11 h-11">
            <i class="fas fa-history text-xl"></i>
        </a>

    </div>
</div>

<div class="px-4 pt-4 pb-2 overflow-x-auto flex gap-2 no-scrollbar">
    <a href="{{ url('/home') }}" class="px-4 py-1 rounded-full text-xs font-bold border-2 border-black transition {{ !request('status') ? 'bg-black text-white' : 'bg-white text-black hover:bg-gray-100' }}">
       Semua
    </a>
    <a href="{{ url('/home?status=kehilangan') }}" class="px-4 py-1 rounded-full text-xs font-bold border-2 border-black transition {{ request('status') == 'kehilangan' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-black hover:bg-gray-100' }}">
       Kehilangan
    </a>
    <a href="{{ url('/home?status=menemukan') }}" class="px-4 py-1 rounded-full text-xs font-bold border-2 border-black transition {{ request('status') == 'menemukan' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-black hover:bg-gray-100' }}">
       Ditemukan
    </a>
</div>

<div class="p-4 space-y-4 pb-24"> 
    
    @if(session('success'))
        <div class="bg-green-100 border-2 border-green-600 text-green-800 px-4 py-2 rounded mb-2 text-xs font-bold text-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @forelse($items as $item)
    <a href="{{ url('/post/'.$item->id) }}" class="block transform transition hover:scale-[1.01]">
        <div class="card-mockup flex gap-3">
            
            <div class="w-24 h-24 border border-black bg-gray-100 flex-shrink-0 overflow-hidden flex items-center justify-center">
                @if($item->image_path)
                    <img src="{{ asset('uploads/'.$item->image_path) }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-image text-2xl text-gray-400"></i>
                @endif
            </div>

            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider {{ $item->status == 'kehilangan' ? 'text-red-600' : 'text-green-600' }}">
                            ● {{ $item->status }}
                        </span>
                        <span class="text-[10px] text-gray-500 font-mono">
                            {{ \Carbon\Carbon::parse($item->time)->format('d M') }}
                        </span>
                    </div>

                    <h3 class="font-bold text-sm leading-tight line-clamp-1 mb-1">{{ $item->title }}</h3>
                    <p class="text-[10px] text-gray-600 line-clamp-2">{{ $item->description }}</p>
                </div>
                
                <div class="mt-1 flex items-center text-[10px] font-bold text-black">
                    <i class="fas fa-map-marker-alt mr-1 text-red-500"></i> 
                    <span class="truncate max-w-[120px]">{{ $item->location }}</span>
                </div>
            </div>
            
        </div>
    </a>
    @empty
    <div class="flex flex-col items-center justify-center py-20 text-center opacity-60">
        <div class="border-2 border-black p-4 rounded-full mb-4 bg-white shadow-md">
            <i class="fas fa-box-open text-4xl"></i>
        </div>
        <h3 class="font-bold text-lg">Belum ada data</h3>
        <p class="text-xs text-gray-500 px-10 mb-4">
            Jadilah yang pertama melaporkan barang!
        </p>
        <a href="{{ url('/post/create') }}" class="text-xs font-bold underline hover:text-blue-600">Buat Laporan Baru</a>
    </div>
    @endforelse

</div>
@endsection
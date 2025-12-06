@extends('layout')

@section('content')
<div class="p-4 flex items-center border-b-2 border-black mb-4 bg-[#FDF5E6] sticky top-0 z-40 shadow-sm">
    <a href="{{ url('/home') }}" class="flex flex-col items-center mr-4 group">
        <div class="border-2 border-black p-1 bg-white group-hover:bg-gray-100 transition shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    <h1 class="flex-1 text-center text-xl font-black tracking-widest uppercase">INFORMASI</h1>
</div>

<div class="px-4 pb-40 w-full"> <div class="border-2 border-black p-2 bg-white mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="w-full aspect-square bg-gray-200 overflow-hidden relative group">
            @if($item->image_path)
                <img src="{{ asset('uploads/'.$item->image_path) }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full">
                    <i class="fas fa-image text-6xl text-gray-400"></i>
                </div>
            @endif
            
            <div class="absolute bottom-0 left-0 bg-white border-t-2 border-r-2 border-black px-4 py-1 text-sm font-black uppercase tracking-widest {{ $item->status == 'kehilangan' ? 'text-red-600' : 'text-green-600' }}">
                {{ $item->status }}
            </div>
        </div>
    </div>

    <div class="space-y-4">
        
        <div class="bg-white p-4 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="mb-3 border-b border-gray-200 pb-2">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">DIPOSTING OLEH</label>
                <div class="flex items-center mt-1">
                    <i class="fas fa-user-circle text-lg mr-2"></i>
                    <span class="font-bold text-lg">{{ $item->user_name }}</span>
                </div>
            </div>

            <div class="mb-2">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">NAMA BARANG</label>
                <h3 class="font-bold text-xl leading-tight">{{ $item->title }}</h3>
            </div>
            
            <div>
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest">DESKRIPSI</label>
                <p class="text-sm text-gray-800 whitespace-pre-line mt-1">{{ $item->description }}</p>
            </div>
        </div>

        <div class="bg-gray-100 p-4 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm space-y-4">
            <div class="flex items-start">
                <div class="w-8 pt-1"><i class="fas fa-map-marker-alt text-xl text-red-600"></i></div>
                <div>
                    <span class="font-bold block text-xs text-gray-500 uppercase mb-1">
                        {{ $item->status == 'kehilangan' ? 'AREA KEHILANGAN' : 'DITEMUKAN DI' }}
                    </span>
                    <span class="text-black font-bold text-base block">{{ $item->location }}</span>
                </div>
            </div>
            
            <div class="flex items-start border-t border-gray-300 pt-3">
                <div class="w-8 pt-1"><i class="fas fa-building text-xl text-blue-600"></i></div>
                <div>
                    <span class="font-bold block text-xs text-gray-500 uppercase mb-1">
                        {{ $item->status == 'kehilangan' ? 'LAPOR KE' : 'DISIMPAN DI' }}
                    </span>
                    <span class="text-black font-bold text-base block">{{ $item->titipkan_ke }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between border-2 border-black p-3 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <span class="text-[10px] font-black text-gray-500 uppercase">WAKTU {{ strtoupper($item->status) }}</span>
                <div class="text-sm font-bold mt-1">
                    {{ \Carbon\Carbon::parse($item->time)->format('d F Y') }} 
                    <span class="text-gray-400 mx-1">|</span> 
                    {{ \Carbon\Carbon::parse($item->time)->format('H:i') }} WIB
                </div>
            </div>

    </div>
</div>

<div class="fixed bottom-0 left-0 right-0 mx-auto w-full max-w-[420px] bg-white border-t-4 border-black p-4 z-50 shadow-[0_-4px_10px_-1px_rgba(0,0,0,0.1)] flex flex-col gap-3">
    
    {{-- BAGIAN 1: TOMBOL DONE (Hanya muncul jika kondisi terpenuhi) --}}
    @if($item->status == 'kehilangan')
        @if(Auth::user()->name == $item->user_name)
            <form action="{{ url('/post/done/'.$item->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none flex items-center justify-center transition hover:bg-blue-700">
                    <i class="fas fa-check-circle mr-2"></i> BARANG SUDAH KEMBALI
                </button>
            </form>
        @else
            {{-- Info jika bukan pemilik --}}
            <div class="text-center text-[10px] text-gray-400 italic border border-gray-200 p-1 rounded bg-gray-50">
                Hanya <b>{{ $item->user_name }}</b> yang bisa menandai selesai.
            </div>
        @endif
    @else
        {{-- Jika Menemukan: Muncul tombol Klaim untuk SEMUA user --}}
        <form action="{{ url('/post/done/'.$item->id) }}" method="POST" onsubmit="return confirm('Yakin ini barang Anda?')" class="w-full">
            @csrf
            <button type="submit" class="w-full bg-orange-500 text-white font-bold py-3 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none flex items-center justify-center transition hover:bg-orange-600">
                <i class="fas fa-hand-paper mr-2"></i> SAYA PEMILIK BARANG INI
            </button>
        </form>
    @endif

    {{-- BAGIAN 2: TOMBOL KONTAK --}}
    <div class="w-full pt-2 border-t border-gray-200">
        <p class="text-center text-[10px] font-bold uppercase text-gray-500 mb-2 tracking-widest">HUBUNGI PELAPOR VIA:</p>
        <div class="flex gap-2">
            @if($item->whatsapp)
                @php
                    $clean_wa = preg_replace('/[^0-9]/', '', $item->whatsapp);
                    if (substr($clean_wa, 0, 1) == '0') $clean_wa = '62' . substr($clean_wa, 1);
                @endphp
                <a href="https://wa.me/{{ $clean_wa }}?text=Halo, saya melihat postingan barang *{{ $item->title }}*." target="_blank" class="flex-1 bg-[#25D366] text-white text-center font-bold py-2 rounded-lg border-2 border-black shadow-sm flex items-center justify-center hover:brightness-90"><i class="fab fa-whatsapp text-xl mr-2"></i> WhatsApp</a>
            @endif

            @if($item->instagram)
                <a href="https://instagram.com/{{ str_replace('@', '', $item->instagram) }}" target="_blank" class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-center font-bold py-2 rounded-lg border-2 border-black shadow-sm flex items-center justify-center hover:brightness-90"><i class="fab fa-instagram text-xl mr-2"></i> Instagram</a>
            @endif
        </div>
        @if(!$item->whatsapp && !$item->instagram)
            <div class="text-center text-xs text-red-500 font-bold py-1">Kontak tidak tersedia</div>
        @endif
    </div>
    @if(Auth::user()->name == $item->user_name || Auth::user()->role == 'ADMIN')
        <div class="flex gap-2 mb-2 border-b border-gray-300 pb-2">
            <a href="{{ url('/post/edit/'.$item->id) }}" class="flex-1 bg-blue-600 text-white text-center py-2 rounded font-bold text-xs">
                EDIT
            </a>
            <form action="{{ url('/post/delete/'.$item->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus permanen?')">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded font-bold text-xs">
                    HAPUS
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
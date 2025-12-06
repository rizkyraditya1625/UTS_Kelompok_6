@extends('layout')

@section('content')
<div class="p-4 flex items-center border-b-2 border-black mb-4 bg-[#FDF5E6] sticky top-0 z-40">
    <a href="{{ url('/post/'.$item->id) }}" class="flex flex-col items-center mr-4 group">
        <div class="border-2 border-black p-1 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition-all">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    <h1 class="flex-1 text-center text-xl font-black tracking-widest uppercase">EDIT LAPORAN</h1>
</div>

<div class="px-6 pb-20">
    
    @if ($errors->any())
        <div class="bg-red-100 border-2 border-red-500 text-red-700 px-4 py-3 rounded mb-6 shadow-[4px_4px_0px_0px_rgba(255,0,0,0.2)]">
            <div class="flex items-center mb-1">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span class="font-bold text-sm uppercase">Gagal Update!</span>
            </div>
            <ul class="list-disc ml-6 text-xs font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/post/update/'.$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-6 text-center">
            <span class="px-4 py-2 font-bold text-white text-sm uppercase tracking-widest border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] {{ $item->status == 'kehilangan' ? 'bg-red-600' : 'bg-green-600' }}">
                STATUS: {{ $item->status }}
            </span>
        </div>

        <div class="mb-6 flex flex-col items-center justify-center">
            <div class="relative">
                <label for="image-upload" class="cursor-pointer block">
                    <div class="w-40 h-40 border-4 border-black bg-white flex items-center justify-center overflow-hidden relative shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:translate-y-[2px] active:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all group">
                        
                        <img id="image-preview" 
                             src="{{ $item->image_path ? asset('uploads/'.$item->image_path) : '' }}" 
                             class="absolute inset-0 w-full h-full object-cover {{ $item->image_path ? '' : 'hidden' }}">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <i class="fas fa-camera text-3xl text-white"></i>
                            <span class="text-[10px] font-bold text-white mt-1 uppercase">Ganti Foto</span>
                        </div>

                        @if(!$item->image_path)
                        <div id="image-placeholder" class="flex flex-col items-center">
                            <i class="fas fa-image text-6xl text-gray-800"></i>
                        </div>
                        @endif

                    </div>
                </label>
                <input type="file" name="image" id="image-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
            </div>
            <p class="text-[10px] text-gray-500 mt-2 font-bold">*Klik gambar untuk mengubah (Opsional)</p>
        </div>

        <div class="space-y-5">
            
            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">BARANG:</label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>
            </div>

            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">DESKRIPSI BARANG:</label>
                <textarea name="description" rows="4" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>{{ old('description', $item->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">
                    {{ $item->status == 'kehilangan' ? 'AREA KEHILANGAN:' : 'DITEMUKAN DI:' }}
                </label>
                <input type="text" name="location" value="{{ old('location', $item->location) }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>
            </div>

            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">
                    {{ $item->status == 'kehilangan' ? 'LAPOR KE (POS/SATUAN):' : 'DISIMPAN DI:' }}
                </label>
                <input type="text" name="titipkan_ke" value="{{ old('titipkan_ke', $item->titipkan_ke) }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>
            </div>

            <div class="border-t-2 border-black pt-4 mt-6">
                <label class="block text-sm font-black mb-3 uppercase tracking-wide text-center">-- KONTAK (OPSIONAL) --</label>
                
                <div class="mb-3">
                    <label class="block text-xs font-bold mb-1 uppercase"><i class="fab fa-whatsapp text-green-600 text-lg mr-1"></i> VIA WHATSAPP:</label>
                    <input type="number" name="whatsapp" value="{{ old('whatsapp', $item->whatsapp) }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" placeholder="628123...">
                </div>

                <div>
                    <label class="block text-xs font-bold mb-1 uppercase"><i class="fab fa-instagram text-pink-600 text-lg mr-1"></i> DM INSTAGRAM:</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $item->instagram) }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" placeholder="@username">
                </div>
            </div>

        </div>

        <div class="mt-10">
            <button type="submit" class="w-full bg-black text-white font-bold py-4 text-lg tracking-widest hover:bg-gray-800 transition shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] active:translate-y-[2px] active:shadow-none">
                UPDATE LAPORAN
            </button>
        </div>

    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
        }
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
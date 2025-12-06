@extends('layout')

@section('content')
<div class="p-4 flex items-center border-b-2 border-black mb-4 bg-[#FDF5E6] sticky top-0 z-40">
    <a href="{{ url('/home') }}" class="flex flex-col items-center mr-4 group">
        <div class="border-2 border-black p-1 bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-[1px] active:shadow-none transition-all">
            <i class="fas fa-arrow-left text-lg"></i>
        </div>
        <span class="text-[10px] font-bold mt-1">BACK</span>
    </a>
    
    <div class="flex flex-1 border-2 border-black bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <button type="button" onclick="switchTab('kehilangan')" id="tab-lost" 
            class="flex-1 py-3 text-sm font-bold border-r-2 border-black transition-colors bg-gray-300">
            KEHILANGAN
        </button>
        <button type="button" onclick="switchTab('menemukan')" id="tab-found" 
            class="flex-1 py-3 text-sm font-bold transition-colors bg-white hover:bg-gray-50">
            MENEMUKAN
        </button>
    </div>
</div>

<div class="px-6 pb-20">
    
    @if ($errors->any())
        <div class="bg-red-100 border-2 border-red-500 text-red-700 px-4 py-3 rounded mb-6 shadow-[4px_4px_0px_0px_rgba(255,0,0,0.2)]">
            <div class="flex items-center mb-1">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span class="font-bold text-sm uppercase">Gagal Posting!</span>
            </div>
            <ul class="list-disc ml-6 text-xs font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/post/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="status" id="status-input" value="kehilangan">

        <div class="mb-6 flex flex-col items-center justify-center">
            <div class="relative">
                <label for="image-upload" class="cursor-pointer block">
                    <div class="w-40 h-40 border-4 {{ $errors->has('image') ? 'border-red-500' : 'border-black' }} bg-white flex items-center justify-center overflow-hidden relative shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:translate-y-[2px] active:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">
                        
                        <div id="image-placeholder" class="flex flex-col items-center">
                            <i class="fas fa-image text-6xl {{ $errors->has('image') ? 'text-red-500' : 'text-gray-800' }}"></i>
                            <span class="text-[10px] font-bold mt-2 {{ $errors->has('image') ? 'text-red-500' : 'text-gray-600' }}">TAP TO UPLOAD</span>
                        </div>
                        
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>
                </label>
                <input type="file" name="image" id="image-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
            </div>
            
            @error('image')
                <div class="text-red-600 text-xs font-bold mt-2 text-center uppercase tracking-wide animate-pulse">
                    <i class="fas fa-arrow-up mr-1"></i> Foto Wajib Diupload!
                </div>
            @enderror
        </div>

        <div class="space-y-5">
            
            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">BARANG:</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" placeholder="Contoh: Dompet Kulit Hitam" required>
            </div>

            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">DESKRIPSI BARANG:</label>
                <textarea name="description" rows="4" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label id="label-location" class="block text-xs font-bold mb-1 uppercase tracking-wide">AREA KEHILANGAN:</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>
            </div>

            <div>
                <label id="label-titip" class="block text-xs font-bold mb-1 uppercase tracking-wide">LAPOR KE (POS/SATUAN):</label>
                <input type="text" name="titipkan_ke" value="{{ old('titipkan_ke') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" required>
            </div>

            <div>
                <label class="block text-xs font-bold mb-1 uppercase tracking-wide">WAKTU:</label>
                <input type="datetime-local" name="time" value="{{ old('time') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none text-gray-700" required>
            </div>

            <div class="border-t-2 border-black pt-4 mt-6">
                <label class="block text-sm font-black mb-3 uppercase tracking-wide text-center">-- KONTAK (OPSIONAL) --</label>
                
                <div class="mb-3">
                    <label class="block text-xs font-bold mb-1 uppercase"><i class="fab fa-whatsapp text-green-600 text-lg mr-1"></i> VIA WHATSAPP:</label>
                    <input type="number" name="whatsapp" value="{{ old('whatsapp') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" placeholder="628123...">
                </div>

                <div>
                    <label class="block text-xs font-bold mb-1 uppercase"><i class="fab fa-instagram text-pink-600 text-lg mr-1"></i> DM INSTAGRAM:</label>
                    <input type="text" name="instagram" value="{{ old('instagram') }}" class="w-full bg-gray-300 p-3 text-sm border-b-2 border-transparent focus:border-black outline-none transition" placeholder="@username">
                </div>
            </div>

        </div>

        <div class="mt-10">
            <button type="submit" class="w-full bg-black text-white font-bold py-4 text-lg tracking-widest hover:bg-gray-800 transition shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] active:translate-y-[2px] active:shadow-none">
                POST
            </button>
        </div>

    </form>
</div>

<script>
    // Fungsi Switch Tab (Sama seperti sebelumnya)
    function switchTab(type) {
        document.getElementById('status-input').value = type;
        const tabLost = document.getElementById('tab-lost');
        const tabFound = document.getElementById('tab-found');
        const labelLoc = document.getElementById('label-location');
        const labelTitip = document.getElementById('label-titip');

        if (type === 'kehilangan') {
            tabLost.classList.add('bg-gray-300');
            tabLost.classList.remove('bg-white');
            tabFound.classList.add('bg-white');
            tabFound.classList.remove('bg-gray-300');

            labelLoc.innerText = "AREA KEHILANGAN:";
            labelTitip.innerText = "JIKA MENEMUKAN, LAPOR KE:";
        } else {
            tabFound.classList.add('bg-gray-300');
            tabFound.classList.remove('bg-white');
            tabLost.classList.add('bg-white');
            tabLost.classList.remove('bg-gray-300');

            labelLoc.innerText = "DITEMUKAN DI:";
            labelTitip.innerText = "BARANG DISIMPAN/DITITIPKAN DI:";
        }
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');
            
            preview.src = reader.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
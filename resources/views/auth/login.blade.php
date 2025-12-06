@extends('layout')

@section('content')
<div class="flex flex-col justify-center min-h-[90vh] px-8">
    
    <div class="flex justify-center mb-10">
        <div class="relative w-24 h-24">
            <div class="absolute top-1 left-1 w-full h-full border-4 border-black rounded-xl bg-black"></div>
            
            <div class="relative w-full h-full border-4 border-black rounded-xl flex items-center justify-center bg-white shadow-lg z-10">
                <i class="fas fa-search-location text-5xl text-black"></i>
            </div>
        </div>
    </div>
    <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">Sign In</h2>
    
    @if(session('error')) 
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">{{ session('error') }}</div> 
    @endif
    @if(session('success')) 
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 text-sm text-center">{{ session('success') }}</div> 
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-xs font-bold text-gray-600 mb-1">Email</label>
            <input type="email" name="email" class="input-mockup" placeholder="Value" required>
        </div>
        <div class="mb-8">
            <label class="block text-xs font-bold text-gray-600 mb-1">Password</label>
            <input type="password" name="password" class="input-mockup" placeholder="Value" required>
        </div>
        <button type="submit" class="btn-black mb-4 shadow-lg">Sign In</button>
        
        <div class="flex justify-between text-xs mt-4">
            <a href="{{ url('/forgot-password') }}" class="text-gray-500 hover:text-black">Forgot password?</a>
            <a href="{{ url('/register') }}" class="font-bold text-black hover:underline">Register</a>
        </div>
    </form>
</div>
@endsection
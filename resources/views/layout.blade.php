<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --bg-cream: #FDF5E6; --btn-black: #1a1a1a; }
        body { background-color: #e5e5e5; font-family: sans-serif; margin: 0; display: flex; justify-content: center; min-height: 100vh; }
        .mobile-screen { width: 100%; max-width: 420px; min-height: 100vh; background-color: var(--bg-cream); position: relative; box-shadow: 0 0 20px rgba(0,0,0,0.1); display: flex; flex-direction: column; }
        .content-area { flex: 1; width: 100%; padding-bottom: 100px; }
        
        .input-mockup { background: #F3F4F6; border: 1px solid #D1D5DB; width: 100%; padding: 12px; border-radius: 6px; outline: none; font-size: 14px; transition: 0.2s; }
        .input-mockup:focus { border-color: black;}
        
        .btn-black { background-color: black; color: white; width: 100%; padding: 14px; border-radius: 8px; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 1px; transition: 0.2s; cursor: pointer; }
        .btn-black:hover { background-color: #333; }
        
        .card-mockup { border: 2px solid #000; border-radius: 0px; background: white; margin-bottom: 15px; padding: 10px; box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); transition: transform 0.1s; }
        .card-mockup:active { transform: translate(2px, 2px); box-shadow: 2px 2px 0px 0px rgba(0,0,0,1); }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body>
    <div class="mobile-screen">
        <div class="content-area">
            @yield('content')
        </div>

        @if(!Request::is('/') && 
            !Request::is('login') && 
            !Request::is('register') && 
            !Request::is('post/*') && 
            !Request::is('forgot-password') && 
            !Request::is('about') && 
            !Request::is('reset-password*'))
            
        <div class="fixed bottom-0 w-full max-w-[420px] bg-white border-t-4 border-black px-8 py-3 z-50 flex justify-between items-center shadow-[0_-4px_10px_-1px_rgba(0,0,0,0.1)]">
            <a href="{{ url('/home') }}" class="flex flex-col items-center text-black hover:scale-110 transition group"><i class="fas fa-home text-3xl group-hover:text-gray-600"></i></a>
            <a href="{{ url('/post/create') }}" class="relative -top-8 bg-white border-4 border-black rounded-xl p-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-1 hover:shadow-none transition-all"><i class="fas fa-plus text-4xl text-black"></i></a>
            <a href="{{ url('/profile') }}" class="flex flex-col items-center text-black hover:scale-110 transition group"><i class="fas fa-user-circle text-3xl group-hover:text-gray-600"></i></a>
        </div>
        @endif
    </div>
</body>
</html>
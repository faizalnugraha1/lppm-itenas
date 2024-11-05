<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - LP2M ITENAS</title>
    <meta name="description" content="">

    <link rel="stylesheet" href="{{ asset('css/app.css') }} " />

</head>
<body class="body-bg min-h-screen pt-12 md:pt-20 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mx-auto justify-center">
        <a href="" class="intro-x flex justify-center items-center pt-4">
            <img alt="LP2M" class="w-12" src="{{asset('logo-itenas.svg') }}">
            <span class="text-black font-bold text-3xl ml-3"><span class=" text-theme-1">LP2M </span>ITENAS</span>
        </a>
    </header>

    <main class="bg-white bg-opacity-90 max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl intro-x">
        @if(Session::has('error'))        
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white bg-opacity-90"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> 
            {{ Session('error') }} 
        </div>
        @endif

        <section class="mt-5">
            <form class="flex flex-col" method="POST" action="{{ route('login') }}">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="nip">NIP</label>
                <div class="mb-6 pt-3 rounded bg-gray-200"> 
                    <input type="text" id="nip" name="nip" value="{{ old('nip') }}" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-theme-4 transition duration-500 px-3 pb-3" placeholder="NIP atau email">
                </div>
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="pin">PASSWORD</label>
                <div class="mb-4 pt-3 rounded bg-gray-200">
                    <input type="password" id="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-theme-4 transition duration-500 px-3 pb-3" >
                </div>
                {{-- <div class="flex justify-end">
                    <a href="#" class="text-sm text-theme-1 hover:underline mb-6">Forgot your password?</a>
                </div> --}}
                {{-- <div class="flex items-center text-gray-700 mb-6">
                    <input name="remember" id="remember" type="checkbox" class="input border mr-2 border-zinc-500" id="vertical-remember-me" {{ old('remember') ? 'checked' : '' }}>
                    <label class="cursor-pointer select-none" for="vertical-remember-me">Ingatkan Saya</label>
                </div> --}}
                <button class="bg-theme-1 mt-4 hover:bg-theme-4 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Sign In</button>
            </form>
        </section>
    </main>
</body>
</html>
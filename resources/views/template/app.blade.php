<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="LP2M ITENAS">
        <meta name="decription" content="E-Office LP2M ITENAS">
        <meta name="decription" content="Sistem Informasi Lembaga Penelitian dan Pengabdian kepada Masyarakat">
        <title>@isset($title){{$title}} -@endisset LP2M ITENAS</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }} " />
        <link rel="stylesheet" href="{{ asset('dist/css/fontawesome/css/all.min.css') }}">
        @yield('lib-css')

    </head>

    <body class="app">

       @include('template.mobile-menu')

        <div class="flex">

           @include('template.side-menu')


            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><p>Sistem Informasi Lembaga Penelitian dan Pengabdian kepada Masyarakat</p></div>
                    <!-- END: Breadcrumb -->

                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            @if(Auth::guard('pegawai')->check())
                            <img alt="Profile Picture" src="{{ asset('dist/images/'.Auth::guard('pegawai')->user()->pict) }}">
                            @elseif(Auth::guard('dosen')->check())
                            <img alt="Profile Picture" src="{{ asset('dist/images/'.Auth::guard('dosen')->user()->pict) }}">
                            @endif
                            
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content bg-theme-1 box text-white">
                                <div class="p-4 border-b border-theme-2">

                                    @if(Auth::guard('pegawai')->check())
                                    <div class="font-medium"> {{ Auth::guard('pegawai')->user()->nama }}</div>
                                    @elseif(Auth::guard('dosen')->check())
                                    <div class="font-medium"> {{ Auth::guard('dosen')->user()->nama }}</div>
                                    @endif
                                    
                                    @if(Auth::guard('pegawai')->check())
                                    <div class="text-xs text-theme-2">Pegawai</div>
                                    @elseif(Auth::guard('dosen')->check())
                                    <div class="text-xs text-theme-2">Dosen</div>
                                    @endif

                                </div>
                                @auth('dosen')
                                <div class="p-2">
                                    <a href="{{ route('profil') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                </div>
                                @endauth
                                <div class="p-2 border-t border-theme-2">
                                    <a href="{{ route('logout') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout 
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->

                @yield('content')

            </div>
        </div>

        @yield('modal')
        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('js/jquery/dist/jquery.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('lib-script')
        @yield('line-script')
    </body>
</html>
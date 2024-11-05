<nav class="side-nav">
    <a href="{{ route('base') }}" class="intro-x flex items-center pl-5 pt-4">
        <img alt="LP2M" class="w-6" src="{{asset('logo-itenas.svg') }}">
        <span class="hidden xl:block text-black font-medium text-lg ml-3"><span class="font-bold text-white">LP2M </span>itenas</span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('base') }}" class="side-menu @if(url()->current()==route('base')) side-menu--active @endif">
                <div class="side-menu__icon"><i class="fa-solid fa-house fa-xl"></i></div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{ route('penelitian.index') }}" class="side-menu @if(url()->current()==route('penelitian.index')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-microscope fa-xl"></i> </div>
                <div class="side-menu__title"> Data Penelitian </div>
            </a>
        </li>
        <li>
            <a href="{{ route('pkm.index') }}" class="side-menu @if(url()->current()==route('pkm.index')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-calendar-days fa-xl"></i> </div>
                <div class="side-menu__title"> Data PKM </div>
            </a>
        </li>
        <li>
            <a href="{{ route('insentif.index') }}" class="side-menu @if(url()->current()==route('insentif.index')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-receipt fa-xl"></i> </div>
                <div class="side-menu__title"> Data Insentif </div>
            </a>
        </li>
        <li>
            <a href="{{ route('hki.index') }}" class="side-menu @if(url()->current()==route('hki.index')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-file-invoice fa-xl"></i> </div>
                <div class="side-menu__title"> Data HKI </div>
            </a>
        </li>
        <li>
            <a href="{{ route('publikasi.index') }}" class="side-menu @if(url()->current()==route('publikasi.index')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-regular fa-file-lines fa-xl"></i> </div>
                <div class="side-menu__title"> Data Publikasi </div>
            </a>
        </li>
        {{-- <li>
            <a href="javascript:;" class="side-menu @if(Request::segment(1) == 'data') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="book"></i> </div>
                <div class="side-menu__title"> List Data Hibah <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">

            </ul>
        </li> --}}
        <li>
            <a href="{{ route('input')}}" class="side-menu @if(url()->current()==route('input')) side-menu--active @endif">
                <div class="side-menu__icon"><i class="fa-regular fa-pen-to-square fa-xl"></i> </div>
                <div class="side-menu__title"> Input data </div>
            </a>
        </li>
        @auth('dosen')
        <li>
            <a href="{{ route('history') }}" class="side-menu @if(url()->current()==route('history')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-clock-rotate-left fa-xl"></i> </div>
                <div class="side-menu__title"> Riwayat Input Data </div>
            </a>
        </li>
        @endauth
        @auth('pegawai')
        <li>
            <a href="{{ route('inbox')}}" class="side-menu @if(url()->current()==route('inbox')) side-menu--active @endif">
                <div class="side-menu__icon"> <i class="fa-solid fa-inbox fa-xl"></i> </div>
                <div class="side-menu__title"> Kotak Masuk </div>
            </a>
        </li>
        @endauth
    </ul>
    @auth('pegawai')
    <div class="side-nav__devider my-3"></div>
    <ul>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i class="fa-solid fa-envelope fa-xl"></i> </div>
                <div class="side-menu__title"> Surat Menyurat <i data-feather="chevron-down"
                        class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('surat.index') }}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-chevron-right"></i> </div>
                        <div class="side-menu__title"> Data Surat </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('surat.input')}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-chevron-right"></i> </div>
                        <div class="side-menu__title"> Buat Surat Keluar</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('surat.masuk.input')}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-chevron-right"></i> </div>
                        <div class="side-menu__title"> Buat Surat Masuk </div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li>
            <a href="{{ route('surat.input')}}" class="side-menu @if(url()->current()==route('surat.input')) side-menu--active @endif">
                <div class="side-menu__icon"><i class="fa-regular fa-pen-to-square fa-xl"></i> </div>
                <div class="side-menu__title"> Surat Menyurat </div>
            </a>
        </li> --}}
    </ul>
    @endauth
    <div class="side-nav__devider my-3"></div>
    <ul>
        <li>
            <a href="{{ route('masterdata')}}" class="side-menu @if(url()->current()==route('masterdata')) side-menu--active @endif">
                <div class="side-menu__icon"><i class="fa-solid fa-database fa-xl"></i></div>
                <div class="side-menu__title"> Master Data </div>
            </a>
        </li>
    </ul>
</nav>

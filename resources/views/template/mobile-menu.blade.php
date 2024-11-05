<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('base') }}" class="flex mr-auto">
            <img alt="LP2M ITENAS" class="w-6" src="{{ asset('logo-itenas.svg') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-2 py-5 hidden">
        <li>
            <a href="{{ route('base') }}" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="book"></i> </div>
                <div class="menu__title"> List Data Hibah <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="index.html" class="menu">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Penelitian </div>
                    </a>
                </li>
                <li>
                    <a href="simple-menu-dashboard.html" class="menu">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> PKM </div>
                    </a>
                </li>
                <li>
                    <a href="top-menu-dashboard.html" class="menu">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Insentif </div>
                    </a>
                </li>
                <li>
                    <a href="top-menu-dashboard.html" class="menu">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Haki </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('input')}}" class="menu">
                <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="menu__title"> Input data Hibah </div>
            </a>
        </li>
        <li>
            <a href="side-menu-file-manager.html" class="menu">
                <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
                <div class="menu__title"> Riwayat Input Data </div>
            </a>
        </li>
    </ul>
</div>
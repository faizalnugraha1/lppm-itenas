<div class="modal__content modal__content--lg">
    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Data Hibah Penelitian
        </h2>
    </div>
    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
        <div class="col-span-12 intro-y">
            <div class="px-5 py-3 mb-3 flex ">
                <div class="flex items-start">
                    <i class="mt-2 mr-2 fa-solid fa-microscope text-5xl xl:text-5xl"></i>
                </div>
                <div class="ml-4 mr-auto items-center">
                    <div class="border-l-2 border-theme-1 pl-4 mt-3">
                        <h3 class="font-semibold text-xl">{{$penelitian->judul}}</h3>
                    </div>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Ketua Penelitian</div>
                    <a href="#" class="font-semibold text-base tooltip" >{{$penelitian->dosen_ketua->nama}}</a>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Anggota</div>
                    @foreach ($penelitian->getDosenAnggota() as $da)
                        <a href="#" class="font-semibold text-base block tooltip" >{{$da->nama}}</a>
                    @endforeach
                    
                    <div class="text-gray-600 font-normal mt-3 text-sm">Jenis Hibah</div>
                    <h3 class="font-semibold text-base">{{$penelitian->jenis_hibah->nama}}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Mitra</div>
                    <h3 class="font-semibold text-base">{{$penelitian->nama_mitra}}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tanggal Mulai</div>
                    <h3 class="font-semibold text-base">{{ \Carbon\Carbon::parse($penelitian->mulai)->format('d/m/Y') }}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tanggal Selesai</div>
                    <h3 class="font-semibold text-base">{{ \Carbon\Carbon::parse($penelitian->selesai)->format('d/m/Y') }}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tahun</div>
                    <h3 class="font-semibold text-base">{{$penelitian->tahun}}</h3>
                    
                    <div class="text-gray-600 font-normal mt-3 text-sm">Jumlah</div>
                    <h3 class="font-semibold text-base">Rp. {{number_format($penelitian->jumlah)}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
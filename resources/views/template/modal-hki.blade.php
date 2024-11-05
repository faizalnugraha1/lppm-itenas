<div class="modal__content modal__content--lg">
    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Data Hibah HKI
        </h2>
    </div>
    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
        <div class="col-span-12 intro-y">
            <div class="px-5 py-3 mb-3 flex ">
                <div class="flex items-start">
                    <i class="mt-2 mr-2 fa-solid fa-receipt text-5xl xl:text-5xl"></i>
                </div>
                <div class="ml-4 mr-auto">
                    <div class="border-l-2 border-theme-1 pl-4 mt-3">
                        <h3 class="font-semibold text-xl">{{$hki->judul}}</h3>
                    </div>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Jenis HKI</div>
                    <h3 class="font-semibold text-base">{{$hki->jenis_hki}}</h3>
                    
                    <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Ketua</div>
                    <a href="#" class="font-semibold text-base tooltip">{{$hki->dosen_ketua->nama}}</a>

                    {{-- <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Anggota</div>
                    <a href="#" class="font-semibold text-base tooltip">{{$hki->dosen_ketua->nama}}</a> --}}

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tahun</div>
                    <h3 class="font-semibold text-base">{{$hki->tahun}}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Jumlah</div>
                    <h3 class="font-semibold text-base">Rp. {{number_format($hki->jumlah)}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
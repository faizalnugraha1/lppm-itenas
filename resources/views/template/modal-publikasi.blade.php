<div class="modal__content modal__content--lg">
    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Data Publikasi
        </h2>
    </div>
    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
        <div class="col-span-12 intro-y">
            <div class="px-5 py-3 mb-3 flex ">
                <div class="flex items-start">
                    <i class="mt-2 mr-2 fa-regular fa-file-lines text-5xl xl:text-5xl"></i>
                </div>
                <div class="ml-4 mr-auto items-center">
                    <div class="border-l-2 border-theme-1 pl-4 mt-3">
                        <h3 class="font-semibold text-xl">{{$publikasi->judul}}</h3>
                    </div>

                    @if(!empty($publikasi->dosen_ketua))
                    <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Ketua</div>
                    <a href="#" class="font-semibold text-base tooltip" >{{$publikasi->dosen_ketua->nama}}</a>
                    @endif

                    @if(!empty($publikasi->ketua_external))
                    <div class="text-gray-600 font-normal mt-3 text-sm">Ketua External</div>
                    <p class="font-semibold text-base" >{{$publikasi->ketua_external}}</p>
                    @endif
                    
                    @if(!empty($publikasi->penulis_anggota))
                    <div class="text-gray-600 font-normal mt-3 text-sm">Anggota Penulis Internal</div>
                    @foreach ($publikasi->getPenulisInternal() as $da)
                        <a href="#" class="font-semibold text-base block" >{{$da->nama}}</a>
                    @endforeach
				    @endif  

                    @if(!empty($publikasi->getPenulisExternal()))
                    <div class="text-gray-600 font-normal mt-3 text-sm">Anggota Penulis External</div>
                    @foreach ($publikasi->getPenulisExternal() as $da)
                        <a href="#" class="font-semibold text-base block" >{{$da}}</a>
                    @endforeach
					@endif

                    <div class="text-gray-600 font-normal mt-3 text-sm">Jurnal</div>
                    <h3 class="font-semibold text-base">{{$publikasi->jurnal}}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">URL</div>
                    <a href="{{$publikasi->url}}" class="font-semibold text-base">{{$publikasi->url}}</a>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Lingkup</div>
                    <h3 class="font-semibold text-base">{{$publikasi->lingkup}}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tanggal Publish</div>
                    <h3 class="font-semibold text-base">{{ \Carbon\Carbon::parse($publikasi->tanggal_publish)->format('d/m/Y') }}</h3>

                    <div class="text-gray-600 font-normal mt-3 text-sm">Tahun</div>
                    <h3 class="font-semibold text-base">{{$publikasi->tahun}}</h3>
                    
                    <div class="text-gray-600 font-normal mt-3 text-sm">Jumlah</div>
                    <h3 class="font-semibold text-base">Rp. {{number_format($publikasi->jumlah)}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
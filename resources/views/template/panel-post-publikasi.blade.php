<div class="col-span-12 md:col-span-6 box intro-x">
    <div class="px-5 py-3 mb-3 flex ">
        <div class="flex items-start">
            <i class="mt-2 mr-2 fa-regular fa-file-lines text-5xl xl:text-5xl"></i>
        </div>
        <div class="ml-4 mr-auto items-center">
            <div class="text-gray-600 font-normal">Publikasi</div>
            <div class="border-l-2 border-theme-1 pl-4 mt-3">
                <h3 class="font-semibold text-xl">{{$data->judul}}</h3>
            </div>
            @if(!empty($data->dosen_ketua))
            <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Ketua</div>
            <a href="#" class="font-semibold text-base tooltip" >{{$data->dosen_ketua->nama}}</a>
            @else
            <div class="text-gray-600 font-normal mt-3 text-sm">Dosen Ketua (external)</div>
            <a href="#" class="font-semibold text-base tooltip" >{{$data->ketua_external}}</a>
            @endif

            <div class="text-gray-600 font-normal mt-3 text-sm">Lingkup</div>
            <h3 class="font-semibold text-base">{{$data->lingkup}}</h3>

            <div class="text-gray-600 font-normal mt-3 text-sm">Tahun</div>
            <h3 class="font-semibold text-base">{{$data->tahun}}</h3>

            <div class="text-gray-600 font-normal mt-3 text-sm">Jumlah</div>
            <h3 class="font-semibold text-base">Rp. {{number_format($data->jumlah)}}</h3>
        </div>
    </div>
    <div class="flex items-center px-5 py-5 sm:py-3 border-t border-gray-200 bottom-0">
        <a class="show-data button w-20 text-white bg-theme-1 shadow-md ml-auto" data-url="{{ route('publikasi.show', [$data->id]) }}">Detail</a>
    </div>
</div>
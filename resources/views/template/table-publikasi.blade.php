@extends('list')

@section('table')
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table class="table table-report table-report--bordered display nowrap datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 text-center whitespace-nowrap w-40">Judul</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jurusan</th>
                <th class="border-b-2 text-center whitespace-nowrap">Penulis Utama Internal</th>
                <th class="border-b-2 text-center whitespace-nowrap">Penulis Utama Eksternal</th>
                <th class="border-b-2 text-center whitespace-nowrap">Penulis Anggota Internal</th>
                <th class="border-b-2 text-center whitespace-nowrap">Penulis Anggota Eksternal</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jurnal/Proceeding/Penerbit</th>
                <th class="border-b-2 text-center whitespace-nowrap">URL</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jenis Publikasi</th>
                <th class="border-b-2 text-center whitespace-nowrap">Lingkup Publikasi</th>
                <th class="border-b-2 text-center whitespace-nowrap">Sumber Dana</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jumlah Dana</th>
                <th class="border-b-2 text-center whitespace-nowrap">Tahun</th>
                @auth('pegawai','web')
                <th class="border-b-2 text-center whitespace-nowrap">#</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td class="border-b text-center">
                    <div class="font-medium whitespace-nowrap">{{$d->judul}}</div>
                </td>
                <td class="text-center border-b">{{$d->getjurusan()}} </td>
                <td class="text-center border-b">
                    @if(!empty($d->dosen_ketua))
                    {{$d->dosen_ketua->nama}}
                    @else
                    -
                    @endif
                </td>
                <td class="text-center border-b">
                    @if(!empty($d->ketua_external))
                       {{$d->ketua_external}}
                    @else
                    -
                    @endif
                </td>
                <td class="w-40 border-b">
                    @if(!empty($d->getPenulisInternal()))
                        @foreach ($d->getPenulisInternal() as $da)
                            <div class="font-medium whitespace-nowrap text-center">{{$da->nama}}</div>
                        @endforeach
                    @else
                    -
                    @endif
                </td>
                <td class="w-40 border-b">
                    @if(!empty($d->getPenulisExternal()))
                        @foreach ($d->getPenulisExternal() as $da)
                            <div class="font-medium whitespace-nowrap text-center">{{$da}}</div>
                        @endforeach
                    @else
                    -
                    @endif
                </td>
                <td class="text-center border-b">
                    @if(!empty($d->jurnal))
                     {{$d->jurnal}}
                     @else
                     -
                     @endif
                </td>    
                <td class="text-center border-b">
                    @if(!empty($d->url))
                     {{$d->url}}
                     @else
                     -
                     @endif
                </td> 
                <td class="text-center border-b">
                    <div class="text-center whitespace-nowrap">{{$d->jenis_publikasi->nama}}</div>
                </td>
                <td class="text-center border-b">{{$d->lingkup}}</td>
                <td class="text-center border-b">{{$d->sumber_dana}}</td>
                <td class="text-center border-b">
                    @if(!empty($d->jumlah))
                     {{$d->jumlah}}
                     @else
                     -
                     @endif
                </td> 
                <td class="text-center border-b">{{$d->tahun}}</td>
                @auth('pegawai','web')
                <td class="border-b w-5">
                    <div class="flex sm:justify-center items-center">
                        {{-- <button class="show-data button px-2 mr-1 mb-2 bg-theme-14 text-theme-10 tooltip" data-url="{{ route('pkm.show', [$d->id]) }}" title="Lihat"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="eye" class="w-4 h-4"></i> </span> </button> --}}
                        <a href="{{ route('publikasi.edit', [$d->id]) }}" class="button btn-edit px-2 mr-1 mb-2 bg-theme-17 text-theme-11 tooltip" title="Edit"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="edit-3" class="w-4 h-4"></i> </span> </a>
                        <a class="button px-2 mr-1 mb-2 bg-theme-31 text-theme-6 tooltip" title="Tolak"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="trash-2" class="w-4 h-4"></i> </span> </a>
                    </div>
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
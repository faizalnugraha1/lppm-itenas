@extends('list')

@section('table')
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table class="table table-report table-report--bordered display nowrap datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 text-center whitespace-nowrap">Judul</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jurusan/Bidang</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jenis Hibah</th>
                <th class="border-b-2 text-center whitespace-nowrap">Dosen Ketua</th>
                <th class="border-b-2 text-center whitespace-nowrap">Dosen Anggota</th>
                <th class="border-b-2 text-center whitespace-nowrap">Anggota Mahasiswa</th>
                <th class="border-b-2 text-center whitespace-nowrap">Nama Mitra</th>
                <th class="border-b-2 text-center whitespace-nowrap">Jumlah</th>
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
                <td class="text-center border-b">{{$d->jenis_hibah->nama}} </td>
                <td class="text-center border-b">{{$d->dosen_ketua->nama}}</td>
                <td class="w-40 border-b">
                    @if(!empty($d->getDosenAnggota()))
                        @foreach ($d->getDosenAnggota() as $da)
                            <div class="font-medium whitespace-nowrap text-center">{{$da->nama}}</div>
                        @endforeach
                    @else
                    -
                    @endif
                </td>
                <td class="w-40 border-b">
                    @if(!empty($d->getMhsAnggota()))
                        @foreach ($d->getMhsAnggota() as $ma)
                            <div class="font-medium whitespace-nowrap text-center">{{$ma->nama}}</div>
                        @endforeach
                    @else
                    -
                    @endif
                </td>
                <td class="text-center border-b">
                    @if(!empty($d->nama_mitra))
                     {{$d->nama_mitra}}
                     @else
                     -
                     @endif
                </td>    
                <td class="text-center border-b">{{number_format($d->jumlah)}}</td>
                <td class="text-center border-b">{{$d->tahun}}</td>
                @auth('pegawai','web')
                <td class="border-b w-5">
                    <div class="flex sm:justify-center items-center">
                        {{-- <button class="show-data button px-2 mr-1 mb-2 bg-theme-14 text-theme-10 tooltip" data-url="{{ route('pkm.show', [$d->id]) }}" title="Lihat"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="eye" class="w-4 h-4"></i> </span> </button> --}}
                        <a href="{{ route('pkm.edit', [$d->id]) }}" class="button btn-edit px-2 mr-1 mb-2 bg-theme-17 text-theme-11 tooltip" title="Edit"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="edit-3" class="w-4 h-4"></i> </span> </a>
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
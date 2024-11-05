@extends('edit')

@section('edt-form')
<form action="{{ route('pkm.update', [$pkm->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <div class="box p-5" id="input">
            <div>
                <label>Judul PKM</label>
                <input name="pkm_judul_pkm" type="text" class="input w-full border mt-2" placeholder="--Judul PKM--" value="{{$pkm->judul}}">
            </div>
            <div class="mt-3">
                <label>Dosen Ketua</label>
                @if(Auth::guard('pegawai')->check())
                <select name="pkm_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="--Pilih dosen ketua--" data-list="{{ route('get_dosen') }}">
                    <option selected="selected" value="{{$pkm->dosen_ketua->id}}">{{$pkm->dosen_ketua->nama}}</option>
                </select>
                @elseif(Auth::guard('dosen')->check())
                <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{Auth::user()->nama}}" disabled>
                <input name="pkm_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{Auth::user()->nip}}">
                @endif 
            </div>
            <div class="mt-3">
                <label class="mb-2">Anggota Dosen</label>
                <select name="pkm_dosen_anggota[]" class="select2 input w-full border mt-2 select-dosen" multiple data-placeholder="--Pilih anggota dosen--" data-list="{{ route('get_dosen') }}">
                @foreach ($pkm->getDosenAnggota() as $da)
                    <option selected="selected" value="{{$da->id}}">{{$da->nama}}</option>
                @endforeach
            </select>
            </div>
            <div class="mt-3">
                <label class="mb-2">Anggota Mahasiswa</label>
                <select name="pkm_anggota_mhs[]" class="select2 input w-full border mt-2 select-mhs" multiple style="width: 100%" data-placeholder="--Pilih anggota mahasiswa--" data-list="{{ route('get_mhs') }}">
                    @foreach ($pkm->getMhsAnggota() as $ma)
                    <option selected="selected" value="{{$ma->id}}">{{$ma->nrp}}-{{$ma->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label class="mb-2">Jenis Hibah</label>
                <select name="pkm_jenis_hibah" class="select2 input w-full border mt-2 select-hibah" style="width: 100%" data-placeholder="--Pilih Jenis Hibah--" data-list="{{ route('get_hibah') }}">
                    <option selected="selected" value="{{$pkm->jenis_hibah->id}}">{{$pkm->jenis_hibah->nama}}</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Mitra</label>
                <input name="pkm_nama_mitra" type="text" class="input w-full border mt-2" placeholder="--Nama Mitra (Opsional)--" value="{{$pkm->nama_mitra}}">
            </div>
            <div class="mt-3" id="inline-form">
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-4">
                        <label for="">Tanggal Mulai</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                            <input name="pkm_mulai" type="text" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off" value="{{ \Carbon\Carbon::parse($pkm->mulai)->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="">Tanggal Selesai</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                            <input name="pkm_selesai" type="text" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off" value="{{ \Carbon\Carbon::parse($pkm->selesai)->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="">Tahun</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                            <input name="pkm_tahun" type="text" class="bs-yearpicker input pl-12 w-full border col-span-4" value="{{$pkm->tahun}}" placeholder="--Pilih Tahun--" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label>Jumlah</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
                    <input name="pkm_jumlah" type="text" class="input rupiah pl-12 w-full border col-span-4" placeholder="--Jumlah Dana Hibah--" autocomplete="off" value="{{$pkm->jumlah}}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4 md:col-span-12 xxl:col-span-3">
        <div class="box p-5 ">
            <div class="">
                <label>Tanggal Dibuat</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                    <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{ \Carbon\Carbon::parse($pkm->created_at)->format('d/m/Y') }}">
                </div>
            </div>
            <div class="mt-4">
                <label>Status</label>
                <div class="flex flex-col sm:flex-row mt-2 status-group">
                    <div class="flex items-center text-gray-700 mr-4">
                        <input type="radio" class="input border mr-2" name="pkm_status" value="1" @auth('dosen') disabled @endauth @if($pkm->status == 1) checked @endif>
                        <label class="cursor-pointer select-none" for="status-posted">Posted</label>
                    </div>
                    <div class="flex items-center text-gray-700 mr-2">
                        <input type="radio" class="input border mr-2" name="pkm_status" value="0" @if($pkm->status == 0) checked @elseif(Auth::guard('dosen')->check()) checked @endif >
                        <label class="cursor-pointer select-none" for="status-draft">Draft</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="button w-full mt-5 text-white bg-theme-1 shadow-md disabled:bg-theme-4">Simpan</button>
    </div>

</div>
</form>
@endsection

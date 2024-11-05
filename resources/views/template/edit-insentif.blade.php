@extends('edit')

@section('edt-form')
<form action="{{ route('insentif.update', [$insentif->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        
        <div class="box p-5" id="input">
            <div class="">
                <label class="mb-2">Jenis Insentif</label>
                <select name="ins_jenis_insentif" class="select2 input w-full border mt-2 select-insentif" style="width: 100%" data-placeholder="--Pilih Jenis Hibah--" data-list="{{ route('get_insentif') }}">
                    <option selected="selected" value="{{$insentif->jenis_insentif->id}}">{{$insentif->jenis_insentif->nama}}</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Judul Publikasi</label>
                <input name="ins_judul_publikasi" type="text" class="input w-full border mt-2" placeholder="--Judul Publikasi--" value="{{$insentif->judul}}">
            </div>
            <div class="mt-3">
                <label>Penulis Ketua</label>
                @if(Auth::guard('pegawai')->check())
                <select name="ins_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="----Pilih dosen ketua----" data-list="{{ route('get_dosen') }}">
                    <option selected="selected" value="{{$insentif->dosen_ketua->id}}">{{$insentif->dosen_ketua->nama}}</option>
                </select>
                @elseif(Auth::guard('dosen')->check())
                <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{$insentif->dosen_ketua->nama}}" disabled>
                <input name="ins_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{$insentif->dosen_ketua->id}}">
                @endif 
            </div>
            <div class="mt-3">
                <label class="mb-2">Penulis Anggota</label>
                <select name="ins_dosen_anggota[]" class="select2 input w-full border mt-2 select-dosen" multiple data-placeholder="--Pilih penulis anggota--" data-list="{{ route('get_dosen') }}">
                    @foreach ($insentif->getDosenAnggota() as $da)
                        <option selected="selected" value="{{$da->id}}">{{$da->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label class="mb-2">Jenis Publikasi</label>
                <select name="ins_jenis_publikasi" class="select2 input w-full border mt-2 select-pub" style="width: 100%" data-placeholder="--Pilih jenis publikasi--" data-list="{{ route('get_pub') }}">
                    <option selected="selected" value="{{$insentif->jenis_publikasi->id}}">{{$insentif->jenis_publikasi->nama}}</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Jurnal</label>
                <input name="ins_jurnal" type="text" class="input w-full border mt-2" placeholder="--Nama Jurnal--" value="{{$insentif->jurnal}}">
            </div>
            <div class="mt-3" id="inline-form">
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-4">
                        <label for="">Tahun</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                            <input name="ins_tahun" type="text" class="bs-yearpicker input pl-12 w-full border col-span-4" value="{{$insentif->tahun}}" placeholder="--Pilih Tahun--" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label>Jumlah</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
                    <input name="ins_jumlah" type="text" class="input rupiah pl-12 w-full border col-span-4" placeholder="--Jumlah Dana Hibah--" autocomplete="off" value="{{$insentif->jumlah}}">
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
                    <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{ \Carbon\Carbon::parse($insentif->created_at)->format('d/m/Y') }}">
                </div>
            </div>
            <div class="mt-4">
                <label>Status</label>
                <div class="flex flex-col sm:flex-row mt-2 status-group">
                    <div class="flex items-center text-gray-700 mr-4">
                        <input type="radio" class="input border mr-2" name="ins_status" value="1" @auth('dosen') disabled @endauth @if($insentif->status == 1) checked @endif>
                        <label class="cursor-pointer select-none" for="status-posted">Posted</label>
                    </div>
                    <div class="flex items-center text-gray-700 mr-2">
                        <input type="radio" class="input border mr-2" name="ins_status" value="0" @if($insentif->status == 0) checked @elseif(Auth::guard('dosen')->check()) checked @endif >
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

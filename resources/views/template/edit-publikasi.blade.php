@extends('edit')

@section('edt-form')
<form action="{{ route('publikasi.update', [$publikasi->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        
        <div class="box p-5" id="input">
            <div class="">
                <label class="mb-2">Judul</label>
                <input name="pub_judul_publikasi" type="text" class="input w-full border mt-2" placeholder="--Judul Publikasi--" value="{{$publikasi->judul}}">
            </div>
            <div class="mt-3">
                <label>Penulis Utama Internal ITENAS</label>
                {{-- @if(Auth::guard('pegawai')->check()) --}}
                <select name="pub_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="--Pilih dosen ketua--" data-list="{{ route('get_dosen') }}">
                    <option selected="selected" value="{{ $publikasi->dosen_ketua->id }}">{{ $publikasi->dosen_ketua->nama }}</option>
                </select>
                {{-- @elseif(Auth::guard('dosen')->check())
                <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{Auth::user()->nama}}" disabled>
                <input name="pub_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{Auth::user()->nip}}">
                @endif  --}}
            </div>
            <div class="mt-3">
                <label>Penulis Utama Eksternal ITENAS</label>
                <input name="pub_penulis_external" type="text" class="input w-full border mt-2" placeholder="--Masukkan Penulis Utama Eksternal ITENAS--" autocomplete="off" value="{{$publikasi->ketua_external}}">
            </div>
            <div class="mt-3">
                <label>Penulis Anggota Internal ITENAS</label>
                <select name="pub_penulis_anggota[]" class="select2 input w-full border mt-2 select-dosen" multiple data-placeholder="--Pilih penulis internal--" data-list="{{ route('get_dosen') }}">
                    @foreach ($publikasi->getPenulisInternal() as $da)
                    <option selected="selected" value="{{$da->id}}">{{$da->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label>Penulis Anggota Eksternal ITENAS</label>
                {{-- <input name="pub_anggota_external" type="text" class="input w-full border mt-2" placeholder="--Masukkan Penulis Anggota Eksternal ITENAS--" value="{{old('pub_anggota_external')}}"> --}}
                <select name="pub_anggota_external[]" class="select2 input w-full border mt-2 pub_external" multiple data-placeholder="--Masukkan Penulis Anggota Eksternall--">
                    @foreach ($publikasi->getPenulisExternal() as $da)
                        <option selected="selected" value="{{$da}}">{{$da}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label>Jurnal/Proceeding/Penerbit</label> 
                <input name="pub_jurnal" type="text" class="input w-full border mt-2" placeholder="--Masukkan Penulis Anggota Eksternal ITENAS--" value="{{$publikasi->jurnal}}">
            </div>
            <div class="mt-3">
                <label class="mb-2">URL</label>
                <input name="pub_url" type="url" class="input w-full border mt-2" placeholder="--Masukkan URL--" value="{{$publikasi->url}}">
            </div>
            <div class="mt-3">
                <label class="mb-2">Jenis Publikasi</label>
                <select name="pub_jenis_publikasi" class="select2 input w-full border mt-2 select-pub2" style="width: 100%" data-placeholder="--Pilih jenis publikasi--" data-list="{{ route('get_pub2') }}">
                    <option selected="selected" value="{{$publikasi->jenis_publikasi->id}}">{{$publikasi->jenis_publikasi->nama}}</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Lingkup Publikasi</label>
                <select name="pub_lingkup" class="select2 input w-full border mt-2" data-placeholder="--Pilih Lingkup Publikasi--">
                    <option></option>
                    <option @if($publikasi->lingkup == 'Internasional') selected="selected" @endif value="Internasional">Internasional</option>
                    <option @if($publikasi->lingkup == 'Lokal') selected="selected" @endif value="Lokal">Lokal</option>
                    <option @if($publikasi->lingkup == 'Nasional') selected="selected" @endif value="Nasional">Nasional</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Sumber Dana</label>
                <select name="pub_sumber_dana" class="select2 input w-full border mt-2" data-placeholder="--Pilih Sumber Dana--">
                    <option></option>
                    <option @if($publikasi->sumber_dana == 'Dikti') selected="selected" @endif value="Dikti">Dikti</option>
                    <option @if($publikasi->sumber_dana == 'Institusi Luar Negeri') selected="selected" @endif value="Institusi Luar Negeri">Institusi Luar Negeri</option>
                    <option @if($publikasi->sumber_dana == 'ITENAS') selected="selected" @endif value="ITENAS">ITENAS</option>
                    <option @if($publikasi->sumber_dana == 'Pemerintah Non Dikti') selected="selected" @endif value="Pemerintah Non Dikti">Pemerintah Non Dikti</option>
                    <option @if($publikasi->sumber_dana == 'Pribadi') selected="selected" @endif value="Pribadi">Pribadi</option>
                    <option @if($publikasi->sumber_dana == 'Swasta') selected="selected" @endif value="Swasta">Swasta</option>
                </select>
            </div>
            <div class="mt-3">
                <label>Jumlah Dana</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
                    <input name="pub_jumlah" type="text" class="input rupiah pl-12 w-full border col-span-4" value="{{$publikasi->jumlah}}" placeholder="--Jumlah Dana--" autocomplete="off">
                </div>
            </div>
            <div class="mt-3" id="inline-form">
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-4">
                        <label for="">Tanggal Publish</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                            <input name="pub_tanggal_publish" type="text" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off" value="{{ \Carbon\Carbon::parse($publikasi->tanggal_publish)->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="">Tahun</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                            <input name="pub_tahun" type="text" class="bs-yearpicker input pl-12 w-full border col-span-4" value="{{$publikasi->tahun}}" placeholder="--Pilih Tahun--"  autocomplete="off">
                        </div>
                    </div>
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
                    <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{ \Carbon\Carbon::parse($publikasi->created_at)->format('d/m/Y') }}">
                </div>
            </div>
            <div class="mt-4">
                <label>Status</label>
                <div class="flex flex-col sm:flex-row mt-2 status-group">
                    <div class="flex items-center text-gray-700 mr-4">
                        <input type="radio" class="input border mr-2" name="pub_status" value="1" @auth('dosen') disabled @endauth @if($publikasi->status == 1) checked @endif>
                        <label class="cursor-pointer select-none" for="status-posted">Posted</label>
                    </div>
                    <div class="flex items-center text-gray-700 mr-2">
                        <input type="radio" class="input border mr-2" name="pub_status" value="0" @if($publikasi->status == 0) checked @elseif(Auth::guard('dosen')->check()) checked @endif >
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

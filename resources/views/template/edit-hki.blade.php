@extends('edit')

@section('edt-form')
<form action="{{ route('hki.update', [$hki->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        
        <div class="box p-5" id="input">
            <div>
                <label>Nama HKI</label>
                <input type="text" name="hki_nama_hki" class="input w-full border mt-2" placeholder="--Nama HKI--" value="{{$hki->judul}}">
            </div>
            <div class="mt-3">
                <label>Jenis HKI</label>
                <input type="text" name="hki_jenis_hki" class="input w-full border mt-2" placeholder="--Jenis HKI--" value="{{$hki->jenis_hki}}">
            </div>
            <div class="mt-3">
                <label>Dosen Ketua</label>
                @if(Auth::guard('pegawai')->check())
                <select id="pen" name="hki_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="--Pilih dosen ketua--" data-list="{{ route('get_dosen') }}">
                    <option selected="selected" value="{{$hki->dosen_ketua->id}}">{{$hki->dosen_ketua->nama}}</option>
                </select>
                @elseif(Auth::guard('dosen')->check())
                <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{$hki->dosen_ketua->nama}}" disabled>
                <input name="hki_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{$hki->dosen_ketua->id}}">
                @endif 
            </div>
            <div class="mt-3" id="inline-form">
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-4">
                        <label for="">Tahun</label>
                        <div class="relative mt-2">
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                            <input name="hki_tahun" type="text" class="bs-yearpicker input pl-12 w-full border col-span-4" value="{{$hki->tahun}}" placeholder="--Pilih Tahun--" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label>Jumlah</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
                    <input name="hki_jumlah" type="text" class="input rupiah pl-12 w-full border col-span-4" placeholder="--Jumlah Dana Hibah--" autocomplete="off" value="{{$hki->jumlah}}">
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
                    <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{ \Carbon\Carbon::parse($hki->created_at)->format('d/m/Y') }}">
                </div>
            </div>
            <div class="mt-4">
                <label>Status</label>
                <div class="flex flex-col sm:flex-row mt-2 status-group">
                    <div class="flex items-center text-gray-700 mr-4">
                        <input type="radio" class="input border mr-2" name="hki_status" value="1" @auth('dosen') disabled @endauth @if($hki->status == 1) checked @endif>
                        <label class="cursor-pointer select-none" for="status-posted">Posted</label>
                    </div>
                    <div class="flex items-center text-gray-700 mr-2">
                        <input type="radio" class="input border mr-2" name="hki_status" value="0" @if($hki->status == 0) checked @elseif(Auth::guard('dosen')->check()) checked @endif >
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

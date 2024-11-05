<form action="{{ route('hki.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="jenis" value="hki">
<div class="box p-5" id="input">
    <div>
        <label>Nama HKI</label>
        <input type="text" name="hki_nama_hki" class="input w-full border mt-2" placeholder="--Nama HKI--" value="{{old('hki_nama_hki')}}">
    </div>
    <div class="mt-3">
        <label>Jenis HKI</label>
        <input type="text" name="hki_jenis_hki" class="input w-full border mt-2" placeholder="--Jenis HKI--" value="{{old('hki_jenis_hki')}}" >
    </div>
    <div class="mt-3">
        <label>Dosen Ketua</label>
        @if(Auth::guard('pegawai')->check())
        <select name="hki_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="--Pilih dosen ketua--" data-list="{{ route('get_dosen') }}">
            @if(Session::has('hki_dosen_ketua'))
            <option selected="selected" value="{{ Session('hki_dosen_ketua')[0] }}">{{ Session('hki_dosen_ketua')[1] }}</option>
            @endif
        </select>
        @elseif(Auth::guard('dosen')->check())
        <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{Auth::user()->nama}}" disabled>
        <input name="hki_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{Auth::user()->nip}}">
        @endif 
    </div>
    <div class="mt-3">
        <label class="mb-2">Anggota Dosen</label>
        <select name="hki_dosen_anggota[]" class="select2 input w-full border mt-2 select-dosen" multiple data-placeholder="--Pilih anggota dosen--" data-list="{{ route('get_dosen') }}">
            @if(Session::has('hki_dosen_anggota'))
            @foreach (Session('hki_dosen_anggota') as $da)       
                <option selected="selected"  value="{{$da[0]}}">{{$da[1]}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="mt-3" id="inline-form">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-4">
                <label for="">Tahun</label>
                <div class="relative mt-2">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                    <input name="hki_tahun" type="text" class="bs-yearpicker input pl-12 w-full border col-span-4" value="{{old('hki_tahun')}}" placeholder="--Pilih Tahun--" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <label>Jumlah</label>
        <div class="relative mt-2">
            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
            <input name="hki_jumlah" value="{{old('hki_jumlah')}}" type="text" class="input rupiah pl-12 w-full border col-span-4" value="" placeholder="--Jumlah Dana Hibah--"  autocomplete="off">
        </div>
    </div>
</div>
<div class="box p-5 mt-4">
    <div class="">
        <label>Tanggal Dibuat</label>
        <div class="relative mt-2">
            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
            <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{date('d/m/Y', time())}}" >
        </div>
    </div>
    <div class="mt-4">
        <label>Status</label>
        <div class="flex flex-col sm:flex-row mt-2 status-group">
            <div class="flex items-center text-gray-700 mr-4">
                <input type="radio" class="input border mr-2" name="hki_status" value="1" @auth('dosen') disabled @endauth @if(old('hki_status') === '1') checked @endif>
                <label class="cursor-pointer select-none" for="status-posted">Posted</label>
            </div>
            <div class="flex items-center text-gray-700 mr-2">
                <input type="radio" class="input border mr-2" name="hki_status" value="0" @if(Auth::guard('dosen')->check() || old('hki_status') === '0' ) checked @endif>
                <label class="cursor-pointer select-none" for="status-draft">Draft</label>
            </div>
        </div>
    </div>
</div>
<button type="submit" class="button w-full mt-5 text-white bg-theme-1 shadow-md disabled:bg-theme-4">Submit</button>
</form>
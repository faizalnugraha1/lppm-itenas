
<form action="{{ route('pkm.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden" name="jenis" value="pkm">
@method('POST')
    <div class="box p-5" id="input">
        <div>
            <label>Judul PKM</label>
            <input name="pkm_judul_pkm" type="text" class="input w-full border mt-2" placeholder="--Judul PKM--" value="{{old('pkm_judul_pkm')}}">
        </div>
        <div class="mt-3">
            <label>Dosen Ketua</label>
            @if(Auth::guard('pegawai')->check())
            <select name="pkm_dosen_ketua" class="select2 input w-full border mt-2 select-dosen" data-placeholder="--Pilih dosen ketua--" data-list="{{ route('get_dosen') }}">
                @if(Session::has('pkm_dosen_ketua'))
                <option selected="selected" value="{{ Session('pkm_dosen_ketua')[0] }}">{{ Session('pkm_dosen_ketua')[1] }}</option>
                @endif
            </select>
            @elseif(Auth::guard('dosen')->check())
            <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{Auth::user()->nama}}" disabled>
            <input name="pkm_dosen_ketua" type="hidden" class="input w-full border mt-2" value="{{Auth::user()->nip}}">
            @endif 
        </div>
        <div class="mt-3">
            <label class="mb-2">Anggota Dosen</label>
            <select name="pkm_dosen_anggota[]" class="select2 input w-full border mt-2 select-dosen" multiple data-placeholder="--Pilih anggota dosen--" data-list="{{ route('get_dosen') }}">
                @if(Session::has('pkm_dosen_anggota'))
                @foreach (Session('pkm_dosen_anggota') as $da)       
                    <option selected="selected"  value="{{$da[0]}}">{{$da[1]}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="mt-3">
            <label class="mb-2">Anggota Mahasiswa</label>
            <select name="pkm_anggota_mhs[]" class="select2 input w-full border mt-2 select-mhs" multiple style="width: 100%" data-placeholder="--Pilih anggota mahasiswa--" data-list="{{ route('get_mhs') }}">
                @if(Session::has('pkm_anggota_mhs'))
                @foreach (Session('pkm_anggota_mhs') as $am)       
                    <option selected="selected"  value="{{$am[0]}}">{{$am[1]}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="mt-3">
            <label class="mb-2">Jenis Hibah</label>
            <select name="pkm_jenis_hibah" class="select2 input w-full border mt-2 select-hibah" style="width: 100%" data-placeholder="--Pilih Jenis Hibah--" data-list="{{ route('get_hibah') }}">
                @if(Session::has('pkm_jenis_hibah'))
                <option selected="selected" value="{{ Session('pkm_jenis_hibah')[0] }}">{{ Session('pkm_jenis_hibah')[1] }}</option>
                @endif
            </select>
        </div>
        <div class="mt-3">
            <label>Mitra</label>
            <input name="pkm_nama_mitra" type="text" class="input w-full border mt-2" placeholder="--Nama Mitra (Opsional)--" value="{{old('pkm_nama_mitra')}}">
        </div>
        <div class="mt-3" id="inline-form">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-4">
                    <label for="">Tanggal Mulai</label>
                    <div class="relative mt-2">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                        <input name="pkm_mulai" type="text" value="{{old('pkm_mulai')}}" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off">
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="">Tanggal Selesai</label>
                    <div class="relative mt-2">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                        <input name="pkm_selesai" type="text" value="{{old('pkm_selesai')}}" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off">
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="">Tahun</label>
                    <div class="relative mt-2">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar-week"></i></div>
                        <input name="pkm_tahun" type="text" value="{{old('pkm_tahun')}}" class="bs-yearpicker input pl-12 w-full border col-span-4" value="" placeholder="--Pilih Tahun--" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <label>Jumlah</label>
            <div class="relative mt-2">
                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Rp. </div>
                <input name="pkm_jumlah" type="text" class="input rupiah pl-12 w-full border col-span-4" value="{{old('pkm_jumlah')}}" placeholder="--Jumlah Dana Hibah--" autocomplete="off">
            </div>
        </div>

        </div>
        <div class="box p-5 mt-4">
        <div class="">
            <label>Tanggal Dibuat</label>
            <div class="relative mt-2">
                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                <input type="text" class="input pl-12 w-full border col-span-4 bg-gray-100" disabled value="{{date('d/m/Y', time())}}">
            </div>
        </div>
        <div class="mt-4">
            <label>Status</label>
            <div class="flex flex-col sm:flex-row mt-2 status-group">
                <div class="flex items-center text-gray-700 mr-4">
                    <input type="radio" class="input border mr-2" name="pkm_status" value="1" @auth('dosen') disabled @endauth @if(old('pkm_status') === '1') checked @endif>
                    <label class="cursor-pointer select-none" for="status-posted">Posted</label>
                </div>
                <div class="flex items-center text-gray-700 mr-2">
                    <input type="radio" class="input border mr-2" name="PKMstatus" value="0" @if(Auth::guard('dosen')->check() || old('pkm_status') === '0' ) checked @endif>
                    <label class="cursor-pointer select-none" for="status-draft">Draft</label>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="button w-full mt-5 text-white bg-theme-1 shadow-md disabled:bg-theme-4">Submit</button>
</form>
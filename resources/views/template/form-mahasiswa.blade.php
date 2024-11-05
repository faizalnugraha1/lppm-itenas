@extends('template.app')

@section('lib-css')
<link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}" />
@endsection


@section('content')
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium mr-5">
        Input Data Mahasiswa
    </h2>
</div>  
@if($errors->any())
            @foreach($errors->getMessages() as $this_error)
            <div class="rounded-md px-5 py-4 mb-3 bg-theme-31 text-theme-6">{{$this_error[0]}}</div> 
            @endforeach
        @endif
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-2">
        <form action="{{ route('mhs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="box p-5">
                <div>
                    <label>NRP Mahasiswa</label>
                    <input type="text" name="nrp" class="input w-full border mt-2" placeholder="--NRP Mahasiswa--">
                </div>
                <div class="mt-3">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="nama" class="input w-full border mt-2" placeholder="--Nama Mahasiswa--"  autocomplete="off">
                </div>
                <div class="mt-3">
                    <label class="mb-2">Jurusan Mahasiswa</label>
                    <select name="jurusan" class="select2 input w-full border mt-2 select-jurusan" data-placeholder="--Pilih Jurusan Mahasiswa--">
                        <option></option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Geodesi">Teknik Geodesi</option>
                        <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                        <option value="Perencanaan Wilayah Kota">Perencanaan Wilayah Kota</option>
                        <option value="Arsitektur">Arsitektur</option>
                        <option value="Desain Interior">Desain Interior</option>
                        <option value="Desain Produk">Desain Produk</option>
                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="button w-full mt-5 text-white bg-theme-1 shadow-md disabled:bg-theme-4">Submit</button>
            </form>
        </div>
        
    </div>
</div>
@endsection

@section('lib-script')
<script src="{{ asset('js/select2/dist/js/select2.js') }}"></script>
@endsection

@section('line-script')
<script>
    $('.select-jurusan').select2({
        width: "100%",
    });
</script>
@endsection
@extends('template.app')

@section('lib-css')
<link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}" />
@endsection


@section('content')
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium mr-5">
        Input Surat
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
        <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="box p-5">
                <div class="mt-3">
                    <label class="mb-2">Jenis Surat</label>
                    <select name="jenis_surat" class="select2 input w-full border mt-2 select-jenis-surat" data-placeholder="--Pilih Jenis Surat--">
                        <option></option>
                        <option @if(old('jenis_surat')== 'Surat Keterangan') selected="selected" @endif value="Surat Keterangan">Surat Keterangan</option>
                        <option>Surat Kerja</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label>Nomor Surat</label>
                    <input type="text" name="no_surat" value="{{old('no_surat')}}" class="input w-full border mt-2" placeholder="--Nomor Surat--">
                </div>
                <div class="mt-3">
                    <label>Pembuat Surat</label>
                    <input type="text" class="input w-full border mt-2 dsn_place" placeholder="{{Auth::user()->nama}}" disabled>
                    <input name="pembuat_id" type="hidden" class="input w-full border mt-2" value="{{Auth::user()->id}}">
                    {{-- <input type="text" name="pembuat-id" class="input w-full border mt-2" placeholder="--Nama Pembuat--"> --}}
                </div>
                <div class="mt-3">
                    <label class="mb-2">Jenis Kegiatan</label>
                    <select name="nama_kegiatan" class="select2 input w-full border mt-2 jenis-kegiatan" data-placeholder="--Pilih Jenis Kegiatan--">
                        <option></option>
                        <option @if(old('pub_sumber_dana')== 'penelitian') selected="selected" @endif value="penelitian">Kegiatan Penelitian</option>
                        <option @if(old('pub_sumber_dana')== 'pkm') selected="selected" @endif value="pkm">Kegiatan PKM</option>
                        <option @if(old('pub_sumber_dana')== 'hki') selected="selected" @endif value="hki">Kegiatan HKI</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label class="mb-2">Nama Kegiatan</label>
                    <select name="kegiatan_id" class="select2 input w-full border mt-2 select-nama-kegiatan" data-placeholder="--Pilih Nama Kegiatan--" data-list="{{ route('get_keg') }}">
                        <option></option>
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
    $('.select2').select2({
        width: "100%",
    });

    var url_keg = $('.select-nama-kegiatan').data('list');
    $('.select-nama-kegiatan').select2({
        ajax: {
            url: url_keg,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    k:  $('.jenis-kegiatan').val(),
                    q: params.term, // search term
                };
            },
            processResults: function(data) 
            {
                return {
                    results: data
                };
            },
            cache: true
        },
        width: "100%",
    });
</script>
@endsection

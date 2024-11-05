@extends('template.app')

@section('lib-css')
<link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('js/dropify/dist/css/dropify.css') }}" />
@endsection


@section('content')
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium mr-5">
        Input Surat Masuk
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
        <form action="{{ route('surat.masuk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="box p-5">
                <div class="mt-3">
                    <label class="mb-2">Perihal Surat</label>
                    <input type="text" name="perihal_surat" value="{{old('perihal_surat')}}" class="input w-full border mt-2" placeholder="--Perihal Surat--">
                </div>
                <div class="mt-3">
                    <label>Asal Surat</label>
                    <input type="text" name="dari_surat" value="{{old('dari_surat')}}" class="input w-full border mt-2" placeholder="--Asal Surat--">
                </div>
                <div class="mt-3">
                    <label>Lampiran</label>
                    <input type="text" name="lampiran" value="{{old('lampiran')}}" class="input w-full border mt-2" placeholder="--Lampiran--">
                </div>
                <div class="mt-3" id="inline-form">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-3">
                            <label for="">Tanggal Masuk Surat</label>
                            <div class="relative mt-2">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"><i class="fa-solid fa-calendar"></i></div>
                                <input name="tanggal_masuk" type="text" value="{{old('tanggal_masuk')}}" class="input ts-datepicker pl-12 w-full border col-span-4" placeholder="Pilih Tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label>File Surat</label>
                    <input type="file" name="file_surat" data-allowed-file-extensions="pdf" class="input dropify w-full border mt-2" accept="application/pdf">
                </div>
            </div>
            <button type="submit" class="button w-full mt-5 text-white bg-theme-1 shadow-md disabled:bg-theme-4">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('lib-script')
<script src="{{ asset('js/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/dropify/dist/js/dropify.js') }}"></script>
@endsection

@section('line-script')
    <script>
        $('.dropify').dropify();

        $('.ts-datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: true,
        autoApply: true,
        drops: 'up',
        locale: {
            cancelLabel: 'Hapus',
            applyLabel: 'Terapkan',
            format: 'DD/MM/YYYY'
        }
    });
    </script>
@endsection
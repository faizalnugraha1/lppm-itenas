@extends('template.app')

@section('lib-css')
<link rel="stylesheet" href="{{ asset('js/dropify/dist/css/dropify.css') }}" />
<link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker.css') }}" />
@endsection

@section('content')

<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Tambah Data Baru
        </h2>
    </div>
</div>   
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 lg:col-span-4 md:col-span-12 xxl:col-span-3">
        <div class="intro-y box p-5">
            <div class="pos__tabs nav-tabs mt-1">
                <button data-toggle="tab" data-target="#penelitian" href="javascript:;" class="flex items-center px-3 py-2 rounded-md w-full @if(!is_null(old('jenis')) && old('jenis') == 'penelitian') active @elseif(is_null(old('jenis'))) active @endif"> <i class="fa-solid fa-microscope text-lg mr-2"></i> Penelitian </button>
                <button data-toggle="tab" data-target="#pkm" href="javascript:;" class="flex items-center px-3 py-2 rounded-md w-full @if(old('jenis') == 'pkm') active @endif"> <i class="fa-solid fa-calendar-days text-lg mr-2"></i> PKM </button>
                <button data-toggle="tab" data-target="#insentif" href="javascript:;" class="flex items-center px-3 py-2 rounded-md w-full @if(old('jenis') == 'insentif') active @endif"> <i class="fa-solid fa-receipt text-lg mr-2"></i> Insentif </button>
                <button data-toggle="tab" data-target="#hki" href="javascript:;" class="flex items-center px-3 py-2 rounded-md w-full @if(old('jenis') == 'hki') active @endif"> <i class="fa-solid fa-file-invoice text-lg mr-2"></i> HKI </button>
                <button data-toggle="tab" data-target="#publikasi" href="javascript:;" class="flex items-center px-3 py-2 rounded-md w-full @if(old('jenis') == 'publikasi') active @endif"> <i class="fa-regular fa-file-lines text-lg mr-2"></i> Publikasi </button>
            </div>
        </div>
    </div>

    <div class="intro-y col-span-12 lg:col-span-8">
        @if($errors->any())
            @foreach($errors->getMessages() as $this_error)
            <div class="rounded-md px-5 py-4 mb-3 bg-theme-31 text-theme-6">{{$this_error[0]}}</div> 
            @endforeach
        @endif 
        @if(Session::has('success'))
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-18 text-theme-9">{{ Session('success') }} </div>
        @endif
        
        <div class="tab-content">
            <div class="tab-content__pane @if(!is_null(old('jenis')) && old('jenis') == 'penelitian') active @elseif(is_null(old('jenis'))) active @endif" id="penelitian">
                @include('template.form-penelitian')
            </div>
          
            <div class="tab-content__pane @if(old('jenis') == 'pkm') active @endif" id="pkm">
                @include('template.form-pkm')
            </div>

            <div class="tab-content__pane @if(old('jenis') == 'insentif') active @endif" id="insentif">
                @include('template.form-insentif')
            </div>

            <div class="tab-content__pane @if(old('jenis') == 'hki') active @endif" id="hki">
                @include('template.form-hki')
            </div>

            <div class="tab-content__pane @if(old('jenis') == 'publikasi') active @endif" id="publikasi">
                @include('template.form-publikasi')
            </div>
           
        </div>

    </div>

</div>

@endsection

@section('lib-script')
<script src="{{ asset('js/dropify/dist/js/dropify.js') }}"></script>
<script src="{{ asset('js/select2/dist/js/select2.js') }}"></script>
<script src="{{ asset('js/yearpicker/dist/yearpicker.js') }}"></script>
<script src="{{ asset('js/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/bs-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/cleavejs/dist/cleave.min.js') }}"></script>
@endsection

@section('line-script')
<script>
    $('.select2').select2({
        width: "100%",
        minimumResultsForSearch: -1
    });

    var url_dsn = $('.select-dosen').data('list');
    $('.select-dosen').select2({
        ajax: {
            url: url_dsn,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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

    var url_mhs = $('.select-mhs').data('list');
    $('.select-mhs').select2({
        ajax: {
            url: url_mhs,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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

    var url_hbh = $('.select-hibah').data('list');
    $('.select-hibah').select2({
        ajax: {
            url: url_hbh,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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
    var url_ins = $('.select-insentif').data('list');
    $('.select-insentif').select2({
        ajax: {
            url: url_ins,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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

    var url_pub = $('.select-pub').data('list');
    $('.select-pub').select2({
        ajax: {
            url: url_pub,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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

    var url_pub2 = $('.select-pub2').data('list');
    $('.select-pub2').select2({
        ajax: {
            url: url_pub2,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
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

    $('.pub_external').select2({
        tags: true,
        tokenSeparators: [";"],
        width: "100%",
        minimumResultsForSearch: -1,
    });

    $('.bs-yearpicker').datepicker({
        autoclose: true,
        format: " yyyy",
        viewMode: "years",
        minViewMode: "years",
        orientation: "top",
    });

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

    $('.rupiah').toArray().forEach(function(field){
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    });


</script>


@endsection
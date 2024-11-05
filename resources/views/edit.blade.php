@extends('template.app')

@section('lib-css')
<link rel="stylesheet" href="{{ asset('js/dropify/dist/css/dropify.css') }}" />
<link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker.css') }}" />
@endsection

@section('content')

<div class="col-span-12 mt-4">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">
            Edit Data
        </h2>
    </div>
</div>  

<div class="col-span-12">
    @if($errors->any())
    @foreach($errors->getMessages() as $this_error)
    <div class="rounded-md px-5 py-4 mb-3 bg-theme-31 text-theme-6">{{$this_error[0]}}</div> 
    @endforeach
    @endif 
    @if(Session::has('success'))
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-18 text-theme-9">{{ Session('success') }} </div>
    @endif
</div> 

@yield('edt-form')

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
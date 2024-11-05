@extends('template.app')

@section('lib-css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/datatable/datatables') }}"/> --}}
@endsection

@section('content')

<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium mr-5">
        {{$title}}
    </h2>
</div>  
@if($errors->any())
    @foreach($errors->getMessages() as $this_error)
    <div class="rounded-md px-5 py-4 mb-3 bg-theme-31 text-theme-6">{{$this_error[0]}}</div> 
    @endforeach
@endif 
@if(Session::has('success'))
    <div class="rounded-md px-5 py-4 mb-2 bg-theme-18 text-theme-9">{{ Session('success') }} </div>
@endif
{{-- dosen --}}
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="intro-x col-span-12 mt-6 box">
            <h2 class="text-lg font-medium pt-5 pl-5">
                Surat Keluar
            </h2>
        <div class="datatable-wrapper box p-5">
            <table class="table table-report table-report--bordered display datatable w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 text-left whitespace-no-wrap">Jenis Surat</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Nomor Surat</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Pembuat surat</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Nama Kegiatan</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $da)
                    <tr>
                        <td class="text-left border-b">{{$da->jenis_surat}} </td>
                        <td class="text-center border-b">{{$da->no_surat}} </td>
                        <td class="text-center border-b">{{$da->getPembuat()->nama}} </td>
                        <td class="text-center border-b">{{Str::ucfirst($da->nama_kegiatan)}} </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center items-center">
                            <a href="{{ route('surat.tampil', [$da->qr]) }}" target="_blank" class="button px-2 mr-1 mb-2 bg-theme-14 text-theme-10 tooltip" title="Lihat"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="eye" class="w-4 h-4"></i> </span> </a>
                            </div>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="intro-x col-span-12 mt-6 box">
            <h2 class="text-lg font-medium pt-5 pl-5">
                Surat Masuk
            </h2>
        <div class="datatable-wrapper box p-5">
            <table class="table table-report table-report--bordered display datatable w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 text-left whitespace-no-wrap">Perihal</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Dari</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Lampiran</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Tanggal Diterima</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data2 as $d2)
                    <tr>
                        <td class="text-left border-b">{{$d2->perihal}} </td>
                        <td class="text-center border-b">{{$d2->dari}} </td>
                        <td class="text-center border-b">{{!empty($d2->lampiran)? $d2->lampiran : '-'}}</td>
                        <td class="text-center border-b">{{$d2->tanggal_masuk}} </td>
                        <td class="text-center border-b">
                            <div class="flex sm:justify-center items-center">
                            <a href="{{ asset('files/surat/'.$d2->file) }}" target="_blank" class="button px-2 mr-1 mb-2 bg-theme-14 text-theme-10 tooltip" title="Lihat"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="eye" class="w-4 h-4"></i> </span> </a>
                            </div>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@if(Session::has('redirect'))
<a id="redirect_button" href="{{Session('redirect')}}" target="_blank" hidden></a>
@endif

@endsection

@section('lib-script')
<script type="text/javascript" src="{{ asset('js/datatable/datatables.min.js') }}"></script>
@endsection

@section('line-script')
<script>
    $('.datatable').DataTable();
</script>

@if(Session::has('redirect'))
<script>
    $(document).ready(function() {
        $("#redirect_button")[0].click()
    })
</script>
@endif

@endsection

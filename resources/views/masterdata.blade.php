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
        <div class="col-span-12 mt-6 box">
        <div class="text-center text-lg font-bold mt-4">Data Dosen</div>
        <div class="intro-y datatable-wrapper box p-5">
            <div class="mb-4">
                <a href="{{ route('dosen.create') }}" class="button text-white bg-theme-1 shadow-md">Add Data Dosen</a>
            </div>
            <table class="table table-report table-report--bordered display datatable w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 text-left whitespace-no-wrap">Nama Dosen</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">NIP</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">NIDN</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">JURUSAN</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dsn as $ds)
                    <tr>
                        <td class="text-left border-b">{{$ds->nama}} </td>
                        <td class="text-center border-b">{{$ds->nip}} </td>
                        <td class="text-center border-b">{{$ds->nidn}} </td>
                        <td class="text-center border-b">{{$ds->jurusan}} </td>
                        <td class="text-center border-b">{{$ds->email}} </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
{{-- MHS --}}

<div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-6 box">
        <div class="text-center text-lg font-bold mt-4">Data Mahasiswa</div>
        <div class="intro-y datatable-wrapper box p-5">
            <div class="mb-4">
                <a href="{{ route('mhs.create') }}" class="button text-white bg-theme-1 shadow-md">Add Data Mahasiswa</a>
            </div>
            <table class="table table-report table-report--bordered display datatable w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 text-center whitespace-no-wrap">NRP</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">NAMA MAHASISWA</th>
                        <th class="border-b-2 text-center whitespace-no-wrap">JURUSAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mhs as $ms)
                    <tr>
                        <td class="text-center border-b">{{$ms->nrp}} </td>
                        <td class="text-center border-b">{{$ms->nama}} </td>
                        <td class="text-center border-b">{{$ms->jurusan}} </td>                  
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection

@section('lib-script')
<script type="text/javascript" src="{{ asset('js/datatable/datatables.min.js') }}"></script>
@endsection

@section('line-script')
<script>
    $('.datatable').DataTable();
</script>
@endsection
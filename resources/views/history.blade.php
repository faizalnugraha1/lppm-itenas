@extends('template.app')

@section('lib-css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/datatable/datatables.min.css') }}"/> --}}
@endsection

@section('content')
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium mr-5">
        Riwayat Input Data
    </h2>
</div>  

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        @if($errors->any())
            @foreach($errors->getMessages() as $this_error)
            <div class="rounded-md px-5 py-4 mb-3 bg-theme-31 text-theme-6">{{$this_error[0]}}</div> 
            @endforeach
        @endif 
        @if(Session::has('success'))
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-18 text-theme-9">{{ Session('success') }} </div>
        @endif
        <div class="col-span-12 mt-2 box">
            <div class="intro-y datatable-wrapper box p-5 mt-5">
                <table class="table table-report table-report--bordered display datatable w-full">
                    <thead>
                        <tr>
                            <th class="border-b-2 whitespace-nowrap">Data</th>
                            <th class="border-b-2 text-center whitespace-nowrap">Judul</th>
                            <th class="border-b-2 text-center whitespace-nowrap">Dosen Ketua</th>
                            <th class="border-b-2 text-center whitespace-nowrap">Status</th>
                            <th class="border-b-2 text-center whitespace-nowrap">Terakhir diubah</th>
                            <th class="border-b-2 text-center whitespace-nowrap">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td class="border-b">
                                <div class="font-medium whitespace-nowrap">{{$d->table_name}}</div>
                            </td>
                            <td class="text-center border-b">{{$d->getKegiatan()->judul}} </td>
                            <td class="text-center border-b">{{$d->getKegiatan()->dosen_ketua->nama}}</td>
                            <td class="w-40 border-b">
                                @if($d->status == 1)
                                <div class="flex items-center sm:justify-center text-theme-9"> 
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Posted 
                                </div>
                                @else
                                <div class="flex items-center sm:justify-center text-theme-6"> 
                                    <i data-feather="clock" class="w-4 h-4 mr-2"></i> Pending 
                                </div>
                                @endif
                            </td>
                            <td class="text-center border-b">{{$d->updated_at}}</td>
                            <td class="border-b w-5">
                                <div class="flex sm:justify-center items-center">
                                    <button class="show-data button px-2 mr-1 mb-2 bg-theme-14 text-theme-10 tooltip" data-url="@if($d->table_name == 'Penelitian') {{ route('penelitian.show', [$d->id]) }} @elseif ($d->table_name == 'Pkm') {{ route('pkm.show', [$d->id]) }} @elseif($d->table_name == 'Insentif') {{ route('insentif.show', [$d->id]) }} @elseif($d->table_name == 'HKI') {{ route('hki.show', [$d->id]) }} @endif" title="Lihat"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="eye" class="w-4 h-4"></i> </span> </button>
                                    <a href="@if($d->table_name == 'Penelitian') {{ route('penelitian.edit', [$d->id]) }} @elseif ($d->table_name == 'Pkm') {{ route('pkm.edit', [$d->id]) }} @elseif($d->table_name == 'Insentif') {{ route('insentif.edit', [$d->id]) }} @elseif($d->table_name == 'HKI') {{ route('hki.edit', [$d->id]) }} @endif" class="button btn-edit px-2 mr-1 mb-2 bg-theme-17 text-theme-11 tooltip" title="Edit"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="edit-3" class="w-4 h-4"></i> </span> </a>
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
<div class="modal" id="large-modal-size-preview">
</div>
@endsection

@section('lib-script')
<script type="text/javascript" src="{{ asset('js/datatable/datatables.min.js') }}"></script>
@endsection

@section('line-script')
<script>
    $('.datatable').DataTable({
        responsive: true,
        'order': [[ 4, "asc" ]]
    })

    // $('.btn-edit').click(function (e) { 
    //     e.preventDefault();
    //     alert('youre going to google .com');
    //     window.location = $(this).attr('href');
    // });
</script>
@endsection
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

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-2 box">
           @yield('table')
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
        "scrollX": true,
        // "dom": '<"dataTables_wrapper"fltip>'
    });

    // $('.btn-edit').click(function (e) { 
    //     e.preventDefault();
    //     alert('youre going to google .com');
    //     window.location = $(this).attr('href');
    // });
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <meta name="description" content="">

    <link rel="stylesheet" href="{{ asset('css/app.css') }} " />

</head>
<body class="flex place-content-center content-center place-items-center body-bg min-h-screen py-6 px-2" style="font-family:'Lato',sans-serif;">
    <div>
    <header class="max-w-lg mx-auto justify-center">
        <a href="" class="intro-x flex justify-center items-center pt-4">
            <img alt="LP2M" class="w-12" src="{{asset('logo-itenas.svg') }}">
            <span class="text-black font-bold text-3xl ml-3"><span class=" text-theme-1">LP2M </span>ITENAS</span>
        </a>
    </header>
    <main class="bg-white bg-opacity-90 max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl intro-x">
        <section class="mt-5">

                <table>
                    <tr>
                        <td style="width:10%;font-size: 15px;">No Surat</td>
                        <td style="width:5%;text-align: center">:</td>
                        <td style="width:20%;font-size: 15px">{{$dasur->no_surat}}</td>
        
                    </tr>
                    <tr>
                        <td style="width:10%;font-size: 15px;">Dibuat Tanggal</td>
                        <td style="width:5%;text-align: center">:</td>
                        <td style="width:20%;font-size: 15px;">{{ \Carbon\Carbon::parse($dasur->created_at)->format('d F Y') }}</td>
        
                    </tr>
                    <tr>
                        <td style="width:10%;font-size: 15px;">Pembuat</td>
                        <td style="width:5%;text-align: center">:</td>
                        <td style="width:20%;font-size: 15px;">{{$dasur->getPembuat()->nama}}</td>
                    </tr>
        
                </table>
        </section>
    </main>
</div>
</body>
</html>
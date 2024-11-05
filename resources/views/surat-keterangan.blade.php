<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Aktif Kuliah</title>
    <link rel="icon" type="image/png" href="{{asset('logo-itenas.svg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}
</head>
<style>
    @page {
        margin: 240px 3em 3em 3em;
    }

    header {
        position: fixed;
        top: -200px;
        left: 0;
        right: 0;
        height: 200px;
        padding: 0px;
        margin: 0px;
        z-index: 900;
        vertical-align: bottom;
    }

    table {
        position: relative;
        width: 80%;
        max: width 100%;
        margin: auto;
    }

    .list-dosen td tr {
        /* padding-top: 3px; */
        /* padding-bottom: 7px; */
        vertical-align: middle;
    }

    .border {
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
    }

    .isi {
        margin-left: 2em;
        margin-right: 1em;
        margin-bottom: 1em;
        margin-top: -4.7em;
    }

    .container {
        display: flex;
        align-items: flex-start;
    }

    .p-al {
        font-size: 11px;
        line-height: 0.2;
    }

    .p-itenas {
        font-size: 28px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        line-height: 0.1;
    }

    .arial {
        font-family: Arial, sans-serif;
    }

    .isisurat {
        text-align: justify;
    }

    footer {
        position: fixed;
        top: 19cm;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
    }

    .tembusan {
        bottom: 110;
        margin-left: 3em;
        /* position:fixed; */
    }

    .over {
        text-decoration: overline;
    }

    .ttd {
        bottom: 250;
        margin-left: 25em;
        margin-right: 0;
        /* position:fixed; */
    }

    .page:after {
        content: counter(page);
    }

</style>

<body>
    <header class="header">
        <table border="0" style="width: 100%; margin-bottom: 1em;">
            <tr>
                <td style="width:20%;">
                    <img src="{{ url('logo-itenas.png') }}" width="110" height="110">
                </td>
                <td class="header">
                    <p align="center" style="font-family: Arial, sans-serif; font-size: 11pt;line-height: 0.1;">
                        <>YAYASAN PENDIDIKAN DAYANG SUMBI
                    </p>
                    <p align="center" class="p-itenas">INSTITUT TEKNOLOGI NASIONAL
                    <p align="center" style="font-family: Arial, sans-serif; font-size: 11pt;line-height: 0.1;">
                        LEMBAGA PENELITIAN DAN PENGABDIAN KEPADA MASYARAKAT
                    </p>

                    <p align="center" class="p-al" style="font-family: Arial, sans-serif;font-size: 7pt;">Jl. PKH. Hasan Mustafa No. 23 Bandung 40124
                        Indonesia,Telepon:+62-22-7272215 ext 181; Fax: +62-22-7202892</p>
                    <p align="center" class="p-al" style="font-family: Arial, sans-serif;font-size: 7pt;">Website: <font color="blue">http://www.itenas.ac.id</font>;
                        Email : <font color="blue">lppm@itenas.ac.id</font>
                    </p>
                </td>
            </tr>
        </table>
        <hr style="border-top: 1px solid black;margin-top: -10px">
    </header>

    <div class="isi">
        <center>
            <!-- <p style="font-size: 14px;"><u>FORM PEMBIMBINGAN PELAKSANAAN PRAKTIK KERJA / TUGAS AKHIR (TA) *) -->
            <p class="arial" style="font-size: 14pt;font-weight: bold;line-height: 0; margin-top: 2em;"> SURAT KETERANGAN </p>
            <p class="arial" style="font-size: 11pt; font-weight: bold;line-height: 0;">MELAKUKAKAN KEGIATAN {{Str::upper($kegiatan)}}</p>
            <p class="arial" style="font-size: 11pt; font-weight: bold;line-height: 0;">INSTITUT TEKNOLOGI NASIONAL</p>
            <p class="arial" style="font-size: 11pt; font-weight: bold;line-height: 0;">No. {{$nosurat}}</p>
        </center>
    </div>

    <br>
    <br>
    <br>
    <div class="isi arial">
        <p style="font-size: 14x;"> Yang bertanda tangan dibawah ini,</p>
        <table>
            <tr>
                <td style="width:10%;font-size: 15px;">Nama</td>
                <td style="width:5%;text-align: center">:</td>
                <td style="width:20%;font-size: 15px">{{$pembuat->nama}}</td>

            </tr>
            <tr>
                <td style="width:10%;font-size: 15px;">Jabatan</td>
                <td style="width:5%;text-align: center">:</td>
                <td style="width:20%;font-size: 15px;">{{$pembuat->jabatan}}</td>

            </tr>
            <tr>
                <td style="vertical-align:top;width:10%;font-size: 15px;"  >Unit Kerja</td>
                <td style="vertical-align:top;width:2%;text-align: center">:</td>
                <td style="width:18%;font-size: 15px;">
                   LPPM-Itenas
                   <br>
                   JL. P.K.H. Mustafa No.23 Bandung
                </td>

            </tr>

        </table>
        <p style="font-size: 14x;"> Menerangkan bahwa,</p>

    </div>

    {{-- <div class="arial"> --}}
        <table class="list-dosen" style="width: 90%;border-collapse:collapse;">
            <tr style="">
                <td class="border arial" style=" width:7%;font-size: 10pt;text-align: center; vertical-align: middle" bgcolor="#538DD3"><p style="font-weight: bold; line-height: 0;vertical-align: middle">No.</p></td>
                <td class="border arial" style="width:40%;font-size: 10pt;text-align: center; vertical-align: middle" bgcolor="#538DD3"><p style="font-weight: bold; line-height: 0;vertical-align: middle">Nama</p></td>
                <td class="border arial" style="width:25%;font-size: 10pt;text-align: center; vertical-align: middle" bgcolor="#538DD3"><p style="font-weight: bold; line-height: 0;vertical-align: middle">NPP</p></td>
                <td class="border arial" style="width:30%;font-size: 10pt;text-align: center; vertical-align: middle" bgcolor="#538DD3"><p style="font-weight: bold; line-height: 0;vertical-align: middle">Jabatan</p></td>
            </tr>
            @foreach ($data->getlistdosen() as $key => $d)
            <tr style="line-height: 20pt;">
                <td class="border arial" style=" width:7%;font-size: 10pt;text-align: center; vertical-align: middle" ><p style="line-height: 0;vertical-align: middle">{{$key+1}}</p></td>
                <td class="border arial" style="width:40%;font-size: 10pt;text-align: center; vertical-align: middle" ><p style="line-height: 0;vertical-align: middle">{{$d[0]}}</p></td>
                <td class="border arial" style="width:25%;font-size: 10pt;text-align: center; vertical-align: middle" ><p style="line-height: 0;vertical-align: middle">{{$d[1]}}</p></td>
                <td class="border arial" style="width:30%;font-size: 10pt;text-align: center; vertical-align: middle" ><p style="line-height: 0;vertical-align: middle">Tenaga Ahli</p></td>
            </tr>
            @endforeach


        </table>

    {{-- </div> --}}
    <br>
    <br>
    <br>
    <br>

    <div class="isi arial">
        <p style="font-size: 14x;"> Telah melakukan kegiatan Pengabdian kepada Masyarakat sebagai berikut:</p>

        <table>
            <tr>
                <td style="font-size: 15px; vertical-align: top">
                    Nama Kegiatan
                </td>
                <td style="width:5%;text-align: center; vertical-align: top">:</td>
                <td style="width:20%;font-size: 15px;  vertical-align: top">{{$data->judul}}</td>

            </tr>
            <tr>
                <td style="width:10%;font-size: 15px;">
                    Tempat
                </td>
                <td style="width:5%;text-align: center">:</td>
                <td style="width:20%;font-size: 15px;">{{$data->mitra}}</td>

            </tr>
            <tr>
                <td style="vertical-align:top;width:10%;font-size: 15px;">
                    Waktu
                </td>
                <td style="vertical-align:top;width:2%;text-align: center">:</td>
                <td style="width:18%;font-size: 15px;">
                    {{$waktu}}
                </td>
            </tr>
            {{-- <tr>
                <td style="vertical-align:top;width:10%;font-size: 15px;">
                    Sumber Dana
                </td>
                <td style="vertical-align:top;width:2%;text-align: center">:</td>
                <td style="font-size: 15px;">
                    {{$data->jenis_hibah->nama}}
                </td>
            </tr> --}}
        </table>
        <p style="font-size: 15x;"> Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </div>

    <br>
    <div class="ttd arial">
        <table style="float:right">
            <tr>
                <td>
                    Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>
                    Lembaga Penelitian dan Pengabdian
                    kepada Masyarakat (LPPM) Itenas
                    <br>
                    {{$pembuat->jabatan}},
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <img src="data:image/png;base64, {!! $qrcode !!}">
                    {{-- {!! QrCode::size(80)->generate('http://www.corelangs.com/css/table/css-tables.html'); !!} --}}
                </td>
            </tr>
            <tr>
                <td>
                    <u><b>{{$pembuat->nama}}</u></b>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <footer>

    </footer>
</body>

</html>

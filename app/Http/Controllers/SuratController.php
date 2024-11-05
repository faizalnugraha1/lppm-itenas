<?php

namespace App\Http\Controllers;

use App\Models\Hki;
use App\Models\Pegawai;
use App\Models\Penelitian;
use App\Models\Pkm;
use App\Models\Surat;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use QrCode;
use PDF;
use Session;

class SuratController extends Controller
{
    public function index()
    {
        $title = 'Data Surat';
        $data = Surat::all();
        $data2 = SuratMasuk::all();

        return view('template.table-surat', compact('title','data', 'data2'));
    }

    public function input_surat()
    {
        $title = 'Create Surat';

        return view('input-surat', compact('title'));
    }

    public function store_surat(Request $request)
    {
        // dd($request->all());
        $rules = array(
            'jenis_surat' => 'required',
            'no_surat' => 'required',
            'nama_kegiatan' => 'required',
            'kegiatan_id' => 'required',
        );
        $messages = array(
            'jenis_surat.required' => 'Jenis surat tidak boleh kosong!',
            'no_surat.required' => 'Nomor tidak boleh kosong!',
            'nama_kegiatan.required' => 'Nama Dosen tidak boleh kosong!',
            'kegiatan_id.required' => 'Nama Dosen tidak boleh kosong!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $key = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);;
            $nosurat = $request->no_surat.'/C.02.01/LPPM/'.$this->getRomawi(date('m')).'/'.date("Y");
            if($request->nama_kegiatan == 'penelitian'){
                $kegiatan = 'Penelitian';
            }elseif($request->nama_kegiatan == 'pkm'){
                $kegiatan = 'Pengabdian Kepada Masyarakat';
            }elseif($request->nama_kegiatan == 'hki'){
                $kegiatan = 'Hak Kekayaan Intelektual';
            }
            $dasur = Surat::create([
                'pembuat_id' => (int)$request->pembuat_id,
                'jenis_surat' => $request->jenis_surat,
                'no_surat' => $nosurat,
                'nama_kegiatan' => $kegiatan,
                'kegiatan_id' => (int)$request->kegiatan_id,
                'qr' => $key,
                
            ]);

            Session::flash('redirect', route('surat.tampil',  $key));
            $msg = 'Surat Berhasil sibuat.';
            return redirect()->route('surat.index')->with('success',$msg);
        }
        
    }

    public function tampil_surat($id)
    {
        $dasur = Surat::where('qr',$id)->first();

        // dd($dasur);

        $qrl = route('surat.cek',  $dasur->qr);
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($qrl));

        $pdf = PDF::loadview('surat-keterangan2', compact('dasur','qrcode'))->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function input_surat_masuk()
    {
        $title = 'Create Surat Masuk';

        return view('input-surat-masuk', compact('title'));
    }

    public function store_surat_masuk(Request $request)
    {
        // dd($request->all());
        $rules = array(
            'perihal_surat' => 'required',
            'dari_surat' => 'required',
            'tanggal_masuk' => 'required',
            'file_surat' => 'required|mimes:pdf',
        );
        $messages = array(
            'perihal_surat.required' => 'Perihal surat tidak boleh kosong!',
            'dari_surat.required' => 'Asal surat tidak boleh kosong!',
            'tanggal_masuk.required' => 'Tanggal masuk surat tidak boleh kosong!',
            'file_surat.required' => 'File tidak boleh kosong!',
            'file_surat.mimes' => 'Format file tidak didukung!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {

            SuratMasuk::create([
                'perihal' => $request->perihal_surat,
                'dari' => $request->dari_surat,
                'lampiran' => $request->lampiran,
                'tanggal_masuk' => Carbon::createFromFormat('d/m/Y', $request->tanggal_masuk)->format('Y-m-d'),
                'file' =>  date("YmdHis").'-'.$request->file_surat->getClientOriginalName()
            ]);

            $request->file_surat->move('files/surat/', date("YmdHis").'-'.$request->file_surat->getClientOriginalName());

            $msg = 'Surat Masuk Berhasil dibuat.';
            return redirect()->route('surat.index')->with('success',$msg);
        }
        
    }

    public function cek_surat($id)
    {
        $title = 'LPPM Digital Signature';

        $dasur = Surat::where('qr',$id)->first();

        return view('cek-surat',compact('title','dasur'));
    }

    function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
}




}

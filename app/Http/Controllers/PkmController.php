<?php

namespace App\Http\Controllers;

use App\Models\Pkm;
use Illuminate\Http\Request;
use App\Http\Requests\StorePkmRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Ref_jenishibah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class PkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data PKM';
        $data = Pkm::where('status', 1)->get();

        return view('template.table-pkm', compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePkmRequest $request)
    {
        $rules = array(
            'pkm_dosen_ketua' => 'required',
            'pkm_judul_pkm' => 'required',
            'pkm_jenis_hibah' => 'required',
            'pkm_mulai' => 'required',
            'pkm_selesai' => 'required|after:mulai',
            'pkm_tahun' => 'required',
            'pkm_jumlah' => 'required|integer',
            'pkm_status' => 'required|boolean',
        );    
        $messages = array(
            'pkm_dosen_ketua' => 'required',
            'pkm_judul_pkm.required' => 'Judul PKM tidak boleh kosong!',
            'pkm_jenis_hibah.required' => 'Jenis Hibah tidak boleh kosong!',
            'pkm_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'pkm_selesai.required' => 'Tanggal selesai tidak boleh kosong!',
            'pkm_selesai.after' => 'Tanggal Mulai-Selesai tidak valid!',
            'pkm_tahun.required' => 'Tahun tidak boleh kosong!!',
            'pkm_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'pkm_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'pkm_status.required' => 'Status tidak valid!',
            'pkm_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            if($request->has('pkm_dosen_ketua')){
                $dk = Dosen::find($request->pkm_dosen_ketua);
                Session::flash('pkm_dosen_ketua', array($dk->id, $dk->nama));
            }   
            if($request->has('pkm_dosen_anggota')){
                $da = Dosen::findMany(explode(',', $request->pkm_dosen_anggota));
                $j =[];
                foreach ($da as $a){
                    array_push($j, [ $a->id,$a->nama]);
                }
                Session::flash('pkm_dosen_anggota', $j);
            }
            if($request->has('pkm_anggota_mhs')){
                $ma = Mahasiswa::findMany(explode(',', $request->pkm_anggota_mhs));
                $k =[];
                foreach ($ma as $a){
                    array_push($k, [ $a->id,$a->nama]);
                }
                Session::flash('pkm_anggota_mhs', $k);
            }
            if($request->has('pkm_jenis_hibah')){
                $jh = Ref_jenishibah::find($request->pkm_jenis_hibah);
                Session::flash('pkm_jenis_hibah', array($jh->id, $jh->nama));
            }
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->pkm_dosen_ketua);
                $stat = $request->pkm_status;
            }
            Pkm::create([
                'judul' => $request->pkm_judul_pkm,
                'dosen_ketua_id' => $ketua->id,
                'dosen_anggota' => $request->pkm_dosen_anggota,
                'anggota_mhs' => $request->pkm_anggota_mhs,
                'jenis_hibah_id' => $request->pkm_jenis_hibah,
                'nama_mitra' => $request->pkm_nama_mitra,
                'mulai' => $request->pkm_mulai,
                'selesai' => $request->pkm_selesai,
                'tahun' => $request->pkm_tahun,
                'jumlah' => $request->pkm_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data PKM berhasil ditambahkan.';
   
            return redirect()->route('input')->with('success',$msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pkm  $pkm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, pkm $pkm)
    {
        if ($request->ajax()) {

            $modal = view('template.modal-pkm',compact('pkm'))->render();
    
            return response()->json([
                'modal' =>  $modal
            ]);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pkm  $pkm
     * @return \Illuminate\Http\Response
     */
    public function edit(pkm $pkm)
    {
        return view('template.edit-pkm', compact('pkm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pkm  $pkm
     * @return \Illuminate\Http\Response
     */
    public function update(StorePkmRequest $request, pkm $pkm)
    {
        $rules = array(
            'pkm_judul_pkm' => 'required',
            'pkm_jenis_hibah' => 'required',
            'pkm_mulai' => 'required',
            'pkm_selesai' => 'required|after:mulai',
            'pkm_tahun' => 'required',
            'pkm_jumlah' => 'required|integer',
            'pkm_status' => 'required|boolean',
        );    
        $messages = array(
            'pkm_judul_pkm.required' => 'Judul PKM tidak boleh kosong!',
            'pkm_jenis_hibah.required' => 'Jenis Hibah tidak boleh kosong!',
            'pkm_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'pkm_selesai.required' => 'Tanggal selesai tidak boleh kosong!',
            'pkm_selesai.after' => 'Tanggal Mulai-Selesai tidak valid!',
            'pkm_tahun.required' => 'Tahun tidak boleh kosong!!',
            'pkm_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'pkm_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'pkm_status.required' => 'Status tidak valid!',
            'pkm_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->pkm_dosen_ketua);
                $stat = $request->pkm_status;
            }
            $pkm->update([
                'judul' => $request->pkm_judul_pkm,
                'dosen_ketua_id' => $ketua->id,
                'dosen_anggota' => $request->pkm_dosen_anggota,
                'anggota_mhs' => $request->pkm_anggota_mhs,
                'jenis_hibah_id' => $request->pkm_jenis_hibah,
                'nama_mitra' => $request->pkm_nama_mitra,
                'mulai' => $request->pkm_mulai,
                'selesai' => $request->pkm_selesai,
                'tahun' => $request->pkm_tahun,
                'jumlah' => $request->pkm_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data Hibah PKM berhasil diupdate.';
   
            return redirect()->route('pkm.index')->with('success',$msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pkm  $pkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(pkm $pkm)
    {
        //
    }

    public function accept($id)
    {
        $data = Pkm::find($id);
        // dd($data);
        $data->update([
            'status' => 1
        ]);

        $msg = 'Data berhasil dikonfirmasi!';

        return redirect()->route('inbox')->with('success',$msg);
    }

    public function delete($id)
    {
        $data = Pkm::find($id);
        $data->delete();

        $msg = 'Data berhasil dihapus!';

        return redirect()->route('pkm.index')->with('success',$msg);
    }
}

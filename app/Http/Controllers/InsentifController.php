<?php

namespace App\Http\Controllers;

use App\Models\Insentif;
use App\Http\Requests\StoreInsentifRequest;
use App\Http\Requests\UpdateInsentifRequest;
use App\Models\Dosen;
use App\Models\Ref_jenisinsentif;
use App\Models\Ref_jenispublikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class InsentifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Insentif';
        $data = Insentif::where('status', 1)->get();

        return view('template.table-insentif', compact('title','data'));
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
     * @param  \App\Http\Requests\StoreInsentifRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsentifRequest $request)
    {
        $rules = array(
            'ins_dosen_ketua' => 'required',
            'ins_judul_publikasi' => 'required',
            'ins_jenis_insentif' => 'required',
            'ins_jenis_publikasi' => 'required',
            'ins_tahun' => 'required',
            'ins_jumlah' => 'required|integer',
            'ins_status' => 'required|boolean',
        );    
        $messages = array(
            'ins_dosen_ketua.required' => 'Dosen Ketua tidak boleh kosong!',
            'ins_judul_publikasi.required' => 'Judul publikasi tidak boleh kosong!',
            'ins_jenis_insentif.required' => 'Jenis Insentif tidak boleh kosong!',
            'ins_jenis_publikasi.required' => 'Jenis Publikasi tidak boleh kosong!',
            'ins_tahun.required' => 'Tahun tidak boleh kosong!!',
            'ins_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'ins_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'ins_status.required' => 'Status tidak valid!',
            'ins_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            if($request->has('ins_dosen_ketua')){
                $dk = Dosen::find($request->ins_dosen_ketua);
                Session::flash('ins_dosen_ketua', array($dk->id, $dk->nama));
            }   
            if($request->has('ins_dosen_anggota')){
                $da = Dosen::findMany(explode(',', $request->ins_dosen_anggota));
                $j =[];
                foreach ($da as $a){
                    array_push($j, [ $a->id,$a->nama]);
                }
                Session::flash('ins_dosen_anggota', $j);
            }
            if($request->has('ins_jenis_insentif')){
                $jh = Ref_jenisinsentif::find($request->ins_jenis_insentif);
                Session::flash('ins_jenis_insentif', array($jh->id, $jh->nama));
            }
            if($request->has('ins_jenis_publikasi')){
                $jh = Ref_jenispublikasi::find($request->ins_jenis_publikasi);
                Session::flash('ins_jenis_publikasi', array($jh->id, $jh->nama));
            }
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->ins_dosen_ketua);
                $stat = $request->ins_status;
            }
            Insentif::create([
                'judul' => $request->ins_judul_publikasi,
                'dosen_ketua_id' => $ketua->id,
                'penulis_anggota' => $request->ins_dosen_anggota,
                'jenis_insentif_id' => $request->ins_jenis_insentif,
                'jenis_publikasi_id' => $request->ins_jenis_publikasi,
                'jurnal' => $request->ins_jurnal,
                'tahun' => $request->ins_tahun,
                'jumlah' => $request->ins_jumlah,
                'status' => $stat,
                
            ]);

            $msg = 'Data Insentif berhasil ditambahkan.';
   
            return redirect()->route('input')->with('success',$msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Insentif $insentif)
    {
        if ($request->ajax()) {

            $modal = view('template.modal-insentif',compact('insentif'))->render();
    
            return response()->json([
                'modal' =>  $modal
            ]);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function edit(Insentif $insentif)
    {
        return view('template.edit-insentif', compact('insentif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInsentifRequest  $request
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInsentifRequest $request, Insentif $insentif)
    {
        $rules = array(
            'ins_judul_publikasi' => 'required',
            'ins_jenis_insentif' => 'required',
            'ins_jenis_publikasi' => 'required',
            'ins_tahun' => 'required',
            'ins_jumlah' => 'required|integer',
            'ins_status' => 'required|boolean',
        );    
        $messages = array(
            'ins_judul_publikasi.required' => 'Judul penelitian tidak boleh kosong!',
            'ins_jenis_insentif.required' => 'Jenis Insentif tidak boleh kosong!',
            'ins_jenis_publikasi.required' => 'Jenis Publikasi tidak boleh kosong!',
            'ins_tahun.required' => 'Tahun tidak boleh kosong!!',
            'ins_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'ins_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'ins_status.required' => 'Status tidak valid!',
            'ins_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->ins_dosen_ketua);
                $stat = $request->ins_status;
            }
            $insentif->update([
                'judul' => $request->ins_judul_publikasi,
                'dosen_ketua_id' => $ketua->id,
                'penulis_anggota' => $request->ins_dosen_anggota,
                'jenis_insentif_id' => $request->ins_jenis_insentif,
                'jenis_publikasi_id' => $request->ins_jenis_publikasi,
                'jurnal' => $request->ins_jurnal,
                'tahun' => $request->ins_tahun,
                'jumlah' => $request->ins_jumlah,
                'status' => $stat,
                
            ]);

            $msg = 'Data Hibah Insentif berhasil diupdate.';
   
            return redirect()->route('insentif.index')->with('success',$msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insentif $insentif)
    {
        //
    }

    public function accept($id)
    {
        $data = Insentif::find($id);
        // dd($data);
        $data->update([
            'status' => 1
        ]);

        $msg = 'Data berhasil dikonfirmasi!';

        return redirect()->route('inbox')->with('success',$msg);
    }

    public function delete($id)
    {
        $data = Insentif::find($id);
        $data->delete();

        $msg = 'Data berhasil dihapus!';

        return redirect()->route('insentif.index')->with('success',$msg);
    }
}

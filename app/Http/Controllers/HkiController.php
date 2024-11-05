<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHkiRequest;
use App\Models\Dosen;
use App\Models\Hki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class HkiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data HKI';
        $data = Hki::where('status', 1)->get();

        return view('template.table-hki', compact('title','data'));
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
    public function store(StoreHkiRequest $request)
    {
        $rules = array(
            'hki_nama_hki' => 'required',
            'hki_jenis_hki' => 'required',
            'hki_tahun' => 'required',
            'hki_jumlah' => 'required|integer',
            'hki_status' => 'required|boolean',
        );    
        $messages = array(
            'hki_nama_hki.required' => 'Nama HKI tidak boleh kosong!',
            'hki_jenis_hki.required' => 'Jenis HKI tidak boleh kosong!',
            'hki_tahun.required' => 'Tahun tidak boleh kosong!!',
            'hki_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'hki_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'hki_status.required' => 'Status tidak valid!',
            'hki_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            if($request->has('hki_dosen_ketua')){
                $dk = Dosen::find($request->hki_dosen_ketua);
                Session::flash('hki_dosen_ketua', array($dk->id, $dk->nama));
            }   
            if($request->has('hki_dosen_anggota')){
                $da = Dosen::findMany(explode(',', $request->hki_dosen_anggota));
                $j =[];
                foreach ($da as $a){
                    array_push($j, [ $a->id,$a->nama]);
                }
                Session::flash('hki_dosen_anggota', $j);
            }
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->hki_dosen_ketua);
                $stat = $request->hki_status;
            }
            Hki::create([
                'judul' => $request->hki_nama_hki,
                'dosen_ketua_id' => $ketua->id,
                'penulis_anggota' => $request->hki_dosen_anggota,
                'jenis_hki' => $request->hki_jenis_hki,
                'tahun' => $request->hki_tahun,
                'jumlah' => $request->hki_jumlah,
                'status' => $stat,
                
            ]);

            $msg = 'Data HKI berhasil ditambahkan.';
   
            return redirect()->route('input')->with('success',$msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hki  $hki
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Hki $hki)
    {
        if ($request->ajax()) {

            // $modal = $hki;
            $modal = view('template.modal-hki',compact('hki'))->render();
    
            return response()->json([
                'modal' =>  $modal
            ]);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hki  $hki
     * @return \Illuminate\Http\Response
     */
    public function edit(Hki $hki)
    {
        return view('template.edit-hki', compact('hki'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hki  $hki
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHkiRequest $request, Hki $hki)
    {
        $rules = array(
            'hki_nama_hki' => 'required',
            'hki_jenis_hki' => 'required',
            'hki_tahun' => 'required',
            'hki_jumlah' => 'required|integer',
            'hki_status' => 'required|boolean',
        );    
        $messages = array(
            'hki_nama_hki.required' => 'Judul HKI tidak boleh kosong!',
            'hki_jenis_hki.required' => 'Jenis Insentif tidak boleh kosong!',
            'hki_tahun.required' => 'Tahun tidak boleh kosong!!',
            'hki_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'hki_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'hki_status.required' => 'Status tidak valid!',
            'hki_status.boolean' => 'Status tidak valid!',
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
                $ketua = Dosen::find($request->hki_dosen_ketua);
                $stat = $request->hki_status;
            }
            $hki->update([
                'judul' => $request->hki_nama_hki,
                'dosen_ketua_id' => $ketua->id,
                'penulis_anggota' => $request->hki_dosen_anggota,
                'jenis_hki' => $request->hki_jenis_hki,
                'tahun' => $request->hki_tahun,
                'jumlah' => $request->hki_jumlah,
                'status' => $stat,
                
            ]);

            $msg = 'Data Hibah HKI berhasil diupdate.';
   
            return redirect()->route('hki.index')->with('success',$msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hki  $hki
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hki $hki)
    {
        //
    }

    public function accept($id)
    {
        $data = Hki::find($id);
        // dd($data);
        $data->update([
            'status' => 1
        ]);

        $msg = 'Data berhasil dikonfirmasi!';

        return redirect()->route('inbox')->with('success',$msg);
    }

    public function delete($id)
    {
        $data = Hki::find($id);
        $data->delete();

        $msg = 'Data berhasil dihapus!';

        return redirect()->route('hki.index')->with('success',$msg);
    }
}

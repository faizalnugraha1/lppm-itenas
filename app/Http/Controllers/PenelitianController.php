<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Http\Requests\StorePenelitianRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Ref_jenishibah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Penelitian';
        $data = Penelitian::where('status', 1)->get();

        return view('template.table-peneltian', compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenelitianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenelitianRequest $request)
    {
        // dd($request->all());
        $rules = array(
            'plt_dosen_ketua' => 'required',
            'plt_judul_penelitian' => 'required',
            'plt_jenis_hibah' => 'required',
            'plt_mulai' => 'required',
            'plt_selesai' => 'required|after:mulai',
            'plt_tahun' => 'required',
            'plt_jumlah' => 'required|integer',
            'plt_status' => 'required|boolean',
        );    
        $messages = array(
            'plt_dosen_ketua.required' => 'Dosen Ketua tidak boleh kosong!',
            'plt_judul_penelitian.required' => 'Judul penelitian tidak boleh kosong!',
            'plt_jenis_hibah.required' => 'Jenis Hibah tidak boleh kosong!',
            'plt_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'plt_selesai.required' => 'Tanggal selesai tidak boleh kosong!',
            'plt_selesai.after' => 'Tanggal Mulai-Selesai tidak valid!',
            'plt_tahun.required' => 'Tahun tidak boleh kosong!!',
            'plt_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'plt_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'plt_status.required' => 'Status tidak valid!',
            'plt_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            if($request->has('plt_dosen_ketua')){
                $dk = Dosen::find($request->plt_dosen_ketua);
                Session::flash('plt_dosen_ketua', array($dk->id, $dk->nama));
            }   
            if($request->has('plt_dosen_anggota')){
                $da = Dosen::findMany(explode(',', $request->plt_dosen_anggota));
                $j =[];
                foreach ($da as $a){
                    array_push($j, [ $a->id,$a->nama]);
                }
                Session::flash('plt_dosen_anggota', $j);
            }
            if($request->has('plt_anggota_mhs')){
                $ma = Mahasiswa::findMany(explode(',', $request->plt_anggota_mhs));
                $k =[];
                foreach ($ma as $a){
                    array_push($k, [ $a->id,$a->nama]);
                }
                Session::flash('plt_anggota_mhs', $k);
            }
            if($request->has('plt_jenis_hibah')){
                $jh = Ref_jenishibah::find($request->plt_jenis_hibah);
                Session::flash('plt_jenis_hibah', array($jh->id, $jh->nama));
            }
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $ketua = Auth::user();
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $ketua = Dosen::find($request->plt_dosen_ketua);
                $stat = $request->plt_status;
            }
            Penelitian::create([
                'judul' => $request->plt_judul_penelitian,
                'dosen_ketua_id' => $ketua->id,
                'dosen_anggota' => $request->plt_dosen_anggota,
                'anggota_mhs' => $request->plt_anggota_mhs,
                'jenis_hibah_id' => $request->plt_jenis_hibah,
                'nama_mitra' => $request->plt_nama_mitra,
                'mulai' => $request->plt_mulai,
                'selesai' => $request->plt_selesai,
                'tahun' => $request->plt_tahun,
                'jumlah' => $request->plt_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data Penelitian berhasil ditambahkan.';
   
            return redirect()->route('input')->with('success',$msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Penelitian $penelitian)
    {
        if ($request->ajax()) {

            $modal = view('template.modal-penelitian',compact('penelitian'))->render();
    
            return response()->json([
                'modal' =>  $modal
            ]);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penelitian $penelitian)
    {
        return view('template.edit-penelitian', compact('penelitian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenelitianRequest  $request
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function update(StorePenelitianRequest $request, Penelitian $penelitian)
    {
        // dd($penelitian);
        $rules = array(
            'plt_judul_penelitian' => 'required',
            'plt_jenis_hibah' => 'required',
            'plt_mulai' => 'required',
            'plt_selesai' => 'required|after:mulai',
            'plt_tahun' => 'required',
            'plt_jumlah' => 'required|integer',
            'plt_status' => 'required|boolean',
        );    
        $messages = array(
            'plt_judul_penelitian.required' => 'Judul penelitian tidak boleh kosong!',
            'plt_jenis_hibah.required' => 'Jenis Hibah tidak boleh kosong!',
            'plt_mulai.required' => 'Tanggal mulai tidak boleh kosong!',
            'plt_selesai.required' => 'Tanggal selesai tidak boleh kosong!',
            'plt_selesai.after' => 'Tanggal Mulai-Selesai tidak valid!',
            'plt_tahun.required' => 'Tahun tidak boleh kosong!!',
            'plt_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'plt_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'plt_status.required' => 'Status tidak valid!',
            'plt_status.boolean' => 'Status tidak valid!',
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
                $ketua = Dosen::find($request->plt_dosen_ketua);
                $stat = $request->plt_status;
            }
            $penelitian->update([
                'judul' => $request->plt_judul_penelitian,
                'dosen_ketua_id' => $ketua->id,
                'dosen_anggota' => $request->plt_dosen_anggota,
                'anggota_mhs' => $request->plt_anggota_mhs,
                'jenis_hibah_id' => $request->plt_jenis_hibah,
                'nama_mitra' => $request->plt_nama_mitra,
                'mulai' => $request->plt_mulai,
                'selesai' => $request->plt_selesai,
                'tahun' => $request->plt_tahun,
                'jumlah' => $request->plt_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data Hibah Penelitian berhasil diupdate.';
   
            return redirect()->route('penelitian.index')->with('success',$msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function accept($id)
    {
        $data = Penelitian::find($id);
        // dd($data);
        $data->update([
            'status' => 1
        ]);

        $msg = 'Data berhasil dikonfirmasi!';

        return redirect()->route('inbox')->with('success',$msg);
    }

    public function delete($id)
    {
        $data = Penelitian::find($id);
        $data->delete();

        $msg = 'Data berhasil dihapus!';

        return redirect()->route('penelitian.index')->with('success',$msg);
    }
}

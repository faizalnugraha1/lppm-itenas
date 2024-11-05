<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use App\Http\Requests\StorePublikasiRequest;
use App\Http\Requests\UpdatePublikasiRequest;
use App\Models\Dosen;
use App\Models\Ref_publikasijenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Publikasi';
        $data = Publikasi::where('status', 1)->get();

        return view('template.table-publikasi', compact('title','data'));
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
     * @param  \App\Http\Requests\StorePublikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublikasiRequest $request)
    {
        // dd($request->all());
        $rules = array(
            'pub_judul_publikasi' => 'required',
            'pub_jurnal' => 'required',
            'pub_url' => 'required',
            'pub_jenis_publikasi' => 'required',
            'pub_sumber_dana' => 'required',
            'pub_tanggal_publish' => 'required',
            'pub_jumlah' => 'required|integer',
            'pub_status' => 'required|boolean',
        );    
        $messages = array(
            'pub_judul_publikasi.required' => 'Judul publikasi tidak boleh kosong!',
            'pub_jurnal.required' => 'Nama jurnal/proceeding/penerbit tidak boleh kosong!',
            'pub_url.required' => 'URL publikasi tidak boleh kosong!',
            'pub_jenis_publikasi.required' => 'Jenis Publikasi tidak boleh kosong!',
            'pub_sumber_dana.required' => 'Tahun tidak boleh kosong!!',
            'pub_tanggal_publish.required' => 'Tahun tidak boleh kosong!!',
            'pub_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'pub_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'pub_status.required' => 'Status tidak valid!',
            'pub_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            if($request->has('pub_dosen_ketua')){
                $dk = Dosen::find($request->pub_dosen_ketua);
                Session::flash('pub_dosen_ketua', array($dk->id, $dk->nama));
            }   
            if($request->has('pub_penulis_anggota')){
                $da = Dosen::findMany(explode(',', $request->pub_penulis_anggota));
                $j =[];
                foreach ($da as $a){
                    array_push($j, [ $a->id,$a->nama]);
                }
                Session::flash('pub_penulis_anggota', $j);
            }
            if($request->has('pub_jenis_publikasi')){
                $jh = Ref_publikasijenis::find($request->pub_jenis_publikasi);
                Session::flash('pub_jenis_publikasi', array($jh->id, $jh->nama));
            }
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $stat = $request->pub_status;
            }

            Publikasi::create([
                'judul' => $request->pub_judul_publikasi,
                'dosen_ketua_id' => $request->pub_dosen_ketua,
                'ketua_external' => $request->pub_penulis_external,
                'penulis_anggota' => $request->pub_penulis_anggota,
                'penulis_external' => isset($request->pub_anggota_external) ? implode(';', $request->pub_anggota_external) : $request->pub_anggota_external,
                'jurnal' => $request->pub_jurnal,
                'url' => $request->pub_url,
                'jenis_publikasi_id' => $request->pub_jenis_publikasi,
                'sumber_dana' => $request->pub_sumber_dana,
                'lingkup' => $request->pub_lingkup,
                'tanggal_publish' => $request->pub_tanggal_publish,
                'tahun' => $request->pub_tahun,
                'jumlah' => $request->pub_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data Publikasi berhasil ditambahkan.';
   
            return redirect()->route('input')->with('success',$msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publikasi  $publikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Publikasi $publikasi)
    {
        // dd($publikasi);
        if ($request->ajax()) {

            $modal = view('template.modal-publikasi',compact('publikasi'))->render();
            // dd($modal);
            return response()->json([
                'modal' =>  $modal
            ]);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publikasi  $publikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Publikasi $publikasi)
    {
        return view('template.edit-publikasi', compact('publikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublikasiRequest  $request
     * @param  \App\Models\Publikasi  $publikasi
     * @return \Illuminate\Http\Response
     */
    public function update(StorePublikasiRequest $request, Publikasi $publikasi)
    {
        $rules = array(
            'pub_judul_publikasi' => 'required',
            'pub_jurnal' => 'required',
            'pub_url' => 'required',
            'pub_jenis_publikasi' => 'required',
            'pub_sumber_dana' => 'required',
            'pub_tanggal_publish' => 'required',
            'pub_jumlah' => 'required|integer',
            'pub_status' => 'required|boolean',
        );    
        $messages = array(
            'pub_judul_publikasi.required' => 'Judul publikasi tidak boleh kosong!',
            'pub_jurnal.required' => 'Nama jurnal/proceeding/penerbit tidak boleh kosong!',
            'pub_url.required' => 'URL publikasi tidak boleh kosong!',
            'pub_jenis_publikasi.required' => 'Jenis Publikasi tidak boleh kosong!',
            'pub_sumber_dana.required' => 'Tahun tidak boleh kosong!!',
            'pub_tanggal_publish.required' => 'Tahun tidak boleh kosong!!',
            'pub_jumlah.required' => 'Jumlah tidak boleh kosong!!',
            'pub_jumlah.integer' => 'Jumlah tidak valid, masukan nominal angka!!',
            'pub_status.required' => 'Status tidak valid!',
            'pub_status.boolean' => 'Status tidak valid!',
        );

        $request->all();
        $validator = Validator::make($request->all(), $rules, $messages);        

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // dd($request->all());
            if (Auth::guard('dosen')->check()){
                $stat = 0;
            }elseif(Auth::guard('pegawai')->check()){
                $stat = $request->pub_status;
            }

            $publikasi->update([
                'judul' => $request->pub_judul_publikasi,
                'dosen_ketua_id' => $request->pub_dosen_ketua,
                'ketua_external' => $request->pub_penulis_external,
                'penulis_anggota' => $request->pub_penulis_anggota,
                'penulis_external' => isset($request->pub_anggota_external) ? implode(';', $request->pub_anggota_external) : $request->pub_anggota_external,
                'jurnal' => $request->pub_jurnal,
                'url' => $request->pub_url,
                'jenis_publikasi_id' => $request->pub_jenis_publikasi,
                'sumber_dana' => $request->pub_sumber_dana,
                'lingkup' => $request->pub_lingkup,
                'tanggal_publish' => $request->pub_tanggal_publish,
                'tahun' => $request->pub_tahun,
                'jumlah' => $request->pub_jumlah,
                'status' => $stat,
                
            ]);


            $msg = 'Data Publikasi berhasil diupdate.';
   
            return redirect()->route('publikasi.index')->with('success',$msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publikasi  $publikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publikasi $publikasi)
    {
        //
    }
    public function accept($id)
    {
        $data = Publikasi::find($id);
        // dd($data);
        $data->update([
            'status' => 1
        ]);

        $msg = 'Data berhasil dikonfirmasi!';

        return redirect()->route('inbox')->with('success',$msg);
    }

    public function delete($id)
    {
        $data = Publikasi::find($id);
        $data->delete();

        $msg = 'Data berhasil dihapus!';

        return redirect()->route('publikasi.index')->with('success',$msg);
    }
}

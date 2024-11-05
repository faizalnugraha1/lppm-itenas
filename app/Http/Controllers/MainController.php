<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hki;
use App\Models\Insentif;
use App\Models\Mahasiswa;
use App\Models\Penelitian;
use App\Models\Pkm;
use App\Models\Publikasi;
use App\Models\RawQue;
use App\Models\Ref_jenishibah;
use App\Models\Ref_jenisinsentif;
use App\Models\Ref_jenispublikasi;
use App\Models\Ref_publikasijenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;


class MainController extends Controller
{
    public function index() {
        $title = 'Dashboard';
    
        $r = DB::select(DB::raw("
        select tahun from penelitians WHERE  STATUS = 1 AND deleted_at IS NULL UNION ALL
        select tahun from pkms WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
        select tahun from insentifs WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
        select tahun from hkis WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
        SELECT tahun from publikasis WHERE STATUS = 1 AND deleted_at IS NULL
        ORDER BY tahun ASC"));

        
        $tahun = range($r[0]->tahun,end($r)->tahun);
        // dd($tahun);

        $penelitians = Penelitian::where('status', 1)->get();
        $pkms = Pkm::where('status', 1)->get();
        $insentifs = Insentif::where('status', 1)->get();
        $hkis = Hki::where('status', 1)->get();
        $publikasis = Publikasi::where('status', 1)->get();

        $latest = DB::select(DB::raw("select 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE STATUS = 1 UNION ALL
        select 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE STATUS = 1 UNION all
        select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE STATUS = 1 UNION all
        select 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE STATUS = 1 UNION all
        select 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE STATUS = 1
        ORDER BY created_at DESC"));

        $panel= '';
        if(!empty($latest)){
            $latest = array_slice($latest, 0, 2);

            foreach($latest as $l){
                if ($l->table_name == 'pkm'){
                    $data = Pkm::find($l->id);
                    $panel = $panel.view('template.panel-post-pkm',compact('data'));
                }elseif ($l->table_name == 'penelitian'){
                    $data = Penelitian::find($l->id);
                    $panel = $panel.view('template.panel-post-penelitian',compact('data'));
                }elseif ($l->table_name == 'insentif'){
                    $data = Insentif::find($l->id);
                    $panel = $panel.view('template.panel-post-insentif',compact('data'));
                }elseif ($l->table_name == 'hki'){
                    $data = Hki::find($l->id);
                    $panel = $panel.view('template.panel-post-hki',compact('data'));
                }elseif ($l->table_name == 'publikasi'){
                    $data = Publikasi::find($l->id);
                    $panel = $panel.view('template.panel-post-publikasi',compact('data'));
                }
            }
        } 

        return view('index', compact('title','panel', 'penelitians', 'pkms','insentifs', 'hkis', 'publikasis','tahun'));
    }

    public function inbox() {
        $title = 'Kotak Masuk';

        $latest = DB::select(DB::raw("select 'Penelitian' as table_name, id, jumlah, status, updated_at from penelitians WHERE STATUS = 0  AND deleted_at IS NULL UNION ALL
        select 'Pkm' as table_name, id, jumlah, status, updated_at from pkms WHERE STATUS = 0  AND deleted_at IS NULL UNION all
        select 'Insentif' as table_name, id, jumlah, status, updated_at from insentifs WHERE STATUS = 0  AND deleted_at IS NULL UNION all
        select 'HKI' as table_name, id, jumlah, status, updated_at from hkis WHERE STATUS = 0  AND deleted_at IS NULL UNION all
        select 'Publikasi' as table_name, id, jumlah, status, updated_at from publikasis WHERE STATUS = 0  AND deleted_at IS NULL
        ORDER BY updated_at DESC"));

        $latest = array_map(function ($value) {
            return (array)$value;
        }, $latest);

        $data = collect(new RawQue());
        foreach ($latest as $l) {
            $r = new RawQue($l);
            $data->push($r);
        };

        return view('inbox', compact('title', 'data'));
    }

    public function history() {
        $title = 'Riwayat Data';

        $mydata = DB::select(DB::raw("select 'Penelitian' as table_name, id, dosen_ketua_id, jumlah, status, updated_at from penelitians WHERE dosen_ketua_id = ". Auth::user()->id ." AND deleted_at IS NULL
        UNION ALL
        select 'Pkm' as table_name, id,dosen_ketua_id, jumlah, status, updated_at from pkms WHERE dosen_ketua_id = ". Auth::user()->id ." AND deleted_at IS NULL
        UNION ALL
        select 'Insentif' as table_name, id,dosen_ketua_id, jumlah, status, updated_at from insentifs WHERE dosen_ketua_id = ". Auth::user()->id ." AND deleted_at IS NULL
        UNION ALL
        select 'HKI' as table_name, id, dosen_ketua_id, jumlah, status, updated_at from hkis WHERE dosen_ketua_id = ". Auth::user()->id ." AND deleted_at IS NULL
        UNION ALL
        select 'Publikasi' as table_name, id, dosen_ketua_id, jumlah, status, updated_at from publikasis WHERE dosen_ketua_id = ". Auth::user()->id ." AND deleted_at IS NULL
        ORDER BY updated_at ASC"));

        $mydata = array_map(function ($value) {
            return (array)$value;
        }, $mydata);

        $data = collect(new RawQue());
        foreach ($mydata as $l) {
            $r = new RawQue($l);
            $data->push($r);
        };

        // dd($data);
        return view('history', compact('title', 'data'));
    }

    public function test() {

        // jumlah
        $databiaya = DB::select(DB::raw("
        SELECT table_name, SUM(tabel_semua.jumlah) as total FROM 
        (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
        SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE STATUS = 1 AND deleted_at IS NULL) tabel_semua
        GROUP BY table_name"));

        $datajumlah = DB::select(DB::raw("
        SELECT table_name, count(tabel_semua.id) as jumlah FROM 
        (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
        SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE STATUS = 1 AND deleted_at IS NULL UNION all
        SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE STATUS = 1 AND deleted_at IS NULL) tabel_semua
        GROUP BY TABLE_NAME"));

        dd($databiaya, $datajumlah);
    }

    public function input() {
        $title = 'Input Data Baru';
        return view('input', compact('title'));
    }

    public function input2() {
        $title = 'Input Data Baru';
        return view('input2', compact('title'));
    }


    public function input_penelitian(Request $request) {
        if ($request->ajax()) {
            $form = view('template.user.form-penelitian')->render();

            return response([
                'form' =>  $form
            ]);  
        }
    }

    public function input_pkm(Request $request) {
        if ($request->ajax()) {

            $form = view('template.user.form-pkm')->render();
    
            return response()->json([
                'form' =>  $form
            ]);   
        }
    }

    public function input_insentif(Request $request) {
        if ($request->ajax()) {

            $form = view('template.user.form-insentif')->render();
    
            return response()->json([
                'form' =>  $form
            ]);  
        }
    }

    public function input_haki(Request $request) {
        if ($request->ajax()) {

            $form = view('template.user.form-haki')->render();
    
            return response()->json([
                'form' =>  $form
            ]);  
        }
    }

    public function get_dosen(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                if(Auth::guard('pegawai')->check()){
                    $data = Dosen::where('nama','LIKE', '%'.$search.'%')->get();
                }else{
                    $data = Dosen::where('id', '!=', Auth::user()->id)
                    ->where('nama','LIKE', '%'.$search.'%')->get();
                }
                
            }else {
                if(Auth::guard('pegawai')->check()){
                    $data = Dosen::all();
                }else{
                    $data = Dosen::where('id', '!=', Auth::user()->id)->get();
                }
                
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_mhs(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                $data = Mahasiswa::where('nama','LIKE', '%'.$search.'%')->get();
            }else {
                $data = Mahasiswa::all();
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nrp.'-'.$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_hibah(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                $data = Ref_jenishibah::where('nama','LIKE', '%'.$search.'%')->get();
            }else {
                $data = Ref_jenishibah::all();
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_insentif(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                $data = Ref_jenisinsentif::where('nama','LIKE', '%'.$search.'%')->get();
            }else {
                $data = Ref_jenisinsentif::all();
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_pub(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                $data = Ref_jenispublikasi::where('nama','LIKE', '%'.$search.'%')->get();
            }else {
                $data = Ref_jenispublikasi::all();
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_pub2(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                $data = Ref_publikasijenis::where('nama','LIKE', '%'.$search.'%')->get();
            }else {
                $data = Ref_publikasijenis::all();
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->nama
                );
            }
    
            return response()->json($response);  
        }
    }

    public function get_keg(Request $request) {
        if ($request->ajax()) {
            
            if($request->has('q')){
                $search = $request->q;
                if($request->k == 'penelitian'){
                    $data = Penelitian::where('judul','LIKE', '%'.$search.'%')->where('status', 1)->get();
                }elseif($request->k == 'pkm'){
                    $data = Pkm::where('judul','LIKE', '%'.$search.'%')->where('status', 1)->get();
                }elseif($request->k == 'hki'){
                    $data = Hki::where('judul','LIKE', '%'.$search.'%')->where('status', 1)->get();
                }
            }elseif($request->has('k')){
                if($request->k == 'penelitian'){
                    $data = Penelitian::where('status', 1)->get();
                }elseif($request->k == 'pkm'){
                    $data = Pkm::where('status', 1)->get();
                }elseif($request->k == 'hki'){
                    $data = Hki::where('status', 1)->get();
                }
                
            }

            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id"=>$d->id,
                    "text"=>$d->judul
                );
            }

            return response()->json($response);  
        }
    }

    public function getTotalJumlah($tahun = null)
    {
        if($tahun != NULL || $tahun != ''){
            $databiaya = DB::select(DB::raw("
            SELECT table_name, count(tabel_semua.jumlah) as jumlah FROM 
            (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION ALL
            SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL) tabel_semua
            GROUP BY table_name"));
        }else{
            $databiaya = DB::select(DB::raw("
            SELECT table_name, count(tabel_semua.jumlah) as jumlah FROM 
            (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
            SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE STATUS = 1 AND deleted_at IS NULL) tabel_semua
            GROUP BY table_name"));
        }

        $databiaya = array_map(function ($value) {
            return (array)$value;
        }, $databiaya);

        $label=[];
        $data=[];

        foreach ($databiaya as $db){
            array_push($label, strtoupper($db['table_name']));
            array_push($data, $db['jumlah']);
        }

        return response()->json([
            'label' =>  $label,
            'data' =>  $data,
        ]); 
    }

    public function getTotalBiaya($tahun = null)
    {
        if($tahun != NULL || $tahun != ''){
            $databiaya = DB::select(DB::raw("
            SELECT table_name, SUM(tabel_semua.jumlah) as total FROM 
            (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION ALL
            SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE tahun = ".$tahun." AND STATUS = 1 AND deleted_at IS NULL) tabel_semua
            GROUP BY table_name"));
        }else{
            $databiaya = DB::select(DB::raw("
            SELECT table_name, SUM(tabel_semua.jumlah) as total FROM 
            (SELECT 'penelitian' as table_name, id, jumlah, status, created_at from penelitians WHERE STATUS = 1 AND deleted_at IS NULL UNION ALL
            SELECT 'pkm' as table_name, id, jumlah, status, created_at from pkms WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            select 'insentif' as table_name, id, jumlah, status, created_at from insentifs WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'hki' as table_name, id, jumlah, status, created_at from hkis WHERE STATUS = 1 AND deleted_at IS NULL UNION all
            SELECT 'publikasi' as table_name, id, jumlah, status, created_at from publikasis WHERE STATUS = 1 AND deleted_at IS NULL) tabel_semua
            GROUP BY table_name"));
        }

        $databiaya = array_map(function ($value) {
            return (array)$value;
        }, $databiaya);

        $label=[];
        $data=[];

        foreach ($databiaya as $db){
            array_push($label, strtoupper($db['table_name']));
            array_push($data, $db['total']);
        }

        return response()->json([
            'label' =>  $label,
            'data' =>  $data,
        ]); 
    }
}

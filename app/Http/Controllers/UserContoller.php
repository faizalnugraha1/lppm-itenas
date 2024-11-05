<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class UserContoller extends Controller
{
    public function profil() {
        $title = 'Profil';
        return view('profil', compact('title'));
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update_info(Request $request, Dosen $dosen)
    {
        // dd($dosen);
        $dosen->update([
            'gs_id' => $request->gs,
            'scopus_id' => $request->sc,
            'sinta_id' => $request->sinta,
        ]);

        return redirect()->route('profil')->with('success','Profile Berhasil diupdate.');
    }

    public function update_pict(Request $request, Dosen $dosen)
    {
        if($request->hasFile('pict')){ 
            $dosen->update([
                'pict' => $request->pict->getClientOriginalName()
            ]);

            $request->pict->move('dist/images/', $request->pict->getClientOriginalName());

            return redirect()->route('profil')->with('success','Profile Berhasil diupdate.');
        } else {
            return redirect()->route('profil')->with('error','Profile Picture gagal diupdate.');
        }
    }
}

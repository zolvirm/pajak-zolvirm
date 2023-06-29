<?php

namespace App\Http\Controllers;

use App\Exports\PemilikExport;
use App\Imports\PemilikImport;
use App\Models\Pajak;
use App\Models\Pemilik;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $pemiliks = Pemilik::where('nama', 'LIKE', '%' . request('search') . '%')
                ->paginate(10)->withQueryString();
        } else {
            // std
            $pemiliks = Pemilik::paginate(10)->withQueryString();
        }

        // return $pemiliks;
        return view('dashboard.pemilik.index', compact('pemiliks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.pemilik.create', [
            'pajaks' => Pajak::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->pajak);
        $validasi = $request->validate([
            'nama' => 'required|max:75|unique:pemiliks',
            'dusun' => 'required',
            'RT' => 'required|alpha-num',
            'RW' => 'required|alpha-num',
            'alamat' => 'required|max:255',
        ]);

        $validasi['nama'] = Str::upper($validasi['nama']);
        $validasi['dusun'] = Str::upper($validasi['dusun']);
        $validasi['alamat'] = Str::upper($validasi['alamat']);


        Pemilik::create($validasi);

        if (!empty($request->pajak)) {

            $kadal = preg_replace("/[^0-9]/", "", Pemilik::where('nama', Str::upper($request->nama))->pluck('id'));

            $pepe['pemilik_id'] = $kadal;
            Pajak::whereIn('id', $request->pajak)->update($pepe);
        }


        return Redirect('dash/pemiliks')->with('berhasil', 'data pemilik berhasil di buat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function show(Pemilik $pemilik)
    {
        // $pemiliks = Pemilik::where('id', '=', $pemilik->id)->first();
        // ddd($pemilik->pajak);
        return view('dashboard.pemilik.show', [
            'pemilik' => $pemilik,
            'pajaks' => $pemilik->pajak
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemilik $pemilik)
    {
        return view('dashboard.pemilik.edit', [
            'pemilik' => $pemilik,
            'pajaks' => Pajak::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemilik $pemilik)
    {

        $validasi = $request->validate([
            'dusun' => 'required',
            'RT' => 'required|alpha-num',
            'RW' => 'required|alpha-num',
            'alamat' => 'required|max:255',
        ]);

        if ($request->nama != $pemilik->nama) {
            $validasi['nama'] = $request->validate(['nama' => 'required|max:75|unique:pemiliks',]);
            $validasi['nama'] = Str::upper($validasi['nama']);
        }


        $validasi['dusun'] = Str::upper($validasi['dusun']);
        $validasi['alamat'] = Str::upper($validasi['alamat']);

        Pemilik::where('id', $pemilik->id)->update($validasi);
        if (!empty($request->pajak)) {
            $pem_id['pemilik_id'] = $pemilik->id;
            Pajak::whereIn('id', $request->pajak)->update($pem_id);
        } else {
            $pem['pemilik_id'] = null;
            Pajak::where('pemilik_id', $pemilik->id)->update($pem);
        }

        return redirect('dash/pemiliks')->with('berhasil', 'data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemilik $pemilik)
    {
        Pemilik::destroy(($pemilik->id));

        return redirect('dash/pemiliks')->with('berhasil', 'data berhasil di hapus');
    }

    // Eksport Excel
    public function exportPemilikExcel()
    {
        return Excel::download(new PemilikExport, 'PEMILIK.xlsx');
    }

    // Import Excel
    public function importPemilikExcel(Request $request)
    {
        $this->validate($request, ['excel' => 'required|mimes:csv,xlx,xlsx']);

        $file = $request->file('excel');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('data_excel/pemilik', $nama_file);

        $import = new PemilikImport;
        $import->import(public_path('/data_excel/pemilik/' . $nama_file));

        if ($import->failures()->isNotEmpty()) {
            return back()->with('failures', $import->failures());
        }

        return redirect('/dash/pemiliks')->with('berhasil', 'data berhasil di import');
    }
    //FOR DOWNLOAD FILE CONTOH EXCEL
    public function downloadCthPemilikExcel()
    {
        $filePath = public_path('data_sample-pemiliks.xlsx');
        $headers = ['Content-Type: application/xlsx'];
        $fileName = time() . '.xlsx';

        return response()->download($filePath, $fileName, $headers);
    }
}

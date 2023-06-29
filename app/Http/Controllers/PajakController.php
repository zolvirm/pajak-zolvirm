<?php

namespace App\Http\Controllers;

use App\Exports\PajakExport;
use App\Imports\PajakImport;
use App\Models\Pajak;
use App\Models\Pemilik;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PajakController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('search')) {
            $pajaks = Pajak::where('NOP', 'LIKE', '%' . request('search') . '%')
                ->orWhere('nama', 'LIKE', '%' . request('search') . '%')
                ->paginate(10)->withQueryString();
        } else {
            // std
            $pajaks = Pajak::paginate(10)->withQueryString();
        }
        // dd($pajaks);
        return view('dashboard.pajak.index', compact('pajaks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pajak.create', [
            'pemiliks' => Pemilik::all()
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
        // dd($request);
        $kadal = preg_replace("/[^0-9]/", "", $request['yang_harus_dibayar']);

        $validasi = $request->validate([
            'NOP' => 'required|unique:pajaks|alpha-num|digits:18',
            'nama' => 'required|max:255',
            'tahun' => 'required|digits:4|alpha-num',
            'yang_harus_dibayar' => 'required',
            'pemilik_id' => 'required',
        ]);
        // dd($validasi);

        $validasi['status'] = '0';
        $validasi['yang_harus_dibayar'] = $kadal;
        $validasi['nama'] = Str::upper($validasi['nama']);


        Pajak::create($validasi);

        return redirect('dash/pajaks')->with('berhasil', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function show(Pajak $pajak)
    {
        // $pajak['NOP'] = str_replace("'", "", $pajak->NOP);
        // dd($pajak);
        return view('dashboard.pajak.show', [
            'pajak' => $pajak,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function edit(Pajak $pajak)
    {
        // $pajak['NOP'] = str_replace("'", "", $pajak->NOP);
        $pajak['yang_harus_dibayar'] = "Rp." . number_format($pajak->yang_harus_dibayar, 0, '.', '.');
        return view('dashboard.pajak.edit', [
            'pajak' => $pajak,
            'pemiliks' => Pemilik::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pajak $pajak)
    {
        $kadal = preg_replace("/[^0-9]/", "", $request['yang_harus_dibayar']);

        $aturan = [
            'nama' => 'required|max:255',
            'tahun' => 'required|digits:4|alpha-num',
            'yang_harus_dibayar' => 'required',
            // 'status' => 'required'
        ];
        // $aturan['status'] = '0';

        // dd($aturan);

        if ($request->NOP != $pajak->NOP) {
            $aturan['NOP'] = 'required|unique:pajaks|numeric|digits:18';
        }

        $datas = $request->validate($aturan);
        $datas['pemilik_id'] = $request->pemilik_id;
        $datas['yang_harus_dibayar'] = $kadal;
        $datas['nama'] = Str::upper($datas['nama']);


        Pajak::where('id', $pajak->id)->update($datas);
        return redirect('dash/pajaks')->with('berhasil', 'data telah berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pajak $pajak)
    {
        //
        Pajak::destroy($pajak->id);
        return redirect('dash/pajaks')->with('berhasil', 'data berhasil di hapus');
    }

    //for export excel
    public function exportpajakexcel()
    {
        return Excel::download(new PajakExport, 'PAJAK.xlsx');
    }

    //FOR IMPORT EXCEL
    public function importpajakexcel(Request $request)
    {

        // validasi file dan ekstensi
        $this->validate($request, ['excel' => 'required|mimes:csv,xls,xlsx']);

        //mengambil file dari inputan lewat request
        $file = $request->file('excel');

        //randomkan nama file
        $nama_file = rand() . $file->getClientOriginalName();

        //memindahkan file ke folder public dengan nama folder data_excel
        $file->move('data_excel/pajak', $nama_file);

        $import = new PajakImport;

        $import->import(public_path('/data_excel/pajak/' . $nama_file));

        // dd($import->failures());
        if ($import->failures()->isNotEmpty()) {
            return back()->with('failures', $import->failures());
        }
        // Excel::import(new PajakImport, public_path('/data_excel/' . $nama_file));

        return redirect('/dash/pajaks')->with('berhasil', 'data berhasil di import');
    }

    //FOR DOWNLOAD FILE CONTOH EXCEL
    public function downloadCthPajakExcel()
    {
        $filePath = public_path('data_sample.xlsx');
        $headers = ['Content-Type: application/xlsx'];
        $fileName = time() . '.xlsx';

        return response()->download($filePath, $fileName, $headers);
    }

    // public function dataTB_html(DataTables $dataTables)
    // {
    //     $column = [
    //         'id' => ['title' => 'No.', 'orderable' => false, 'searchable' => false, 'render' => function () {
    //             return 'function (data, type, fullData, meta) {return meta . settings . _iDisplayStart + meta . row + 1;}';
    //         }],
    //         'NOP' => ['title' => 'NOP'],
    //         'nama' => ['title' => 'NAMA WAJIB PAJAK'],
    //         'yang_harus_dibayar' => ['title' => 'YANG HARUS DI BAYAR'],
    //         'status' => ['title' => 'STATUS'],
    //         'action' => ['orderable' => false, 'searchable' => false, 'title' => 'OPSI',]
    //     ];

    //     if ($dataTables->getRequest()->ajax()) {

    //         return $dataTables->of(Pajak::orderBy('NOP', 'DESC')->get())

    //             ->addColumn('action', function ($data) {
    //                 $btn = '<div class="btn-group">';
    //                 $btn .= '<a href="/dash/pajaks/' . $data->id . '" class="badge bg-primary border-0 text-decoration-none text-light" id="btn-detail" data-bs-toggle="tooltip"  data-bs-placement="top" title="Detail" data-id="#">Detail</a>' . '&nbsp;';
    //                 $btn .= '<a href="/dash/pajaks/' . $data->id . '/edit" class="badge bg-secondary border-0 text-decoration-none text-light" id="btn-edit" data-bs-toggle="tooltip"  data-bs-placement="top" title="Edit" data-id="#">Edit</a>' . '&nbsp;';
    //                 $btn .= '<form action="/dash/pajaks/' . $data->id . '" method="post"><input type="hidden" name="_method" value="DELETE"><button id="btn_hapus" class="badge bg-danger border-0 text-decoration-none text-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" onclick="return confirm(\'APAKAH YAKIN INGIN MENGHAPUS?\')" >
    //                     Del
    //                 </button></form>';
    //                 // $btn .= '<a href="/dash/pajaks/' . $data->id . '/edit" class="badge bg-secondary border-0 text-decoration-none text-light" id="btn-edit" data-bs-toggle="tooltip"  data-bs-placement="top" title="Edit" data-id="#">Edit</a>';
    //                 $btn .= '</div>';

    //                 return $btn;
    //             })
    //             ->editColumn('NOP', function ($data) {
    //                 // menghilangkan tanda petik dari database
    //                 return str_replace("'", "", $data->NOP);
    //             })
    //             ->editColumn('status', function ($pj) {
    //                 return $pj->status == 1 ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-danger">Terhutang</span>';
    //             })
    //             ->editColumn('yang_harus_dibayar', function ($data) {
    //                 // AGAR 3 DIGIT ADA TITIKNYA <dt> agar font tebel
    //                 return '<dt class="text-end">' . number_format($data->yang_harus_dibayar, 0, ',', '.') . '</dt>';
    //             })
    //             ->rawColumns(['action', 'status', 'yang_harus_dibayar'])
    //             ->toJson();
    //     }

    //     $html = $dataTables->getHtmlBuilder()
    //         ->columns($column)
    //         ->parameters([
    //             'processing' => true,
    //             'serverSide' => true,
    //             'searching' => true,
    //             'paging' => true,
    //             'lengthChange' => true,
    //             'searchDelay' => 1000,
    //             'responsive' => true,
    //             'dom' => 'Bfrtip',
    //         ]);

    //     return view('dashboard.pajak.index', compact('html'));
    // }



    // public function seting_table()
    // {
    //     // $query = Pajak::with('hak_milik');
    //     $query = Pajak::all();

    //     return DataTables::of($query)
    //         ->addIndexColumn()
    //         ->editColumn('status', function ($data) {
    //             if ($data->status == '1') {
    //                 return '<span class="badge bg-success">Lunas</span>';
    //             } else {
    //                 return '<span class="badge bg-danger">Belum Lunas</span>';
    //             }
    //         })
    //         ->editColumn('yang_harus_dibayar', function ($data) {
    //             return "Rp " . number_format($data->yang_harus_dibayar, 0, ',', '.');
    //         })
    //         ->rawColumns(['hak_milik.nama', 'status'])->make('true'); //agar bisa addcolumn bisa di sisipi tag html
    // }
}

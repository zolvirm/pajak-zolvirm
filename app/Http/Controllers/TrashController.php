<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $trashs = Pajak::onlyTrashed()->orderBy('NOP')->paginate(15);
        // dd($trashs);

        return view('dashboard.sampah.index', compact('trashs'));
    }

    public function restore($id)
    {
        Pajak::withTrashed()->findOrFail($id)->restore();
        return redirect('dash/trash-pajak')->with('berhasil', 'data berhasil di kembalikan');
    }

    public function forcedelete($id)
    {
        Pajak::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect('dash/trash-pajak')->with('berhasil', 'data berhasil di hapus PERMANEN');
    }

    public function index2()
    {
        $trashs2 = Pemilik::onlyTrashed()->paginate(15);
        // dd($trashs);

        return view('dashboard.sampah.index2', compact('trashs2'));
    }

    public function restore2($id)
    {
        Pemilik::withTrashed()->findOrFail($id)->restore();
        return redirect('dash/trash-pemilik')->with('berhasil', 'data berhasil di kembalikan');
    }

    public function forcedelete2($id)
    {
        Pemilik::onlyTrashed()->findOrFail($id)->forceDelete();
        Pajak::where('pemilik_id', $id)->update(['pemilik_id' => null]);
        return redirect('dash/trash-pemilik')->with('berhasil', 'data berhasil di hapus PERMANEN');
    }
}

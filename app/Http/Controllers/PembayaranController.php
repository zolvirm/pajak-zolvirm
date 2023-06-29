<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use App\Models\Pembayaran;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kadal = Pemilik::all();
        if (request('pemiliks')) {

            $megalodon = Pajak::with('pemilik')
                ->where('pemilik_id', 'LIKE', '%' . request('pemiliks') . '%')->get();

            $harga = $megalodon->pluck('yang_harus_dibayar');
            $total = 0;
            foreach ($harga as $item) {
                $total = $total + $item;
            }
            // dd($total);
        } else {

            $megalodon = Pajak::all();
            $total = 0;
        }

        return view('dashboard.pembayaran.index', compact(['megalodon', 'kadal', 'total']));
    }

    public function pembjson()
    {
        // $pemilik=Pemilik::get();
        // $pajaks = Pajak::where('status', 0)->orWhere('status',null)->get();
        // return response()->json([
        //     'pajaks' => $pajaks,
        //     'pemilik'=>$pemilik
        // ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}

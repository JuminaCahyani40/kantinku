<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\buyer;



class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $buyer = buyer::orderBy('id','asc')->paginate(5);
        return view('buyer.index',compact('buyer'))
                ->with('i',(request()->input('page',1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buyer.create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->image)){
            $extention = $request->image->extension();
            $image_name = time().'.'.$extention;
            $request->image->move(public_path('img\avatar'),$image_name);
            
        }else{
            $image_name = null;
        }

        $Buyer = buyer::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'foto' => $image_name,
            'user_id' => $request->user_id,

        ]);        
        return redirect()->route('buyer.index')
                         ->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer = buyer::find($id);

        return view('buyer.detail-profile', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer = buyer::find($id);

        return view('buyer.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'=>'required',
            'jenis_kelamin' => 'required',
            'alamat'=>'required',
            'foto' => 'required',
            'user_id' => 'required'
        ]);

        if (isset($request->image)){
            $extention = $request->image->extension();
            $image_name = time().'.'.$extention;
            $request->image->move(public_path('img\avatar'),$image_name);
            
        }else{
            $image_name = null;
        }

        $buyer = buyer::find($id);
        $buyer->nama = $request->get('nama');
        $buyer->jenis_kelamin = $request->get('jenis_kelamin');
        $buyer->alamat = $request->get('alamat');
        $buyer->foto = $image_name;
        $buyer->user_id = $request->get('user_id');
        $buyer->save();

        return redirect()->route('buyer.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buyer = buyer::find($id);
        $buyer->delete();

        return redirect()->route('buyer.index')
                         ->with('success', 'Data Alumni berhasil dihapus');
    }
}
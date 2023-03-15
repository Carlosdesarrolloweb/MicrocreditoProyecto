<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interes;

class InteresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interes::all();
        return view('interests.index', compact('interests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('interests.create');
    }

     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'interes_prestamo' => 'required|numeric'
        ]);

        $interest = new Interes();
        $interest->interes_prestamo = $validatedData['interes_prestamo'];
        $interest->save();

        return redirect()->route('interests.index')
            ->with('success', 'El interés se ha agregado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

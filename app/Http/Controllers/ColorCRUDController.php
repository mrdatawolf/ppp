<?php

namespace App\Http\Controllers;

use App\Models\ColorConversion;
use Illuminate\Http\Request;

class ColorCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['colors'] = ColorConversion::orderBy('id', 'desc')->paginate(5);

        return view('colors.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colors.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'original'   => 'required',
            'convert_to' => 'required'
        ]);
        $color             = new ColorConversion();
        $color->original   = $request->original;
        $color->convert_to = $request->convert_to;
        $color->save();

        return redirect()->route('colors.index')->with('success', 'Color has been created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param ColorConversion $color
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ColorConversion $color)
    {
        return view('colors.show', compact('color'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param ColorConversion $color
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorConversion $color)
    {
        return view('colors.edit', compact('color'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'original'   => 'required',
            'convert_to' => 'required'
        ]);
        $color             = ColorConversion::find($id);
        $color->original   = $request->original;
        $color->convert_to = $request->convert_to;
        $color->save();

        return redirect()->route('colors.index')->with('success', 'Color Has Been updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param ColorConversion $color
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColorConversion $color)
    {
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Color has been deleted successfully');
    }
}

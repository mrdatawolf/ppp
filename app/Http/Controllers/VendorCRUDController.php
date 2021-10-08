<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vendors'] = Vendor::orderBy('id', 'desc')->paginate(5);

        return view('vendors.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
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
            'name'             => 'required',
            'po_vendor_code'   => 'required',
            'item_vendor_code' => 'required'
        ]);
        $vendor                   = new Vendor;
        $vendor->name             = $request->name;
        $vendor->po_vendor_code   = $request->po_vendor_code;
        $vendor->item_vendor_code = $request->item_vendor_code;
        $vendor->save();

        return redirect()->route('vendors.index')->with('success', 'Vendor has been created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param vendor                   $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required',
            'po_vendor_code'   => 'required',
            'item_vendor_code' => 'required'
        ]);
        $vendor                   = Vendor::find($id);
        $vendor->name             = $request->name;
        $vendor->po_vendor_code   = $request->po_vendor_code;
        $vendor->item_vendor_code = $request->item_vendor_code;
        $vendor->save();

        return redirect()->route('vendors.index')->with('success', 'Vendor Has Been updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor has been deleted successfully');
    }
}

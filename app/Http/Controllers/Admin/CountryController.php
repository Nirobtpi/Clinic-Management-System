<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
        ]);

        Country::create([
            'name' => $request->name,
            'status' => $request->has('status') ? "active" : "inactive",
        ]);

        $notification = [
            'message' => 'Country created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('countries.index')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $id,
        ]);
        $country = Country::findOrFail($id);
        $country->update([
            'name' => $request->name,
            'status' => $request->has('status') ? "active" : "inactive",
        ]);

        $notification = [
            'message' => 'Country updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('countries.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        $notification = [
            'message' => 'Country deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('countries.index')->with($notification);
    }
}

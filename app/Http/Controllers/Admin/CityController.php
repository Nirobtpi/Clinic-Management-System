<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('country')->get();
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.city.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        $notification = array(
            'message' => 'City created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('cities.index')->with($notification);
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
        $city = City::findOrFail($id);
        $countries = Country::all();
        return view('admin.city.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $city->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        $notification = array(
            'message' => 'City updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('cities.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        $notification = array(
            'message' => 'City deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('cities.index')->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::with('country','city')->get();
        return view('admin.state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        // $cities = City::all();
        return view('admin.state.create', compact('countries'));
    }

    public function getCityByCountry($id){
        $cities = City::where('country_id', $id)->get();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        State::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ]);
        $notification = [
            'message' => 'State created successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('states.index')->with($notification);
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
        $state = State::findOrFail($id);
        $countries = Country::all();
        $cities = City::where('country_id', $state->country_id)->get();
        return view('admin.state.edit', compact('state', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $state = State::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        $state->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ]);
        $notification = [
            'message' => 'State updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('states.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        $notification = [
            'message' => 'State deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('states.index')->with($notification);
    }
}

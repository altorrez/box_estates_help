<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use App\Property;





class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return view('property.index')->withProperties($properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => 'required|max:255',
            'address' => 'required|max:255',
            'state' => 'required|max:255',
            'zipcode' => 'required|max:11',
            'beds' => 'required|max:2',
            'baths' => 'required|max:2',
            'feet' => 'required|max:5',
            'price' => 'required|max:255',
            'description' => 'required'
        ));

        $property = new Property;

        $property->title = $request->title;
        $property->address = $request->address;
        $property->state = $request->state;
        $property->zipcode = $request->zipcode;
        $property->beds = $request->beds;
        $property->baths = $request->baths;
        $property->feet = $request->feet;
        $property->price = $request->price;
        $property->description = $request->description;

        $property->save();

        Session::flash('success', 'Property was saved successfully!');

        return redirect()->route('property.show', $property->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::find($id);
        return view('property.show')->withProperty($property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);

        return view('property.edit')->withProperty($property);
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
        $this->validate($request, array(
            'title' => 'required|max:255',
            'address' => 'required|max:255',
            'state' => 'required|max:255',
            'zipcode' => 'required|max:11',
            'beds' => 'required|max:2',
            'baths' => 'required|max:2',
            'feet' => 'required|max:5',
            'price' => 'required|max:255',
            'description' => 'required'
        ));

        $property = Property::find($id);

        $property->title = $request->input('title');
        $property->address = $request->input('address');
        $property->state = $request->input('state');
        $property->zipcode = $request->input('zipcode');
        $property->beds = $request->input('beds');
        $property->baths = $request->input('baths');
        $property->feet = $request->input('feet');
        $property->price = $request->input('price');
        $property->description = $request->input('description');

        $property->save();

        Session::flash('success', 'This property was successfully updated!');

        //redirect
        return redirect()->route('property.show', $property->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);

        $property->delete();

        Session::flash('success', 'This property was successfully deleted!');

        return redirect()->route('property.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);
        $company = new Companies();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extension = $logo->extension();
            $rand = rand(11111, 99999);
            $tempName = $rand . ' ' . $extension;
            $logo->storeAs('public/logos/', $tempName);
            $company->logo = $tempName;
        }
        $company->save();
        if ($company) {
            return redirect()->route('companies.index')->with('message', 'Company Created Successful');
        } else {
            return redirect()->back()->with('message', 'Company Creation Failed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}

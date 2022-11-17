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
        $companies = Companies::orderBy('id', 'ASC')->paginate(10);
        // dd($companies);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // returning view for creating new company
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
        // Validating the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        // Creating object of company and adding fields
        $company = new Companies();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        // making sure if logo exists in the request
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extension = $logo->extension();
            $rand = rand(11111, 99999);
            $tempName = $rand . '.' . $extension;
            // Storing Logo public/logos/ directory
            $logo->storeAs('public/logos/', $tempName);
            $company->logo = $tempName;
        }
        // saving data to the database
        $company->save();

        // returning response based on success or failure
        if ($company) {
            return redirect()->route('companies.index')->with(['message' => 'Company Created Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Creation Failed', 'type' => 'warning']);
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
    public function edit(Companies $company)
    {

        return view('Companies.update')->with(['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $company)
    {
        // Validating the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        // making sure if logo exists in the request
        if ($request->hasFile('logo')) {

            // Removing previous used logo if it exists on server
            if ($company->logo) {
                $oldLogo = 'storage/logos' . '/' . $company->logo;
                if (file_exists($oldLogo)) {
                    unlink($oldLogo);
                }
            }


            $logo = $request->file('logo');
            $extension = $logo->extension();
            $rand = rand(11111, 99999);
            $tempName = $rand . '.' . $extension;
            // Storing Logo public/logos/ directory
            $logo->storeAs('public/logos/', $tempName);
            $company->logo = $tempName;
        }

        $company->save();
        // returning response based on success or failure
        if ($company) {
            return redirect()->route('companies.index')->with(['message' => 'Company Updated Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Updation Failed', 'type' => 'warning']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        if ($company) {
            // Removing previous used logo if it exists on server
            if ($company->logo) {
                $oldLogo = 'storage/logos' . '/' . $company->logo;
                if (file_exists($oldLogo)) {
                    unlink($oldLogo);
                }
            }

            $company->delete();
            return redirect()->back()->with(['message' => 'Company Information Deleted Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Information Not Found', 'type' => 'warning']);
        }
    }
}

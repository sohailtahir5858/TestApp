<?php

namespace App\Http\Controllers;

use App\Mail\CompanyMail;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompaniesController extends Controller
{
    
    public function index()
    {
        // Retrieving Companies records with pagination (10 records per page)
        $companies = Companies::orderBy('id', 'ASC')->paginate(10);
        return view('companies.index', compact('companies'));
    }

    
    
    public function create()
    {
        // returning view for creating new company
        return view('Companies.create');
    }

    
    // Storing Company record to DB
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

            // Sending Mail to User Once Company has been created
            Mail::to($request->email)->send(new CompanyMail());


            return redirect()->route('companies.index')->with(['message' => 'Company Created Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Creation Failed', 'type' => 'warning']);
        }
    }

    
    
    public function show(Companies $companies)
    {
        //
    }

    
    
    public function edit(Companies $company)
    {
        return view('Companies.update')->with(['company' => $company]);
    }

    
    // Method to update company record
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
            // Storing Logo public/logos/ directory with a temprary name
            $logo->storeAs('public/logos/', $tempName);
            $company->logo = $tempName;
        }
        // Saving record to DB
        $company->save();

        // returning response based on success or failure
        if ($company) {
            return redirect()->route('companies.index')->with(['message' => 'Company Updated Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Updation Failed', 'type' => 'warning']);
        }
    }

    
    // Method to delete Company record along with associated Employees
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

            // Removing employees associated with this company
            $company->employees()->delete();

            // deleting company
            $company->delete();

            // returning response based on success or failure
            return redirect()->back()->with(['message' => 'Company Information Deleted Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Company Information Not Found', 'type' => 'warning']);
        }
    }
}

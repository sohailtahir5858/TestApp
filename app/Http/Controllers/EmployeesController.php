<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    
    public function index()
    {
        // Retrieving Employees records with pagination (10 records per page)
        $employees = Employees::with('companies')->orderBy('id', 'ASC')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    
    public function create()
    {
        // retrieving companies list.
        $companies = Companies::select('id', 'name')->get();
        return view('Employees.create', compact('companies'));
    }

    // Method to store Employee record to DB
    public function store(Request $request)
    {
        // Validating the request
        $validated = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'company' => 'required|integer',
        ]);

        $employee = Employees::create($validated);

        // returning response based on success or failure
        if ($employee) {
            // Sending Mail to User Once Company has been created

            return redirect()->route('employees.index')->with(['message' => 'Employee Added Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Employee Adding Failed', 'type' => 'warning']);
        }
    }

    
    public function show(Employees $employees)
    {
        //
    }

    
    // Method returns companies list along with employee record for update page
    public function edit(Employees $employee)
    {
        // retrieving companies list.
        $companies = Companies::select('id', 'name')->get();

        return view('Employees.update', compact('companies','employee'));
    }

    
    // Method to update Employee records
    public function update(Request $request, Employees $employee)
    {
        // Validating the request
        $validated = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'company' => 'required|integer',
        ]);

        $employee = Employees::where('id',$employee->id)->update($validated);

        // returning response based on success or failure
        if ($employee) {
            // Sending Mail to User Once Company has been created

            return redirect()->route('employees.index')->with(['message' => 'Employee Updated Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Employee Updating Failed', 'type' => 'warning']);
        }
    }

    
    // Method to delete Employee Record
    public function destroy(Employees $employee)
    {
        // Delete only if employee record is found
        if ($employee) {
            $employee->delete();
            return redirect()->back()->with(['message' => 'Employee Information Deleted Successful', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Employee Information Not Found', 'type' => 'warning']);
        }
    }
}

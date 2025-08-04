<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    public function __construct(protected EmployeeService $employeeService)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('list-employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-employee', [
            'companyId' => Auth::user()->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee($request);

        if (isset($employee['error'])) {
            return redirect()->back()->withErrors($employee['error']);
        }

        return redirect()->route('companies.show', $request->company_id)->with('success', $employee['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Logic to show a specific employee
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logic to show form for editing an employee
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Logic to update an employee
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete an employee
    }
}

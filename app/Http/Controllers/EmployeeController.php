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
    public function index($companyId)
    {
        // Validasi akses company
        if (Auth::user()->role === 'company' && Auth::user()->id != $companyId) {
            abort(403, 'You can only view your own employees.');
        }

        $employees = $this->employeeService->getEmployeesByCompany($companyId);
        return view('list-employees', compact('employees', 'companyId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($companyId)
    {
        // Validasi akses company
        if (Auth::user()->role === 'company' && Auth::user()->id != $companyId) {
            abort(403, 'You can only create employees for your own company.');
        }

        return view('create-employee', [
            'companyId' => $companyId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, $companyId)
    {
        // Auto-assign company_id dari parameter route
        $request->merge(['company_id' => $companyId]);
        
        $employee = $this->employeeService->createEmployee($request);

        if (isset($employee['error'])) {
            return redirect()->back()->withErrors($employee['error']);
        }

        return redirect()->route('companies.show', $companyId)->with('success', $employee['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show($companyId, $employeeId)
    {
        // Validasi akses company
        if (Auth::user()->role === 'company' && Auth::user()->id != $companyId) {
            abort(403, 'You can only view your own employees.');
        }

        $employee = $this->employeeService->getEmployeeById($employeeId, $companyId);

        if (!$employee) {
            return redirect()->back()->withErrors(['error' => 'Employee not found']);
        }

        return view('show-employee', compact('employee', 'companyId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($companyId, $employeeId)
    {
        // Validasi akses company
        if (Auth::user()->role === 'company' && Auth::user()->id != $companyId) {
            abort(403, 'You can only edit your own employees.');
        }

        $employee = $this->employeeService->getEmployeeById($employeeId, $companyId);
        return view('edit-employee', compact('employee', 'companyId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $companyId, $employeeId)
    {
        // Validasi hanya phone dan logo
        $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'logo'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Hanya ambil phone dan logo dari request
        $data = $request->only(['phone', 'logo']);
        
        $result = $this->employeeService->updateEmployee($employeeId, $data, $companyId);
        
        if (isset($result['error'])) {
            return redirect()->back()->withErrors($result['error']);
        }
        
        return redirect()->route('employees.show', [$companyId, $employeeId])
            ->with('success', $result['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($companyId, $employeeId)
    {
        $result = $this->employeeService->deleteEmployee($employeeId, $companyId);
        
        if (isset($result['error'])) {
            return redirect()->back()->withErrors($result['error']);
        }
        
        return redirect()->route('companies.show', $companyId)
            ->with('success', $result['message']);
    }
}

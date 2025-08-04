<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isCompany());
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $employeeId = $this->route('employee') ? $this->route('employee')->id : null;

    return [
      'company_id' => 'required|exists:companies,id',
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:employees,email,' . $employeeId,
      'phone' => 'required|string|max:20',
      'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
    ];
  }
}

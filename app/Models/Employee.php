<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
  use HasFactory;

  protected $fillable = [
    'company_id',
    'name',
    'email',
    'phone',
    'profile_picture',
  ];

  /**
   * Get the company that owns the employee.
   */
  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}

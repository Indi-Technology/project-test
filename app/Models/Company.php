<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'logo',
    'website',
  ];

  /**
   * Get the users for the company.
   */
  public function users()
  {
    return $this->hasMany(User::class);
  }

  /**
   * Get the employees for the company.
   */
  public function employees()
  {
    return $this->hasMany(Employee::class);
  }
}

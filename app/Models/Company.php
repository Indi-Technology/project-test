<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
	protected $fillable = [
		'name',
		'email',
		'logo',
		'user_id',
		'description',
	];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

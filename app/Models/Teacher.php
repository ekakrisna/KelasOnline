<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Teacher
 * 
 * @property int $id
 * @property int $file_id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $description
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property File $file
 * @property Collection|Theory[] $theories
 *
 * @package App\Models
 */
class Teacher extends User
{
	use HasApiTokens, HasFactory, Authenticatable, Notifiable;

	protected $table = 'teachers';

	protected $primaryKey = 'id';

	protected $casts = [
		'file_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'file_id',
		'name',
		'email',
		'email_verified_at',
		'password',
		'description',
		'remember_token'
	];

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function theories()
	{
		return $this->hasMany(Theory::class);
	}
}

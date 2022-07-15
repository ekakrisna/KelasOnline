<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SessionType
 * 
 * @property int $id
 * @property string $name_id
 * @property string $name_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class SessionType extends Model
{
	protected $table = 'session_types';

	protected $fillable = [
		'name_id',
		'name_en'
	];

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'class_type_id');
	}
}

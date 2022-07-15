<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $alt
 * @property string|null $path
 * @property string|null $extension
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Teacher[] $teachers
 * @property Collection|Theory[] $theories
 *
 * @package App\Models
 */
class File extends Model
{
	use SoftDeletes;
	protected $table = 'files';

	protected $fillable = [
		'name',
		'alt',
		'path',
		'extension'
	];

	public function teachers()
	{
		return $this->hasMany(Teacher::class);
	}

	public function theories()
	{
		return $this->hasMany(Theory::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Theory
 * 
 * @property int $id
 * @property int|null $teacher_id
 * @property string $name_id
 * @property string $name_en
 * @property string $description_id
 * @property string $description_en
 * @property int|null $file_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property File|null $file
 * @property Teacher|null $teacher
 *
 * @package App\Models
 */
class Theory extends Model
{
	use SoftDeletes;
	protected $table = 'theory';

	protected $casts = [
		'teacher_id' => 'int',
		'file_id' => 'int'
	];

	protected $fillable = [
		'teacher_id',
		'name_id',
		'name_en',
		'description_id',
		'description_en',
		'file_id'
	];

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}

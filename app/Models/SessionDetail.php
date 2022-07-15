<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SessionDetail
 * 
 * @property int|null $id
 * @property int|null $class_id
 * @property int|null $teacher_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class SessionDetail extends Model
{
	use SoftDeletes;
	protected $table = 'session_details';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'class_id' => 'int',
		'teacher_id' => 'int'
	];

	protected $fillable = [
		'id',
		'class_id',
		'teacher_id'
	];
}

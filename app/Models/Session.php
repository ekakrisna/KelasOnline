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
 * Class Session
 * 
 * @property int $id
 * @property string $title_id
 * @property string $title_en
 * @property string $description_id
 * @property string $description_en
 * @property float|null $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Session extends Model
{
	use SoftDeletes;
	protected $table = 'sessions';

	protected $casts = [
		'price' => 'float'
	];

	protected $fillable = [
		'title_id',
		'title_en',
		'description_id',
		'description_en',
		'price'
	];

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'class_id');
	}
}

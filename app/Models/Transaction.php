<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * 
 * @property int $id
 * @property int $class_id
 * @property int $class_type_id
 * @property int $user_id
 * @property int $payment_method_id
 * @property Carbon $class_date
 * @property int $how_many_hours
 * @property float $total_price
 * @property string|null $status_payment
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Session $session
 * @property SessionType $session_type
 * @property User $user
 * @property PaymentMethod $payment_method
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';

	protected $casts = [
		'class_id' => 'int',
		'class_type_id' => 'int',
		'user_id' => 'int',
		'payment_method_id' => 'int',
		'how_many_hours' => 'int',
		'total_price' => 'float',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $dates = [
		'class_date'
	];

	protected $fillable = [
		'class_id',
		'class_type_id',
		'user_id',
		'payment_method_id',
		'class_date',
		'how_many_hours',
		'total_price',
		'status_payment',
		'latitude',
		'longitude',
		'note'
	];

	public function session()
	{
		return $this->belongsTo(Session::class, 'class_id');
	}

	public function session_type()
	{
		return $this->belongsTo(SessionType::class, 'class_type_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function payment_method()
	{
		return $this->belongsTo(PaymentMethod::class);
	}
}

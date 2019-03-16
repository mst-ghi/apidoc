<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class:     Request
 * Developer: MostafaGh
 * Email:     MostafaGholami01@gmail.com
 * Date:      11/12/2018
 * Time:      8:44 PM
 * @package App\Models
 */
class Request extends Model
{
	protected $fillable = [
		'route_id',
		'fields',
		'description',
		'status',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function route()
	{
		return $this->belongsTo(Route::class);
	}
}

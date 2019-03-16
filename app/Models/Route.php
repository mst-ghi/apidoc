<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class:     Route
 * Developer: MostafaGh
 * Email:     MostafaGholami01@gmail.com
 * Date:      11/12/2018
 * Time:      8:44 PM
 * @package App\Models
 */
class Route extends Model
{
	/** @var array  */
	protected $fillable = [
		'folder_id',
		'uri',
		'method',
		'description',
		'status',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function folder()
	{
		return $this->belongsTo(Folder::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function requests()
	{
		return $this->hasMany(Request::class, 'route_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function responses()
	{
		return $this->hasMany(Response::class, 'route_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function headers()
	{
		return $this->hasMany(Header::class, 'route_id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'route_id');
    }
}

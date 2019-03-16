<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class:     Project
 * Developer: MostafaGh
 * Email:     MostafaGholami01@gmail.com
 * Date:      11/12/2018
 * Time:      8:44 PM
 * @package App\Models
 */
class Project extends Model
{
    protected $fillable = [
    	'user_id',
    	'name',
    	'platform',
    	'description',
    	'status',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function versions()
	{
		return $this->hasMany(Version::class, 'project_id')->orderBy('created_at','desc');
    }
}

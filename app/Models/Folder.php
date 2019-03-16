<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
	/** @var array  */
    protected $fillable = [
    	'version_id', 'parent_id', 'title', 'path', 'status'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function version()
	{
		return $this->belongsTo(Version::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function routes()
	{
		return $this->hasMany(Route::class, 'folder_id');
    }

    /**
     * @return mixed
     */
    public function getChildFolder()
    {
        return Folder::whereParentId($this->id)->get();
    }
}

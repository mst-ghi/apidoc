<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
	/** @var array  */
    protected $fillable = [
    	'project_id', 'version', 'explain'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function folders()
	{
		return $this->hasMany(Folder::class, 'version_id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMainFolder()
    {
        return $this->folders()->where('parent_id', NULL)->get();
	}

    /**
     * get all route of the version by this method
     * @return array
     */
    public function getAllRoute()
    {
        $routes = [];
        $folders = $this->folders;
        foreach ($folders as $folder){
            $rts = $folder->routes;
            foreach ($rts as $r){
                array_push($routes, $r);
            }
        }
        return $routes;
    }
}

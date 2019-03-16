<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class:     Comment
 * Developer: MostafaGh
 * Email:     MostafaGholami01@gmail.com
 * Date:      11/12/2018
 * Time:      8:43 PM
 * @package App\Models
 */
class Comment extends Model
{
    protected $fillable = [
      'user_id','route_id','title','body', 'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

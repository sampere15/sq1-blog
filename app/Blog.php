<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ["user_id", "title", "description", "publication_date"];

    protected $table = 'blogs';
    //  To avoid the defaults created_ad and updated_at
    public $timestamps = false;

    protected $casts = [
        'publication_date' => 'datetime',
    ];

    //  Relation wit user model. A Blog belongs to a user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

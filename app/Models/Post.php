<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dates = ['publication_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'publication_date',
        'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')
        ->withDefault(['name'=> 'Anonymous']) ;
    }
}

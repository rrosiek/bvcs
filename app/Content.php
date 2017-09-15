<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * @var string
     */
    protected $table = 'content';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'type',
        'posted_at',
    ];

    /**
     * @array
     */
    protected $dates = [
        'posted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNews($query)
    {
        return $query->where('type', 'news')->orWhere('type', 'newsletter');
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewsletter($query)
    {
        return $query->where('type', 'newsletter');
    }
}

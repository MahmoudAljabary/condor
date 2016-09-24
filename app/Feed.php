<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $apikey
 * @property string $params
 * @property \Illuminate\Support\Collection $boards
 * @property int $aspect_id
 * @property bool $enabled
 * @property \App\Aspect $aspect
 */
class Feed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apikey', 'aspect_id', 'params', 'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function boards()
    {
        return $this->belongsToMany(Board::class);
    }

    public function aspect()
    {
        return $this->belongsTo(Aspect::class);
    }

    public function scopeForAspect($query, $aspectId)
    {
        return $query->where('aspect_id', $aspectId);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeDisabled($query)
    {
        return $query->where('enabled', false);
    }

    /**
     * Set Params.
     *
     * @param string $params
     */
    public function setParamsAttribute($params)
    {
        $this->attributes['params'] = trim($params) ?: null;
    }

    /**
     * Set Params.
     *
     * @param string|null $apikey
     */
    public function setApikeyAttribute($apikey = null)
    {
        $this->attributes['apikey'] = trim($apikey) ?: null;
    }

    public function enable()
    {
        $this->toggle(true);
    }

    public function disable()
    {
        $this->toggle(false);
    }

    public function toggle($value = true)
    {
        $this->attributes['enabled'] = (bool) $value;
        $this->save();
    }
}

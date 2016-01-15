<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $fillable = [ 'start', 'end', 'period_id' ];

    protected $dates = [ 'start', 'end' ];

    public function period()
    {
        return $this->belongsTo('App\Period');
    }

    public function getStartFormatAttribute()
    {
        return $this->start->format('d/m/Y');
    }

    public function getEndFormatAttribute()
    {
        return $this->end->format('d/m/Y');
    }

    public function getRangeAttribute()
    {
        return $this->start_format . ' - ' . $this->end_format;
    }

}

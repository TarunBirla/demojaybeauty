<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'ip_address',
        'url',
        'page_name',
        'referer',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}

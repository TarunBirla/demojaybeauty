<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'browser',
        'device',
        'os',
        'user_agent',
        'visit_date',
        'views_count',
        'last_activity',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'last_activity' => 'datetime',
    ];

    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }
}

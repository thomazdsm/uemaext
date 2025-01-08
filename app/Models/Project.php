<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status_id',
        'type_id'
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
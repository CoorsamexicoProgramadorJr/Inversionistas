<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;

class Category extends Model
{
    use BroadcastsEvents;
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function broadcastOn($e)
    {
        return match ($e) {
            'created' => [new PrivateChannel('App.Models.Category.' . auth()->user()->id)],
            'deleted' => [],
            'updated' => [new PrivateChannel('App.Models.Category.' . auth()->user()->id)],
            default => [],
        };
    }
}
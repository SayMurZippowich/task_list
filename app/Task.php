<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function task_statuses() {
        return $this->belongsTo('App\TaskStatus', 'task_status_id', 'id');
    }

    public function creator() {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }
    public function performer() {
        return $this->belongsTo('App\User', 'performer_id', 'id');
    }
}

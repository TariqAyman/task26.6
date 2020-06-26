<?php

namespace App;

use App\Helpers\TaskStatus;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'projects';
    protected $fillable = ['title'];

    protected $appends = ['taskDoneCount', 'taskInProgressCount','progressPercentage'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function taskDone()
    {
        return $this->tasks()->where('status', TaskStatus::Done);
    }

    public function taskInProgress()
    {
        return $this->tasks()->where('status', TaskStatus::InProgress);
    }

    public function gettaskDoneCountAttribute()
    {
        return $this->taskDone()->count();
    }

    public function gettaskInProgressCountAttribute()
    {
        return $this->taskInProgress()->count();
    }

    public function getProgressPercentageAttribute()
    {
        return number_format(($this->taskDone()->count() / $this->tasks()->count()) * 100,1) . ' %';
    }

}

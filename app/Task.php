<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $table = 'tasks';
    protected $fillable = ['title', 'project_id', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}

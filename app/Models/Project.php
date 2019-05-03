<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'project';
    public $dates = ['deleted_at'];

    public function getStartedAtDesc($fmt = 'Y-m-d H:i:s')
    {
        return date($fmt, $this->started_at);
    }

    public function getEndedAtDesc($fmt = 'Y-m-d H:i:s')
    {
        return date($fmt, $this->ended_at);
    }
}

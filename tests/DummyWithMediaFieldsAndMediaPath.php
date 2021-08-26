<?php

namespace CodeBugLab\MediaRemovable\Tests;

use CodeBugLab\MediaRemovable\MediaRemovable;
use Illuminate\Database\Eloquent\Model;

class DummyWithMediaFieldsAndMediaPath extends Model
{
    use MediaRemovable;

    protected $table = 'dummies';
    protected $guarded = [];
    public $timestamps = false;

    public static $mediaFields = ['image'];

    public static $mediaPath = "storage/app/";
}

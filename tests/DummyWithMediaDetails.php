<?php

namespace CodeBugLab\MediaRemovable\Tests;

use CodeBugLab\MediaRemovable\MediaRemovable;
use Illuminate\Database\Eloquent\Model;

class DummyWithMediaDetails extends Model
{
    use MediaRemovable;

    protected $table = 'dummies';
    protected $guarded = [];
    public $timestamps = false;

    public static $mediaDetails = [
        [
            'field' => 'image',
            'path' => 'storage/app/public/'
        ]
    ];
}

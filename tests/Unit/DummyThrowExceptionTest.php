<?php

namespace CodeBugLab\MediaRemovable\Tests\Unit;

use CodeBugLab\MediaRemovable\Exceptions\MediaNotFoundException;
use CodeBugLab\MediaRemovable\Tests\DummyThrowException;
use CodeBugLab\MediaRemovable\Tests\TestCase;

class DummyThrowExceptionTest extends TestCase
{

    public function test_dummy_model_has_image()
    {
        $dummy = DummyThrowException::where('id' ,3)->first();

        $this->assertNotNull($dummy->image);
    }

    public function test_media_removable_throw_exception()
    {
        $this->expectException(MediaNotFoundException::class);

        DummyThrowException::find(3)->delete();
    }
}

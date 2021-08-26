<?php

namespace CodeBugLab\MediaRemovable\Tests\Unit;

use CodeBugLab\MediaRemovable\Tests\DummyWithMediaDetails;
use CodeBugLab\MediaRemovable\Tests\TestCase;

class DummyWithMediaDetailsTest extends TestCase
{

    public function test_dummy_model_has_image()
    {
        $dummy = DummyWithMediaDetails::where('id', 4)->first();

        $this->assertNotNull($dummy->image);
    }

    public function test_with_media_details_remove_image_when_update_record()
    {
        $dummy = DummyWithMediaDetails::where('id', 4)->first();

        DummyWithMediaDetails::find(4)->update(['image' => 'dummy_with_media_details2.jpg']);

        $this->assertFileDoesNotExist($dummy::$mediaDetailsPaths[0] . $dummy->image);
    }

    public function test_with_media_details_remove_image_when_delete_record()
    {
        $dummy = DummyWithMediaDetails::where('id', 4)->first();

        DummyWithMediaDetails::find(4)->delete();

        $this->assertFileDoesNotExist($dummy::$mediaDetailsPaths[0] . $dummy->image);
    }
}

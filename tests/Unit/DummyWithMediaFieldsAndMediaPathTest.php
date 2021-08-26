<?php

namespace CodeBugLab\MediaRemovable\Tests\Unit;

use CodeBugLab\MediaRemovable\Tests\DummyWithMediaFieldsAndMediaPath;
use CodeBugLab\MediaRemovable\Tests\TestCase;

class DummyWithMediaFieldsAndMediaPathTest extends TestCase
{

    public function test_dummy_model_has_image()
    {
        $dummy = DummyWithMediaFieldsAndMediaPath::where('id' ,2)->first();

        $this->assertNotNull($dummy->image);
    }

    public function test_with_media_fields_and_media_path_remove_image_when_update_record()
    {
        $dummy = DummyWithMediaFieldsAndMediaPath::where('id' ,2)->first();

        DummyWithMediaFieldsAndMediaPath::find(2)->update(['image' => 'dummy_with_path2.jpg']);

        $this->assertFileDoesNotExist(base_path(DummyWithMediaFieldsAndMediaPath::$mediaPath .$dummy->image));
    }

    public function test_with_media_fields_and_media_path_remove_image_when_delete_record()
    {
        $dummy = DummyWithMediaFieldsAndMediaPath::where('id' ,2)->first();

        DummyWithMediaFieldsAndMediaPath::find(2)->delete();

        $this->assertFileDoesNotExist(base_path(DummyWithMediaFieldsAndMediaPath::$mediaPath .$dummy->image));
    }
}

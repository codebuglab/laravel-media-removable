<?php

namespace CodeBugLab\MediaRemovable\Tests\Unit;

use CodeBugLab\MediaRemovable\Tests\DummyWithMediaFields;
use CodeBugLab\MediaRemovable\Tests\DummyWithNullableImageField;
use CodeBugLab\MediaRemovable\Tests\TestCase;

class DummyWithMediaFieldsTest extends TestCase
{

    public function test_dummy_model_has_image()
    {
        $dummy = DummyWithMediaFields::where('id' ,1)->first();

        $this->assertNotNull($dummy->image);
    }

    public function test_media_fields_remove_image_when_update_record()
    {
        $dummy = DummyWithMediaFields::where('id' ,1)->first();

        DummyWithMediaFields::find(1)->update(['image' => 'dummy2.jpg']);

        $this->assertFileDoesNotExist(base_path(config('media-removable.path') .$dummy->image));
    }

    public function test_media_fields_remove_image_when_delete_record()
    {
        $dummy = DummyWithMediaFields::where('id' ,1)->first();

        DummyWithMediaFields::find(1)->delete();

        $this->assertFileDoesNotExist(base_path(config('media-removable.path') .$dummy->image));
    }

    public function test_media_fields_do_not_remove_image_if_image_null_when_update()
    {
        $dummy = DummyWithNullableImageField::where('id' ,6)->first();

        $dummy->update(['image' => 'dummy2.jpg']);

        $this->assertNotNull($dummy->image);
    }

    public function test_media_fields_do_not_remove_image_if_image_null_when_delete()
    {
        DummyWithNullableImageField::where('id' ,6)->first()->delete();

        $this->assertNull(DummyWithNullableImageField::where('id' ,6)->first());
    }
}

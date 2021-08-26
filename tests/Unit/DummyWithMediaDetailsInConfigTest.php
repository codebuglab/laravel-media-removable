<?php

namespace CodeBugLab\MediaRemovable\Tests\Unit;

use CodeBugLab\MediaRemovable\Tests\DummyWithMediaDetailsInConfig;
use CodeBugLab\MediaRemovable\Tests\TestCase;

class DummyWithMediaDetailsInConfigTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        copy(
            __DIR__ . "/../config/media-removable-with-details.php",
            __DIR__ . "/../../src/config/media-removable.php"
        );
    }

    public function test_dummy_model_has_image()
    {
        $dummy = DummyWithMediaDetailsInConfig::where('id', 5)->first();

        $this->assertNotNull($dummy->image);
    }

    public function test_with_media_details_in_config_remove_image_when_update_record()
    {
        $dummy = DummyWithMediaDetailsInConfig::where('id', 5)->first();

        DummyWithMediaDetailsInConfig::find(5)->update(['image' => 'dummy_with_media_details_in_config2.jpg']);

        $this->assertFileDoesNotExist(base_path(config('media-removable.details.dummies')[0]['path'] . $dummy->image));
    }

    public function test_with_media_details_in_config_remove_image_when_delete_record()
    {
        $dummy = DummyWithMediaDetailsInConfig::where('id', 5)->first();

        DummyWithMediaDetailsInConfig::find(5)->delete();

        $this->assertFileDoesNotExist(base_path(config('media-removable.details.dummies')[0]['path'] . $dummy->image));
    }

    public static function tearDownAfterClass(): void
    {
        copy(
            __DIR__ . "/../config/media-removable.php",
            __DIR__ . "/../../src/config/media-removable.php"
        );
    }
}

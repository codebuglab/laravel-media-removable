<?php

namespace CodeBugLab\MediaRemovable\Tests;

use CodeBugLab\MediaRemovable\MediaRemovableServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use File;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app): array
    {
        return [
            MediaRemovableServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'media_removable');
        $app['config']->set('database.connections.media_removable', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }

    protected function setUpDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('dummies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
        });

        $this->dummyData();
        $this->dummyWithPathData();
        $this->dummyWithExceptionData();
        $this->dummyWithMediaDetailsData();
        $this->dummyWithMediaDetailsInConfigData();
        $this->dummyWithNullableImageField();
    }

    private function dummyData()
    {
        DummyWithMediaFields::create(['image' => "dummy.jpg"]);
        File::copy(
            __DIR__ . "/test.jpg",
            base_path(
                config('media-removable.path') . "dummy.jpg"
            )
        );
    }

    private function dummyWithPathData()
    {
        DummyWithMediaFields::create(['image' => "dummy_with_path.jpg"]);
        File::copy(
            __DIR__ . "/test.jpg",
            base_path(
                DummyWithMediaFieldsAndMediaPath::$mediaPath . "dummy_with_path.jpg"
            )
        );
    }

    private function dummyWithExceptionData()
    {
        DummyWithMediaFields::create(['image' => "dummy_with_exception.jpg"]);
        File::copy(
            __DIR__ . "/test.jpg",
            base_path(
                config('media-removable.path') . "dummy_with_exception.jpg"
            )
        );
    }

    private function dummyWithMediaDetailsData()
    {
        DummyWithMediaFields::create(['image' => "dummy_with_media_details.jpg"]);
        File::copy(
            __DIR__ . "/test.jpg",
            base_path(
                DummyWithMediaDetails::$mediaDetails[0]['path'] . "dummy_with_media_details.jpg"
            )
        );
    }

    private function dummyWithMediaDetailsInConfigData()
    {
        DummyWithMediaFields::create(['image' => "dummy_with_media_details_in_config.jpg"]);
        File::copy(
            __DIR__ . "/test.jpg",
            base_path(
                "storage/app/public/dummy_with_media_details_in_config.jpg"
            )
        );
    }

    private function dummyWithNullableImageField()
    {
        DummyWithNullableImageField::create(['image' => NULL]);
    }
}

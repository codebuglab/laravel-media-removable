<?php

namespace CodeBugLab\MediaRemovable;
use Illuminate\Support\ServiceProvider;

class MediaRemovableServiceProvider extends ServiceProvider{

    public function boot(){
        $this->mergeConfigFrom(
            __DIR__ . '/config/media-removable.php',
            'media-removable'
        );

        $this->publishes([
            __DIR__ . '/config/media-removable.php' => config_path('media-removable.php')
        ]);
    }

    public function register(){

    }
}

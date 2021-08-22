<?php

namespace CodeBugLab\MediaRemovable;
use Illuminate\Support\ServiceProvider;

class MediaRemovableServiceProvider extends ServiceProvider{

    public function boot(){
        $this->mergeConfigFrom(
            __DIR__ . '/config/media_removable.php',
            'media_removable'
        );

        $this->publishes([
            __DIR__ . '/config/media_removable.php' => config_path('media_removable.php')
        ]);
    }

    public function register(){

    }
}

<?php

namespace Codebuglab\MediaRemovable;

trait MediaRemovable
{
    protected static function bootStorageRemovable()
    {
        static::deleted(function ($model) {
            foreach (self::getFields() as $file) {
                self::removeFile($model->{$file});
            }
        });

        static::updating(function ($model) {
            foreach (self::getFields() as $file) {
                if ($model->getOriginal($file) !== $model->{$file}) {
                    self::removeFile($model->getOriginal($file));
                }
            }
        });
    }

    private static function removeFile($fileName)
    {
        $filePath = base_path(self::getPath() . $fileName);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private static function getFields() {
        $fields = self::isExist(self::$mediaFields);
       if ($fields == null) {
           throw new MediaNotFoundException();
       }
        return $fields;
    }

    private static function getPath() {
        $path = self::isExist(config('media_removable.path'));
        $path = self::isExist(self::$mediaPath);
       if ($path == null) {
           throw new PathNotFoundException();
       }
        return $path;
    }

    private static function isExist($parameter) {
        if (isset($parameter)) {
            return $parameter;
        }
        return null;
    }
}

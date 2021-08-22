<?php

namespace CodeBugLab\MediaRemovable;

use CodeBugLab\MediaRemovable\Exceptions\MediaNotFoundException;
use CodeBugLab\MediaRemovable\Exceptions\PathNotFoundException;

trait MediaRemovable
{
    protected static function bootMediaRemovable()
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

    private static function getFields()
    {
        $fields = self::isExist(self::$mediaFields);
        if ($fields == null) {
            throw new MediaNotFoundException();
        }
        return $fields;
    }

    private static function getPath()
    {
        $path = isset(self::$mediaPath) ? self::isExist(self::$mediaPath) : self::isExist(config('media_removable.path'));
        if ($path == null) {
            throw new PathNotFoundException();
        }
        return $path;
    }

    private static function isExist($parameter)
    {
        if (isset($parameter)) {
            return $parameter;
        }
        return null;
    }
}

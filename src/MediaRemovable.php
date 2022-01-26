<?php

namespace CodeBugLab\MediaRemovable;

use CodeBugLab\MediaRemovable\Exceptions\MediaNotFoundException;
use CodeBugLab\MediaRemovable\Exceptions\PathNotFoundException;

trait MediaRemovable
{

    public static $mediaDetailsFields = NULL;

    public static $mediaDetailsPaths = NULL;

    protected static function bootMediaRemovable()
    {
        if (isset(self::$mediaDetails)) {
            self::setMediaDetailsFieldsAndPaths(self::$mediaDetails);
        }

        if (config('media-removable.details') !== null) {
            self::setMediaDetailsFieldsAndPaths(config('media-removable.details.' . self::getTableName()));
        }

        static::deleted(function ($model) {
            foreach (self::getFields() as $fileKey => $file) {
                if($model->getOriginal($file) == null) {
                    continue;
                }

                if (is_array(self::getPath())) {
                    self::removeFile(self::getPath()[$fileKey] . $model->{$file});
                } else {
                    self::removeFile(self::getPath() . $model->{$file});
                }
            }
        });

        static::updating(function ($model) {
            foreach (self::getFields() as $fileKey => $file) {
                if($model->getOriginal($file) == null) {
                    continue;
                }

                if ($model->getOriginal($file) !== $model->{$file}) {
                    if (is_array(self::getPath())) {
                        self::removeFile(self::getPath()[$fileKey] . $model->getOriginal($file));
                    } else {
                        self::removeFile(self::getPath() . $model->getOriginal($file));
                    }
                }
            }
        });
    }

    private static function getTableName()
    {
        return with(new static)->getTable();
    }

    private static function removeFile($fileName)
    {
        $filePath = base_path($fileName);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private static function getFields()
    {
        if (isset(self::$mediaDetailsFields)) {
            return self::$mediaDetailsFields;
        } elseif (isset(self::$mediaFields)) {
            return self::$mediaFields;
        } elseif (config('media-removable.fields') != null) {
            return config('media-removable.fields');
        }
        throw new MediaNotFoundException();
    }

    private static function getPath()
    {
        if (isset(self::$mediaDetailsPaths)) {
            return self::$mediaDetailsPaths;
        } elseif (isset(self::$mediaPath)) {
            return self::$mediaPath;
        } elseif (config('media-removable.path') != null) {
            return config('media-removable.path');
        }
        throw new PathNotFoundException();
    }

    private static function setMediaDetailsFieldsAndPaths($data)
    {
        if (isset($data)) {
            foreach ($data as $detail) {
                self::$mediaDetailsFields[] = $detail['field'];
                self::$mediaDetailsPaths[] = $detail['path'];
            }
        }
    }
}

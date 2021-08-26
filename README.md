# ⚡⚡⚡ Laravel Media Removable

Automatically remove media like images, videos, and audios from storage folder once record with media deleted or updated from database

<!-- [![Issues](https://img.shields.io/github/issues/codebuglab/laravel-media-removable)](https://github.com/codebuglab/laravel-media-removable/issues)
[![Forks](https://img.shields.io/github/forks/codebuglab/laravel-media-removable)](https://github.com/codebuglab/laravel-media-removable/network/members)
[![Stars](https://img.shields.io/github/stars/codebuglab/laravel-media-removable)](https://github.com/codebuglab/laravel-media-removable/stargazers)
[![Download](https://img.shields.io/packagist/dt/codebuglab/laravel-media-removable)](https://packagist.org/packages/codebuglab/laravel-media-removable)
[![License](https://img.shields.io/github/license/codebuglab/laravel-media-removable)](https://github.com/codebuglab/laravel-media-removable/blob/main/LICENCE) -->

![Laravel media removable](logo.png)

## Table of contents
- [Setup](#setup)
    - [Installation](#installation)
    - [Publish](#publish)
- [Instructions](#Instructions)
    - [Using The Model](#using-the-model)
    - [Using Config File](#using-config-file)
    - [Important Notice](#important-notice)
- [Testing](#testing)
- [License](#license)

## Setup
### Installation

To install this package through composer run the following command in the terminal

```bash
composer require codebuglab/laravel-media-removable
```

### Publish
You have to publish config file with this artisan command:
```bash
php artisan vendor:publish --provider="CodeBugLab\MediaRemovable\MediaRemovableServiceProvider"
```
- File `media-removable.php` will be publish in `config` folder after that.


## Instructions
Here is multiple ways to use this package to delete media files from your project during updating and deleting database row using eloquent.

- You have to use the trait `CodeBugLab\MediaRemovable\MediaRemovable`
### Using The Model
- To use model method all you have to do is to add a private static parameter `mediaField`
- if you don't add `mediaField` automatically the package will throw and exception.

```php
use CodeBugLab\MediaRemovable\MediaRemovable;

class MyModel extends Eloquent
{
    use MediaRemovable;

    private static $mediaFields = ['image']; //image is column_name you want to delete

}
 ```
- by using the method the package will determine files path from config file which already set at `config\media_removable.php`
- if you want to change file path for all the project you can change it from config file or use the private method `mediaPath` like this
 ```php
use CodeBugLab\MediaRemovable\MediaRemovable;

class MyModel extends Eloquent
{
    use MediaRemovable;

    private static $mediaFields = ['image']; //image is column_name you want to delete

    private static $mediaPath = "storage/app/public/"; //The path of you media files
}
```
- If you have a complex structure to your media files in your application you can use the private method `mediaDetails` instead
 ```php
use CodeBugLab\MediaRemovable\MediaRemovable;

class MyModel extends Eloquent
{
    use MediaRemovable;

    // set all columns and paths for this model
    public static $mediaDetails = [
        [
            'field' => 'image',
            'path' => 'storage/app/public/images/'
        ],
        [
            'field' => 'profile_picture',
            'path' => 'storage/app/public/profile/'
        ],
    ];
}
```
- Here you can determine every column folder path individually.

### Using Config File
- Alternatively you can use the config file to set all your media details instead of the model.
- keep using `MediaRemovable` trait. 

```php
use CodeBugLab\MediaRemovable\MediaRemovable;

class MyModel extends Eloquent
{
    use MediaRemovable;
}
```
- And then set change your config file as you want
```php
return [
    'path' => 'storage/app/public/',
    'fields' => ['image']
];
```
- The above code expect field `image` in all models used `MediaRemovable` trait, We don't think it's a practical way but we keep it if someone need it.
- If you have move details than that you can use `details` instead.
```php
return [
    'details' => [
        'table_name' => [
            [
                'field' => 'field_name',
                'path' => 'storage/app/public/directory/'
            ],
            [
                'field' => 'another_field_name',
                'path' => 'storage/app/public/another_directory/'
            ]
        ], 
        'another_table_name' => [
            [
                'field' => 'image',
                'path' => 'storage/app/public/'
            ]
        ]
    ]
];
```
- Inside `details` array we use table name to track model details.
- You can set multiple `tables` and `fields` as you can see, this way will make the model much cleaner specially if you have multiple fields.

### Important Notice
- The priority in this package is for `config` file information so if you set information to your `config` and your `model`, the `model` information will be overwrite by `config` information so be carful with that.

## Testing

To run test use this command `vendor/bin/phpunit`

## License

This package is a free software distributed under the terms of the MIT license.

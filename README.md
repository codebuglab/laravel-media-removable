# ⚡⚡⚡ Laravel Media Removable

Automatically remove media like images, videos, and audios from storage folder once record with media deleted or updated from database

<!-- [![Issues](https://img.shields.io/github/issues/codebuglab/laravel-go-translate)](https://github.com/codebuglab/laravel-go-translate/issues)
[![Forks](https://img.shields.io/github/forks/codebuglab/laravel-go-translate)](https://github.com/codebuglab/laravel-go-translate/network/members)
[![Stars](https://img.shields.io/github/stars/codebuglab/laravel-go-translate)](https://github.com/codebuglab/laravel-go-translate/stargazers)
[![Download](https://img.shields.io/packagist/dt/codebuglab/laravel-go-translate)](https://packagist.org/packages/codebuglab/laravel-go-translate)
[![License](https://img.shields.io/github/license/codebuglab/laravel-go-translate)](https://github.com/codebuglab/laravel-go-translate/blob/main/LICENCE) -->

![Laravel media removable](logo.png)

## Table of contents <!-- omit in toc -->

- [Installation](#installation)
- [Instructions](#Instructions)
- [License](#license)

## Installation

To install this package through composer run the following command in the terminal

```bash
composer require codebuglab/laravel-media-removable
```
<!-- - This package can translate laravel project by multiple ways from `php` or `json` files -->

## Instructions

In your model you should add 
```
 use StorageRemovable;
 ```
```
 private static $mediaFields = ['image']; //image is column_name you want to delete
 ```
 ```
 private static $mediaPath = "storage/app/public/"; //The path of you media
```


## License

This package is a free software distributed under the terms of the MIT license.

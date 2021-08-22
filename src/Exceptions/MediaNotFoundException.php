<?php

namespace CodeBugLab\MediaRemovable\Exceptions;

use Exception;

class MediaNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = "Media Not Found";

    /**
     * @var int
     */
    protected $code    = 1;
}

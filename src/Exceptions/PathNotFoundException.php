<?php

namespace CodeBugLab\MediaRemovable\Exceptions;

use Exception;

class PathNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = "Path Not Found";

    /**
     * @var int
     */
    protected $code    = 1;
}

<?php
namespace LUMASERV;

class S3AccessGrantCreateRequest {
    /**
     * @var string
     */
    public $bucket_id;
    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $role;
    /**
     * @var object
     */
    public $labels;
}


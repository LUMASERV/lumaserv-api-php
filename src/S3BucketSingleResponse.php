<?php
namespace LUMASERV;

class S3BucketSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3Bucket
     */
    public $data;
    /**
     * @var bool
     */
    public $success;
    /**
     * @var ResponseMessages
     */
    public $messages;
}


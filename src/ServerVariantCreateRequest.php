<?php
namespace LUMASERV;

class ServerVariantCreateRequest {
    /**
     * @var string[]
     */
    public $zone_ids;
    /**
     * @var int
     */
    public $disk;
    /**
     * @var int
     */
    public $cores;
    /**
     * @var int
     */
    public $memory;
    /**
     * @var bool
     */
    public $legacy;
    /**
     * @var string
     */
    public $storage_class_id;
    /**
     * @var string
     */
    public $title;
}


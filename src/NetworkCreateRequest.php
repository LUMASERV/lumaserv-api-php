<?php
namespace LUMASERV;

class NetworkCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var int
     */
    public $tag;
    /**
     * @var string
     */
    public $title;
    /**
     * @var NetworkType
     */
    public $type;
}


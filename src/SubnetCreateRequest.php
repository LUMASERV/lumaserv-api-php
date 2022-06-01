<?php
namespace LUMASERV;

class SubnetCreateRequest {
    /**
     * @var bool
     */
    public $shared;
    /**
     * @var string
     */
    public $network_id;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var int
     */
    public $prefix;
    /**
     * @var string
     */
    public $range;
}


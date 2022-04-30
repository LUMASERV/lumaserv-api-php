<?php
namespace LUMASERV;

class SubnetCreateRequest {
    /**
     * @var string
     */
    public $network_id;
    /**
     * @var string
     */
    public $address;
    /**
     * @var bool
     */
    public $public;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var int
     */
    public $prefix;
}


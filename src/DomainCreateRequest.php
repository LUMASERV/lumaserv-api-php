<?php
namespace LUMASERV;

class DomainCreateRequest {
    /**
     * @var int
     */
    public $duration;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $admin_handle_code;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $owner_handle_code;
    /**
     * @var string
     */
    public $tech_handle_code;
    /**
     * @var DomainRequestNameserver[]
     */
    public $nameserver;
    /**
     * @var string
     */
    public $authinfo;
    /**
     * @var string
     */
    public $zone_handle_code;
    /**
     * @var object
     */
    public $labels;
}


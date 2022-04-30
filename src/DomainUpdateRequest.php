<?php
namespace LUMASERV;

class DomainUpdateRequest {
    /**
     * @var string
     */
    public $admin_handle_code;
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
    public $zone_handle_code;
    /**
     * @var object
     */
    public $labels;
}


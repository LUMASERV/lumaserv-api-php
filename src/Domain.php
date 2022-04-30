<?php
namespace LUMASERV;

class Domain {
    /**
     * @var string
     */
    public $registered_at;
    /**
     * @var string
     */
    public $admin_handle_code;
    /**
     * @var string
     */
    public $tech_handle_code;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $suspended_until;
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
    public $expire_at;
    /**
     * @var string
     */
    public $zone_handle_code;
    /**
     * @var DomainStatus
     */
    public $status;
    /**
     * @var string
     */
    public $suspended_at;
}


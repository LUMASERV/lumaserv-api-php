<?php
namespace LUMASERV;

class AuditLogEntry {
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $token_id;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $object_type;
    /**
     * @var object
     */
    public $context;
    /**
     * @var string
     */
    public $action;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $ip_address;
    /**
     * @var string
     */
    public $object_id;
}


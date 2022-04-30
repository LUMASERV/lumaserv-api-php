<?php
namespace LUMASERV;

class ServerCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $backup_id;
    /**
     * @var string
     */
    public $variant_id;
    /**
     * @var string[]
     */
    public $ssh_keys;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $template_id;
    /**
     * @var ServerCreateRequestNetwork[]
     */
    public $networks;
    /**
     * @var object
     */
    public $labels;
}


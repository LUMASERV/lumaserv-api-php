<?php
namespace LUMASERV;

class Server {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var Address[]
     */
    public $addresses;
    /**
     * @var string
     */
    public $variant_id;
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
    public $media_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $template_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerState
     */
    public $state;
    /**
     * @var object
     */
    public $labels;
}


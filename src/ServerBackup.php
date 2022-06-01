<?php
namespace LUMASERV;

class ServerBackup {
    /**
     * @var float
     */
    public $size;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $action_id;
    /**
     * @var bool
     */
    public $scheduled;
    /**
     * @var bool
     */
    public $keep;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerBackupState
     */
    public $state;
    /**
     * @var string
     */
    public $title;
}


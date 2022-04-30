<?php
namespace LUMASERV;

class ScheduledServerAction {
    /**
     * @var string
     */
    public $backup_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var ScheduledServerActionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $execute_at;
    /**
     * @var string
     */
    public $server_id;
    /**
     * @var ServerActionType
     */
    public $type;
}


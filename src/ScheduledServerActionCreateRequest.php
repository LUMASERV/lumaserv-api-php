<?php
namespace LUMASERV;

class ScheduledServerActionCreateRequest {
    /**
     * @var string
     */
    public $backup_id;
    /**
     * @var int
     */
    public $backup_retention;
    /**
     * @var ScheduledServerActionInterval
     */
    public $interval;
    /**
     * @var bool
     */
    public $force;
    /**
     * @var string
     */
    public $execute_at;
    /**
     * @var ServerActionType
     */
    public $type;
}


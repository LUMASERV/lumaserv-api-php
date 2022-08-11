<?php
namespace LUMASERV;

class ScheduledServerActionUpdateRequest {
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
     * @var ServerActionType
     */
    public $type;
}


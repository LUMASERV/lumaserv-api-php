<?php
namespace LUMASERV;

class ServerAction {
    /**
     * @var float
     */
    public $progress;
    /**
     * @var string
     */
    public $started_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerActionState
     */
    public $state;
    /**
     * @var ServerActionType
     */
    public $type;
    /**
     * @var bool
     */
    public $cancellable;
    /**
     * @var string
     */
    public $ended_at;
}


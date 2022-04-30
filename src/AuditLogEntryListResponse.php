<?php
namespace LUMASERV;

class AuditLogEntryListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var AuditLogEntry[]
     */
    public $data;
    /**
     * @var bool
     */
    public $success;
    /**
     * @var ResponseMessages
     */
    public $messages;
}


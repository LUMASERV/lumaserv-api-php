<?php
namespace LUMASERV;

class AuditLogEntryListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
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


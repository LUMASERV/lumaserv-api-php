<?php
namespace LUMASERV;

class CustomerSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var CustomerDetailed
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


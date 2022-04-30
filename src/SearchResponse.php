<?php
namespace LUMASERV;

class SearchResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SearchResults
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


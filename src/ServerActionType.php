<?php
namespace LUMASERV;

abstract class ServerActionType {
    const START = "START";
    const SHUTDOWN = "SHUTDOWN";
    const STOP = "STOP";
    const RESIZE = "RESIZE";
}


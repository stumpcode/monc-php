<?php


class FileLock {

    private $fname;
    public $handle;

    function __construct($fname, $mode = null) {
        if (substr($fname, 0, 1) != '/') {
            $fname = app()->runtimePath . '/lock/' . $fname;
        }
        !$mode && $mode = 'wb+';
        $this->fname = $fname;
        $this->handle = fopen($fname, $mode);
    }

    function trylock() {
        return flock($this->handle, LOCK_EX);
    }

    function release() {
        flock($this->handle, LOCK_UN);
    }

    function close() {
        fclose($this->handle);
    }
}

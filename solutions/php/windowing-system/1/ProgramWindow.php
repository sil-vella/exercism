<?php

class ProgramWindow
{
    public $width;
    public $height;
    public $x;
    public $y;

    public function resize($size) {
        $this->width = $size->width;
        $this->height = $size->height;
    }

    function __construct() {
        $this->width = 800;
        $this->height = 600;
        $this->x = 0;
        $this->y = 0;
    }

}

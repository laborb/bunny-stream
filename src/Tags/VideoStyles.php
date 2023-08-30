<?php

namespace Laborb\BunnyStream\Tags;
 
class VideoStyles extends \Statamic\Tags\Tags
{
    protected static $handle = 'video_styles';

    public function css() {
        return '<link href="https://laborb.b-cdn.net/bunny-stream-assets/videojs.css" rel="stylesheet" />';
    }

    public function js() {
       return '<script src="https://laborb.b-cdn.net/bunny-stream-assets/video.min.js"></script>';
    }
}
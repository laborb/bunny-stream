<?php

namespace Laborb\BunnyStream\Tags;

class VideoStyles extends \Statamic\Tags\Tags
{
    protected static $handle = 'video_styles';

    public function css()
    {
        return '<link href="https://cdn.laborb.de/bunny-stream-assets/videojs-8-11-4.min.css" rel="stylesheet" />';
    }

    public function js()
    {
        return '<script src="https://cdn.laborb.de/bunny-stream-assets/video-8-11-4.min.js"></script>';
    }
}

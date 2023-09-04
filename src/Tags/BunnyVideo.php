<?php

namespace Laborb\BunnyStream\Tags;
 
class BunnyVideo extends \Statamic\Tags\Tags
{
    protected static $handle = 'video';

    public function index()
    {
        $data = [
            'id' => $this->params->get('id'),
            'source' => 'https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/playlist.m3u8',
            'class' => $this->getClasses(),
            'controls' => $this->params->bool('controls', true),
            'width' => $this->params->get('width'),
            'height' => $this->params->get('height'),
            'poster' => 'https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/thumbnail.jpg',
            'autoplay' => !$this->params->bool('controls', true),
        ];

        return view('bunny::video', $data);
    }

    public function getClasses()
    {
        $classes = 'video-js';

        if ($this->params->bool('responsive', true)) {
            $classes .= ' vjs-fluid';
        }

        if ($this->params->get('ratio') == '16/9') {
            $classes .= ' vjs-16-9';
        }

        if ($this->params->get('ratio') == '4/3') {
            $classes .= ' vjs-4-3';
        }

        if ($this->params->get('ratio') == '9/16') {
            $classes .= ' vjs-9-16';
        }

        if ($this->params->get('ratio') == '1/1') {
            $classes .= ' vjs-1-1';
        }

        return $classes . ' ' . $this->params->get('class');
    }
}
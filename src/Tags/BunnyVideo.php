<?php

namespace Laborb\BunnyStream\Tags;
 
class BunnyVideo extends \Statamic\Tags\Tags
{
    protected static $handle = 'video';

    public function index()
    {
        $video = '<video
                id="' . $this->params->get('id') . '"
                class="' . $this->getClasses() . '"
                ' . $this->getControls() . ' 
                preload="auto"
                width="' . $this->params->get('width') . '"
                height="' . $this->params->get('height') . '"
                poster="https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/thumbnail.jpg"
                data-setup="{}"
                >
                    <source
                        src="https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/playlist.m3u8"
                        type="application/x-mpegURL">
                <p class="vjs-no-js">
                    Um dieses Video zu sehen wird JavaScript benötigt und ein Browser, der
                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >HTML5 Videos unterstützt.</a
                    >
                </p>
            </video>';

        $script = '';

        if (!$this->params->bool('controls', true)) {
            $script = "<script> var playPromise = document.getElementById('".$this->params->get('id')."'); setTimeout(function () { playPromise.play(); }, 150); </script>";
        }

        return $video . $script;
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

        return $classes;
    }

    public function getControls()
    {
        if (!$this->params->bool('controls', true)) {
            return 'muted autoplay loop';
        }

        return 'controls';
    }
}
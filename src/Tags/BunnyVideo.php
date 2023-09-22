<?php

namespace Laborb\BunnyStream\Tags;

use Illuminate\Support\Facades\Http;
 
class BunnyVideo extends \Statamic\Tags\Tags
{
    protected static $handle = 'bunny_video';

    public function index()
    {
        $request = $this->getVideo($this->params->get('id'));

        if ($request->status() != 200) {
            return 'Video not found';
        }

        $video = $request->json();

        $data = [
            'id' => $this->params->get('id'),
            'source' => 'https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/playlist.m3u8',
            'class' => $this->getClasses(),
            'controls' => $this->params->bool('controls', true),
            'width' => $this->params->get('width'),
            'height' => $this->params->get('height'),
            'poster' => 'https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/' . $video['thumbnailFileName'],
            'autoplay' => !$this->params->bool('controls', true),
        ];

        return view('bunny::video', $data);
    }

    public function thumbnail()
    {
        $request = $this->getVideo($this->params->get('id'));

        if ($request->status() != 200) {
            return 'Video not found';
        }

        $video = $request->json();

        return 'https://' . config('statamic.bunny.hostname') . '/' . $this->params->get('id') . '/' . $video['thumbnailFileName'];
    }

    private function getVideo($videoId) {
        return Http::withHeaders([
            'accept' => 'application/json',
            'AccessKey' => config('statamic.bunny.apiKey')
        ])->get('https://video.bunnycdn.com/library/' . config('statamic.bunny.libraryId') . '/videos/' . $videoId);
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
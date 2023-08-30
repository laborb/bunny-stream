<?php

namespace Laborb\BunnyStream\Fieldtypes;
 
class Bunny extends \Statamic\Fields\Fieldtype
{
    protected $icon = 'video';

    public function preload()
    {
        return [
            'api' => config('statamic.bunny.apiKey'),
            'library' => config('statamic.bunny.libraryId'),
            'hostname' => config('statamic.bunny.hostname'),
        ];
    }
}
<?php

/*
 *  Configure your bunny.net stream credentials
 *
 */

return [
    "libraryId" => env("BUNNY_LIBRARY_ID", null),
    "apiKey" => env("BUNNY_API_KEY", null),
    "hostname" => env("BUNNY_CDN_HOSTNAME", null),
    "play_url" => env("BUNNY_PLAY_URL", "play"),
];

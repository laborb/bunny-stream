<?php

namespace Laborb\BunnyStream\Http\Controllers\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlayController
{
    public function index(Request $request, string $videoId)
    {
        $video = $this->getVideo($videoId);

        if ($video->status() != 200) {
            return response("Video not found", 404);
        }

        $video = $video->json();

        $data = [
            "id" => $videoId,
            "source" =>
                "https://" .
                config("statamic.bunny.hostname") .
                "/" .
                $videoId .
                "/playlist.m3u8",
            "color" => $request->get("color") ?? "333",
            "poster" =>
                "https://" .
                config("statamic.bunny.hostname") .
                "/" .
                $videoId .
                "/" .
                $video["thumbnailFileName"],
            "title" => $video["title"],
        ];

        return view("bunny::public.play", $data);
    }

    public function embed(Request $request, string $videoId)
    {
        $video = $this->getVideo($videoId);

        if ($video->status() != 200) {
            return response("Video not found", 404);
        }

        $video = $video->json();

        $data = [
            "id" => $videoId,
            "source" =>
                "https://" .
                config("statamic.bunny.hostname") .
                "/" .
                $videoId .
                "/playlist.m3u8",
            "color" => $request->get("color") ?? "333",
            "poster" =>
                "https://" .
                config("statamic.bunny.hostname") .
                "/" .
                $videoId .
                "/" .
                $video["thumbnailFileName"],
            "title" => $video["title"],
        ];

        return view("bunny::public.embed", $data);
    }

    public function links()
    {
        return response()->json([
            "directPlayUrl" => url(config("statamic.bunny.play_url")),
            "embedUrl" => url(config("statamic.bunny.embed_url")),
        ]);
    }

    private function getVideo($videoId)
    {
        return Http::withHeaders([
            "accept" => "application/json",
            "AccessKey" => config("statamic.bunny.apiKey"),
        ])->get(
            "https://video.bunnycdn.com/library/" .
                config("statamic.bunny.libraryId") .
                "/videos/" .
                $videoId
        );
    }
}

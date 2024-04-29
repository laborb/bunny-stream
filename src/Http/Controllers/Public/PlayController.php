<?php

namespace Laborb\BunnyStream\Http\Controllers\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlayController
{
    public function index(Request $request, string $videoId)
    {
        $videoData = $this->getVideo($request, $videoId);

        return view("bunny::public.play", $videoData);
    }

    public function embed(Request $request, string $videoId)
    {
        $videoData = $this->getVideo($request, $videoId);

        return view("bunny::public.embed", $videoData);
    }

    public function links()
    {
        return response()->json([
            "directPlayUrl" => url(config("statamic.bunny.play_url")),
            "embedUrl" => url(config("statamic.bunny.embed_url")),
        ]);
    }

    private function getVideo(Request $request, $videoId): array
    {
        $video = Http::withHeaders([
            "accept" => "application/json",
            "AccessKey" => config("statamic.bunny.apiKey"),
        ])->get(
            "https://video.bunnycdn.com/library/" .
                config("statamic.bunny.libraryId") .
                "/videos/" .
                $videoId
        );

        if ($video->status() != 200) {
            return response("Video not found", 404);
        }

        $video = $video->json();

        return [
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
            "embedUrl" => route("bunny.public.embed", ["videoId" => $videoId]),
        ];
    }
}

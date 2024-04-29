<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.laborb.de/bunny-stream-assets/plyr-3-7-8.css" rel="stylesheet" />

        <title>{{ $title }}</title>

        <meta property="og:url" content="{{ $embedUrl }}" />
        <meta property="og:image" content="{{ $poster }}" />
        <meta property="og:image:secure_url" content="{{ $poster }}" />
        <meta property="og:site_name" content="{{ request()->root() }}" />
        <meta property="og:title" content="{{ $title }}" />
        <meta property="og:description" content="" />
        <meta property="og:type" content="video.other" />

        <meta property="og:video:url" content="{{ $source }}" />
        <meta property="og:video:secure_url" content="{{ $source }}" />

        <meta property="og:video:type" content="text/html" />
        <meta property="og:video:width" content="1920">
        <meta property="og:video:height" content="1080">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="player">
        <meta property="twitter:domain" content="{{ request()->root() }}">
        <meta property="twitter:url" content="{{ $embedUrl }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="">
        <meta name="twitter:image" content="{{ $poster }}">
        <meta name="twitter:player" content="{{ $embedUrl }}">
        <meta name="twitter:player:width" content="1920">
        <meta name="twitter:player:height" content="1080">

        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "VideoObject",
              "name": "{{ $title }}",
              "description": "",
              "thumbnailUrl": "{{ $poster }}",
              "embedUrl": "{{ $embedUrl }}"
            }
        </script>

        <style>
	        html, body {
	     	    background-color: #{{{ $color }}};
			    font-family: 'Rubik', sans-serif;
			    display: flex;
			    align-items: center;
			    justify-content: center;
				width: 100%;
			    height: 100%;
			    margin: 0;
			    padding: 0;
			    box-sizing: border-box;
	        }

	        .wrapper {
			    box-sizing: border-box;
			    width: calc((100vh -(2* 2em))* 1);
			    padding: 2em;
			    margin-top: -6px;
			    margin-left: auto;
			    margin-right: auto;
			    max-width: 1280px;
	        }
        </style>
    </head>
    <body>
    	<div class="wrapper">
		    <video id="{{ $id }}" style="--plyr-color-main: #{{ $color }};" preload="auto" poster="{{ $poster }}" crossorigin>
		        <source src="{{ $source }}" type="application/x-mpegURL">
		    </video>
		</div>
        <script src="https://cdn.laborb.de/bunny-stream-assets/plyr-3-7-8.js"></script>
        <script src="https://cdn.laborb.de/bunny-stream-assets/hls.js"></script>
        <script>
		    document.addEventListener('DOMContentLoaded', () => {
			const source = '{{ $source }}';
			const video = document.getElementById('{{ $id }}');

			// For more options see: https://github.com/sampotts/plyr/#options
			// captions.update is required for captions to work with hls.js
			const player = new Plyr(video, {captions: {active: false}});

			if (!Hls.isSupported()) {
				video.src = source;
			} else {
				// For more Hls.js options, see https://github.com/dailymotion/hls.js
				const hls = new Hls({ startLevel: 4 });
				hls.loadSource(source);
				hls.attachMedia(video);
				window.hls = hls;
			}

			// Expose player so it can be used from the console
			window.player = player;
		    });
	    </script>
    </body>
</html>

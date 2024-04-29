<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.laborb.de/bunny-stream-assets/plyr-3-7-8.css" rel="stylesheet" />

        <title>{{ $title }}</title>

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
	        	margin: 0;
	            padding: 0;
	            overflow: hidden;
	            width: 100%;
	            height: 100%;
	            background-color: transparent;
	            font-family: 'Rubik', sans-serif;
	        }

	        .container {
	        	width: 100%;
	            height: 100%;
	        }

			video {
	        	width: 100%;
	            height: 100%;
	        }
        </style>
    </head>
    <body>
    	<div class="container" style="margin-top: 0px;">
		    <video id="{{ $id }}" style="--plyr-color-main: {{ $color }};" preload="auto" poster="{{ $poster }}" crossorigin>
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

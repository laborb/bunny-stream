
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta name="description" content="" />

<meta property="og:url" content="{{ $embedUrl }}" />
<meta property="og:image" content="{{ $poster }}" />
<meta property="og:image:secure_url" content="{{ $poster }}" />
<meta property="og:site_name" content="bunny.net" />
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
<meta property="twitter:domain" content="bunny.net">
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

    <link rel="stylesheet" href="https://assets.mediadelivery.net/play.css">
    <style>
        .wrapper {
            --video-aspect-ratio: 1;
            --padding: 2em;
            box-sizing: border-box;
            width: calc((100vh - (2 * var(--padding))) * var(--video-aspect-ratio));
            padding: var(--padding);
            margin-top: -6px;
            margin-left: auto;
            margin-right: auto;
            max-width: 1280px;
        }
    </style>
</head>
<body id="body">
    <div class="wrapper" id="video-wrapper">
        <div class="container">
            <iframe src="{{ $embedUrl }}" loading="lazy" style="border: none;" allowfullscreen="true" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"></iframe>
        </div>
    </div>
</body>
</html>

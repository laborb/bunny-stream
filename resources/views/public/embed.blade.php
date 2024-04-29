
<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
    <!--@formatter:off -->
<script src="https://assets.mediadelivery.net/castjs/5.2.0/cast.min.js"></script>
<link href="https://assets.mediadelivery.net/rubik.css" rel="stylesheet">
<script src="https://assets.mediadelivery.net/hls/1.5.4/hls.min.js"></script>

<script src="https://assets.mediadelivery.net/rum.js"></script>

<script src="https://assets.mediadelivery.net/plyr/3.7.3.2/plyr.polyfilled.min.js"></script>
<script src="https://assets.mediadelivery.net/plyr-plugin-thumbnail.js"></script>
<script src="https://assets.mediadelivery.net/session-tracker.js"></script>
<script src="https://assets.mediadelivery.net/jquery/jquery-3.7.1.min.js" type="text/javascript"></script>
<script src="https://assets.mediadelivery.net/chartist.min.js" type="text/javascript"></script>
<script src="https://assets.mediadelivery.net/plyr-vr.js" type="text/javascript"></script>
<link href="https://assets.mediadelivery.net/plyr/3.7.3.2/plyr.css" rel="stylesheet">
<link href="https://assets.mediadelivery.net/plyr-vr.css" rel="stylesheet">
<script src="https://assets.mediadelivery.net/pb.js?v=1"></script>
<link href="https://assets.mediadelivery.net/pb.css?v=1" rel="stylesheet">
<script src="https://assets.mediadelivery.net/playerjs/pjs-implementation.js" type="text/javascript"></script>
<script src="https://assets.mediadelivery.net/playerjs/player-0.1.0.min.js" type="text/javascript"></script>

<link href="https://fonts.bunny.net/css?family=Rubik" rel="stylesheet" />


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta name="description" content="" />

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
    * {
        user-select: none; /* supported by Chrome and Opera */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    :root {
        --plyr-color-main: #{{ $color }};
        --plyr-video-background: transparent;
        --plyr-captions-background: #000;
        --plyr-captions-text-color: #fff;
        --plyr-font-weight-regular: 600;
        --plyr-font-weight-bold: 600;

        --plyr-font-family: 'Rubik';

        --webkit-text-track-display: none;
        --plyr-font-size-xlarge: 30px;
    }
    html, body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }
    body {
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

    .plyr__poster {
        background-size: cover;
    }

    .plyr__control--overlaid {
        background: #{{ $color }};
        box-shadow: #4a4a4a20 0 0 27px;
    }

    .plyr--video {
	    height: 100%;
    }

    .plyr--video .plyr__control.plyr__tab-focus,
    .plyr--video .plyr__control:hover,
    .plyr--video .plyr__control[aria-expanded=true] {
        background: #{{ $color }};
    }

    .plyr__control.plyr__tab-focus {
	    box-shadow: 0 0 0 5px rgba(255,0,0, .5);
    }

    .plyr__menu__container .plyr__control[role=menuitemradio][aria-checked=true]::before {
	    background: #{{ $color }};
    }

    [data-plyr="captions"].plyr__control {
        border-bottom: solid 3px transparent;
    }

    [data-plyr="captions"].plyr__control--pressed {
        border-bottom: solid 3px #{{ $color }};
    }

    .plyr__captions {
        font-size: 20px;
    }

    @media (max-width: 479px) {
        .plyr__captions {
		    font-size: 18px;
	    }
    }
    @media (min-width: 480px) {
        .plyr__captions {
		    font-size: 18px;
	    }
    }
    @media (min-width: 768px) {
        .plyr__captions {
		    font-size: 23px;
	    }
    }
    @media (min-width: 1024px) {
        .plyr__captions {
		    font-size: 26px;
	    }
    }

    .plyr__progress input {
        border-radius: 0px !important;
        -webkit-appearance: none;
        background: transparent;
    }
        .plyr__progress input[value]::-webkit-progress-bar {
            border-radius: 0px !important;
        }
        .plyr__progress input[value]::-webkit-progress-value {
            border-radius: 0px !important;
        }

    .plyr audio, .plyr iframe, .plyr video {
        max-height: 100vh;
    }
    .plyr__spacer {
        width: 100%;
    }
    .plyr__progress__container {
        position: absolute;
        top: 14px;
        left: 10px;
        width: calc(100% - 24px);
    }
    @media (max-width: 480px) {
        .plyr__progress__container {
            top: -5px;
        }
    }
    .wt-chart-active .ct-series-a .ct-area, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-slice-pie {
        fill: url(#gradient-active);
    }
    .ct-series-a .ct-area, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-slice-pie {
        fill: url(#gradient-a);
    }
    .ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
        stroke: #{{ $color }};
    }
    .plyr__pb {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        z-index: 3;
        margin-left: calc(var(--plyr-range-thumb-height, 13px)*-.5);
        margin-right: -6.5px;
        margin-right: calc(var(--plyr-range-thumb-height, 13px)*-.5);
        width: calc(100% + 13px);
        width: calc(100% + var(--plyr-range-thumb-height, 13px));
    }
    .plyr__preview-thumb {
	    bottom: 22px;
        transition: bottom ease 0.1s;
    }
    .plyr__controls {
        padding-top: 70px;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-webkit-slider-runnable-track{
        background-color: transparent !important;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-moz-range-track{
        background-color: transparent !important;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-ms-track{
        background-color: transparent !important;
    }

    .plyr__progress input {
        background-color: transparent !important;
        color: transparent !important;
        top: -6px !important;
        z-index: 7 !important;
        cursor: pointer;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-webkit-slider-thumb {
        opacity: 0;
        transition: opacity ease 0.1s;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-moz-range-thumb {
        opacity: 0;
        transition: opacity ease 0.1s;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-ms-thumb {
        opacity: 0;
        transition: opacity ease 0.1s;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-webkit-slider-thumb {
        opacity: 1;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-moz-range-thumb {
        opacity: 1;
    }
    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-ms-thumb {
        opacity: 1;
    }
    .plyr__menu__container {
        z-index: 10;
    }
    @media (min-width: 1280px) {
        .plyr--full-ui.plyr--video .plyr__control--overlaid {
            width: 60px;
            height: 60px;
        }
        .plyr__control svg {
            height: 21px;
            width: 21px;
        }
    }
    .plyr__control--overlaid svg {
        margin-left: auto;
        margin-right: auto;
    }
    .plyr__control--logo {
        height: auto;
        max-height: 23.5px;
        position: absolute;
        left: 44%;
        top: 37px;
        margin-left: -50px;
    }
    .plyr__tooltip--drag {
        opacity: 1;
        transform: translate(-50%) scale(1);
    }

    .plyr__controls__item[data-plyr="rewind"], .plyr__controls__item[data-plyr="fast-forward"] {
        padding: 4px;
    }
    .plyr__controls__item[data-plyr="rewind"] svg, .plyr__controls__item[data-plyr="fast-forward"] svg {
        height: 24px;
        height: var(--plyr-control-icon-size,24px);
        pointer-events: none;
        width: 24px;
        width: var(--plyr-control-icon-size,24px);
    }

    .plyr--full-ui ::-webkit-media-text-track-container {
        display: var(--webkit-text-track-display);
    }

    .disable-poster-transition .plyr__poster {
        transition: none;
    }

    /*workaround to fix safari bug with not showing video thumbnail:*/
    .plyr__video-wrapper {
        z-index: 0;
    }

    /* fix for vertical subtitles scrolling */
    .plyr__menu__container > div {
        max-height: 50vh;
        overflow-y: auto;
    }

    /* Fix for controls overlapping on small devices */
    @media only screen and (max-width: 500px) {
        .hide_mobile.plyr__spacer {
            display: none
        }
    }

    .plyr--is-ios .plyr__volume {
        min-width: 32px;
    }

    /* Chromecast */
    .chromecast-connected {

        opacity: 1;
    }

    .chromecast-disconnected {
        opacity: 0.5;
    }

    .error-message {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        text-align: center;
        color: #ccc;
        padding-top: 50px;
    }
</style>



</head>
<body id="body">
	<div class="container" id="video-container">
		<svg viewBox="0 0 0 0" style="height: 0; width: 0; display: block;">
			<defs>
				<linearGradient id="gradient-a" x2="0%" y2="100%">
					<stop offset="0%" stop-color="#abababaf"></stop>
					<stop offset="30%" stop-color="#ababab8f"></stop>
					<stop offset="70%" stop-color="#ababab5f"></stop>
					<stop offset="100%" stop-color="#ababab33"></stop>
				</linearGradient>
				<linearGradient id="gradient-active" x2="0%" y2="100%">
					<stop offset="0%" stop-color="#{{ $color }}af"></stop>
					<stop offset="30%" stop-color="#{{ $color }}8f"></stop>
					<stop offset="70%" stop-color="#{{ $color }}3f"></stop>
					<stop offset="100%" stop-color="#{{ $color }}13"></stop>
				</linearGradient>
			</defs>
		</svg>

		<video id="main-video" preload="auto" crossorigin autoplay none   data-plyr-config='{ "title": "{{ $title }}" }' playsinline data-poster="{{ $poster }}">
			<source src="{{ $source }}">
		</video>
	</div>
<script>
        var thumbnail_width = 300;

var seek_thumbnail_config = {
    enabled: true,
    pic_num: 50,// total thumbnail numbers
    width: thumbnail_width,// per thumbnail item width
    height: thumbnail_width * 9 / 16, // default height
    col: 6,// per thumbnail image columns
    row: 6,// per thumbnail image rows
    offsetX: 0,
    offsetY: 0,
    urls: [
        '{{ $poster }}',
    ]
}

function getSeekThumbnailHeight(imgWidth, imgHeight) {
    var aspectRatio = imgWidth / imgHeight;
    return Math.floor(thumbnail_width / aspectRatio);
}

var prevShowImage = null;
function setSeekThumbnailHeight(player) {
    if (prevShowImage || !player || !player.thumbnails)
        return;

    prevShowImage = player.thumbnails.showImage;

    player.thumbnails.showImage = function (previewImage, qualityIndex, thumbNum, thumbFilename, newImage) {
        if (previewImage.width > 0 && previewImage.height > 0)
            player.config.thumbnail.height = getSeekThumbnailHeight(previewImage.width, previewImage.height);
        prevShowImage.call(player.thumbnails, previewImage, qualityIndex, thumbNum, thumbFilename, newImage);
    }
}

var video_start_time = 0;
function setPlayerStartingPosition(player) {

    if (video_start_time > 0) {
        player.on('loadeddata', function (event) {
            var instance = event.detail.plyr;
            if (video_start_time <= instance.duration) {
                instance.off('loadeddata', event);
                instance.currentTime = video_start_time;
            }
        });
    }
}

	var errorEvents = {};
    function loadUrl(url, onFinished) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
					if (xmlhttp.status == 200) {
						onFinished(xmlhttp.responseText);
					}
				}
			};

			xmlhttp.open("GET", url, true);
			xmlhttp.send();
		}
		function IsMobile() {
			var check = false;
			(function (a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
			return check;
		}





	    document.addEventListener("DOMContentLoaded", async function () {
			var video = document.querySelector("video");
			var fragmentsLoaded = 0;
			var player = null;
            var isFairplay = false;
            var useFairplayInternalEngine= false;
            var useFairplayHlsJs= false;
			var isEntDrm = false;
			var playOriginal = false;
			var urlPlaylistUrl = '{{ $source }}';
			var isHlsSupported = (!isFairplay || useFairplayHlsJs) && Hls.isSupported();
			var source = video.getElementsByTagName("source")[0].src;
			var isAdPaused = false;
			var cjs = null;
			var isAirplayEnabled = true;



			function isChromecastConnected(){
				return cjs != null && cjs.connected;
			}

			function manageChromecastAvailableTrigger(cjs) {
				if (isEntDrm == false) {

                    $(".plyr__controls").append(($('<button class="plyr__controls__item plyr__control chromecast chromecast-disconnected"><svg aria-hidden="true" focusable="false"><use xlink:href="#chromecast"></use></svg></button>')));

                    $('.chromecast').click(function () {
						if (cjs.available) {
							if (cjs.connected) {
								cjs.disconnect();
							}
							else {
								var castUrl = urlPlaylistUrl;

								cjs.cast(castUrl, {
									poster: '{{ $poster }}',
									title: '{{ $title }}',
									subtitles: []
								})
							}
						}
					});
				}
			}

			function initChromecast() {
				cjs = new Castjs();

				cjs.on('error', function (e) { console.log('chromecast:' + e); });

                if (cjs.available) {
                    manageChromecastAvailableTrigger(cjs);
                }
                else {
                    cjs.on('available', function () {
                        manageChromecastAvailableTrigger(cjs);
                    });
				}

				cjs.on('event', function (e) {

					if (e == 'pause') {
						cjs.seek(player.currentTime);
					}
					else if (e == 'statechange') {
						switch (cjs.state) {
							case 'ended':
								cjs.disconnect();
								break;

							case 'connected':
                                $('.chromecast').addClass('chromecast-connected');
                                $('.chromecast').removeClass('chromecast-disconnected');
								break;

							case 'disconnected':
                                $('.chromecast').addClass('chromecast-disconnected');
                                $('.chromecast').removeClass('chromecast-connected');
								break;

							case 'playing':
								cjs.seek(player.currentTime);
								player.play();
								break;

							case 'timeupdate':
								player.isChromecastSeeked = true;
								player.currentTime = cjs._player.currentTime;
								break;

							case 'buffering':
								player.pause();
								cjs.seek(player.currentTime);
								break;
						}
					}
				})
			}

	        var defaultOptions = {
				storage: {
					enabled: true,
					key: 'plyr--lib-151629'
				},
				fullscreen: {
					enabled: true,
					fallback: true,
					iosNative: true
				},
				iconUrl: 'https://assets.mediadelivery.net/plyr/3.7.3.2/plyr.svg',
				captions: { active: false, language: '', update: true },
			    controls: [
				    "play-large","play","progress","current-time","mute","volume","settings","pip","airplay","fullscreen"
		        ],
                settings: ['quality', 'speed', 'loop'],
			    speed: { selected: 1, options: [0.5,0.75,1,1.25,1.5,1.75,2,4] },
			    i18n: {
    restart: 'Restart',
    rewind: 'Rewind {seektime}s',
    play: 'Play',
    pause: 'Pause',
    fastForward: 'Forward {seektime}s',
    seek: 'Seek',
    seekLabel: '{currentTime} of {duration}',
    played: 'Played',
    buffered: 'Buffered',
    currentTime: 'Current time',
    duration: 'Duration',
    volume: 'Volume',
    mute: 'Mute',
    unmute: 'Unmute',
    enableCaptions: 'Enable captions',
    disableCaptions: 'Disable captions',
    download: 'Download',
    enterFullscreen: 'Enter fullscreen',
    exitFullscreen: 'Exit fullscreen',
    frameTitle: 'Player for {title}',
    captions: 'Captions',
    settings: 'Settings',
    pip: 'PIP',
    menuBack: 'Go back to previous menu',
    speed: 'Speed',
    normal: 'Normal',
    quality: 'Quality',
    loop: 'Loop',
    start: 'Start',
    end: 'End',
    all: 'All',
    reset: 'Reset',
    disabled: 'Disabled',
    enabled: 'Enabled',
    advertisement: 'Ad',
    qualityBadge: {
      2160: '4K',
      1440: 'HD',
      1080: 'HD',
      720: 'HD',
      576: 'SD',
      480: 'SD',
    },
},
			    thumbnail: seek_thumbnail_config,

		    };

			function initPlayer() {
                // needed for displaying right direction of the captions
				player.elements.captions.dir = "auto";

				$('<div class="plyr__controls__item hide_mobile plyr__spacer"></div>').insertBefore(".plyr__progress__container");





				/* Heatmap Chart */



				$("video").on('webkitbeginfullscreen webkitendfullscreen', function (event) {
					if (event.type === 'webkitbeginfullscreen') {
						document.documentElement.style.setProperty('--webkit-text-track-display', 'block');
					} else {
						document.documentElement.style.setProperty('--webkit-text-track-display', 'none');
					}
				});

				/* VAST management */
				document.addEventListener('visibilitychange', function (e) {
                    if (!document.hidden && player.ads != null && player.ads.playing) {
                        player.ads.manager.resume();
					}
				});

				setPlayerStartingPosition(player);

				/* Session tracking */
				player.on("play", function () {


                    if (isChromecastConnected()) {
                        cjs.play();
                    }
				});

				player.on("pause", function () {
                    if (isChromecastConnected()) {
                        cjs.pause();
                    }
				});

				player.on("seeked", function () {
					if (isChromecastConnected()) {
                        if (player.isChromecastSeeked != null && !player.isChromecastSeeked) {
							cjs.seek(player.currentTime);
						}
                        player.isChromecastSeeked = false;
					}
				});

				player.on("languagechange", function (e) {
					if (isChromecastConnected()) {
						cjs.subtitle(e.detail.plyr.captions.currentTrack);
					}
				});

				/* VR */


				/* Progress bar */
				var scrubbingPaused = false;
				var isMobile = IsMobile();
				$(".plyr__progress__container input").css("top", "-5px");
				$(".plyr__progress__container progress").css("top", "4px");
				$(".plyr__progress__container progress").css("opacity", "0.01");
				$(".plyr__progress").prepend($('<div class="plyr__pb"></div>'));
				var pb = new PB(".plyr__pb", ".plyr__progress__container input", {
					keyColor: "#{{ $color }}",
					videoLength: 99,
					chapters: [

					],
					moments: [

					],
					onScrubbingChange: function(seekTime, offset) {
						var thumbWidth = $(".plyr__preview-thumb").width();
                        var position = Math.max(thumbWidth / 2, offset);
                        position = Math.min($(".plyr__controls").width() - $(".plyr__preview-thumb").width() + (thumbWidth / 4), position);
						$(".plyr__preview-thumb").css("left", (position - 5.5) + "px");
					}
				});

				function subscribeAdManagerEvent() {
					if (player.ads != null) {

                        Object.keys(google.ima.AdEvent.Type).forEach(function (e) {

                            player.ads.manager.addEventListener(google.ima.AdEvent.Type[e], function (e) {
                                switch (e.type) {
                                    case 'pause':
                                        isAdPaused = true;
                                        break;
                                    case 'complete':
                                    case 'allAdsCompleted':
                                    case 'userClose':
                                    case 'start':
                                    case 'resume':
                                    case 'loaded':
                                        isAdPaused = false;
                                        break;
                                    case 'click':

                                        if (isAdPaused)
                                            player.ads.manager.resume();
                                        break;
                                }
                            });
                        });
					}
				}

				document.addEventListener('ready', function() {
					setSeekThumbnailHeight(player);
				});

				player.on("loadedmetadata", function () {
					pb.SetDuration(player.duration);
					if (player.ads != null && player.ads.manager == null) {
						if (player.ads.loader != null) {
							player.ads.loader.addEventListener("adsManagerLoaded", function (e) {
								subscribeAdManagerEvent();
							}, false);
						}
					}
					else {
						subscribeAdManagerEvent();
					}
				});

				setInterval(function () {
					pb.SetCurrentProgress(player.currentTime);

					pb.SetBufferProgress(player.duration * player.buffered);
				}, 16);
				/* Progress bar */


				function getStatusObject() {
					return {
						volume: player.volume,
						muted: player.muted,
						hideControls: player.hideControls,
						speed: player.speed,
						quality: player.quality,
						currentTime: player.currentTime,
						playing: player.playing,
						paused: player.paused,
						stopped: player.stopped,
						ended: player.ended,
						buffered: player.buffered,
						duration: player.duration,
						hasAudio: player.hasAudio,
						loop: player.loop,
						language: player.language,
						ratio: player.ratio,
					};
                }

				function sendEvent(name) {
					window.parent.postMessage({
						channel: "bunnystream",
						video: "4976ba4e-3a6e-4b40-9fd2-cd957bf98baf",
						event: name,
						status: getStatusObject(),
					}, '*');
				}

				function wireEvent(name) {
					player.on(name, function () { sendEvent(name)});
                }

				function wireUpEvents()
				{
					wireEvent("progress");
					wireEvent("ready");
					wireEvent("play");
					wireEvent("pause");
					wireEvent("timeupdate");
					wireEvent("seeking");
					wireEvent("seeked");
					wireEvent("ended");
					wireEvent("ratechange");
					wireEvent("enterfullscreen");
					wireEvent("exitfullscreen");
					wireEvent("captionsenabled");
					wireEvent("captionsdisabled");
					wireEvent("languagechange");
					wireEvent("ready");
                }

				window.onmessage = function(e)
				{
					var message = e.data;
					if (message.command == 'activate')
					{
						wireUpEvents();
					}
					else if (message.command == 'pause') {
						player.pause();
					}
					else if (message.command == 'play') {
						player.play();
					}
					else if (message.command == 'togglePlay') {
						if (message.parameter != null)
							player.togglePlay(message.parameter);
						else
							player.togglePlay();
					}
					else if (message.command == 'destroy') {
						player.destroy();
					}
					else if (message.command == 'increaseVolume') {
						if (message.parameter != null)
							player.increaseVolume(message.parameter);
						else
							player.increaseVolume(0.1);
					}
					else if (message.command == 'decreaseVolume') {
						if (message.parameter != null)
							player.decreaseVolume(message.parameter);
						else
							player.decreaseVolume(0.1);
					}
					else if (message.command == 'toggleCaptions') {
						if (message.parameter != null)
							player.toggleCaptions(message.parameter);
						else
							player.toggleCaptions();
					}
					else if (message.command == 'toggleControls') {
						if (message.parameter != null)
							player.toggleControls(message.parameter);
						else
							player.toggleControls();
					}
					else if (message.command == 'fullscreen.enter') {
						player.fullscreen.enter();
					}
					else if (message.command == 'fullscreen.exit') {
						player.fullscreen.exit();
					}
					else if (message.command == 'fullscreen.toggle') {
						player.fullscreen.toggle();
					}
					else if (message.command == 'forward') {
						if (message.parameter != null)
							player.forward(message.parameter);
						else
							player.forward();
					}
					else if (message.command == 'rewind') {
						if (message.parameter != null)
							player.rewind(message.parameter);
						else
							player.rewind();
					}
				};

                var pjs = new BunnyPlayerJs(player);
                pjs.init();
            }

            function generateDrmRequest(initDataType, initData, keyContext){
                //console.log(initDataType, initData, keyContext);
                return {initDataType:initDataType, initData:initData};
            }


				if (isHlsSupported) {
					var hlsConfig = {
						debug: false,
						abrEwmaDefaultEstimate: 5000000,
						maxBufferLength: 120,
						minBufferLength: 20,




							autoStartLoad: true,

					};
					var hls = new Hls(hlsConfig);
					hls.loadSource(source);

					// From the m3u8 playlist, hls parses the manifest and returns
					// all available video qualities. This is important, in this approach,
					// we will have one source on the Plyr player.
					hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

						if (window.hls.currentLevel == -1)
						{
							// Auto
							if(hls.levels.length == 1) {
								window.hls.currentLevel = 0;
							}
							else if(hls.levels.length == 2) {
								window.hls.currentLevel = 1;
							}
							else {
								window.hls.currentLevel = 2;
							}
						}

						// Transform available levels into an array of integers (height values).
						var availableQualities = hls.levels.map(function (l) { return l.height });
						availableQualities.unshift(-1) //prepend -1 (auto) to quality array;

						// Add new qualities to option
						defaultOptions.quality = {
							default: -1,
							options: availableQualities,
							// this ensures Plyr to use Hls to update quality level
							forced: true,
							onChange: function (e) { updateQuality(e); },
						}

                        defaultOptions.i18n["qualityLabel"] = { "-1": "Auto" };

                        // Initialize here
						player = new Plyr(video, defaultOptions);
						initPlayer();



					});
					hls.on(Hls.Events.LEVEL_SWITCHED, function (event, data) {
						var span = document.querySelector(".plyr__controls [data-plyr='quality'][value='-1'] span")
						if (span != null) {
							if (hls.autoLevelEnabled) {
								var height = hls.levels[data.level].height;
								span.innerHTML = 'Auto (' + height + 'p)'
							} else {
								span.innerHTML = 'Auto'
							}
						}
					});





					hls.on(Hls.Events.ERROR, function (event, data) {
                        if (errorEvents[data.details] == undefined) {
							errorEvents[data.details] = 0;
						}



                        console.error("HLS error occured:", data);
						errorEvents[data.details] += 1;

						if (data.fatal) {
                            console.error("HLS fatal error occured:", data);
							switch (data.type) {
								case Hls.ErrorTypes.NETWORK_ERROR:
									// try to recover network error
									console.log('fatal network error encountered, try to recover');
									hls.startLoad();
									break;
								case Hls.ErrorTypes.MEDIA_ERROR:
									console.log('fatal media error encountered, try to recover');
									hls.recoverMediaError();
									break;
								default:
									break;
							}
						}
					});

					setInterval(function() {
						var bandwidth = hls.abrController.bwEstimator.getEstimate();
						if (isNaN(bandwidth)) {
							bandwidth = 0;
						}
						if (!video.paused) {

							var errorEventsString = "";
							var keys = Object.keys(errorEvents);
							for (var i = 0; i < keys.length; i++) {
								var key = keys[i];
                                var value = errorEvents[key];
								if (errorEventsString != "") {
									errorEventsString += ",";
								}
								errorEventsString += (key + "=" + value);
                            }
							errorEvents = {};
                        }
					}, 15000);

                    hls.attachMedia(video);

                    if (isAirplayEnabled) {
                        var source = document.createElement('source');
                        source.src = urlPlaylistUrl;
                        video.appendChild(source);
                        video.disableRemotePlayback = false;
                    }

					window.hls = hls;
				}
				else {
				    // hls not supported
					defaultOptions.quality = {
						default: 480,
						options: [240, 320, 480, 720]
					};

					player = new Plyr(video, defaultOptions);
					initPlayer();
				}


			function updateQuality(newQuality) {
                if (newQuality === -1) {
                    window.hls.currentLevel = -1; //Enable AUTO quality if option.value = -1
                } else {
                    window.hls.levels.forEach(function (level, levelIndex) {
                        if (level.height === newQuality) {
                            console.log("Found quality match with " + newQuality);
                            window.hls.currentLevel = levelIndex;
                        }
                    });
                }
			};
		});

        var errorElement;
        function showError(message){
            if(!errorElement){
                errorElement = document.createElement("div");
                errorElement.className = "error-message";
                const container = document.getElementById("video-container");
                container.appendChild(errorElement);
            }
            errorElement.innerHTML = message;
        }

        function centerVertically() {
            var container = document.getElementById("body");
            var inner = document.getElementById("video-container");

            var inHeight = inner.offsetHeight;
            var conHeight = container.offsetHeight;

            inner.style.marginTop = ((conHeight - inHeight) / 2) + 'px';
        }
        centerVertically();
		window.addEventListener("resize", centerVertically);
	</script>
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<defs>
			<symbol id="chromecast" viewBox="0 0 18 18" width="18px" height="18px">
				<g transform="matrix(.74895 0 0 .75211 .025316 .025316)" fill="none" fill-rule="evenodd">
					<path d="m1 18v3h3c0-1.66-1.34-3-3-3zm0-4v2c2.76 0 5 2.24 5 5h2c0-3.87-3.13-7-7-7zm0-4v2c4.97 0 9 4.03 9 9h2c0-6.08-4.93-11-11-11zm20-7h-18c-1.1 0-2 0.9-2 2v3h2v-3h18v14h-7v2h7c1.1 0 2-0.9 2-2v-14c0-1.1-0.9-2-2-2z" fill="#fff" />
					<rect width="24" height="24" />
					<g transform="translate(-208,-106)"></g>
				</g>
			</symbol>
		</defs>
	</svg>
</body>
</html>

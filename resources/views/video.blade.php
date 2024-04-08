<video id="{{ $id }}" style="--plyr-color-main: {{ $color }};" class="{{ $class }}" preload="auto" width="{{ $width }}" height="{{ $height }}" poster="{{ $poster }}" @if(!$controls) data-plyr-config='{ "controls": false, "clickToPlay": false, "playsinline": false }' muted autoplay loop @endif crossorigin>
    <source src="{{ $source }}" type="application/x-mpegURL">

    @if($captions['enabled'])
    <track kind="captions" src="{{ $captions['src'] }}" srclang="{{ $captions['src_lang'] }}" label="{{ $captions['lang'] }}" @if($captions['default']) default @endif>
    @endif

</video>

<script>
document.addEventListener('DOMContentLoaded', () => {
	const source = '{{ $source }}';
	const video = document.getElementById('{{ $id }}');

	// For more options see: https://github.com/sampotts/plyr/#options
	// captions.update is required for captions to work with hls.js
	const player = new Plyr(video, {captions: {active: true, update: true, language: 'en'}});

	if (!Hls.isSupported()) {
		video.src = source;
	} else {
		// For more Hls.js options, see https://github.com/dailymotion/hls.js
		const hls = new Hls({ startLevel: 4 });
		hls.loadSource(source);
		hls.attachMedia(video);
		window.hls = hls;

		// Handle changing captions
		player.on('languagechange', () => {
			// Caption support is still flaky. See: https://github.com/sampotts/plyr/issues/994
			setTimeout(() => hls.subtitleTrack = player.currentTrack, 500);
		});
	}

	// Expose player so it can be used from the console
	window.player = player;
});
</script>

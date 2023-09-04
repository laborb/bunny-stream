<video
    id="{{ $id }}"
    class="{{ $class }}"
    preload="auto"
    width="{{ $width }}"
    height="{{ $height }}"
    poster="{{ $poster }}"
    data-setup="{}"
    @if($controls) controls @else muted loop autoplay @endif
    >
        <source
            src="{{ $source }}"
            type="application/x-mpegURL">
    <p class="vjs-no-js">
        Um dieses Video zu sehen wird JavaScript benötigt und ein Browser, der
        <a href="https://videojs.com/html5-video-support/" target="_blank"
        >HTML5 Videos unterstützt.</a
        >
    </p>
</video>

@if($autoplay)
<script> var playPromise = document.getElementById('{{ $id }}'); setTimeout(function () { playPromise.play(); }, 150); </script>
@endif
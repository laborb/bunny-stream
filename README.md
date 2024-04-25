# Bunny Stream

> Bunny Stream is a Statamic addon that integrates the Bunny Stream API for single Stream libraries in the Statamic CP.

## Features

- Upload and rename videos to Bunny Stream
- Automatically detect transcoding status
- Delete videos from Bunny Stream
- Embedding videos via a custom fieldtype or a custom tag
- Customizable plyr.js player included

## How to Install

### 1. Install via composer

```bash
composer require laborb/bunny-stream
```

### 2. Insert CSS and JS files

For the videos to be displayed properly you need to add the Statamic Tag `{{ video_styles:css }}` in the `<head>` section
and the `{{ video_styles:js }}` tag before the `</body>` element in your layout.

This also includes `hls.js` to support HLS streaming.

Alternatively you can add these tags only to pages you want to display videos.

## How to configure

You need to provide the following config options in your evironment:

```bash
BUNNY_LIBRARY_ID=yourid            #Your Bunny Stream LibraryID
BUNNY_API_KEY=yourapikey           #Your Libraries API Key
BUNNY_CDN_HOSTNAME=yourcdnhostname #Your Libraries CDN Hostname

BUNNY_PLAY_URL=play                #Define your direct play URL (https://yourdomain.com/BUNNY_PLAY_URL)(optional)
BUNNY_EMBED_URL=embed                #Define your direct play URL (https://yourdomain.com/BUNNY_EMBED_URL)(optional)
```

You can get all values in your Bunny Stream Dashboard at [https://dash.bunny.net/stream/](https://dash.bunny.net/stream/) `Delivery > Stream > API`

### Add a custom CDN hostname

To add a custom hostname to host the videos from the CDN you can do the following:

1. Login to your bunny dashboard and head over to `Delivery > Stream > API`
2. At Pull zone click `Manage`
3. Create a CName entry in your DNS settings pointing to the displayed bunny CDN hostname
4. Enter your custom hostname in the bunny settings and activate SSL
5. Use your custom hostname in the .env `BUNNY_CDN_HOSTNAME=yourcdnhostname`

Now your videos are delivered over your custom hostname.

### Publish config file (optional)

If you want, you can publish the config file.

```bash
php artisan vendor:publish --tag=bunny-config
```

## How to Use

**After you installed the addon you need to add your config options in your `.env` first.**

### Upload videos

A new CP navigation item appears: `Videobrowser`
There you can upload and rename your video files.
When they are uploaded, they need to be processed. The videos are processed directly at bunny. The given progress indicator displays bunnys progress.
After the processing is done the video is available in the videobrowser and in the included fieldtype.

### Work with videos

You can embed previously uploaded videos via the provided Statamic Tag `{{ bunny_video }}` or in the content area via the provided Statamic Fieldtype `Bunny`.

#### Video Tag

You should always use the provided `Video` Tag as it includes all options that are available.

```antlers
{{ bunny_video :id="bunny_field" :responsive="responsive" :controls="controls" :ratio="ratio" :width="width" :height="height" :captions_enabled="captions_enabled" :captions_src="captions_src" :captions_src_lang="captions_src_lang" :captions_lang="captions_lang" :captions_default="captions_default" class="" :color="color" }}
```

You need to add your own Statamic Fieldset with at least the Bunny Fieldtype included.

You can also add some options:

- `id`: **Required** Expects a valid Bunny Stream GUID. Automatically provided by the included Bunny Fieldtype.
- `responsive`: Displays the video in a responsive way. It respects the given ratio(default: 16/9).
- `ratio`: Expects one of the following ratios: `1/1`, `16/9`, `4/3`, `9/16`. Only works with the `responsive: true`.
- `controls`: If `true` all controls are available in the video player. If `false` no controls are available and the video will autoplay muted in a loop.
- `width`: Width of the video player. Only available with `responsive: false`. Preserves the videos ratio.
- `height`: Height of the video player. Only available with `responsive: false`. Preserves the videos ratio.
- `captions_enabled`: Enable or disable captions. Expects a boolean.
- `captions_src`: The URL to the captions file. Expects a valid URL to a .vtt file.
- `captions_src_lang`: The language of the captions file. Expects a valid language code. Eg. `en`, `de`, `fr`, ...
- `captions_lang`: The language of the captions to display in the settings. Expects a string like `English`, `Deutsch`, `Français`, ...
- `captions_default`: If `true` the captions are enabled by default. If `false` the user needs to enable them manually.
- `class`: You can give additional classes for the video element
- `color`: You can set the color of the player controls. Expects a valid hexadecimal color code. Default is `#333`

#### Video captions

You can add captions to your videos. The captions file needs to be a valid .vtt file. You can host the file in statamic itself or on a different server.

Unfortunately, the Bunny Stream API does not support captions yet. You need to host the file yourself and provide the URL to the video tag.

Currently only one captions file is supported.

#### Thumbnails

You can get the video's thumbnail URL with the video tag: `{{ bunny_video:thumbnail :id="bunny_field" }}`
It expects the video ID as a parameter.

#### Example Fieldset

You can use this example fieldset with the provided tag as a layout to include all available options.

```yaml
title: Video
fields:
  - handle: bunny_field
    field:
      type: bunny
      display: Video
      icon: video
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
  - handle: controls
    field:
      default: true
      type: toggle
      display: Controls
      icon: toggle
      instructions: "Ohne Controls wird das Video automatisch gemuted und im Loop automatisch abgespielt."
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
  - handle: responsive
    field:
      default: true
      type: toggle
      display: "Responsive Darstellung"
      icon: toggle
      instructions: "Stellt das Video in der entsprechenden Ratio responsiv dar."
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
  - handle: width
    field:
      input_type: number
      append: px
      antlers: false
      type: text
      display: Breite
      icon: text
      instructions: "Breite des Videos"
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: "equals false"
  - handle: height
    field:
      input_type: number
      append: px
      antlers: false
      type: text
      display: Höhe
      icon: text
      instructions: "Höhe des Videos"
      width: 33
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: "equals false"
  - handle: ratio
    field:
      options:
        1/1: null
        16/9: null
        4/3: null
        9/16: null
      default: 16/9
      type: button_group
      display: Ratio
      icon: button_group
      instructions: "Das Bildverhältnis des Videos. Nur in responsiver Darstellung möglich."
      listable: hidden
      instructions_position: above
      visibility: visible
      hide_display: false
      if:
        responsive: "equals true"
      width: 66
```

## How to customize

The included video player is a simple [plyr.js](https://plyr.io/) player with zero customization.

You can style the whole player to your needs with simple CSS classes: [https://github.com/sampotts/plyr?tab=readme-ov-file#customizing-the-css](https://github.com/sampotts/plyr?tab=readme-ov-file#customizing-the-css)

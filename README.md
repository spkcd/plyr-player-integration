# Plyr Player Integration

A WordPress plugin that integrates the Plyr media player for enhanced audio playback.

## Features

- Integrates Plyr.js and Plyr CSS from the official JSDelivr CDN
- Lightweight inline initialization script
- Only loads on the frontend when audio players are present
- Version control for cache busting
- No shortcodes or custom post types needed
- Enables m4a file uploads in WordPress
- Fully responsive with modern rounded design

## Usage

1. Install and activate the plugin
2. Add the `plyr-audio` class to any audio element you want to enhance:

```html
<audio class="plyr-audio" src="your-audio-file.mp3" controls></audio>
```

Or for a more complete example with multiple formats:

```html
<audio class="plyr-audio" controls>
  <source src="your-audio-file.mp3" type="audio/mp3">
  <source src="your-audio-file.ogg" type="audio/ogg">
  <source src="your-audio-file.m4a" type="audio/mp4">
  Your browser does not support the audio element.
</audio>
```

## Supported Audio Formats

- MP3 (audio/mp3)
- OGG (audio/ogg)
- M4A (audio/mp4) - enabled by this plugin

## How It Works

- The plugin checks if any `<audio class="plyr-audio">` elements exist on the page
- When found, it automatically initializes Plyr on each audio element
- Scripts are loaded in the footer for optimal page performance
- No configuration or shortcodes needed - just add the class to your audio elements

## Implementation Details

- Uses the official Plyr player from JSDelivr CDN
- Loads minified JS and CSS files
- Adds inline initialization script for minimal overhead 
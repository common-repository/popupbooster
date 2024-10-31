=== Popupbooster ===
Contributors: piet.hadermann
Tags: popup, targeting, ctr, stats
Requires at least: 2.5
Tested up to: 2.9.2
Stable tag: 0.9

This plugin adds the Popupbooster javascript code into the footer of
your website. 

== Description ==

This is a basic wordpress plugin to add Popupbooster to your wordpress site.
It adds the Popupbooster javascript code into every page of your, so
you don't have to code PHP to add it to your templates.

Popupbooster is a popup/overlay tool that features:
* wysiwyg editor (but also option to mess directly with the html code)
* very customizable design/appearance
* ctr (click-through rate) tracking
* visitor targeting (showing different popups based on search-engine keywords used, landing page, referrer,...)
* preview on your site before you put them live for your visitors
* media (youtube, flash, ...) embedding
* very basic visitor info (keywords used if any, referrer, landing page) to aid targeting
* ... (out of scope to mention it all here, check the [Popupbooster](http://www.popupbooster.com) site)

This plugin is based quite heavily on the Piwik Analytics plugin by Jules Stuifbergen which in
turn was based on the Google Analytics wordpress plugin by Joost de Valk.

Please note that this plugin requires a [Popupbooster](http://www.popupbooster.com)
that you can get [here](http://app.popupbooster.com/signup) (free account available).

Future enhancement: who knows, depending largely on what the Popupbooster api will look like.

== Installation ==

1. Upload the popupbooster directory containing `popupbooster.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Make sure your template has a call to wp_footer() somewhere in the footer (most do these days).
1. Copy/paste your javascript code from the Popupbooster site

== Changelog ==

= 0.9 =
* Just to be safe we'll call this version 0.9: it's based on a plugin considered stable, but this is my first attempt at wordpress plugin development


== Frequently Asked Questions ==

Q: Where do I find the javascript code?
A: After logging in to your Popupbooster account, you will find a 'Config' tab all the way to the right. The javascript code is in the gray area.
If you have multiple sites, make sure you choose the correct site.

Q: So where exactly are the popups?
A: Hosted at Popupbooster.com and you can edit everything there. This way everything is future-proof and stays compatible with new browsers.




=== Editor Repositioner ===  
Contributors: OMGCarlos
Author URI: http://twitter.com/omgcarlos
Plugin URI: http://press12.com

Tags: edit, editor, content, movable, admin
Requires at least: 3.3
Tested up to: 3.4.1
Stable tag: 1.0.2

License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Places the backend content editor inside a meta box labeled "Content" (customizable!), allowing you to collapse and reposition it!



== Description ==  
Whether you're building a site for a client or yourself, you'll often wish you could have another meta box between the Title and Editor. It doesn't make too much sense to have a Tagline field, for example, at the bottom of the edit screen!

This plugin places the default content editor found in posts, pages, and custom post types inside of a meta box labeled "Content" (customizable!). You'll then have the ability to collapse/expand the editor and reposition it below more important elements! You can also add basic HTML styling, drawing more attention to the meta box.

**For fast support, please check out our [Support Forums](http://press12.com/support/editor-repositioner/) . *NO* registration required.**


== Frequently Asked Questions ==  
**For fast support, please check out our [Support Forums](http://press12.com/support/editor-repositioner/) . *NO* registration required.**

= I moved my editor and the content disappeared! =
Don't worry, this is a limitation of the current release (3.4.1) of [WordPress](http://codex.wordpress.org/Function_Reference/wp_editor). Simply position the editor *before* you start editing, and refresh the page!

= What happens if I remove the plugin later on? =  
The editor defaults back to its static position, and your posts content remains unchanged!

= What if I have multiple editors? =  
This plugin will only affect the default editor. Editors created through other plugins or through your own code will remain unaffected (as they would already be in a metabox)

= Can I use this with [TinyMCE Advanced](http://wordpress.org/extend/plugins/tinymce-advanced/)? =
Yes! You'll be able to use it with any plugin which hooks into **wp_editor()**.

= This is awesome, but I want MORE! =
Really?!? Let us know what you'd like added and we'll try to inlcude it in the next update by visiting our Feature Request page!



== Screenshots ==
1. The content is placed inside a collapseable meta box.
2. You can reposition the editor anywhere, even in the sidebar!
3. Use with multiple editors!
4. Compatible with any plugin which modifies the look of the default editor, eg [Tiny MCE Advanced](http://wordpress.org/extend/plugins/tinymce-advanced/)
5. Change the metabox title through the settings page/
6. Funky Metabox titles!



== Installation ==  
= Automatic installation =

1. Log into your WordPress admin
2. Click __Plugins__
3. Click __Add New__
4. Search for __P3__
5. Click __Install Now__ under "P3 (Plugin Performance Profiler)"
6. Activate the plugin

= Manual installation: =
1. Download the plugin
2. Extract the contents of the zip file
3. Upload the contents of the zip file to the wp-content/plugins/ folder of your WordPress installation
4. Then activate the Plugin from Plugins page.



== Changelog ==
= 1.0.2 =
* Accidently left a copy of the trunk inside the tag, which caused "Plugin sent incorrect headers" message. Still getting used to SVN :P

= 1.0.1 =
* Added save confirmation


== Other Notes ==
= To Do =
* Post Type blacklist. Don't affect certain post types.
* Different names per post type. Each post type should get their own name.
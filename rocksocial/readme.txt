=== Rocksocial ===
Contributors: joelg87, andy7629
Tags: google, google+1, plus one, tweet, twitter, facebook, share, like, stumbleupon, social sharing, linkedin, reddit, pinterest, sharebar, social media, social networking, sharethis, pocket, tumblr
Requires at least: 2.3
Tested up to: 3.5.1
Stable tag: 5.3.6

Your all in one share buttons plugin. Add a floating bar with share buttons to your blog. Just like Mashable!

== Description ==
With Rocksocial by Buffer, you have an all in one social sharing plugin for your blog. Display all social sharing buttons nicely on your blog and make it look amazing, just like Mashable.

= Features =

* Display all popular social sharing buttons with count, such as Twitter, Buffer, Facebook Share, Facebook Like, LinkedIn, Google +1, Reddit, dZone, TweetMeme, Topsy, Yahoo Buzz, StumbleUpon, Del.icio.us, Sphinn, Designbump, WebBlend, BlogEngage, Serpd, Pinterest, Pocket and Tumblr.
* Facebook Like (Iframe or XFBML), support thumbnail generation, multiple languages, show faces and send button.
* Great customization options. Choose a floating bar like here: http://marketingdeconteudo.com/rocksocial or sharing buttons at the top or bottom of the post.
* Lazy loading to increase website performance.
* Left or right scrolling effect like Mashable.com.
* Support in excerpt mode.
* Support for email and print services.
* Nearly any button out there you can think of.
* Have any suggestions we should include in the next update? Email us: contato@rockcontent.com

== Installation ==

1. Download the plugin from this page and extract it
2. Copy the rocksocial folder to the "/wp-content/plugins/" directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. You are done – you can now customize it however you want by clicking on "Rocksocial" in the "settings" section.

Post Installation
1. Go to the Rocksocial admin section to setup your social buttons

== Frequently Asked Questions ==
If you have any questions, we'd love to hear from you. Email us: contato@rockcontent.com


= How can I disable the Rocksocial Floating Bar on a particular page? =

You can insert the following within the HTML editor anywhere when editing a post and it will disable Rocksocial on that page.

`<!-- Rocksocial Disabled -->`

Another method to disable the bar on a particular page add the following few lines to your themes functions.php file, changing the conditional tags to ones that fit your requirement.

`function dd_exclude_from_pages() {
if(is_page(1)) {
      remove_filter('the_excerpt', 'dd_hook_wp_content');
    	remove_filter('the_content', 'dd_hook_wp_content');
	}
}
add_action('template_redirect', 'dd_exclude_from_pages');`


= How can I add the Rocksocial Floating Bar on a particular page? =

To add the bar to a particular page add the following few lines to your themes functions.php file, changing the conditional tags to ones that fit your requirement.

`if(is_page('page-slug-1') || is_page('page-slug-2')) {
	add_filter('the_excerpt', 'dd_hook_wp_content');
	add_filter('the_content', 'dd_hook_wp_content');
}`


= How can I change the order of sharers throughout Rocksocial? =

In both Normal Display and Floating Display settings pages you can change the weight of a sharer. The highest weighted sharer will be displayed first, the lowest weighted sharer will be displayed last.


== Screenshots ==
1. Floating Bar
2. Normal Bar with Large Buttons at Top
3. Normal Bar with Large Buttons at Bottom
4. Normal Bar with Small Buttons at Top

<?php

/**
 * @package Hello_SciFi
 * @version 1.0.0
 */
/*
Plugin Name: Hello Sci-Fi
Description: 
Author: Patrick Barnhardt
Version: 1.0.0
Author URI: https://patrickbarnhardt.com
*/

function hello_scifi_get_quote()
{
	/** These are the lyrics to Hello Dolly */
	$quotes = "I'll be back.
There isn’t enough life on this ice cube to fill a space cruiser
You could not live with your own failure
Where did that bring you? Back to me
Don't forget, I'm half-human. So that fifty percent of me that's stupid, that's a hundred percent you.
I'm sorry, Dave. I'm afraid I can't do that
You said science was about admitting what we don't know
Ever have that feeling where you're not sure if you're awake or dreaming
Let's face it, this is not the worst thing you've caught me doing
What in the name of Sir Isaac H. Newton happened here
The universe is big. It’s vast and complicated and ridiculous
And sometimes, very rarely, impossible things just happen and we call them miracles
The right information at the right time is deadlier than any weapon
Things are only impossible until they’re not
Time is an illusion. Lunchtime doubly so
I can wait for the galaxy outside to get a little kinder";

	// Here we split it into lines.
	$quotes = explode("\n", $quotes);

	// And then randomly choose a line.
	return wptexturize($quotes[mt_rand(0, count($quotes) - 1)]);
}

// This just echoes the chosen line, we'll position it later.
function hello_scifi()
{
	$chosen = hello_scifi_get_quote();
	$lang   = '';
	if ('en_' !== substr(get_user_locale(), 0, 3)) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="scifi"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__(''),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'hello_scifi');

// We need some CSS to position the paragraph.
function scifi_css()
{
	echo "
	<style type='text/css'>
	#scifi {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #scifi {
		float: left;
	}
	.block-editor-page #scifi {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#scifi,
		.rtl #scifi {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'scifi_css');

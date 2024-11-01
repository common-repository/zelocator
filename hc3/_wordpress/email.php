<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Email
{
	public function send( $to, $subj, $msg )
	{
		add_filter( 'wp_mail_content_type', array($this, 'set_html_mail_content_type') );
		@wp_mail( $to, $subj, $msg );
		remove_filter( 'wp_mail_content_type', array($this, 'set_html_mail_content_type') );
		return $this;
	}

	public function set_html_mail_content_type()
	{
		$return = 'text/html';
		return $return;
	}
}
<?php

namespace threewp_broadcast\maintenance\checks\view_post_info;

use \threewp_broadcast\BroadcastData;

/**
	@brief		View information about a post.
	@since		2016-04-01 22:17:58
**/
class check
	extends \threewp_broadcast\maintenance\checks\check
{
	public function get_description()
	{
		// Maintenance check description
		return __( 'View post information including metadata.', 'threewp_broadcast' );
	}

	public function get_name()
	{
		// Maintenance check name
		return __( 'View post info', 'threewp_broadcast' );
	}

	public function step_start()
	{
		$o = new \stdClass;
		$o->inputs = new \stdClass;
		$o->form = $this->broadcast()->form2();
		$o->r = '';

		$o->inputs->post_id = $o->form->number( 'post_id' )
			->description( __( 'The ID of the post to view', 'threewp_broadcast' ) )
			->label( __( 'Post ID', 'threewp_broadcast' ) )
			->value( 0 );

		$button = $o->form->primary_button( 'dump' )
			// Button
			->value( __( 'Find and display the post info', 'threewp_broadcast' ) );

		if ( $o->form->is_posting() )
		{
			$o->form->post()->use_post_value();
			$this->view_post_info( $o );
		}

		$o->r .= $o->form->open_tag();
		$o->r .= $o->form->display_form_table();
		$o->r .= $o->form->close_tag();
		return $o->r;
	}

	public function view_post_info( $o )
	{
		$post_id = $o->inputs->post_id->get_value();

		$post = get_post( $post_id );

		if ( ! $post )
		{
			// Post 123 does not
			$o->r .= $this->broadcast()->message( sprintf( __( 'Post %s does not exist.', 'threewp_broadcast' ), $post_id ) );
			return;
		}

		$text = sprintf( '<pre>%s</pre>', var_export( $post, true ) );
		$o->r .= $this->broadcast()->message( $text );

		$metas = get_post_meta( $post_id );
		foreach( $metas as $key => $value )
		{
			$value = reset( $value );
			$value = maybe_unserialize( $value );
			$metas [ $key ] = $value;
		}

		$text = sprintf( '<pre>%s</pre>', var_export( $metas, true ) );
		$o->r .= $this->broadcast()->message( $text );
	}
}

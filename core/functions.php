<?php

use \Carbon_Field_Link_Field\Helper;

if ( ! function_exists( 'crb_render_link' ) ) {
    function crb_render_link( $link, $args = [] ) {
        Helper::render_link( $link, $args );
    }
}
<?php

namespace Carbon_Field_Link_Field;

class Helper {
    public static function render_link( $link, $args = [] ) {
        if ( ! $link ) {
            return '';
        }

        $default_args = [
            'before_link'  => '',
            'after_link'   => '',
            'before_label' => '',
            'after_label'  => '',
            'classes'      => '',
        ];

        $args = array_merge( $default_args, $args );

        $url     = esc_url( $link['link'] );
        $label   = esc_html( $link['label'] );
        $target  = ( isset( $link['target'] ) && $link['target'] ) ? '_blank' : '_self';
        $classes = esc_attr( $args['classes'] );

        echo $args['before_link'];
            echo "<a class='{$classes}' href='{$url}' target='{$target}'>";
                echo $args['before_label'];
                echo $label;
                echo $args['after_label'];
            echo "</a>";
        echo $args['after_link'];
    }
}
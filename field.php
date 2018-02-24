<?php
use Carbon_Fields\Carbon_Fields;
use Carbon_Field_Link_Field\Link_Field;

define( 'Carbon_Field_Link_Field\\DIR', __DIR__ );

Carbon_Fields::extend( Link_Field::class, function( $container ) {
	return new Link_Field( $container['arguments']['type'], $container['arguments']['name'], $container['arguments']['label'] );
} );
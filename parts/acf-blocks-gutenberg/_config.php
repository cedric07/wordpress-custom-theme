<?php
//---------------------------------------------------------------------------
//------- Block configuration
//---------------------------------------------------------------------------

// Preview
if ( isset( $block['data']['preview_image'] ) ) {
	$img_preview = $block['data']['preview_image'];
}

// Create id attribute allowing for custom "anchor" value.
$id = esc_attr( $block['id'] );
if ( ! empty( $block['anchor'] ) ) {
	$id = esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className".
$blockClasses = 'custom-wp-block';
if ( ! empty( $block['className'] ) ) {
	$blockClasses = $blockClasses . ' ' .esc_attr( $block['className'] );
}

// Block Name for use classes
$blockName = esc_attr( str_replace( 'acf/', '', $block['name'] ) );

//---------------------------------------------------------------------------
//------- END
//---------------------------------------------------------------------------

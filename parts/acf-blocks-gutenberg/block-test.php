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
$blockClasses = '';
if ( ! empty( $block['className'] ) ) {
	$blockClasses = esc_attr( $block['className'] );
}

// Block Name for use classes
$blockName = esc_attr( str_replace( 'acf/', '', $block['name'] ) );

//---------------------------------------------------------------------------
//------- END
//---------------------------------------------------------------------------

// Load values and assing defaults.
$myField1 = get_field( 'my_field_1' ) ?: __( 'My Field 1', 'your_text_domain' );
$myField2 = get_field( 'my_field_1' ) ?: __( 'My Field 2', 'your_text_domain' );

//---------------------------------------------------------------------------
//------- Block rendering
//---------------------------------------------------------------------------

if ( isset( $img_preview ) && $img_preview ) : // Rendering in inserter preview

	echo '<img src="' . $img_preview . '" style="width:100%; height:auto;">'; ?>

<?php else: // rendering in editor body ?>

	<div id="<?php echo $id; ?>" class="<?php echo $blockName . ' ' . $blockClasses; ?>">
		<h1 class="<?php echo $blockName; ?>--field1"><?php echo $myField1; ?></h1>
		<h2 class="<?php echo $blockName; ?>--field2"><?php echo $myField2; ?></h2>
	</div>

<?php endif; ?>

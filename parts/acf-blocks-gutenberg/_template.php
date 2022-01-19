<?php
// Block configuration
require '_config.php';

// Load values and assing defaults.
$myField1 = get_field( 'my_field_1' ) ?: __( 'My Field 1', 'your_text_domain' );
$myField2 = get_field( 'my_field_1' ) ?: __( 'My Field 2', 'your_text_domain' );

//---------------------------------------------------------------------------
//------- Block rendering
//---------------------------------------------------------------------------

if ( isset( $img_preview ) && $img_preview ) : // Rendering in inserter preview

	echo '<img src="' . $img_preview . '" style="width:100%; height:auto;">'; ?>

<?php else: // rendering in editor body ?>

	<div id="<?= $id; ?>" class="<?= $blockName . ' ' . $blockClasses; ?>">
		<h1 class="<?= $blockName; ?>--field1"><?= $myField1; ?></h1>
		<h2 class="<?= $blockName; ?>--field2"><?= $myField2; ?></h2>
	</div>

<?php endif; ?>

<?php
/**
* Photo Break
* -----------------------------------------------------------------------------
*
* Photo Break component
*/

$defaults = [
  'image' => null
];

$component_data = ll_parse_args( $component_data, $defaults );
?>

<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes        = $component_args['classes'] ?: array();

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id = isset($component_args['id']) ? $component_args['id'] : '';

if ( $component_data['image'] ) {
 $style            = 'style="background-image: url( '.$component_data['image']['url'].' );"';
} else {
 $style            = '';
}

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-photo-break <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="photo-break">
  <div class="container animated-row">
    <div class="ll-photo-break__image animated-image" <?php echo $style; ?>></div>
  </div>
</div>

<?php
/**
* Google Map
* -----------------------------------------------------------------------------
*
* Google Map component
*/

$defaults = [
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

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-google-map-wrapper <?php echo implode( " ", $classes ); ?>">
  <div class="container animated-row">
    <div class="ll-google-map animated-image" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="google-map" data-locations='<?php echo json_encode( $component_data['locations'] ); ?>'></div>
  </div>
</div>

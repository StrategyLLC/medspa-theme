<?php
/**
* Left Right
* -----------------------------------------------------------------------------
*
* Left Right component
*/

$defaults = [
  'content' => null,
  'image'   => null
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


if ( $component_data['will_parallax'] == 'true' ) {
  $classes[] = 'parallax-group';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-left-right <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="left-right">
  <div class="container">
    <div class="row animated-row">
      <div class="col-sm-1of2 ll-left-right__content-col wysiwyg">
        <?php echo $component_data['content']; ?>
      </div>

      <div class="col-sm-1of2 ll-left-right__image-col">
        <div class="ll-left-right__image animated-image parallax-item" style="background-image: url('<?php echo $component_data['image']; ?>');"></div>
      </div>
    </div>
  </div>
</div>

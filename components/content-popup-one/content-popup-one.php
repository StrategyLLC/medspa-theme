<?php
/**
* Content Popup One
* -----------------------------------------------------------------------------
*
* Content Popup One component
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

?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-content-popup-one modal <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="content-popup-one">
  <div class="container">
    <div class="row">
      <div class="col-sm-1of2">
        <div class="ll-content-popup-one__image is-<?php echo $component_data['size']; ?>" style="background-image: url(<?php echo $component_data['image']['url']; ?>);"></div>
      </div>

      <div class="col-sm-1of2">
        <div class="wysiwyg not-animated">
          <?php echo $component_data['content']; ?>
        </div>
      </div>
    </div>
  </div>
</div>

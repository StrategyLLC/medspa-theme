<?php
/**
* Lander 1
* -----------------------------------------------------------------------------
*
* Lander 1 component
*/

$defaults = [
  'content' => null,
  'image'   => null,
  'video'   => null
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
<div class="ll-lander-1 <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="lander-1">
  <div class="container">

    <div class="ll-lander-1__content row row-justify-center" style="text-align:center;">
      <div class="col-full wysiwyg not-animated">
        <?php echo $component_data['content']; ?>
      </div>
    </div>

    <div class="ll-lander-1__image" <?php echo $style; ?>>
      <?php if ( $component_data['video'] ) : ?>
        <?php
          ll_include_component(
            'loop-video',
            array(
              'video' => $component_data['video'],
              'fallback' => ''
            )
          );
        ?>
      <?php endif; ?>
    </div>
  </div>
</div>

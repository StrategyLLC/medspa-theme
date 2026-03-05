<?php
/**
* Four Column
* -----------------------------------------------------------------------------
*
* Four Column component
*/

$defaults = [
  'intro_content' => null,
  'columns'       => null,
  'alignment'     => null,
];

$component_data = ll_parse_args( $component_data, $defaults );

$intro_content = $component_data['intro_content'];
$columns       = $component_data['columns'];
$alignment     = $component_data['alignment'];
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


if ( $component_data['background_color'] ) {
  $style = 'style="background-color: ' . $component_data['background_color'] . '"';
} else {
  $style = '';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-four-column <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="four-column" <?php echo $style; ?>>
  <div class="container">
    <?php if( $alignment == 'center' ) : ?>
      <div class="row animated-row" style="text-align: center;">
        <?php if ( $intro_content ) : ?>
        <div class="col-full wysiwyg keep-bottom">
          <?php echo $intro_content; ?>
        </div>
        <?php endif; ?>

        <?php foreach ($columns as $key => $column): ?>
          <div class="col-sm-3of12 wysiwyg">
            <?php echo $column['content']; ?>
          </div>
        <?php endforeach ?>
      </div>

    <?php elseif ( $alignment == 'left' ) : ?>

      <div class="row animated-row">
        <?php if ( $intro_content ) : ?>
        <div class="col-full wysiwyg keep-bottom">
          <?php echo $intro_content; ?>
        </div>
        <?php endif; ?>

        <?php foreach ($columns as $key => $column): ?>
          <div class="col-sm-3of12 wysiwyg">
            <?php echo $column['content']; ?>
          </div>
        <?php endforeach ?>
      </div>

    <?php endif; ?>
  </div>
</div>

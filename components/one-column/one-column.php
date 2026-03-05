<?php
/**
* One Column
* -----------------------------------------------------------------------------
*
* One Column component
*/

$defaults = [
  'columns'   => null,
  'alignment' => null,
  'size'      => null,
  'indent'    => null
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
if ( $component_data['background_color'] ) {
  $style = 'style="background-color: ' . $component_data['background_color'] . '"';
} else {
  $style = '';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<div class="ll-one-column <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="one-column" <?php echo $style; ?>>
  <div class="container">
    <?php if ( $component_data['alignment'] == 'center' && $component_data['size'] == 'big' ) : ?>
    <div class="row row-justify-center animated-row" style="text-align:center;">
      <?php foreach ($component_data['columns'] as $key => $column): ?>
      <div class="col-sm-8of12 wysiwyg">
        <?php echo $column['content']; ?>
      </div>
      <?php endforeach ?>
    </div>

    <?php elseif ( $component_data['size'] == 'full' ) : ?>

    <div class="row row-justify-center animated-row">
      <?php foreach( $component_data['columns'] as $key => $column ) : ?>
      <div class="wysiwyg">
        <?php echo $column['content']; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <?php elseif ( $component_data['alignment'] == 'center' && $component_data['size'] == 'small' ) : ?>

    <div class="row row-justify-center animated-row" style="text-align:center;">
      <?php foreach( $component_data['columns'] as $key => $column ) : ?>
      <div class="col-sm-6of12 wysiwyg">
        <?php echo $column['content']; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <?php elseif ( $component_data['alignment'] == 'left' && !$component_data['indent'] ) : ?>

    <div class="row animated-row">
      <?php foreach( $component_data['columns'] as $key => $column ) : ?>
        <div class="col-sm-8of12 wysiwyg">
          <?php echo $column['content']; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <?php elseif ( $component_data['alignment'] == 'left' && $component_data['indent'] ) : ?>

    <div class="row row-offset animated-row">
      <?php foreach( $component_data['columns'] as $key => $column ) : ?>
      <div class="col-sm-9of12 wysiwyg">
        <?php echo $column['content']; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <?php endif; ?>
  </div>
</div>

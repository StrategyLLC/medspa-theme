<?php
/**
* Card Grid
* -----------------------------------------------------------------------------
*
* Card Grid component
*/

$defaults = [
  'items' => array(
    0 => array(
      'image' => array(
        'url' => null
      ),
      'sub_text' => null,
      'title' => null,
      'top_text' => null,
      'link'     => null
    )
  ),
  'pattern' => array(
    'url' => null
  ),
  'color'   => null,
  'hover_color' => null,
  'hover_text_color' => null,
  'opacity' => null,
  'text-color' => null,
  'is_offset'  => null
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

if ( $component_data['is_offset'] ) {
  $classes[] = 'll-card-grid--offset';
}

if ( $component_data['will_parallax'] == 'true' ) {
  $classes[] = 'parallax-group';
}
?>

<?php if ( ll_empty( $component_data ) ) return; ?>
<?php if ( $component_data['hover_color'] || $component_data['hover_text_color'] ) : ?>
  <style>
    <?php if ( $component_data['hover_color'] ) : ?>
      .ll-card-grid__item:hover .ll-card-grid__item__overlay.has-hover {
        background-color: <?php echo $component_data['hover_color'] ?>!important;
      }
    <?php endif; ?>

    <?php if ( $component_data['hover_text_color'] ) : ?>
      .ll-card-grid__item:hover .ll-card-grid__item__info {
        color: <?php echo $component_data['hover_text_color']; ?> !important;
      }
    <?php endif; ?>
</style>
<?php endif; ?>
<div class="ll-card-grid <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="card-grid">
  <div class="container">
    <div class="row">
      <?php if ( $component_data['items'] ) : ?>
      <?php foreach ($component_data['items'] as $key => $item): ?>
        <div class="col-sm-1of3">
          <div class="ll-card-grid__item parallax-item">
            <div class="ll-card-grid__item__image" style="background-image: url('<?php echo $item['image']['url']; ?>')"></div>
            <div class="ll-card-grid__item__info" style="<?php echo( $component_data['text-color'] ? 'color: '.$component_data['text-color'] .';' : '' ); ?><?php echo ( $component_data['pattern'] ? 'background-image: url( '.$component_data['pattern']['url'].' );' : '' ); ?>">
              <div class="ll-card-grid__item__overlay <?php echo ( $component_data['pattern'] || $component_data['hover_color'] ? 'has-hover' : '' ); ?>" style="<?php echo ( $component_data['color'] ? 'background-color:' . $component_data['color'] .';' : '' ); ?><?php echo($component_data['opacity'] ? 'opacity: ' . $component_data['opacity'] : '');  ?>"></div>
              <div class="ll-card-grid__item__info__content">
                <span class="<?php echo $component_data['top_text_size']; ?>"><?php echo $item['top_text'] ?></span>
                <span class="<?php echo $component_data['middle_text_size']; ?>"><?php echo $item['title']; ?></span>
                <span class="<?php echo $component_data['bottom_text_size']; ?>"><?php echo $item['sub_text']; ?></span>
              </div>
            </div>
            <?php if ( $item['link'] ) : ?>
              <a class="ll-card-grid__item__link" href="<?php echo $item['link']; ?>"></a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif; ?>
    </div>
  </div>
</div>

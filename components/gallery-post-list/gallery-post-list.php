<?php
/**
* Post List
* -----------------------------------------------------------------------------
*
* Post List component
*/

$defaults = [
  'items' => array(
    0 => array(
      'image' => array(
        'url' => null
      ),
      'title' => null,
      'link'  => null
    )
  )
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
<div class="ll-post-list <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="post-list">
  <div class="container">
    <?php if ( $component_data['items'] ) : ?>
    <?php foreach ($component_data['items'] as $key => $item): ?>
      <div class="ll-post-list__item animated-row">
        <div class="ll-post-list__item__image animated-image" style="background-image: url( <?php echo $item['image']['url'] ?> ); <?php echo( $component_data['image_contain'] ? 'background-size: '. $component_data['image_contain'] : '' ); ?>"></div>
        <span class="ll-post-list__item__line parallax-item"></span>
        <div class="ll-post-list__item__title parallax-item"><?php echo $item['title']; ?></div>
        <a class="ll-post-list__item__link ll-post-list__gallery_link" href="#gallery-popup" data-id="<?php echo $item['post_id']; ?>"></a>
      </div>
    <?php endforeach ?>
    <?php endif; ?>
  </div>
</div>

<?php
/**
* Filter
* -----------------------------------------------------------------------------
*
* Filter component
*/

$defaults = [
  'post_type' => null,
  'taxonomy' => []
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
$terms = get_terms( $component_data['taxonomy'] );
$query_object = get_queried_object();
?>

<?php if ( ll_empty( $terms ) ) return; ?>
<div class="ll-filter <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ) ?> data-component="filter">
  <div class="container">
    <ul>
      <?php if ( $component_data['post_type'] == 'post' ) : ?>
      <li><a class="h2 <?php echo ( $query_object->name == $component_data['post_type'] || $query_object->name == '' ? 'active' : '' ); ?>" href="<?php echo get_post_type_archive_link( $component_data['post_type'] ) ?>#<?php echo $component_id; ?>">All</a></li>
      <?php endif; ?>
      <?php foreach ($terms as $key => $term): ?>
        <li><a class="h2 <?php echo (  $query_object->name == $term->name ? 'active' : ''); ?>" href="<?php echo get_term_link( $term, $component_data['taxononmy'] ); ?>#<?php echo $component_id; ?>"><?php echo $term->name; ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</div>

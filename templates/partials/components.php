<?php
global $post;
$post_id = 0; // Define the $post_id variable with a default value

if (! $post_id) {
  $post_id = $post->ID;
}

?>
  <?php if (have_rows('components', $post_id)): ?>
        <?php
        $components = get_field('components', $post_id);
        ?>
        <?php while (have_rows('components', $post_id)):
          the_row(); ?>
              <?php
              $index = get_row_index();
              $next_index = $index; // get_row_index starts at 1 instead of zero
              $previous_index = $index - 2; // get_row_index starts at 1 instead of zero, so to go BACK a component we must go back 2

              $previous_component = '';
              $next_component = '';

              if ($previous_index >= 0 && isset($components[$previous_index]['acf_fc_layout'])) {
                $previous_component = $components[$previous_index]['acf_fc_layout'];
              }

              if (isset($components[$next_index]['acf_fc_layout'])) {
                $next_component = $components[$next_index]['acf_fc_layout'];
              }
              ?>

              <?php if (get_row_layout() == 'lander-1'): ?>
                    <?php $position_class = ''; ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'lander-1',
                      array(
                        'content' => get_sub_field('content', $post_id),
                        'image' => get_sub_field('image', $post_id),
                        'video' => get_sub_field('video_url', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'lander-2'): ?>
                    <?php $position_class = ''; ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php
                    ll_include_component(
                      'lander-2',
                      array(
                        'content' => get_sub_field('content', $post_id),
                        'image' => get_sub_field('image', $post_id),
                        'blocks' => get_sub_field('blocks', $post_id),
                        'video' => get_sub_field('video_url', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'lander-2-b'): ?>
                    <?php $position_class = ''; ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php
                    ll_include_component(
                      'lander-2',
                      array(
                        'content' => get_sub_field('content', $post_id),
                        'image' => get_sub_field('image', $post_id),
                        'blocks' => get_sub_field('blocks', $post_id),
                        'video' => get_sub_field('video_url', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'is-bordered', get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_group_offset'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-photo-group--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-photo-group--last';
                    }
                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }
                    ?>

                    <?php
                    ll_include_component(
                      'photo-group',
                      array(
                        'images' => get_sub_field('images', $post_id),
                        'type' => 'offset',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'text_size' => get_sub_field('text_size', $post_id),
                        'text_color' => get_sub_field('text_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-photo-group--offset', 'll-photo-group--offset--' . get_sub_field('alignment', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), get_sub_field('show_text', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_group_basic'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-photo-group--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-photo-group--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php
                    ll_include_component(
                      'photo-group',
                      array(
                        'images' => get_sub_field('images', $post_id),
                        'type' => 'basic',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'text_size' => get_sub_field('text_size', $post_id),
                        'text_color' => get_sub_field('text_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-photo-group--basic', 'll-photo-group--basic--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), get_sub_field('show_text', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_group_staggered'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-photo-group--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-photo-group--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php $class = 'normal'; ?>
                    <?php if (get_sub_field('switch_position', $post_id)): ?>
                          <?php $class = 'switch'; ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'photo-group',
                      array(
                        'images' => get_sub_field('images', $post_id),
                        'type' => 'staggered',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'text_size' => get_sub_field('text_size', $post_id),
                        'text_color' => get_sub_field('text_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-photo-group--staggered', 'll-photo-group--staggered--' . $class, 'll-photo-group--staggered--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), get_sub_field('show_text', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_group_group'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-photo-group--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-photo-group--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php $class = 'normal'; ?>
                    <?php if (get_sub_field('switch_position', $post_id)): ?>
                          <?php $class = 'switch'; ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'photo-group',
                      array(
                        'images' => get_sub_field('images', $post_id),
                        'type' => 'group',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'text_size' => get_sub_field('text_size', $post_id),
                        'text_color' => get_sub_field('text_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-photo-group--group', 'll-photo-group--group--' . $class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), get_sub_field('show_text', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'post_grid_one'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-post-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-post-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php
                    ll_include_component(
                      'post-grid',
                      array(
                        'items' => get_sub_field('items', $post_id),
                        'type' => 'normal',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'size' => get_sub_field('image_size', $post_id),
                        'main_text_size' => get_sub_field('main_text_size', $post_id),
                        'secondary_text_size' => get_sub_field('secondary_text_size', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-post-grid--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'post_grid_two'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-post-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-post-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php
                    ll_include_component(
                      'post-grid',
                      array(
                        'items' => get_sub_field('items', $post_id),
                        'type' => 'vertical-line',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'size' => get_sub_field('image_size', $post_id),
                        'main_text_size' => get_sub_field('main_text_size', $post_id),
                        'secondary_text_size' => get_sub_field('secondary_text_size', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-post-grid--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'post_grid_three'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-post-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-post-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php
                    ll_include_component(
                      'post-grid',
                      array(
                        'items' => get_sub_field('items', $post_id),
                        'type' => 'horizontal-line',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'size' => get_sub_field('image_size', $post_id),
                        'main_text_size' => get_sub_field('main_text_size', $post_id),
                        'secondary_text_size' => get_sub_field('secondary_text_size', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-post-grid--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'post_grid_four'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-post-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-post-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    ?>

                    <?php
                    ll_include_component(
                      'post-grid',
                      array(
                        'items' => get_sub_field('items', $post_id),
                        'type' => 'on-image',
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'size' => get_sub_field('image_size', $post_id),
                        'main_text_size' => get_sub_field('main_text_size', $post_id),
                        'secondary_text_size' => get_sub_field('secondary_text_size', $post_id),
                        'text_color' => get_sub_field('text_color', $post_id),
                        'overlay_color' => get_sub_field('overlay_color', $post_id),
                        'overlay_opacity' => get_sub_field('overlay_opacity', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, 'll-post-grid--' . get_sub_field('image_size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_slider_regular'): ?>
                    <?php
                    $slides = get_sub_field('slides', $post_id);

                    if (get_sub_field('static_or_dynamic', $post_id) == 'dynamic') {
                      $dynamic_content = get_sub_field('dynamic_content', $post_id);
                      $galleries = get_field('galleries', $dynamic_content['page_to_pull']);
                      $slides = $galleries[$dynamic_content['meta_key'] - 1]['gallery_items'];
                    }
                    ?>
                    <?php
                    ll_include_component(
                      'photo-slider',
                      array(
                        'slides' => $slides,
                        'image_contain' => get_sub_field('image_contain', $post_id),
                        'type' => ''
                      ),
                      array(
                        'classes' => array( get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_slider_full'): ?>

                    <?php
                    ll_include_component(
                      'photo-slider',
                      array(
                        'slides' => get_sub_field('images', $post_id),
                        'image_contain' => get_sub_field('image_contain', $post_id),
                        'type' => 'full'
                      ),
                      array(
                        'classes' => array( get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_slider_bordered'): ?>

                    <?php
                    ll_include_component(
                      'photo-slider',
                      array(
                        'slides' => get_sub_field('images', $post_id),
                        'image_contain' => get_sub_field('image_contain', $post_id),
                        'type' => 'bordered'
                      ),
                      array(
                        'classes' => array( get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'card_grid'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-card-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-card-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }


                    $items = get_sub_field('items', $post_id);

                    if (get_sub_field('list_type', $post_id) == 'dynamic') {
                      $items = ll_get_posts(get_sub_field('post_type', $post_id), get_sub_field('posts_to_show', $post_id), get_sub_field('post_category', $post_id));
                    }
                    ?>

                    <?php
                    ll_include_component(
                      'card-grid',
                      array(
                        'items' => $items,
                        'color' => get_sub_field('color', $post_id),
                        'text-color' => get_sub_field('text-color', $post_id),
                        'hover_color' => get_sub_field('hover_color', $post_id),
                        'hover_text_color' => get_sub_field('hover_text_color', $post_id),
                        'pattern' => get_sub_field('pattern', $post_id),
                        'opacity' => get_sub_field('opacity', $post_id),
                        'is_offset' => get_sub_field('is_offset', $post_id),
                        'will_parallax' => get_sub_field('will_parallax', $post_id),
                        'top_text_size' => get_sub_field('top_text', $post_id),
                        'middle_text_size' => get_sub_field('middle_text', $post_id),
                        'bottom_text_size' => get_sub_field('bottom_text', $post_id),
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'post_list'): ?>
                    <?php
                    $position_class = '';
                    if (! ll_is_grid_layout($previous_component)) {
                      $position_class .= ' ll-card-grid--first';
                    }
                    ;

                    if (! ll_is_grid_layout($next_component)) {
                      $position_class .= ' ll-card-grid--last';
                    }

                    if ($index == 1) {
                      $position_class .= ' is-first';
                    }

                    $items = get_sub_field('items', $post_id);

                    if (get_sub_field('list_type', $post_id) == 'dynamic') {
                      $items = ll_get_posts(get_sub_field('post_type', $post_id), get_sub_field('posts_to_show', $post_id));
                    }
                    ?>

                    <?php
                    ll_include_component(
                      'post-list',
                      array(
                        'items' => $items,
                        'will_parallax' => get_sub_field('will_parallax', $post_id)
                      ),
                      array(
                        'classes' => array( get_sub_field('image_size', $post_id), $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'text_slider'): ?>

                    <?php
                    ll_include_component(
                      'text-slider',
                      array(
                        'columns' => get_sub_field('columns', $post_id),
                        'alignment' => get_sub_field('alignment', $post_id),
                        'size' => get_sub_field('size', $post_id),
                        'indent' => get_sub_field('indent', $post_id)
                      ),
                      array(
                        'classes' => array( get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'one_column'): ?>
                    <?php
                    $position_class = '';
                    $background_color = get_sub_field('background_color', $post_id);
                    $inner_top = '';
                    $inner_bottom = '';
                    ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php if ($background_color): ?>
                          <?php
                          $inner_top = get_sub_field('inner_top_spacing', $post_id);
                          $inner_bottom = get_sub_field('inner_bottom_spacing', $post_id);
                          ?>
                    <?php endif; ?>

                    <?php
                    ll_include_component(
                      'one-column',
                      array(
                        'columns' => get_sub_field('columns', $post_id),
                        'alignment' => get_sub_field('alignment', $post_id),
                        'size' => get_sub_field('size', $post_id),
                        'indent' => get_sub_field('indent', $post_id),
                        'background_color' => get_sub_field('background_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), $inner_top, $inner_bottom )
                      )
                    );
                    ?>


                <?php elseif (get_row_layout() == 'content_countup'): ?>

                    <?php
                    $sections = get_sub_field('sections'); // Repeater with 'number', 'append', and 'content'
                    ll_include_component(
                      'content-countup',
                      array(
                        'sections' => $sections
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'two_column'): ?>
                    <?php
                    $position_class = '';
                    $background_color = get_sub_field('background_color', $post_id);
                    $inner_top = '';
                    $inner_bottom = '';
                    ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php if ($background_color): ?>
                          <?php
                          $inner_top = get_sub_field('inner_top_spacing', $post_id);
                          $inner_bottom = get_sub_field('inner_bottom_spacing', $post_id);
                          ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'two-column',
                      array(
                        'intro_content' => get_sub_field('intro_content', $post_id),
                        'columns' => get_sub_field('columns', $post_id),
                        'alignment' => get_sub_field('alignment', $post_id),
                        'size' => get_sub_field('size', $post_id),
                        'width' => get_sub_field('width', $post_id),
                        'background_color' => get_sub_field('background_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), $inner_top, $inner_bottom )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'three_column'): ?>
                    <?php
                    $position_class = '';
                    $background_color = get_sub_field('background_color', $post_id);
                    $inner_top = '';
                    $inner_bottom = '';
                    ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php if ($background_color): ?>
                          <?php
                          $inner_top = get_sub_field('inner_top_spacing', $post_id);
                          $inner_bottom = get_sub_field('inner_bottom_spacing', $post_id);
                          ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'three-column',
                      array(
                        'intro_content' => get_sub_field('intro_content', $post_id),
                        'columns' => get_sub_field('columns', $post_id),
                        'alignment' => get_sub_field('alignment', $post_id),
                        'size' => get_sub_field('size', $post_id),
                        'width' => get_sub_field('width', $post_id),
                        'background_color' => get_sub_field('background_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), $inner_top, $inner_bottom )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'four_column'): ?>
                    <?php
                    $position_class = '';
                    $background_color = get_sub_field('background_color', $post_id);
                    $inner_top = '';
                    $inner_bottom = '';
                    ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>

                    <?php if ($background_color): ?>
                          <?php
                          $inner_top = get_sub_field('inner_top_spacing', $post_id);
                          $inner_bottom = get_sub_field('inner_bottom_spacing', $post_id);
                          ?>
                    <?php endif; ?>
                    <?php
                    ll_include_component(
                      'four-column',
                      array(
                        'intro_content' => get_sub_field('intro_content', $post_id),
                        'columns' => get_sub_field('columns', $post_id),
                        'alignment' => get_sub_field('alignment', $post_id),
                        'background_color' => get_sub_field('background_color', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id), $inner_top, $inner_bottom )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'left_right'): ?>
                    <?php $position_class = ''; ?>
                    <?php if ($index == 1): ?>
                          <?php $position_class = 'is-first'; ?>
                    <?php endif; ?>
                    <?php
                    $image = get_sub_field('image', $post_id);
                    ll_include_component(
                      'left-right',
                      array(
                        'content' => get_sub_field('content', $post_id),
                        'image' => $image['url'],
                        'will_parallax' => get_sub_field('will_parallax', $post_id)
                      ),
                      array(
                        'classes' => array( $position_class, get_sub_field('background_size', $post_id), get_sub_field('show_full_image', $post_id), get_sub_field('background_position', $post_id), get_sub_field('alignment', $post_id), get_sub_field('layout', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_divider_contained'): ?>

                    <?php
                    $image = get_sub_field('image', $post_id);
                    ll_include_component(
                      'photo-break-1',
                      array(
                        'image' => $image
                      ),
                      array(
                        'classes' => array( get_sub_field('size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'photo_divider_full'): ?>

                    <?php
                    $image = get_sub_field('image', $post_id);

                    ll_include_component(
                      'photo-break-2',
                      array(
                        'image' => $image
                      ),
                      array(
                        'classes' => array( get_sub_field('bordered', $post_id), get_sub_field('size', $post_id), get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'google_map'): ?>

                    <?php
                    $locations = get_sub_field('locations', $post_id);
                    ll_include_component(
                      'google-map',
                      array(
                        'locations' => $locations
                      ),
                      array(
                        'classes' => array( get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) ),
                        'id' => 'gmap-' . $index
                      )
                    );
                    ?>

              <?php elseif (get_row_layout() == 'steps'): ?>

                    <?php
                    $steps = get_sub_field('steps');
                    ll_include_component(
                      'steps',
                      array(
                        'background_image' => get_sub_field('background_image'),
                        'initial_content' => get_sub_field('initial_content'),
                        'steps' => $steps
                      )
                    );
                    ?>


              <?php elseif (get_row_layout() == 'posts'): ?>
                    <?php if (is_post_type_archive() || is_home() || is_archive() || is_tax()): ?>

                          <?php
                          global $wp_query;
                          $post_type = $wp_query->query['post_type'];

                          if (is_tax()) {
                            $query_term = get_queried_object();
                            $query_taxonomy = get_taxonomy($query_term->taxonomy);
                            if (! empty($query_taxonomy->object_type)) {
                              $post_type = $query_taxonomy->object_type[0];
                            }
                          }
                          if (is_home() || is_category()) {
                            $post_type = 'post';
                          }

                          $post_layout = ll_get_posts_layout($post_id);
                          $taxonomy = ll_get_the_taxonomy($post_type);
                          $position_class = '';

                          if (! ll_is_grid_layout($previous_component)) {
                            $position_class .= ' ll-card-grid--first';
                          }
                          ;

                          if (! ll_is_grid_layout($next_component)) {
                            $position_class .= ' ll-card-grid--last';
                          }

                          $items;

                          while (have_posts()):
                            the_post();
                            $categories = ll_get_the_terms($post, $post->post_type);
                            $top_text = $categories;
                            $sub_text = get_the_excerpt();

                            if ($post->post_type == 'post') {
                              $top_text = get_the_date();
                              $sub_text = $categories;
                            }

                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            $items[] = array(
                              'image' => array(
                                'url' => $image[0],
                                'width' => $image[1],
                                'height' => $image[2]
                              ),
                              'sub_text' => $sub_text,
                              'title' => get_the_title(),
                              'top_text' => $top_text,
                              'link' => get_permalink()
                            );
                          endwhile;

                          if ($taxonomy) {
                            ll_include_component(
                              'filter',
                              array(
                                'post_type' => $post_type,
                                'taxonomy' => $taxonomy
                              ),
                              array(
                                'id' => 'filter',
                                'classes' => array( 'spacing-top-none', 'spacing-bottom-none' )
                              )
                            );
                          }

                          // @TODO: add field options to "post archive" component
                          if ($items) {
                            if ($post_layout == 'list-grid') {
                              $size_class = 'is-medium';

                              ll_include_component(
                                'post-list',
                                array(
                                  'items' => $items
                                ),
                                array(
                                  'classes' => array( $size_class, $position_class, 'spacing-top-medium', 'spacing-bottom-none' ),
                                  'id' => 'the-posts'
                                )
                              );
                            } else {
                              ll_include_component(
                                'card-grid',
                                array(
                                  'items' => $items,
                                  'color' => '#f5f5f5',
                                  'text-color' => '#000',
                                  'pattern' => null,
                                  'hover_color' => '#f5f5f5',
                                  'opacity' => 1,
                                  'is_offset' => false
                                ),
                                array(
                                  'classes' => array( $position_class, 'spacing-top-medium', 'spacing-bottom-medium' ),
                                  'id' => 'the-posts'
                                )
                              );
                            }
                          }

                          // @TODO: @feature Update links to use #the-posts for correct anchoring ?>
                          <?php if ($wp_query->max_num_pages > 1): ?>
                                <?php ll_numeric_posts_nav(); ?>
                          <?php endif; ?>

                    <?php endif; ?>

                <?php elseif (get_row_layout() == 'gallery_popup_list'): ?>
                      <?php
                      $position_class = '';
                      if (! ll_is_grid_layout($previous_component)) {
                        $position_class .= ' ll-card-grid--first';
                      }
                      ;

                      if (! ll_is_grid_layout($next_component)) {
                        $position_class .= ' ll-card-grid--last';
                      }

                      if ($index == 1) {
                        $position_class .= ' is-first';
                      }

                      $items = ll_get_gallery_posts(get_sub_field('post_type', $post_id), -1, get_sub_field('category', $post_id));

                      ?>

                      <?php
                      ll_include_component(
                        'gallery-post-list',
                        array(
                          'items' => $items,
                          'will_parallax' => get_sub_field('will_parallax', $post_id),
                          'image_contain' => get_sub_field('image_contain', $post_id)
                        ),
                        array(
                          'classes' => array( get_sub_field('image_size', $post_id), $position_class, get_sub_field('top_spacing', $post_id), get_sub_field('bottom_spacing', $post_id) )
                        )
                      );
                      ?>
              <?php elseif (get_row_layout() == 'global_component'): ?>
                    <?php $component_key = get_sub_field('component_selection', $post_id) ?>
                    <?php include(locate_template('templates/partials/global-components.php')); ?>
              <?php endif; ?>



        <?php endwhile; ?>

  <?php endif; ?>

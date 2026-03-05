<?php
  $components = get_field( 'components', 'option' );
?>
  <?php if ( $components ) : ?>
    <?php
      $index = $component_key + 1;
      $next_index = $index; //get_row_index starts at 1 instead of zero
      $previous_index = $index - 2; //get_row_index starts at 1 instead of zero so to go BACK a component we must go back 2
      $previous_component = $components[$previous_index]['acf_fc_layout'];
      $next_component = $components[$next_index]['acf_fc_layout'];
    ?>

    <?php if( $components[$component_key]['acf_fc_layout'] == 'lander-1' ) : ?>
      <?php $position_class = ''; ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'lander-1',
          array(
            'content' => $components[$component_key]['content'],
            'image'   => $components[$component_key]['image'],
            'video'   => $components[$component_key]['video_url']
          ),
          array(
            'classes' => array($position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'lander-2' ) : ?>
      <?php $position_class = ''; ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php
        ll_include_component(
          'lander-2',
          array(
            'content' => $components[$component_key]['content'],
            'image'   => $components[$component_key]['image'],
            'blocks'  => $components[$component_key]['blocks'],
            'video'   => $components[$component_key]['video_url']
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'lander-2-b' ) : ?>
      <?php $position_class = ''; ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php
        ll_include_component(
          'lander-2',
          array(
            'content' => $components[$component_key]['content'],
            'image'   => $components[$component_key]['image'],
            'blocks'  => $components[$component_key]['blocks'],
            'video'   => $components[$component_key]['video_url']
          ),
          array(
            'classes' => array($position_class, 'is-bordered', $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_group_offset' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-photo-group--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-photo-group--last';
        }
        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }
      ?>

      <?php
        ll_include_component(
          'photo-group',
          array(
            'images' => $components[$component_key]['images'],
            'type'   => 'offset',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'text_size' => $components[$component_key]['text_size'],
            'text_color' => $components[$component_key]['text_color']
          ),
          array(
            'classes' => array( $position_class ,'ll-photo-group--offset', 'll-photo-group--offset--'.$components[$component_key]['alignment'] ,$components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $components[$component_key]['show_text'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_group_basic' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-photo-group--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-photo-group--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php
        ll_include_component(
          'photo-group',
          array(
            'images' => $components[$component_key]['images'],
            'type'   => 'basic',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'text_size' => $components[$component_key]['text_size'],
            'text_color' => $components[$component_key]['text_color']
          ),
          array(
            'classes' => array( $position_class ,'ll-photo-group--basic', 'll-photo-group--basic--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $components[$component_key]['show_text'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_group_staggered' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-photo-group--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-photo-group--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php $class = 'normal'; ?>
      <?php if ( $components[$component_key]['switch_position'] ) : ?>
        <?php $class = 'switch'; ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'photo-group',
          array(
            'images' => $components[$component_key]['images'],
            'type'   => 'staggered',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'text_size' => $components[$component_key]['text_size'],
            'text_color' => $components[$component_key]['text_color']
          ),
          array(
            'classes' => array( $position_class , 'll-photo-group--staggered','ll-photo-group--staggered--'.$class,'ll-photo-group--staggered--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $components[$component_key]['show_text'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_group_group' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-photo-group--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-photo-group--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php $class = 'normal'; ?>
      <?php if ( $components[$component_key]['switch_position'] ) : ?>
        <?php $class = 'switch'; ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'photo-group',
          array(
            'images' => $components[$component_key]['images'],
            'type'   => 'group',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'text_size' => $components[$component_key]['text_size'],
            'text_color' => $components[$component_key]['text_color']
          ),
          array(
            'classes' => array( $position_class , 'll-photo-group--group','ll-photo-group--group--'.$class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $components[$component_key]['show_text'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'post_grid_one' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-post-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-post-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php
        ll_include_component(
          'post-grid',
          array(
            'items' => $components[$component_key]['items'],
            'type'   => 'normal',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'size' => $components[$component_key]['image_size'],
            'main_text_size' => $components[$component_key]['main_text_size'],
            'secondary_text_size' => $components[$component_key]['secondary_text_size']
          ),
          array(
            'classes' => array( $position_class, 'll-post-grid--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'post_grid_two' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-post-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-post-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php
        ll_include_component(
          'post-grid',
          array(
            'items' => $components[$component_key]['items'],
            'type'   => 'vertical-line',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'size' => $components[$component_key]['image_size'],
            'main_text_size' => $components[$component_key]['main_text_size'],
            'secondary_text_size' => $components[$component_key]['secondary_text_size']
          ),
          array(
            'classes' => array( $position_class, 'll-post-grid--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'post_grid_three' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-post-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-post-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php
        ll_include_component(
          'post-grid',
          array(
            'items' => $components[$component_key]['items'],
            'type'   => 'horizontal-line',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'size' => $components[$component_key]['image_size'],
            'main_text_size' => $components[$component_key]['main_text_size'],
            'secondary_text_size' => $components[$component_key]['secondary_text_size']
          ),
          array(
            'classes' => array( $position_class, 'll-post-grid--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'post_grid_four' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-post-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-post-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

      ?>

      <?php
        ll_include_component(
          'post-grid',
          array(
            'items' => $components[$component_key]['items'],
            'type'   => 'on-image',
            'will_parallax' => $components[$component_key]['will_parallax'],
            'size' => $components[$component_key]['image_size'],
            'main_text_size' => $components[$component_key]['main_text_size'],
            'secondary_text_size' => $components[$component_key]['secondary_text_size'],
            'text_color' => $components[$component_key]['text_color'],
            'overlay_color' => $components[$component_key]['overlay_color'],
            'overlay_opacity' => $components[$component_key]['overlay_opacity']
          ),
          array(
            'classes' => array( $position_class, 'll-post-grid--'.$components[$component_key]['image_size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_slider_regular' ) : ?>
      <?php
        $slides = $components[$component_key]['slides'];

        if ( $components[$component_key]['static_or_dynamic'] == 'dynamic' ) {
          $dynamic_content = $components[$component_key]['dynamic_content'];
          $galleries = get_field( 'galleries', $dynamic_content['page_to_pull'] );
          $slides = $galleries[$dynamic_content['meta_key'] - 1]['gallery_items'];
        }
      ?>
      <?php
        ll_include_component(
          'photo-slider',
          array(
            'slides' => $slides,
            'image_contain' => $components[$component_key]['image_contain'],
            'type' => ''
          ),
          array(
            'classes' => array( $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_slider_full' ) : ?>

      <?php
        ll_include_component(
          'photo-slider',
          array(
            'slides' => $components[$component_key]['images'],
            'image_contain' => $components[$component_key]['image_contain'],
            'type' => 'full'
          ),
          array(
            'classes' => array( $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_slider_bordered' ) : ?>

      <?php
        ll_include_component(
          'photo-slider',
          array(
            'slides' => $components[$component_key]['images'],
            'image_contain' => $components[$component_key]['image_contain'],
            'type' => 'bordered'
          ),
          array(
            'classes' => array( $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'card_grid' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-card-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-card-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }


        $items = $components[$component_key]['items'];

        if ( $components[$component_key]['list_type'] == 'dynamic' ) {
          $items = ll_get_posts( $components[$component_key]['post_type'], $components[$component_key]['posts_to_show'] );
        }
      ?>

      <?php
        ll_include_component(
          'card-grid',
          array(
            'items'       => $items,
            'color'       => $components[$component_key]['color'],
            'text-color'  => $components[$component_key]['text-color'],
            'hover_color' => $components[$component_key]['hover_color'],
            'hover_text_color' => $components[$component_key]['hover_text_color'],
            'pattern'     => $components[$component_key]['pattern'],
            'opacity'     => $components[$component_key]['opacity'],
            'is_offset'   => $components[$component_key]['is_offset'],
            'will_parallax' => $components[$component_key]['will_parallax'],
            'top_text_size' => $components[$component_key]['top_text'],
            'middle_text_size' => $components[$component_key]['middle_text'],
            'bottom_text_size' => $components[$component_key]['bottom_text'],
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'post_list' ) : ?>
      <?php
        $position_class = '';
        if ( !ll_is_grid_layout( $previous_component ) ) {
          $position_class .= ' ll-card-grid--first';
        };

        if ( !ll_is_grid_layout( $next_component ) ) {
          $position_class .= ' ll-card-grid--last';
        }

        if ( $index == 1 ) {
          $position_class .= ' is-first';
        }

        $items = $components[$component_key]['items'];

        if ( $components[$component_key]['list_type'] == 'dynamic' ) {
          $items = ll_get_posts( $components[$component_key]['post_type'], $components[$component_key]['posts_to_show'] );
        }
      ?>

      <?php
        ll_include_component(
          'post-list',
          array(
            'items' => $items,
            'will_parallax' => $components[$component_key]['will_parallax']
          ),
          array(
            'classes' => array( $components[$component_key]['image_size'] , $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'text_slider' ) : ?>

      <?php
        ll_include_component(
          'text-slider',
          array(
            'columns'   => $components[$component_key]['columns'],
            'alignment' => $components[$component_key]['alignment'],
            'size'      => $components[$component_key]['size'],
            'indent'    => $components[$component_key]['indent']
          ),
          array(
            'classes' => array( $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'one_column' ) : ?>
      <?php
        $position_class = '';
        $background_color = $components[$component_key]['background_color'];
        $inner_top = '';
        $inner_bottom = '';
      ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php if ( $background_color ) : ?>
        <?php
          $inner_top = $components[$component_key]['inner_top_spacing'];
          $inner_bottom = $components[$component_key]['inner_bottom_spacing'];
        ?>
      <?php endif; ?>

      <?php
        ll_include_component(
          'one-column',
          array(
            'columns'   => $components[$component_key]['columns'],
            'alignment' => $components[$component_key]['alignment'],
            'size'      => $components[$component_key]['size'],
            'indent'    => $components[$component_key]['indent'],
            'background_color' => $components[$component_key]['background_color']
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $inner_top, $inner_bottom )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'two_column' ) : ?>
      <?php
        $position_class = '';
        $background_color = $components[$component_key]['background_color'];
        $inner_top = '';
        $inner_bottom = '';
      ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php if ( $background_color ) : ?>
        <?php
          $inner_top = $components[$component_key]['inner_top_spacing'];
          $inner_bottom = $components[$component_key]['inner_bottom_spacing'];
        ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'two-column',
          array(
            'intro_content' => $components[$component_key]['intro_content'],
            'columns' => $components[$component_key]['columns'],
            'alignment' => $components[$component_key]['alignment'],
            'size'      => $components[$component_key]['size'],
            'width'     => $components[$component_key]['width'],
            'background_color' => $components[$component_key]['background_color']
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $inner_top, $inner_bottom )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'three_column' ) : ?>
      <?php
        $position_class = '';
        $background_color = $components[$component_key]['background_color'];
        $inner_top = '';
        $inner_bottom = '';
      ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php if ( $background_color ) : ?>
        <?php
          $inner_top = $components[$component_key]['inner_top_spacing'];
          $inner_bottom = $components[$component_key]['inner_bottom_spacing'];
        ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'three-column',
          array(
            'intro_content' => $components[$component_key]['intro_content'],
            'columns' => $components[$component_key]['columns'],
            'alignment' => $components[$component_key]['alignment'],
            'size'      => $components[$component_key]['size'],
            'width'     => $components[$component_key]['width'],
            'background_color' => $components[$component_key]['background_color']
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $inner_top, $inner_bottom )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'four_column' ) : ?>
      <?php
        $position_class = '';
        $background_color = $components[$component_key]['background_color'];
        $inner_top = '';
        $inner_bottom = '';
      ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>

      <?php if ( $background_color ) : ?>
        <?php
          $inner_top = $components[$component_key]['inner_top_spacing'];
          $inner_bottom = $components[$component_key]['inner_bottom_spacing'];
        ?>
      <?php endif; ?>
      <?php
        ll_include_component(
          'four-column',
          array(
            'intro_content' => $components[$component_key]['intro_content'],
            'columns' => $components[$component_key]['columns'],
            'alignment' => $components[$component_key]['alignment'],
            'background_color' => $components[$component_key]['background_color']
          ),
          array(
            'classes' => array( $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'], $inner_top, $inner_bottom )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'left_right' ) : ?>
      <?php $position_class = ''; ?>
      <?php if ( $index == 1 ) : ?>
        <?php $position_class = 'is-first'; ?>
      <?php endif; ?>
      <?php
        $image = $components[$component_key]['image'];
        ll_include_component(
          'left-right',
          array(
            'content' => $components[$component_key]['content'],
            'image'   => $image['url'],
            'will_parallax' => $components[$component_key]['will_parallax']
          ),
          array(
            'classes' => array($position_class, $components[$component_key]['background_size'], $components[$component_key]['show_full_image'], $components[$component_key]['background_position'], $components[$component_key]['alignment'], $components[$component_key]['layout'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_divider_contained' ) : ?>

      <?php
        $image = $components[$component_key]['image'];
        ll_include_component(
          'photo-break-1',
          array(
            'image'   => $image
          ),
          array(
            'classes' => array( $components[$component_key]['size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'photo_divider_full' ) : ?>

      <?php
        $image = $components[$component_key]['image'];

        ll_include_component(
          'photo-break-2',
          array(
            'image'   => $image
          ),
          array(
            'classes' => array( $components[$component_key]['bordered'], $components[$component_key]['size'], $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'google_map' ) : ?>

      <?php
        $locations = $components[$component_key]['locations'];
        ll_include_component(
          'google-map',
          array(
            'locations' => $locations
          ),
          array(
            'classes' => array( $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] ),
            'id' => 'gmap-'.$index
          )
        );
      ?>

    <?php elseif( $components[$component_key]['acf_fc_layout'] == 'posts' ) : ?>
      <?php if ( is_post_type_archive() || is_home() || is_archive() || is_tax() ) : ?>

        <?php
          global $wp_query;
          $post_type = $wp_query->query['post_type'];

          if ( is_tax() ) {
            $query_term = get_queried_object();
            $query_taxonomy = get_taxonomy( $query_term->taxonomy );
            if ( !empty( $query_taxonomy->object_type ) ) {
              $post_type = $query_taxonomy->object_type[0];
            }
          }
          if ( is_home() || is_category() ) {
            $post_type = 'post';
          }

          $post_layout = ll_get_posts_layout( 'option' );
          $taxonomy = ll_get_the_taxonomy( $post_type );
          $position_class = '';

          if ( !ll_is_grid_layout( $previous_component ) ) {
            $position_class .= ' ll-card-grid--first';
          };

          if ( !ll_is_grid_layout( $next_component ) ) {
            $position_class .= ' ll-card-grid--last';
          }

          $items;

          while (have_posts()) : the_post();
            $categories = ll_get_the_terms( $post, $post->post_type );
            $top_text = $categories;
            $sub_text = get_the_excerpt();

            if ( $post->post_type == 'post' ) {
              $top_text = get_the_date();
              $sub_text = $categories;
            }

            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
            $items[] = array(
              'image' => array(
                'url' => $image[0],
                'width' => $image[1],
                'height' => $image[2]
              ),
              'sub_text' => $sub_text,
              'title'    => get_the_title(),
              'top_text' => $top_text,
              'link'     => get_permalink()
            );
          endwhile;

          if ( $taxonomy ) {
            ll_include_component(
              'filter',
              array(
                'post_type' => $post_type,
                'taxonomy'  => $taxonomy
              ),
              array(
                'id' => 'filter',
                'classes' => array( 'spacing-top-none', 'spacing-bottom-none' )
              )
            );
          }

          // @TODO: add field options to "post archive" component
          if ( $items ) {
            if ( $post_layout == 'list-grid' ) {
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
                  'items'       => $items,
                  'color'       => '#f5f5f5',
                  'text-color'  => '#000',
                  'pattern'     => null,
                  'hover_color' => '#f5f5f5',
                  'opacity'     => 1,
                  'is_offset'   => true
                ),
                array(
                  'classes' => array( $position_class, 'spacing-top-medium', 'spacing-bottom-medium' ),
                  'id' => 'the-posts'
                )
              );
            }
          }

        // @TODO: @feature Update links to use #the-posts for correct anchoring ?>
        <?php if ($wp_query->max_num_pages > 1) : ?>
          <?php ll_numeric_posts_nav(); ?>
        <?php endif; ?>

      <?php endif; ?>

      <?php elseif ( $components[$component_key]['acf_fc_layout'] == 'gallery_popup_list' ) : ?>
        <?php
          $position_class = '';
          if ( !ll_is_grid_layout( $previous_component ) ) {
            $position_class .= ' ll-card-grid--first';
          };

          if ( !ll_is_grid_layout( $next_component ) ) {
            $position_class .= ' ll-card-grid--last';
          }

          if ( $index == 1 ) {
            $position_class .= ' is-first';
          }

          $items = ll_get_gallery_posts( $components[$component_key]['post_type'], -1,  $components[$component_key]['category'] );

        ?>

        <?php
          ll_include_component(
            'gallery-post-list',
            array(
              'items' => $items,
              'will_parallax' => $components[$component_key]['will_parallax'],
              'image_contain' => $components[$component_key]['image_contain']
            ),
            array(
              'classes' => array( $components[$component_key]['image_size'] , $position_class, $components[$component_key]['top_spacing'], $components[$component_key]['bottom_spacing'] )
            )
          );
        ?>
      <?php endif; ?>
  <?php endif; ?>

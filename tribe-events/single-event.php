<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">
  <?php /*
  <p class="tribe-events-back" style="margin-left: 7.25em">
    <a class="button is-lined line-left" href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
  </p>

  <!-- Notices -->
  <?php tribe_the_notices() ?>

  <?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>

  <div class="tribe-events-schedule tribe-clearfix">
    <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
    <?php if ( tribe_get_cost() ) : ?>
      <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
    <?php endif; ?>
  </div>
  */ ?>

  <?php while ( have_posts() ) :  the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <!-- Event featured image, but exclude link -->
      <?php if ( tribe_event_featured_image($event_id, 'full', false ) ) : ?>
        <?php
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "Full");
          $image['url'] = $image[0];
          ll_include_component(
            'lander-1',
            array(
              'content' => '<h1 class="h2">'.get_the_title( $event_id ).'</h1>',
              'image'   => $image
            ),
            array(
              'classes' => array( 'spacing-top-medium', 'spacing-bottom-small' )
            )
          );
        ?>
        <?php
          ll_include_component(
            'one-column',
            array(
              'columns'   => array(
                0 => array(
                  'content' => format_text(get_the_content())
                )
              ),
              'alignment' => 'left',
              'size' => 'full'
            ),
            array(
              'classes' => array( 'spacing-top-none', 'spacing-bottom-medium' )
            )
          );
        ?>
      <?php else : ?>
        <?php
          ll_include_component(
            'one-column',
            array(
              'columns'   => array(
                0 => array(
                  'content' => '<h1 class="h2">'.get_the_title( $event_id ).'</h1><p></p>'. get_the_content()
                )
              ),
              'alignment' => 'left',
            ),
            array(
              'classes' => array( 'spacing-top-medium', 'spacing-bottom-medium' )
            )
          );
        ?>
      <?php endif; ?>

      <!-- Event meta -->
      <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
      <?php tribe_get_template_part( 'modules/meta' ); ?>
      <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
    </div> <!-- #post-x -->
  <?php endwhile; ?>


</div><!-- #tribe-events-content -->

<?php
/**
 * Would generate the widget for recent post.
 * Though wordpress already has recent post widget available by default,
 * this widget do just a little extra by showing featured images as well
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

add_action('widgets_init', 'register_sup_recent_posts' );
function register_sup_recent_posts(){
	register_widget( 'sup_recent_posts' );
	}

class sup_recent_posts extends WP_Widget{

	function __construct(){

			$widget_opts = array(
				'classname' => 'sup_recentposts',
				'description' => __('Shows recent posts with date and featured image', 'supernova'),
			);

			$control_opts = array(
				'width' => 250,
				'height' => 350,
				'id_base' => 'sup_recentposts'
			 );

			parent::__construct('sup_recentposts', __('Supernova Recent Posts', 'supernova'), $widget_opts, $control_opts );
		}

	function widget($arg, $instance){
		extract($arg, EXTR_SKIP);

		$title = isset( $instance['title'] ) ? $instance['title'] : false;
		$number = isset( $instance['number'] ) ? $instance['number'] : false;

		echo $before_widget;

		if( $title ) echo $before_title. $title. $after_title;

			$args = apply_filters( 'sup_latest_posts_widget_args' , array(
			        'posts_per_page'      => intval($number),
			        'ignore_sticky_posts' => true,
			        'post_status'         => 'publish',
			        'orderby'             => 'date',
			    ), $number );

			$query = new WP_Query( $args ); ?>

			<?php if( $query->have_posts() ) : ?>
				<ul>
				<?php while( $query->have_posts() ): $query->the_post(); ?>
					<li>
                    	<?php sup_thumbnail( 'thumbnail' , sprintf( '<figure class="sup-rp-thumb"><a href="%s">' , get_permalink( get_the_ID() ) ) , '</a></figure>' , true ); ?>
						<?php the_title( sprintf( "<h4 class='sup-rp-title'><a href='%s'>" , get_permalink( get_the_ID() ) ), '</a></h4>' ); ?>
						<div class="sup-rp-meta">
							<span class="sup-icon-calendar"></span>
							<?php echo sup_posted_on(); ?>
						</div>
					</li>
				<?php endwhile; ?>
				</ul>
		<?php endif; ?>

        <?php echo $after_widget;

		}

	function update($new_instance, $old_instance){
				$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
		}

		//dashboard form
	function form($instance){

		$defaults = array( 'title' =>'Recent posts', 'number' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults );

		//Widget Title: Text Input
		echo '<p>';
                    echo '<label for="'.$this->get_field_id( 'title' ).'">'. __('Title:','supernova').'</label>';
                    echo '<input id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" value="'.$instance['title'].'" style="width:90%;" />';
		echo '</p>';

		//Number of posts
		echo '<p>';
                echo '<label for="'.$this->get_field_id( 'number' ).'">'. __('Number of posts to show:','supernova').'</label>';
                echo '<input id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" value="'.$instance['number'].'" size="3" />';
		echo '</p>';
		}
	}

<?php
/**
 * Would generate the widget for tabber.
 *
 * @package Supernova
 * @since Supenova 1.4.8
 * @license GPL 2.0
 */

class sup_tabber extends WP_Widget
{
	function __construct()
    {
		$widget_opts = array(
            'classname'   => 'sup_tabber',
            'description' => __('Shows tabs for recent and other posts', 'supernova'),
		);

		$control_opts = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'sup_tabber'
		 );

		parent::__construct( 'sup_tabber', __('Supernova Multi Tabs', 'supernova'), $widget_opts, $control_opts );
	}

	function widget( $arg, $instance )
    {
		extract( $arg, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $posts_per_page = isset( $instance['number'] ) ? $instance['number'] : 5;
        $show_thumb     = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : 1 ;
        $comment_date   = isset( $instance['comment_date'] ) ? $instance['comment_date'] : 1 ;

        $types          = $this->get_tab_types();
        $tab_one        = isset( $instance['tab_one'] ) && $instance['tab_one'] ? $types[$instance['tab_one']] : false;
        $tab_two        = isset( $instance['tab_two'] ) && $instance['tab_two'] ? $types[$instance['tab_two']] : false;
        $tab_three      = isset( $instance['tab_three'] ) && $instance['tab_three'] ? $types[$instance['tab_three']] : false;

         echo $before_widget; ?>

            <header>
                <ul>
                    <?php if( $tab_one ){ ?>
                        <li class="sup-tabber-one sup-tab <?php echo $tab_one ? 'sup-active' : false; ?>" ><?php echo $tab_one; ?></li>
                    <?php } ?>
                    <?php if( $tab_two ){ ?>
                        <li class="sup-tabber-two sup-tab <?php echo ! $tab_one ? 'sup-active' : false; ?>"  ><?php echo $tab_two; ?></li>
                    <?php } ?>
                    <?php if( $tab_three ){ ?>
                        <li class="sup-tabber-three sup-tab <?php echo ! $tab_one && ! $tab_two ? 'sup-active' : false; ?>" ><?php echo $tab_three; ?></li>
                    <?php } ?>
                </ul>
            </header>
            <div class="sup-tabber-contents">
                <?php if( $tab_one ){ ?>
                <div class="sup-tabber-one-content sup-tabber-content <?php echo $tab_one ? 'sup-active' : false; ?>">
                    <?php $this->get_posts( $tab_one , $posts_per_page, $show_thumb, $comment_date ); ?>
                </div>
                <?php } ?>
                <?php if( $tab_two ){ ?>
                <div class="sup-tabber-two-content sup-tabber-content <?php echo ! $tab_one ? 'sup-active' : false; ?>">
                    <?php $this->get_posts( $tab_two , $posts_per_page, $show_thumb, $comment_date ); ?>
                </div>
                <?php } ?>
                <?php if( $tab_three ){ ?>
                <div class="sup-tabber-three-content sup-tabber-content <?php echo ! $tab_one && ! $tab_two ? 'sup-active' : false; ?>">
                    <?php $this->get_posts( $tab_three , $posts_per_page, $show_thumb, $comment_date ); ?>
                </div>
                <?php } ?>
            </div>

        <?php echo $after_widget;

	}

	function update( $new_instance, $old_instance )
    {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title']        = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : false;
        $instance['number']       = isset( $new_instance['number'] ) ? intval( $new_instance['number'] ) : false;;
        $instance['show_thumb']   = isset( $new_instance['show_thumb'] ) ? strip_tags( $new_instance['show_thumb'] ) : false;;
        $instance['comment_date'] = isset( $new_instance['comment_date'] ) ? strip_tags( $new_instance['comment_date'] ) : false;;
        $instance['tab_one']      = isset( $new_instance['tab_one'] ) ? strip_tags( $new_instance['tab_one'] ) : false;;
        $instance['tab_two']      = isset( $new_instance['tab_two'] ) ? strip_tags( $new_instance['tab_two'] ) : false;;
        $instance['tab_three']    = isset( $new_instance['tab_three'] ) ? strip_tags( $new_instance['tab_three'] ) : false;;

		return $instance;
	}

	function form( $instance )
    {
        $defaults = array(
                             'title'        => __( 'Tabber' , 'supernova' ),
                             'number'       => 5,
                             'tab_one'      => 1,
                             'tab_two'      => 2,
                             'tab_three'    => 3,
                             'show_thumb'   => 1,
                             'comment_date' => 1
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $tab_ids = array( 'one', 'two', 'three' );

        foreach( $tab_ids as $tab_id )
        {
            $key          = "tab_{$tab_id}";
            $filed_id     = $this->get_field_id( $key );
            $field_name   = $this->get_field_name( $key );
            $saved_tab_id = isset( $instance[$key] ) ? $instance[$key] : false;

            echo '<p>';

                printf( '<label for="%s">%s : </label>' , $filed_id , __('Tab ','supernova') . $tab_id );

                echo "<select name='{$field_name}' id='{$filed_id}' >";

                foreach( $this->get_tab_types() as $key => $type ){
                    $selcted = selected( $key, $saved_tab_id, false );
                    echo "<option value = '{$key}' {$selcted} >{$type}</option>";
                }
                echo '</select>';

            echo '</p>';
        }

        //Number of posts
        echo '<p>';
            echo '<label for="'.$this->get_field_id( 'number' ).'">'. __('Number of posts to show : ','supernova').'</label>';
            echo "<select id='".$this->get_field_id( 'number' )."' name='".$this->get_field_name( 'number' )."'>";
                for ( $i = 1; $i <= 20; ++$i ) {
                    $selected = selected( $i , $instance['number'], false );
                    echo "<option value='{$i}' {$selected} >$i</option>";
                }
            echo "</select></p>";
        echo '</p>';

        //Thumbnail Option
        echo '<p>';
            echo '<label for="'.$this->get_field_id( 'show_thumb' ).'">'. __('Show Thumbnail : ','supernova').'</label>';
            echo '<input type ="checkbox" id="'.$this->get_field_id( 'show_thumb' ).'" name="'.$this->get_field_name( 'show_thumb' ).'" value="1" '.sup_checked($instance['show_thumb'], 1).' />';
        echo '</p>';

        //Comments or Date
        echo '<p>';
        echo '<label>'. __( 'Show : ' , 'supernova' ) .'</label>';
        echo '<input type ="radio" id="sup_show_comment" name="'.$this->get_field_name( 'comment_date' ).'" value="1" '.sup_checked($instance['comment_date'], 1).' />';
        echo '<label for="sup_show_comment">'. __('Comment ','supernova').'</label>';

        echo '<input type ="radio" id="sup_show_date" name="'.$this->get_field_name( 'comment_date' ).'" value="2" '.sup_checked($instance['comment_date'], 2).' />';
        echo '<label for="sup_show_date">'. __('Date ','supernova').'</label>';

        echo '<input type ="radio" id="sup_show_none" name="'.$this->get_field_name( 'comment_date' ).'" value="3" '.sup_checked($instance['comment_date'], 3).' />';

        echo '<label for="sup_show_none">'. __('None ','supernova').'</label>';

        echo '</p>';

	}

    public function get_posts( $tab , $posts_per_page, $show_thumb, $comment_date )
    {
        $args = false;

        switch ( $tab ) {

            case 'Recent':
                $args = apply_filters( 'sup_tabber_latest_posts_args' , array(
                        'posts_per_page'      => $posts_per_page,
                        'ignore_sticky_posts' => true,
                        'post_status'         => 'publish',
                        'orderby'             => 'date',
                    ), $posts_per_page, $show_thumb, $comment_date );
            break;

            case 'Popular':
                $args = apply_filters( 'sup_tabber_popluar_posts_args' , array(
                         'posts_per_page'      => $posts_per_page,
                         'ignore_sticky_posts' => true,
                         'post_status'         => 'publish',
                         'orderby'             => 'meta_value_num',
                         'meta_key'            => 'sup_post_views_count',
                    ), $posts_per_page, $show_thumb, $comment_date );
            break;

            case 'Recommended':
                $args = apply_filters( 'sup_tabber_recommended_posts_args' , array(
                        'posts_per_page'      => $posts_per_page,
                        'ignore_sticky_posts' => true,
                        'post_status'         => 'publish',
                        'orderby'             => 'modified',
                        'meta_key'            => 'supernova-recommended-post',
                        'meta_value'          => 1
                    ), $posts_per_page, $show_thumb, $comment_date );
            break;

            case 'Random':
                $args = apply_filters( 'sup_tabber_random_posts_args' , array(
                        'posts_per_page'      => $posts_per_page,
                        'ignore_sticky_posts' => true,
                        'post_status'         => 'publish',
                        'orderby'             => 'rand',
                    ), $posts_per_page, $show_thumb, $comment_date );
            break;
        }

        $query = new WP_Query( $args );

        if( $query->have_posts() ) :

            echo "<ul>";
                while( $query->have_posts() ) : $query->the_post(); ?>

                    <li>
                        <?php if( $show_thumb ){
                            sup_thumbnail( 'thumbnail' , sprintf( '<figure class="sup-tabber-thumb"><a href="%s">' , get_permalink( get_the_ID() ) ) , '</a></figure>' , true );
                        } ?>
                         <div class="sup-tabber-right">
                             <?php the_title( sprintf( "<h4 class='sup-tabber-title'><a href='%s'>" , get_permalink( get_the_ID() ) ) , "</a></h4>" ); ?>
                             <span class="sup-tabber-meta">
                             <?php
                                 if( $comment_date == 2 ){
                                    echo '<span class="sup-icon-calendar"></span>' . sup_posted_on();
                                 }
                                 if( $comment_date == 1 ){
                                    echo '<span class="sup-icon-comment"></span>';
                                    comments_popup_link(__('Leave A Comment', 'supernova'), __('1 comment', 'supernova'), ' % Comments');
                                 }
                              ?>
                             </span>
                         </div>
                    </li>

                <?php endwhile;
            echo "</ul>";

        endif;
    }

    public function get_tab_types()
    {
        return array(
                __( 'None', 'supernova' ),
                __( 'Recent', 'supernova' ),
                __( 'Popular', 'supernova' ),
                __( 'Recommended', 'supernova' ),
                __( 'Random', 'supernova' )
            );
    }

}

add_action('widgets_init', 'register_sup_tabber' );
function register_sup_tabber()
{
    register_widget( 'sup_tabber' );
}

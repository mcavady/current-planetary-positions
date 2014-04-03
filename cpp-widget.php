<?php
/**
 * Adds Current Planetary Positions Widget
 *
 * @author	Isabel Castillo
 * @package 	Current Planetary Positions
 * @extends 	WP_Widget
 */

class cpp_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'cpp_widget',
			__('Current Planetary Positions', 'cpp'),
			array( 'description' => __( 'Display the current planetary positions in the zodiac signs.', 'cpp' ), )
		);

	}
	public function isa_get_sign_position($longitude) {
		$sym = array('aries','taurus','gemini','cancer','leo','virgo','libra','scorpio','sagittarius','capricorn','aquarius','pisces');

		$localize_signs = array( __( 'Aries', 'cpp' ), __( 'Taurus', 'cpp' ), __( 'Gemini', 'cpp' ), __( 'Cancer', 'cpp' ), __( 'Leo', 'cpp' ), __( 'Virgo', 'cpp' ), __( 'Libra', 'cpp' ), __( 'Scorpio', 'cpp' ), __( 'Sagittarius', 'cpp' ), __( 'Capricorn', 'cpp' ), __( 'Aquarius', 'cpp'), __( 'Pisces', 'cpp') );


		foreach ($sym as $key => $val) {
			$symbol[$key] = '<span id="currentplanets_sprite" class="' . $val . '"></span> '. $localize_signs[$key];
		}
	
		$sign_num = floor($longitude / 30);
		$pos_in_sign = $longitude - ($sign_num * 30);
		$deg = floor($pos_in_sign);
		$full_min = ($pos_in_sign - $deg) * 60;
		$min = floor($full_min);
		$full_sec = round(($full_min - $min) * 60);
		
		$dms_numbers_range = range(0, 59);
					
		$localize_dms_numbers = array(_('00'),_('01'),_('02'),_('03'),_('04'),_('05'),_('06'),_('07'),_('08'),_('09'),_('10'),_('11'),_('12'),_('13'),_('14'),_('15'),_('16'),_('17'),_('18'),_('19'),_('20'),_('21'),_('22'),_('23'),_('24'),_('25'),_('26'),_('27'),_('28'),_('29'),_('30'),_('31'),_('32'),_('33'),_('34'),_('35'),_('36'),_('37'),_('38'),_('39'),_('40'),_('41'),_('42'),_('43'),_('44'),_('45'),_('46'),_('47'),_('48'),_('49'),_('50'),_('51'),_('52'),_('53'),_('54'),_('55'),_('56'),_('57'),_('58'),_('59'));
					
		$localized_dms = array_combine($dms_numbers_range,$localize_dms_numbers);
	
	
		$localized_deg = $localized_dms[$deg];
		$localized_min = $localized_dms[$min];
		$localized_full_sec = $localized_dms[$full_sec];

		// localize degree symbol

		if( is_rtl() ) $degree =  "&deg;$localized_deg";
		else $degree =  "$localized_deg&deg;";

		$set_out = sprintf( __( '%s %s %s%s %s%s', 'cpp' ), 
						$degree,
						$symbol[$sign_num],
						$localized_min,
						chr(39),
						$localized_full_sec,
						chr(34)
						);

		return $set_out;

	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */

	public function widget( $args, $instance ) {

		// get UT/GMT time for exec */
		
		$time = new DateTime('now', new DateTimeZone('UTC'));
		
		$utdate = $time->format('j').'.'.$time->format('n').'.'.$time->format('Y');// day.month.year (single-digit day, month, 4-digit year)
		$uttime = $time->format('H').':'.$time->format('i').':'.$time->format('s');  // HH:MM:SS
		
		$num_planets = 11;
		
		$sweph = CPP_PLUGIN_DIR . 'sweph'; // set path to ephemeris
		
		unset($PATH,$out,$longitude,$speed);

		$PATH = '';
		
		putenv("PATH=$PATH:$sweph");
		
		// get 11 planets
		
		exec ("isabelse -edir$sweph -b$utdate -ut$uttime -p0123456789D -eswe -fPls -g, -head", $out);
		// output $row[] = (planet name, longitude decimal, speed)
		// 1 row for each of 11 planets, indexed 0 - 10
		
		foreach ($out as $key => $line) {
		
			$row = explode(',',$line);
			$pl_name[$key] = $row[0];
			$longitude[$key] = $row[1];
			$speed[$key] = $row[2];
		}
		// localize planet names
		$pl_name = array( __( 'Sun', 'cpp' ), __( 'Moon', 'cpp' ), __( 'Mercury', 'cpp' ), __( 'Venus', 'cpp' ), __( 'Mars', 'cpp' ), __( 'Jupiter', 'cpp' ), __( 'Saturn', 'cpp' ), __( 'Uranus', 'cpp' ), __( 'Neptune', 'cpp' ), __( 'Pluto', 'cpp' ), __( 'Chiron', 'cpp') );

		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget;
		if ( ! empty( $title ) )
			echo '<h3 class="widget-title">'. $title . '</h3>';

		// begin output to browser
		echo '<div id="current-planets">';
		
		// display local date and time
		echo '<p id="localtime">'; ?>
		<script>
			var d=new Date();
			var n=d.toLocaleDateString();
			var t=d.toLocaleTimeString(); 
			document.write(n + "<br />" + t); 
		</script>
		<?php 
// @todo show UTC time here
// 3-Apr-2014, 16:09 UT/GMT

// $utdate = $time->format('j').'.'.$time->format('n').'.'.$time->format('Y');// day.month.year (single-digit day, month, 4-digit year)
// $uttime = $time->format('H').'.'.$time->format('i').'.'.$time->format('s');  // HH.MM.SS


//$utc_display_date = $time->format('j').'-'.$time->format('M').'-'.$time->format('Y');// like 3-Apr-2014
//$utc_display_time = $time->format('H').':'.$time->format('i').':'.$time->format('s');  // 

// @test end

echo '</p>';
		echo '<table>',"\n";
		for ($i = 0; $i <= $num_planets - 1; $i++) {
			echo '<tr><td>';
				printf( __( '%s', 'cpp' ), $pl_name[$i] );
				echo '&nbsp;';
			echo '</td><td>';
				echo $this->isa_get_sign_position($longitude[$i]);
				if ($speed[$i] < 0) { //retrograde
						echo '&nbsp;' . __('R', 'cpp' );
				}
			echo  '</td></tr>';
		}
		echo "</table></div>","\n";
		
		echo $after_widget;

	}// end widget

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$defaults = array( 
					'title' => __('Current Planetary Positions', 'cpp'),
					);
 		$instance = wp_parse_args( (array) $instance, $defaults );
    	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'cpp' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
				name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<?php 
	}

}
?>
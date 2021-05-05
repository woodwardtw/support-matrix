<?php
/**
 * summary table specific functions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function quantity_row_builder($item,$count_array, $assignment_page_id){
	$total = count($count_array);
	echo "<tr id=\"total-{$item}\" data-total={$total} class=\"quantity {$item}\"><td>Quantity \"{$item}\"</td>";
	if( have_rows('assignments', $assignment_page_id) ): //
		    	// Loop through rows.
		   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
		   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
		   		echo '<td>' . count_assignment_numbers($count_array, $assignment) . '</td>';						   	
   		 	endwhile;
   		echo '</tr>';

	// No value.
	else :
	    // Do something...
	endif;
}


function percentage_row_builder($item, $count_array, $assignment_page_id, $total){
	echo "<tr class='percent {$item}'><td>Percentage \"{$item}\"</td>";
			if( have_rows('assignments', $assignment_page_id) ): //
				    	// Loop through rows.
				   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
				   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
				   		$count = count_assignment_numbers($count_array, $assignment);
				   		echo '<td>' . avg_assignment_numbers($total, $count) . '</td>';						   	
		   		 	endwhile;
		   		echo '</tr>';

			// No value.
			else :
			    // Do something...
			endif;
}
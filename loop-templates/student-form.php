<h3> <?php echo get_the_title($lecture_post_id);?> </h3>
<?php 
      if( have_rows('assignments', $lecture_post_id) ):
            while( have_rows('assignments', $lecture_post_id) ) : the_row();
                  if(get_sub_field('assignment_name',$lecture_post_id) != ""){
                        $assignment_name = get_sub_field('assignment_name',$lecture_post_id);
                        $assignment_slug = sanitize_title($assignment_name);
                        echo '<div class="assessment">';
                        echo '<h4>' . $assignment_name . '</h4>';
                        $states = array('Not Done', 'Need Help', 'Some Concern', 'Confident');
                        $checked = '';
                        foreach ($states as $key => $state) {
                              $state_clean = sanitize_title($state);
                              if (get_post_meta( get_the_ID(), $lecture_slug . '-' . $assignment_slug , true ) === sanitize_title($state)){
                                    $checked = "checked";
                              } else {
                                    $checked = "";
                              }
                              echo "<div class=\"input-piece {$state_clean}\">
                                    <input type=\"radio\" id=\"{$lecture_slug}-{$assignment_slug}-{$state_clean}\" name=\"{$assignment_name}\" value=\"{$state_clean}\" data-assessment=\"{$lecture_slug}-{$assignment_slug}\" {$checked}>
                                    <label class=\"better-label \" for=\"{$lecture_slug}-{$assignment_slug}-{$state_clean}\">{$state}</label>
                              </div>";
                        }
                       echo '</div>';
                       echo '<canvas id="chart" width="400" height="100"></canvas>';//javascript chart holder
                       
                  }
            endwhile;
            // No value.
            else :
    // Do something...
      endif;
?>


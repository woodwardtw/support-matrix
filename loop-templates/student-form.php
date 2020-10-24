<h3> <?php echo get_the_title($sub_post_id);?> </h3>
<?php 
      if( have_rows('assignments', $sub_post_id) ):
            while( have_rows('assignments', $sub_post_id) ) : the_row();
                  if(get_sub_field('assignment_name',$sub_post_id) != ""){
                        $assignment_name = get_sub_field('assignment_name',$sub_post_id);
                        echo '<h4>' . $assignment_name . '</h4>';
                        echo "<div class=\"input-piece\">
                                    <input type=\"radio\" id=\"{$sub_slug}-need-help\" name=\"{$assignment_name}\" value=\"need-help\">
                                    <label class=\"better-label help\" for=\"{$sub_slug}-need-help\">Need Help</label>
                              </div>
                              <div class=\"input-piece\">
                                    <input type=\"radio\" id=\"{$sub_slug}-some-concern\" name=\"{$assignment_name}\" value=\"some-concern\">
                                    <label class=\"better-label concern\" for=\"{$sub_slug}-some-concern\">some-concern</label>
                              </div>
                              <div class=\"input-piece\">
                                    <input type=\"radio\" id=\"{$sub_slug}-confident\" name=\"{$assignment_name}\" value=\"confident\">
                                    <label class=\"better-label ok\" for=\"{$sub_slug}-confident\">confident</label>
                              </div>
                              ";
                  }
            endwhile;
            // No value.
            else :
    // Do something...
      endif;
?>
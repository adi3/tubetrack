   <!-- Section for back button -->
   <div id="border_container" class="grid_3">
   <div id="cpanel" style="padding-bottom:12px" class="grid_3">

       <div id="back" class="grid_3">    
           <a href="<?= site_url('') ?>"><?= img(Array('src' => site_url('resources/back_red.png'), 'width' => '140', 'height' => '40')); ?></a>
       </div>
   </div><!-- End cpanel -->
   </div> <!-- End border_container -->
   
   <?php 
       if(!$results_found)
           echo '<div id="no-results" class="grid_12">' 
                    . img(Array('src' => site_url('resources/no-results.png'), 'width' => '410', 'height' => '370'))
                . '</div>';
   ?>

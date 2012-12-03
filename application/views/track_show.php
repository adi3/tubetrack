<?php $results_found = false ?>
<?php $heading = '' ?>

</$sidebar_flag><!DOCTYPE html>

<html>
    <?php include_once('elements/track_header.php') ?>
    
    <body>
       <?php include_once('elements/track_title.php') ?>
       
       <br />
       <div id="page" class="container_12">
           <div id="spacer" class="grid_1"></div>       
           
           <?php
               if($results_found) echo "<div id='results_container' class='grid_7'>";
                   include_once('elements/track_results.php');
               if($results_found) echo "</div>";
           
               if($results_found) include_once('elements/track_sidebar.php');
               else include_once('elements/track_back.php');
           ?>
                      
       </div><!-- End page -->
       
       <!-- Begin footer info -->
       <div id="footer_line" class="container_12"><hr /></div>
       <div id="footer" class="container_12">Copyright 2012 | Hacero | Page loaded in {elapsed_time} sec</div>
       <!-- End footer info --> 
    
    <?php include_once('elements/track_analytics.php') ?>
    </body>
</html>

<script defer='defer' src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
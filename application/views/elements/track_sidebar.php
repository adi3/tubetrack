<!-- Begin sidebar -->

   <!-- Section for update button -->
   <div id="border_container" class="grid_3">
   <div id="cpanel" style="padding-bottom:10px" class="grid_3">
       <!-- URL segments stored to track current sort order and property -->
       <?php $url_key = $this->uri->segment(3, $key) ?>       
       <?php $by = $this->uri->segment(4, 'title') ?>
       <?php $order = $this->uri->segment(5, 'desc') ?>

       <div id="update" class="grid_3">    
           <a href="<?= site_url('track/retrieve/' . $url_key) ?>"><?= img("resources/update.png"); ?></a>
       </div>
       <div id="update_title" class="grid_3">* Feature works for saved lists only.</div>
   </div><!-- End cpanel -->
   </div> <!-- End border_container -->
   
   <!-- Section for ascending and descending order button -->
   <div id="border_container" class="grid_3">
   <div id="cpanel" class="grid_3">
       <div id="asc_sort" class="grid_1">
           <a href="<?= site_url('track/sorted/' . $url_key . '/' . $by . '/asc') ?>"><?= img("resources/asc.png"); ?></a>
       </div>
       <div id="des_sort" class="grid_1">                   
           <a href="<?= site_url('track/sorted/' . $url_key . '/' . $by . '/desc') ?>"><?= img("resources/des.png"); ?></a>
       </div>
   </div><!-- End cpanel -->
   </div> <!-- End border_container -->
       
   <!-- Section for sort by title, views, likes and duration buttons -->
   <div id="border_container" class="grid_3">
   <div id="cpanel" class="grid_3">
       <div id="ch_order" class="grid_1">
           <a href="<?= site_url('track/sorted/' . $url_key . '/title/' . $order) ?>"><?= img("resources/title.png"); ?></a>
       </div>
       <div id="ch_order" class="grid_1">
           <a href="<?= site_url('track/sorted/' . $url_key . '/views/' . $order) ?>"><?= img("resources/views.png"); ?></a>
       </div>
       <div id="ch_order" class="grid_1" style="margin-top:20px">
           <a href="<?= site_url('track/sorted/' . $url_key . '/likes/' . $order) ?>"><?= img("resources/likes.png"); ?></a>
       </div>
       <div id="ch_order" class="grid_1" style="margin-top:20px">
           <a href="<?= site_url('track/sorted/' . $url_key . '/duration/' . $order) ?>"><?= img("resources/duration.png"); ?></a>
       </div>
   </div><!-- End cpanel -->
   </div> <!-- End border_container -->
   
   <?php include_once('track_back.php') ?>
   
   <!-- Section linked to github repo -->       
   <div id="border_container" class="grid_3">
   <div id="cpanel" class="grid_3" style="padding-bottom:12px">
       <div id="github" class="grid_3">
       		<a href="https://github.com/adi3/tubetrack" target="_blank"><?= img("resources/github.png"); ?></a>
       </div>
   </div><!-- End cpanel -->
   </div> <!-- End border_container -->
   
<!-- End sidebar -->

<div id="border_container" class="grid_7" style="margin-left:0">
   <div id="container" class="grid_7">
             
       <?= $heading ?>
       <?php $i = 1 ?>
       
   <!-- Loop through all video data and display results -->
   <?php foreach($results as $entry): ?>
       <?php $id = $entry->id; ?>
  
       <!-- Entire entry block is hyperlinked with the video's youtube link -->
       <a href="http://youtube.com/watch/?v=<?= $id ?>" target="_blank" >
       <div id="entry">
           <!-- Thumbnail of the video -->
           <div id="thumb" class="grid_2"><?= img("http://img.youtube.com/vi/".$id."/2.jpg"); ?></div>
       
           <div id="entry_data" class="grid_4">
               <!-- Rank as determined by sort order and property -->
               <div id="rank"><b>Rank: <?= $i ?></b></div>
               <hr />
               
               <!-- Title, views, likes, and duration of the video -->
               <h3><div id="title"><?= $entry->title ?></div></h3>
               <div class="grid_1" style="width:0"></div>
               <div id="views">Views: <?= number_format($entry->views) ?></div>
               <div class="grid_1" style="width:0"></div>
               <div id="likes">Likes: <?= number_format($entry->likes) ?></div>
               <div class="grid_1" style="width:0"></div>
               <div>Duration: <?= $entry->duration ?></div>
           </div>
       </div> <!-- End entry -->
       </a>
   <?php $i++ ?>
   <?php endforeach; ?>
</div> <!-- End container -->
</div> <!-- End border_container -->

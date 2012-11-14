<!DOCTYPE html>

<html>
    <?php include_once('elements/track_header.php') ?>
    
    <body>
       <br />
       <div id="page" class="container_12">
           <div class="grid_2" style="height:1px"></div>       
           
           <div id="border_container" class="grid_8">
                <div id="container" class="grid_8" style="text-align:center; padding-top:10px">
                    <?= img(site_url('resources/view_title.png')) ?>
                    <img src="<?=site_url('resources/view_subtitle.png') ?>" style="margin-top:22px" />
                    <hr id="heading-div"/>
                    
                    <div id="error" class="grid_6"><pre> </pre></div>
                    <div id="cross" class="grid_1"></div>
                    
                    <?= form_open('track/compare', 'id="form_links"') ?>
                    
                    <?php 
                        $links_prompt = "Enter YouTube video or playlist links one per line...";
                        $textarea = Array("name"  => "input_links",
                                          "id"    => "input_links",
                                          "value" => $links_prompt);
                        echo form_textarea($textarea);
                    ?>
                    
                    <input type="hidden" name="key_store" id="key_store" value="" />
                    
                    <div class="grid_2" style="height:1px"></div>
                    <div id="save_btn" class="grid_1">
                        <?= img("resources/save.png") ?>
                    </div>
                    
                    <div id="compare_btn" class="grid_1">
                        <button type="submit"><?= img("resources/track.png") ?></button>
                    </div>
                    
                    <?= form_close() ?>
                        
                    <div id="divider" class="grid_8">
                        <?= img("resources/div.png"); ?>
                        <?= img("resources/or.png"); ?>
                        <?= img("resources/div.png"); ?>
                    </div>
                        
                    <?= form_open('track/retrieve', 'id="form_key"') ?> 
                    <?php
                        $key_prompt = "Enter TubeTrack key...";
                        $textinput = Array("name" => "input_key",
                                          "id"    => "input_key",
                                          "value" => $key_prompt);
                        echo form_input($textinput);
                    ?>
                    
                    <div class="grid_3" style="height:1px"></div>
                    <div id="retrieve_btn" class="grid_1">
                        <button type="submit"><?= img("resources/retrieve.png") ?></button>
                    </div>
                    
                    <?= form_close() ?>
                    
                </div>
           </div>

       </div><!-- End page -->
       
       <!-- Begin footer info -->
       <div id="footer_line" class="container_12"><hr /></div>
       <div id="footer" class="container_12">Copyright 2012 | Adi | Page loaded in {elapsed_time} sec</div>
       <!-- End footer info --> 
    
    <?php include_once('elements/track_analytics.php') ?>
    </body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script>
    var links_prompt = "<?= $links_prompt ?>";
    var key_prompt = "<?= $key_prompt ?>";
    var site_url = "<?= site_url('') ?>";
</script>
<script src="<?= site_url('js/script.js') ?>"></script>
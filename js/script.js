$(document).ready(function(){
	
    var input = '';			// User input in the links form
    var key = '';			// User input in the keys form
    var cross_img = "<img id='cross' src=" + site_url + "resources/cross.png />";

    /*
     * Clears links textarea from default message upon gaining focus.
     */
    $("#input_links").focusin(function() {
    	clear_def_input(this, links_prompt);
    });
    
    
    /*
     * Clears key textfield from default message upon gaining focus.
     */
    $("#input_key").focusin(function() {
        clear_def_input(this, key_prompt);
    });
    
    
    /*
     * Sets default message in links textarea upon losing focus.
     */
    $("#input_links").focusout(function() {
    	set_def_input(this, links_prompt);
    });
    
    
    /*
     * Sets default message in key textfield upon losing focus.
     */
    $("#input_key").focusout(function() {
    	set_def_input(this, key_prompt);
    });
    
    
    /*
     * Validates links form input. Stops form submission and
     * displays error message if input fails validation.
     */
    $('#form_links').submit(function() {
        var links = $('#input_links').val();
        if(is_empty(links, links_prompt)) return false;
    	if(!is_valid(links)) return false;
        if(links != input) $("#key_store").val(null);
        
    	set_error_msg("<i>Processing input...</i>");
        effectFadeIn('#error');
    });
    
    
    /*
     * Validates key form input. Stops form submission and
     * displays error message if input fails validation.
     */
    $('#form_key').submit(function() {
        var key = $('#input_key').val();
        if(is_empty(key, key_prompt)) return false;
    });
    
    
    /*
     * Hides error message when user clicks on the cross button.
     */
    $("#cross").click(function(){
        $("#error").fadeOut('fast', function(){
            $("#error").html('<pre> </pre>').fadeIn();
        });
        $("#cross").fadeOut();
    });
	
    
    /*
     * Validates links form input. Stops form submission
     * and displays error message if input fails validation. 
     * 
     * If input passes validation, sends the input through 
     * AJAX for storing and displays the TubeTrack key for 
     * the saved links.
     */
	$("#save_btn").click(function(){
	    var new_input = $('#input_links').val();

	    if(is_empty(new_input, links_prompt)) return;
	    if(is_repeated(new_input, input)) return;
    	if(!is_valid(new_input)) return false;
    	
	    input = new_input;
	     
	     $.ajax({
	        url: site_url + 'track/save',
	        type: 'POST',
	        data: {
	        	input_links: input
	        },
	        success: function(msg){
	            key = msg;
	            set_saved_msg(msg); 
	        }
	    });
	});

	
    /*
     * Sets the object value to the given prompt.
     */
	function set_def_input(obj, prompt){
		if($(obj).val() == ''){
	        $(obj).val(prompt);
	        $(obj).css('color', '#888');
	        $(obj).css('font-style', 'italic');
	    }
	}
	
	
    /*
     * Clears the object value from the given prompt.
     */
	function clear_def_input(obj, prompt){
		$(obj).css('color', '#333');
	    $(obj).css('font-style', 'normal');
	    if($(obj).val() == prompt)
	        $(obj).val('');
	}	
	

    /*
     * Checks whether given input is empty (or is default msg) and
     * displays an error if the test is failed.
     */
	function is_empty(input, prompt){
	    if(input == prompt || input == '') {
	    	set_error_msg("<i>Some input might help...</i>");
	        return true;
	    }
	    return false;
	}
	

    /*
     * Checks whether given input is same as what was entered on last
     * submission in this instance and displays an error if the test 
     * is failed.
     */
	function is_repeated(new_input, input){
	    if(new_input == input){
	    	set_error_msg("<i>Links already saved with TubeTrack key <u>" + key + "</u></i>");  
	        return true;
	    }
	    return false;
	}
	
	
    /*
     * Conducts a simple test for link validity by checking if each 
     * submitted link has 'youtube.com' and 'v=' present in the string.
     */
	function is_valid(links){
		var arr = links.split("\n");
		
		for(var i=0; i<arr.length; i++){
			if(arr[i] != '') {
				if(arr[i].indexOf("youtube.com") == -1 || arr[i].indexOf("v=") == -1){
					set_error_msg("<i>Hmm... those links don't seem too valid.</i>");		       
					return false;
				}
			}
		}
		return true;
	}
	
	
    /*
     * Displays the given 'saved key' message in the errors/messages section.
     */
	function set_saved_msg(msg){
		set_error_msg("<i>Links saved with TubeTrack key <u>" + key + "</u></i>");
	    $("#key_store").val(key);
	}
	
	
    /*
     * Displays the given 'error' message in the errors/messages section.
     */
	function set_error_msg(msg){
		 $("#error").fadeOut('fast', function(){
            $("#error").html(msg).fadeIn();
            $("#cross").html(cross_img).fadeIn();
        });
	}
	
	function effectFadeIn(obj) {
		$(obj).fadeOut(500).fadeIn(500, effectFadeOut(obj))
	}
	
	function effectFadeOut(obj) {
		$(obj).fadeIn(500).fadeOut(500, effectFadeIn(obj))
	}
	
});

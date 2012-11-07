<?php

class Track extends CI_Controller {
    
    /*********************
     * Public Functions * 
     *********************/ 
     
    /**
     * Shows the default view of the application which accepts user
     * input for YouTube links or TubeTrack keys.
     * 
     * @access public
     * @return void
     */
    function index(){
        $this->load->view('track_view');
    }
    
    
    /**
     * Retrieves all YouTube links entered by the user and displays
     * their corresponding videos sorted alphabetically, along with 
     * stats on each video's views, likes, and duration.
     * 
     * @access public
     * @return void
     */
    function compare(){
        $links_string = $this->input->post('input_links');
        $id_array = $this->track_model->parse_links($links_string);
        
        $key = $this->input->post('key_store');
        $this->_show_results($id_array, $key);
    }
    
    
    /**
     * Retrieves all YouTube links entered by the user and stores
     * them in the database  with a unique key. This key is common 
     * to all links entered in a single instance, but is unique
     * across different instances.
     * 
     * Echoes back the key to be displayed to the user through AJAX.
     * 
     * @access public
     * @return void
     */
    function save(){
        $links_string = $this->input->post('input_links');
        $id_array = $this->track_model->parse_links($links_string);
        
        $key = $this->track_model->save_links($id_array);
        
        echo $key;
    }
    
    
    /**
     * Receives a valid TubeTrack key and retrieves all YouTube links 
     * stored in the database corresponding to the key. Displays videos
     * corresponding to all retreived links sorted alphabetically, along 
     * with stats on each video's views, likes, and duration.
     * 
     * @access public
     * @param  string     reference string for the stored IDs
     * @return void
     */
    function retrieve($key = null){
        if(!$key) $key = $this->input->post('input_key');
        $id_array = $this->track_model->get_saved_links($key);
        
        $this->_show_results($id_array, $key);
    }
    
    
    /**
     * Recevies a TubeTrack key and display videos sorted in accordance 
     * to the second and third parameters of the function.
     * 
     * Sorting property options (second parameter) are 'title', 'likes',
     * 'views' and 'duration'. Sorting order options (third parameter)
     * are 'asc' and 'desc'.
     * 
     * ul_key stands for unsaved-list-key. This plays the role of a
     * regular TubeTrack key for unsaved video lists. Acts as a 
     * reference for saved data (from the unsaved list) during sorting.
     * 
     * @access  public
     * @param   string      reference string for the stored IDs
     * @param   string      property to be sorted by
     * @param   string      order in which property should be sorted
     * @return  array       sorted array with all video information
     */

    function sorted($key, $by, $order){
        $data['key'] = null;
        if(trim(strlen($key)) == 16) $data['key'] = $key;
        else $data['ul_key'] = $key;
        
        $results = $this->track_model->get_sorted_results($key, $by, $order);
        $this->track_model->format_durations($results);
        
        $data['results'] = $results;
        $this->load->view('track_show', $data);
    }
    
    
    /*********************
     * Private Functions * 
     *********************/ 
    
    /**
     * Retrieves video stats from YouTube for each ID in the received
     * array, records them for future sorting, and displays the
     * results sorted alphabetically by default.
     * 
     * @access private
     * @param  array     array with YouTube IDs
     * @param  string    reference string for the stored IDs
     * @return void
     */

    function _show_results($id_array, $key = null){        
        $results = $this->track_model->get_results($id_array);
        
        $ul_key = random_string('alnum', 6);
        if($key) $this->track_model->record_stats($results, $key);
        else $this->track_model->record_stats($results, $ul_key);
        
        $this->track_model->format_durations($results);
        $data = Array(
            'key'     => $key,
            'ul_key'  => $ul_key,
            'results' => $results 
        );
        $this->load->view('track_show', $data);
    }

}
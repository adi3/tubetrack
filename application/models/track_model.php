<?php

class Track_model extends CI_Model {

    /*********************
     * Public Functions * 
     *********************/ 
     
    /**
     * Receives a concatenated string of YouTube links entered by the
     * user and extracts the ID part from each link into an array.
     * Returns this array containing IDs of all entries.
     * 
     * @access  public
     * @param   string     concatenated YouTube links from user
     * @return  array      array with YouTube IDs of all entries
     */  
    function parse_links($links_string){
        $links_array = explode("\n", $links_string);
        $id_array = Array();
        
        for($i=0; $i<count($links_array); $i++){
            $link = $links_array[$i];
            $index = strpos($link, "v=") + 2;
            $id_array[$i]->id = substr($link, $index, 11);
        }

        return $id_array;
    }
    
    
    /**
     * Iterates over an array of YouTube IDs, and returns a sorted 
     * object array filled with the stats received from YouTube for 
     * each ID. The object array has a form of:
     * 
     *          [this][index]->property 
     * 
     * The properties stored in the returned array are: 
     * 
     *          likes, title, views, duration, and ID
     * 
     * Array is sorted alphabetically by default.
     * 
     * @access  public
     * @param   array      array with YouTube IDs
     * @return  array      sorted array with all video information
     */     
    function get_results($id_array){
        $results = Array();
        
        foreach($id_array as $entry){
            if($entry != '') $this->_get_info(trim($entry->id), $results);
        }
        sort($results);
        return $results;
    }
    
    
    /**
     * Iterates over an array of YouTube IDs, and stores all the
     * IDs along with a common unique key for future retrieval. 
     * Returns the unique key to be provided to the user.
     * 
     * @access  public
     * @param   array     array with YouTube IDs
     * @return  key       reference string for the stored IDs
     */ 
    function save_links($id_array){
        $key = random_string('alnum', 16);
        
        foreach($id_array as $entry){
            if($entry->id != '') {
                $data = Array(
                   'key' => $key,
                   'id' => $entry->id,
                );
                $this->db->insert('saved', $data); 
            }
        }
        return $key;
    }


    /**
     * Returns an array of stored YouTube IDs corresponding to the
     * received unique key string.
     * 
     * @access  public
     * @param   string      reference string for the stored IDs
     * @return  array       array with YouTube video IDs
     */    
    function get_saved_links($key){       
        $this->db->select('id');
        $this->db->where('key', $key);
        return $this->db->get('saved')->result();
    }


    /**
     * Records all video information for all keys of the referenced
     * array in the database. Every array has a unique key common
     * for all its elements, and each entry to the database is written
     * along with this key.
     * 
     * @access  public
     * @param   array        referenced array with info for all videos
     * @param   string       reference string for the stored IDs
     * @return  void
     */   
    function record_stats(&$arr, $key){
        $this->db->where('key', $key);
        $this->db->delete('stats');
            
        foreach($arr as $entry){            
            $data = Array(
                'key' => $key,
                'id' => $entry->id,
                'title' => $entry->title,
                'duration' => $entry->duration,
                'views' => $entry->views,
                'likes' => $entry->likes
            );
            $this->db->insert('stats', $data);
        }
    }


    /**
     * Retrieves all entries corresponding to the unique key from the
     * database and returns an sorted in accordance to the second and 
     * third parameters of the function.
     * 
     * Sorting property options (second parameter) are 'title', 'likes',
     * 'views' and 'duration'. Sorting order options (third parameter)
     * are 'asc' and 'desc'.
     * 
     * @access  public
     * @param   string      reference string for the stored IDs
     * @param   string      property to be sorted by
     * @param   string      order in which property should be sorted
     * @return  array       sorted array with all video information
     */
    function get_sorted_results($key, $by, $order){
        $this->db->where('key', $key);
        $this->db->order_by($by, $order);
        return $this->db->get('stats')->result();
    }
   

    /**
     * Iterates through the referenced array and for each
     * duration entry, converts the string of time in seconds 
     * to a string of the format mm:ss for easy readability.
     * 
     * The time string is not stored preformatted because it
     * hinders subsequent sorting.
     * 
     * @access  public
     * @param   string     time in seconds
     * @return  string     time in mm:ss format     
     */
    function format_durations(&$arr){
        for($i=0; $i < count($arr); $i++){
            $duration = $arr[$i]->duration; 
            $minutes = intval($duration / 60);
            $seconds = intval($duration % 60);
            if (strlen($seconds) == 1) $seconds = "0" . $seconds;
            $arr[$i]->duration = $minutes.":".$seconds;
        }
    }
    
       
    /*********************
     * Private Functions * 
     *********************/ 
     
    /**
     * Retrieves information from YouTube corresponding to the video ID
     * and adds it to the referenced array.
     * 
     * @access  private
     * @param   string       YouTube ID of a video
     * @param   array        referenced array with info for all videos
     * @return  void
     */  
    function _get_info($id, &$results){
        if($results) if(array_key_exists($id, $results)) return;
                        
        $table = json_decode(
                     file_get_contents(
                        "http://gdata.youtube.com/feeds/api/videos/".$id."?v=2&alt=json"), true);

        if(!$table['entry']) return;
        $this->_set_values($id, $results, $table);
    }    
    
    
    /**
     * Assigns video information from the referenced 'table' array
     * (holding data for the single video at hand) to the referenced
     * 'results' array (holding data for all videos). Keys in the 
     * 'table' array are of the format:
     * 
     *          [this][index]->property 
     * 
     * The properties stored in the array are: 
     * 
     *          likes, title, views, duration, and ID
     * 
     * @access  private
     * @param   string      YouTube ID of a video
     * @param   array       array holding data for all videos
     * @param   array       array with data for the single video at hand
     * @return  void
     */
    function _set_values($id, &$results, &$table){        
        $results[$id]->title = $table['entry']['title']['$t'];
        
        $likes;
        if(isset($table['entry']['yt$rating']['numLikes'])){
            $results[$id]->likes = $table['entry']['yt$rating']['numLikes'];
        } else {
            $results[$id]->likes = 0;
        }
        
        $results[$id]->duration = $table['entry']['media$group']['yt$duration']['seconds'];
        $results[$id]->views = $table['entry']['yt$statistics']['viewCount'];
        $results[$id]->id = $id;
    }
    
}

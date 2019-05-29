<?php 
	// ------------------------------------------------------------------------
	if ( ! function_exists('print_query') )
	{
	    /**
	     * PRINT_R HELPER FUNCTION TO PRINT QUERY BEFORE EXECUTING.
	     * PASS $THIS->DB to the PARAM.
	     * debug query
	     */
	    function print_query($db) {
	        echo "<pre>";print_r($db->get_compiled_select());echo "</pre>";
	    }
	}

	if(! function_exists('auto_format_paragraph') ) 
	{
		/**
		 * referensi https://stackoverflow.com/questions/7409512/new-line-to-paragraph-function
		 * @param  [type]  $string      [description]
		 * @param  boolean $line_breaks [description]
		 * @param  boolean $xml         [description]
		 * @return [type]               [description]
		 */
		function auto_format_paragraph($string, $line_breaks = true, $xml = true) {

			$string = str_replace(array('<p>', '</p>'), '', $string);

			// It is conceivable that people might still want single line-breaks
			// without breaking into a new paragraph.
			if ($line_breaks == true)
			    return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'), trim($string)).'</p>';
			else 
			    return '<p>'.preg_replace(
			    array("/([\n]{2,})/i", "/([\r\n]{3,})/i","/([^>])\n([^<])/i"),
			    array("</p>\n<p>", "</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'),

			    trim($string)).'</p>'; 
		}
	}


	function options($src, $id, $ref_val, $text_field)
	{
		$options = '';
		foreach ($src as $row) {
			$opt_value	= $row->$id;
			$text_value	= $row->$text_field;
			$data_id 	= $row->id; 			
			if ($row->$id == $ref_val) {
				$options .= '<option data-id="'.$data_id.'" value="'.$opt_value.'" selected>'.$text_value.'</option>';
			}
			else {
				$options .= '<option data-id="'.$data_id.'" value="'.$opt_value.'">'.$text_value.'</option>';
			}
		}
		return $options;
	}

	if(!function_exists('dateToIndo') ) {
		/**
		 * [dateToIndo description]
		 * @param  [type]  $date  [description]
		 * @param  boolean $short [description]
		 * @return [type]         [description]
		 */
		function dateToIndo($date,$short=false){
		    $BulanIndo = array("Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember");
		 
		    $bln_short = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nop","Des");
		 
		    $tahun = substr($date, 0, 4);
		    $bulan = substr($date, 5, 2);
		    $tgl = substr($date, 8, 2);
		    $jam = substr($date, 11, 8);
		 
		    if(!$short){
		        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun." ".$jam;
		    }else{
		        $result = $tgl . " " . $bln_short[(int)$bulan-1] . " ". $tahun." ".$jam;
		    }
		 
		    return($result);
		}
	}

	if(!function_exists('select_kecamatan') ) {
		/**
		 * [select_kecamatan description]
		 * @param  [type]  $date  [description]
		 * @param  boolean $short [description]
		 * @return [type]         [description]
		 */
		function select_kecamatan ($name, $selected = FALSE, $html_attr = '', $add_options = array("" => " -- Choose --")) {
	        $ci = & get_instance();

	        $ci->load->helper('form');

	        $datas = $ci->Global_model->set_model("mst_districts", "md", "id")->mode(array(
	        	'type' => 'all_data'
	        ));

	        if (!$datas) :
	            return FALSE;
	        endif;

	        $datas = array_column($datas,"name", "name");

	        return form_dropdown($name, $add_options + $datas, $selected, $html_attr);
	    }
	}


?>
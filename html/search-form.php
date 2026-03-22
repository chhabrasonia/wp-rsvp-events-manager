<?php
function get_search_form_html($terms, $type, $date_from, $date_to) {
	$terms_list = '';
	foreach ($terms as $term) {
	    $selected    = selected($type, $term->slug, false);
	    $terms_list .= "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
    }
	$html = 
	"<div class='events-search-form'>
		<form method='GET'>
        	<label>From:</label>
         	<input type='date' name='date_from' value='". esc_attr($date_from) . "'>
        	<label>To:</label> 
        	<input type='date' name='date_to' value='" . esc_attr($date_to) . "'>
        	<div class='form-control'>
	        	<select name='event_type'>
	        	 <option value=''>All Types</option>
	        	 ".$terms_list."
	        	 </select>
        	</div>
			<button>Search</button>
		</form> 
	  </div>";
	return $html;
}
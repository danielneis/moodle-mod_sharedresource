
<?php
/**
 *
 * @author  Valery Fremaux
 * @version 0.0.1
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License, mod/sharedresource is a work derived from Moodle mod/resource
 * @package sharedresource
 *
 */
require_once $CFG->dirroot.'/mod/sharedresource/metadatalib.php';
require_once $CFG->dirroot.'/mod/sharedresource/search_widget.class.php';

/**
* search_widget defines a widget element for the search engine of metadata.
*/


class duration_search_widget extends search_widget{

    /**
    * Constructor for the search_widget class
    */
    function duration_search_widget($pluginchoice, $id, $label, $type) {
    	parent::search_widget($pluginchoice, $id, $label, $type);
    }

	/**
    * Fonction used to display the widget. The parameter $display determines if plugins are displayed on a row or on a column
    */
    function print_search_widget($layout, $value = 0) {
    	global $OUTPUT;

		$lowername = strtolower($this->label);
		$widgetname = get_string(str_replace(' ', '', $lowername), 'sharedresource');

		if (!empty($value)){
			preg_match('/^([^:]+):(.*)/', $value, $matches);
			$operator = $matches[1];
			$value = $this->durationsplit($matches[2]);
		} else {
			$operator = '';
			$value = new StdClass;
			$value->days = '';
			$value->hours = '';
			$value->mins = '';
			$value->secs = '';
		}				
		
		$equalsselected = ($operator == '=') ? 'selected="selected"' : '' ;
		$nonequalsselected = ($operator == '!=') ? 'selected="selected"' : '' ;
		$lessselected = ($operator == '<') ? 'selected="selected"' : '' ;
		$moreselected = ($operator == '>') ? 'selected="selected"' : '' ;
		$lessequalselected = ($operator == '<=') ? 'selected="selected"' : '' ;
		$moreequalselected = ($operator == '>=') ? 'selected="selected"' : '' ;

		echo '<table class="widget" width="100%"><tr><td width="10px" class="header"></td>';
		echo '<td class="header">'.$widgetname.'</td>';
		echo '<td class="header" align="right">'.$OUTPUT->help_icon('durationsearch', 'sharedresource', false).'</td></tr>';
		echo '<tr><td colspan="3">';
		echo '<select name="'.$this->label.'_symbol">';
		echo '<option value="defaultvalue"> </option>';
		echo '<option value="=" '.$equalselected.' >=</option>';
		echo '<option value="<>" '.$nonequalselected.' >!=</option>';
		echo '<option value="<" '.$lessselected.' >&lt;</option>';
		echo '<option value=">" '.$moreselected.' >&gt;</option>';
		echo '<option value="<=" '.$lessequalselected.' >&le;</option>';
		echo '<option value=">=" '.$moreequalselected.' >&ge;</option>';
		echo '</select>';
		echo '<input type="text" size="2" name="'.$this->label.'_day" value="'.$value->days.'" />&nbsp;'.get_string('d', 'sharedresource');
		echo '<input type="text" size="2" name="'.$this->label.'_hour" value="'.$value->hours.'" />&nbsp;'.get_string('h', 'sharedresource');
		echo '<input type="text" size="2" name="'.$this->label.'_min" value="'.$value->mins.'" />&nbsp;'.get_string('m', 'sharedresource');
		echo '<input type="text" size="2" name="'.$this->label.'_sec" value="'.$value->secs.'" />&nbsp;'.get_string('s', 'sharedresource');
		echo '</td></tr></table>';
    }
	
	// catchs a value in session from CGI input
	function catch_value(&$searchfields){
		global $SESSION;

		if (!isset($SESSION->searchbag)){
			$SESSION->searchbag = new StdClass();
		}
		
		$paramkey = str_replace(' ', '_', $this->label);
		$searchfields[$this->id] = @$SESSION->searchbag->$paramkey;

		// check we have operator and at least one field is fed
		if((isset($_GET[$paramkey.'_day']) || isset($_GET[$paramkey.'_hour']) || isset($_GET[$paramkey.'_min']) || isset($_GET[$paramkey.'_sec'])) && isset($_GET[$paramkey.'_symbol']) && $_GET[$paramkey.'_symbol'] != 'defaultvalue'){
			// check of numeric values
			if(($_GET[$paramkey.'_day'] == '' || is_numeric($_GET[$paramkey.'_day'])) && ($_GET[$paramkey.'_hour'] == '' || is_numeric($_GET[$paramkey.'_hour'])) && ($_GET[$paramkey.'_min'] == '' || is_numeric($_GET[$paramkey.'_min'])) && ($_GET[$paramkey.'_sec'] == '' || is_numeric($_GET[$paramkey.'_sec']))){
				$searchduration = 0;
				// find number of seconds of the duration
				if(isset($_GET[$paramkey.'_day'])){
				$searchduration += $_GET[$paramkey.'_day'] * DAYSECS;
				}
				if(isset($_GET[$paramkey.'_hour'])){
				$searchduration += $_GET[$paramkey.'_hour'] * HOURSECS;
				}
				if(isset($_GET[$paramkey.'_min'])){
				$searchduration += $_GET[$paramkey.'_min'] * 60;
				}
				if(isset($_GET[$paramkey.'_sec'])){
				$searchduration += $_GET[$paramkey.'_sec'];
				}
				
				$searchfields[$this->id] = $_GET[$paramkey.'_symbol'].':'.$searchduration;
				$SESSION->searchbag->$paramkey = $_GET[$paramkey.'_symbol'].':'.$searchduration;
			}
		}
		if (isset($_GET[$paramkey.'_symbol']) && $_GET[$paramkey.'_symbol'] == 'defaultvalue'){
			$searchfields[$this->id] = '';
			$SESSION->searchbag->$paramkey = '';		
		}
	}
	
	function durationsplit($duration){
		$return->days = floor($duration / DAYSECS);
		$duration -= $return->days * DAYSECS;
		$return->hours = floor($duration / HOURSECS);
		$duration -= $return->hours * HOURSECS;
		$return->mins = floor($duration / 60);
		$duration -= $return->mins * 60;
		$return->secs = $duration;
		
		return $return;
	}
}
?>
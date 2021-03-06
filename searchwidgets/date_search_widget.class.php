
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


class date_search_widget extends search_widget{

    /**
    * Constructor for the search_widget class
    */
    function date_search_widget($pluginchoice, $id, $label, $type) {
    	parent::search_widget($pluginchoice, $id, $label, $type);
    }

	/**
    * Fonction used to display the widget. The parameter $display determines if plugins are displayed on a row or on a column
    */
    function print_search_widget($layout, $value = 0) {
    	global $OUTPUT;

		$lowername = strtolower($this->label);
		$widgetname = get_string(str_replace(' ', '', $lowername), 'sharedresource');

		echo '<table class="widget" width="100%"><tr><td width="2px" class="header"></td>';
		echo '<td class="header">'.$widgetname.'</td>';
		echo '<td class="header" align="right">'.$OUTPUT->help_icon('datesearch', 'sharedresource', false).'</td></tr>';
		echo '<tr><td colspan="3">';
		echo '<input size="10" onclick="javascript:ds_sh(this);" name="'.$this->label.'_startdate" value="Begin" readonly="readonly"/> ';
		echo '<input size="10" onclick="javascript:ds_sh(this);" name="'.$this->label.'_enddate" value="End" readonly="readonly"/></td></tr></table>';
		echo '<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">';
		echo '<tr><td id="ds_calclass" colspan="3">';
		echo '</td></tr>';
		echo '</table>';
    }
	
	// catchs a value in session from CGI input
	function catch_value(&$searchfields){
		global $SESSION;

		if (!isset($SESSION->searchbag)){
			$SESSION->searchbag = new StdClass();
		}
		
		$paramkey = str_replace(' ', '_', $this->label);
		$searchfields[$this->id] = @$SESSION->searchbag->$paramkey;

		if((isset($_GET[$paramkey.'_startdate']) && $_GET[$paramkey.'_startdate'] != 'Begin') || (isset($_GET[$paramkey.'_enddate']) && $_GET[$paramkey.'_enddate'] != 'End')){
			$searchfields[$this->id] = $_GET[$paramkey.'_startdate'].':'.$_GET[$paramkey.'_enddate'];
		}
	}
}
?>
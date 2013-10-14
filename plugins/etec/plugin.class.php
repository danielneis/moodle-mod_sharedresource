<?php
/**
 *
 * @author  Piers Harding  piers@catalyst.net.nz
 * @contributor  Valery Fremaux valery@valeisti.fr
 * @version 0.0.1
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License, mod/sharedresource is a work derived from Moodle mod/resoruce
 * @package sharedresource
 *
 */
/**
 * Extend the base resource class for file resources
 */
require_once($CFG->dirroot.'/mod/sharedresource/sharedresource_plugin_base.class.php');
require_once($CFG->dirroot.'/lib/accesslib.php');
class sharedresource_plugin_etec extends sharedresource_plugin_base {

    var $pluginname = 'etec';

    var $context;

    var $OTHERSOURCES = array();

    var $DEFAULTSOURCE = 'ETECv1.0';

    var $METADATATREE = array(
            '0' => array(
                'name' => 'Root',
                'source' => 'etec',
                'type' => 'root',
                'childs' => array(
                    '1' => 'single',
                    '2' => 'single',
                    '3' => 'single',
                    '4' => 'single',
                    '5' => 'single',
                    '6' => 'single',
                    )
                ),
            '1' => array(
                'name' => 'General',
                'source' => 'etec',
                'type' => 'category',
                'childs' => array(
                    '1_1' => 'single',
                    '1_2' => 'single',
                    '1_3' => 'single',
                    '1_4' => 'single',
                    '1_5' => 'list',
                    ),
                'checked' => array(
                    'system'  => 1,
                    'indexer' => 1,
                    'author'  => 1,
                    )
                ),
            '1_1' => array(
                    'name' => 'Identifier',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),
            '1_2' => array(
                    'name' => 'Title',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),
            '1_3' => array(
                    'name' => 'Language',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '1_4' => array(
                    'name' => 'Description',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '1_5' => array(
                    'name' => 'Keyword',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '2' => array(
                    'name' => 'Life Cycle',
                    'source' => 'etec',
                    'type' => 'category',
                    'childs' => array(
                        '2_1' => 'single',
                        '2_2' => 'single',
                        '2_3' => 'single'
                        ),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        )
                    ),
            '2_1' => array(
                    'name' => 'Author',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '2_2' => array(
                    'name' => 'Entity',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '2_3' => array(
                    'name' => 'Date',
                    'source' => 'etec',
                    'type' => 'date',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'date',
                    ),
            '3' => array(
                    'name' => 'Technical',
                    'source' => 'etec',
                    'type' => 'category',
                    'childs' => array(
                        '3_1' => 'single',
                        '3_2' => 'single',
                        '3_3' => 'single',
                        ),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        )
                    ),
            '3_1' => array(
                    'name' => 'Format',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '3_2' => array(
                    'name' => 'Size',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'numeric',
                    ),
            '3_3' => array(
                    'name' => 'Location',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '4' => array(
                    'name' => 'Educational',
                    'source' => 'etec',
                    'type' => 'category',
                    'childs' => array(
                        '4_1' => 'single',
                        '4_2' => 'single',
                        ),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                    )
                ),
            '4_1' => array(
                    'name' => 'Learning Resource Type',
                    'source' => 'etec',
                    'type' => 'text',
                    //'values' => array('exercise', 'simulation', 'questionnaire', 'diagram', 'figure', 'graph'),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '4_2' => array(
                    'name' => 'Intended End User Role',
                    'source' => 'etec',
                    'type' => 'text',
                    //'values' => array('teacher', 'author', 'learner', 'manager'),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 0,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '5' => array(
                    'name' => 'Rights',
                    'source' => 'etec',
                    'type' => 'category',
                    'childs' => array(
                        '5_1' => 'single',
                        ),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        )
                    ),
            '5_1' => array(
                    'name' => 'Copyright And Other Restrictions',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        ),
                    'widget' => 'freetext',
                    ),
            '6' => array(
                    'name' => 'Classification',
                    'source' => 'etec',
                    'type' => 'category',
                    'childs' => array(
                        '6_1' => 'single',
                        '6_2' => 'single',
                        '6_3' => 'single',
                        '6_4' => 'single'
                        ),
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 0,
                        )
                    ),
            '6_1' => array(
                    'name' => 'Eixo Tecnologico',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),
            '6_2' => array(
                    'name' => 'Curso/Tema',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),
            '6_3' => array(
                    'name' => 'Disciplina/Ementa/Componente curricular',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),
            '6_4' => array(
                    'name' => 'Unidade',
                    'source' => 'etec',
                    'type' => 'text',
                    'checked' => array(
                        'system'  => 1,
                        'indexer' => 1,
                        'author'  => 1,
                        ),
                    'widget' => 'freetext',
                    ),

    );

    function __construct($entryid = 0){
        $this->entryid = $entryid;
        $this->context = context_system::instance();
    }

    function sharedresource_entry_definition(&$mform){
        global $CFG, $DB;
        $iterators = array();
        foreach(array_keys($this->METADATATREE['0']['childs']) as $fieldid){
            if (has_capability('mod/sharedresource:systemmetadata', $this->context)){
                $metadataswitch = "config_etec_system_";
            } elseif (has_capability('mod/sharedresource:indexermetadata', $this->context)){
                $metadataswitch = "config_etec_indexer_";
            } else {
                $metadataswitch = "config_etec_author_";
            }
            $mform->metadataswitch = $metadataswitch;
            $metadataswitch .= $fieldid;
            if (get_config('sharedresource_etec', $metadataswitch)){
                $fieldtype = $this->METADATATREE['0']['childs'][$fieldid];
                $generic = $this->METADATATREE[$fieldid]['name'];
                if ($fieldtype == 'list'){
                    if ($instances = $DB->get_records('SELECT * FROM sharedresource_metadata WHERE entry_id = "'.$this->entryid.'" AND namespace = "etec" AND name LIKE "'.$generic.':%"')){
                        $iterators[] = 0;
                        foreach($instances as $instance){
                            $this->sharedresource_entry_definition_rec($mform, $fieldid, $iterators);
                            $iterator = array_pop($iterators);
                            $iterator++;
                            array_push($iterators, $iterator);
                        }
                    }
                }
                $this->sharedresource_entry_definition_rec($mform, $fieldid, $iterators);
            }
        }
        return true;
    }

    function sharedresource_entry_definition_rec(&$mform, $nodeid, &$iterators){
        global $CFG, $DB;
        if (!array_key_exists($nodeid, $this->METADATATREE)){
            print_error('metadatastructureerror', 'sharedresource');
        }
        // special traps : Classification
        // common case
        $generic = $this->METADATATREE[$nodeid]['name'];
        if ($this->METADATATREE[$nodeid]['type'] == 'category'){
            $mform->addElement('header', $generic, get_string(str_replace(' ', '_', strtolower($generic)), 'sharedresource'));
            $mform->addElement('hidden', $generic, 1);
            foreach(array_keys($this->METADATATREE[$nodeid]['childs']) as $fieldid){
                $metadataswitch = $mform->metadataswitch.$fieldid;
                if (get_config('sharedresource_etec', $metadataswitch)){
                    $this->sharedresource_entry_definition_rec($mform, $fieldid, $iterators);
                }
            }
        } elseif ($this->METADATATREE[$nodeid]['type'] == 'list'){
            // get exiting records in db
            $elementinstances = $DB->get_records_select('SELECT * FROM sharedresource_metadata WHERE entry_id = "'.$this->entryid.'" AND namespace = "etec" and name LIKE "'.$generic.':%"', array());
            // iterate on instances
            $metadataswitch = $mform->metadataswitch.$nodeid;
            if ($instances && get_config('sharedresource_etec', $metadataswitch)){
                $iterators[] = 0;
                foreach($instances as $instance){
                    $this->sharedresource_entry_definition_rec($mform, $fieldid, $iterators);
                    $iterztor = array_pop($iterators);
                    $iterator++;
                    array_push($iterators, $iterator);
                }
            }
        } else {
            $metadataswitch = $mform->metadataswitch.$nodeid;
            if (get_config('sharedresource_etec', $metadataswitch)){
                $this->sharedresource_entry_definition_scalar($mform, $this->METADATATREE[$nodeid]);
            }
        }
    }

    /**
     * Form handler for scalar value (regular case)
     */
    function sharedresource_entry_definition_scalar(&$mform, &$element){
        if ($element['type'] == 'select'){
            $values = $element['values'];
            $options = array();
            foreach($values as $value){
                $options[$value] = preg_replace('/\[\[|\]\]/', '', get_string(str_replace(' ', '_', strtolower($value)), 'sharedresource'));
            }
            $mform->addElement($element['type'], $element['name'], get_string(str_replace(' ', '_', strtolower($element['name'])), 'sharedresource'), $options);
        } else {
            $mform->addElement($element['type'], $element['name'], get_string(str_replace(' ', '_', strtolower($element['name'])), 'sharedresource'));
        }
    }

    /**
     * prints a full configuration form allowing element by element selection against the user profile
     * regarding to metadata
     */
    function configure($config){
        // initiate
        $selallstr = get_string('selectall', 'sharedresource');
        $selnonestr = get_string('selectnone', 'sharedresource');
        echo '<legend><b>&nbsp;'.get_string('etecformat', 'sharedresource').'</b></legend>';
        echo "<br/><center>";
        echo '<table border="1px" width="90%"><tr><td colspan="4">';
        echo '</td></tr>';
        echo '<tr><td width="30%"><b>&nbsp;'.get_string('fieldname', 'sharedresource').'</b></td>';
        echo '<td width="15%" align=\'center\'><b>'.get_string('system', 'sharedresource').'</b><br/><a href="javascript:selectall(\'system\', \'etec\')">'.$selallstr.'</a>/<a href="javascript:selectnone(\'system\', \'etec\')">'.$selnonestr.'</a></td>';
        echo '<td width="15%" align=\'center\'><b>'.get_string('indexer', 'sharedresource').'</b><br/><a href="javascript:selectall(\'indexer\', \'etec\')">'.$selallstr.'</a>/<a href="javascript:selectnone(\'indexer\', \'etec\')">'.$selnonestr.'</a></td>';
        echo '<td width="15%" align=\'center\'><b>'.get_string('author', 'sharedresource').'</b><br/><a href="javascript:selectall(\'author\', \'etec\')">'.$selallstr.'</a>/<a href="javascript:selectnone(\'author\', \'etec\')">'.$selnonestr.'</a></td>';
        echo '<td width="15%" align=\'center\'><b>'.get_string('widget', 'sharedresource').'</b></td></tr>';
        echo '</table>';
        foreach(array_keys($this->METADATATREE['0']['childs']) as $fieldid){
            echo '<table border="1px" width="90%"><tr><td colspan="4">';
            $this->print_configure_rec($fieldid);
            echo '</table>';
        }
        echo "</center>";
    }

    /**
     * widget classes are automagically loaded when gound in activewidgets
     * @see .§configure()
     */
    function print_configure_rec($fieldid, $parentnode = '0'){
        static $indent = 0;
        if (!array_key_exists($fieldid, $this->METADATATREE)){
            print_error('metadatastructureerror', 'sharedresource');
        }
        $field = $this->METADATATREE[$fieldid];
        $checked_system = (get_config('sharedresource_etec', "config_etec_system_{$fieldid}")) ? 'checked="checked"' : '' ;
        $checked_indexer = (get_config('sharedresource_etec', "config_etec_indexer_{$fieldid}")) ? 'checked="checked"' : '' ;
        $checked_author = (get_config('sharedresource_etec', "config_etec_author_{$fieldid}")) ? 'checked="checked"' : '' ;
        $activewidgets = unserialize(get_config(NULL,'activewidgets'));
        $checked_widget = '';
        if (!empty($activewidgets)){
            foreach($activewidgets as $key => $widget){
                if($widget->id == $fieldid){
                    $checked_widget = 'checked="checked"';
                }
            }
        }
        $indentsize = 15 * $indent;
        $lowername = strtolower($field['name']);
        $fieldname = get_string(str_replace(' ', '', $lowername), 'sharedresource');
        if ($field['type'] == 'category'){
            echo "<tr";
            if($parentnode == '0'){
                echo " bgcolor='#E1E2E2'";
            }
            echo "><td width='30%' align=\"left\" style=\"padding-left:{$indentsize}px\"><b>&nbsp;{$fieldname}</b></td>";
        } else {
            echo "<tr><td width='30%' align=\"left\" style=\"padding-left:{$indentsize}px\">&nbsp;{$fieldname}</td>";
        }
        if($parentnode == '0'){
            echo "<td width='15%' align='center'><input id=\"etec_system_{$fieldid}\" type=\"checkbox\" name=\"config_etec_system_{$fieldid}\" $checked_system value=\"1\" onclick=\"toggle_childs('etec', 'system', '{$fieldid}')\" /></td>";
            echo "<td width='15%' align='center'><input id=\"etec_indexer_{$fieldid}\" type=\"checkbox\" name=\"config_etec_indexer_{$fieldid}\" $checked_indexer value=\"1\" onclick=\"toggle_childs('etec', 'indexer', '{$fieldid}')\" /></td>";
            echo "<td width='15%' align='center'><input id=\"etec_author_{$fieldid}\" type=\"checkbox\" name=\"config_etec_author_{$fieldid}\" $checked_author value=\"1\" onclick=\"toggle_childs('etec', 'author', '{$fieldid}')\" /></td>";
            if(isset($field['widget'])){
                echo "<td width='15%' align='center'><input id=\"etec_widget_{$fieldid}\" type=\"checkbox\" name=\"widget_etec_{$fieldid}\" $checked_widget value=\"1\"/></td></tr>";
            } else {
                echo "<td width='15%' align='center'></td></tr>";
            }
        } else {
            if($checked_system=='checked="checked"'){
                echo "<td align='center'><input id=\"etec_system_{$fieldid}\" type=\"checkbox\" name=\"config_etec_system_{$fieldid}\" $checked_system value=\"1\" onclick=\"toggle_childs('etec', 'system', '{$fieldid}')\"/></td>";
            } else {
                echo "<td align='center'><input id=\"etec_system_{$fieldid}\" type=\"checkbox\" name=\"config_etec_system_{$fieldid}\" $checked_system value=\"1\" onclick=\"toggle_childs('etec', 'system', '{$fieldid}')\" DISABLED/></td>";
            }
            if($checked_indexer=='checked="checked"'){
                echo "<td align='center'><input id=\"etec_indexer_{$fieldid}\" type=\"checkbox\" name=\"config_etec_indexer_{$fieldid}\" $checked_indexer value=\"1\" onclick=\"toggle_childs('etec', 'indexer', '{$fieldid}')\" /></td>";
            } else {
                echo "<td align='center'><input id=\"etec_indexer_{$fieldid}\" type=\"checkbox\" name=\"config_etec_indexer_{$fieldid}\" $checked_indexer value=\"1\" onclick=\"toggle_childs('etec', 'indexer', '{$fieldid}')\" DISABLED/></td>";
            }
            if($checked_author=='checked="checked"'){
                echo "<td align='center'><input id=\"etec_author_{$fieldid}\" type=\"checkbox\" name=\"config_etec_author_{$fieldid}\" $checked_author value=\"1\" onclick=\"toggle_childs('etec', 'author', '{$fieldid}')\"/></td>";
            } else {
                echo "<td align='center'><input id=\"etec_author_{$fieldid}\" type=\"checkbox\" name=\"config_etec_author_{$fieldid}\" $checked_author value=\"1\" onclick=\"toggle_childs('etec', 'author', '{$fieldid}')\" DISABLED/></td>";
            }
            if(isset($field['widget'])){
                if($checked_widget=='checked="checked"'){
                    echo "<td align='center'><input id=\"etec_widget_{$fieldid}\" type=\"checkbox\" name=\"widget_etec_{$fieldid}\" $checked_widget value=\"1\"/></td></tr>";
                } else {
                    echo "<td align='center'><input id=\"etec_widget_{$fieldid}\" type=\"checkbox\" name=\"widget_etec_{$fieldid}\" $checked_widget value=\"1\"/></td></tr>";
                }
            } else {
                echo "<td align='center'></td></tr>";
            }
        }
        $i = 1;
        if ($field['type'] == 'category'){
            if (!empty($field['childs'])){
                foreach(array_keys($field['childs']) as $childfieldid){
                    $indent++;
                    $this->print_configure_rec($childfieldid, $parentnode.'_'.$i);
                    $indent--;
                    $i++;
                }
            }
        }
    }

    // a weak implementation using only in resource title and description.
    function search(&$fromform, &$result) {
        global $CFG,$DB;
        $fromform->title        = isset($fromform->title) ? true : false;
        $fromform->description  = isset($fromform->description) ? true : false;
        // if the search criteria is left blank then this is a complete browse
        if ($fromform->search == '') {
            $fromform->search = '*';
        }
        if ($fromform->section == 'block') {
            $fromform->title = true;
            $fromform->description = true;
        }
        $searchterms = explode(" ", $fromform->search);    // Search for words independently
        foreach ($searchterms as $key => $searchterm) {
            if (strlen($searchterm) < 2) {
                unset($searchterms[$key]);
            }
        }
        // no valid search terms so lets just open it up
        if (count($searchterms) == 0) {
            $searchterms[]= '%';
        }
        $search = trim(implode(" ", $searchterms));
        //to allow case-insensitive search for postgesql
        if ($CFG->dbfamily == 'postgres') {
            $LIKE = 'ILIKE';
            $NOTLIKE = 'NOT ILIKE';   // case-insensitive
            $REGEXP = '~*';
            $NOTREGEXP = '!~*';
        } else {
            $LIKE = 'LIKE';
            $NOTLIKE = 'NOT LIKE';
            $REGEXP = 'REGEXP';
            $NOTREGEXP = 'NOT REGEXP';
        }
        $titlesearch        = '';
        $descriptionsearch  = '';
        foreach ($searchterms as $searchterm) {
            if ($titlesearch) {
                $titlesearch .= ' AND ';
            }
            if ($descriptionsearch) {
                $descriptionsearch .= ' AND ';
            }
            if (substr($searchterm, 0, 1) == '+') {
                $searchterm          = substr($searchterm,1);
                $titlesearch        .= " title $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
                $descriptionsearch  .= " description $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            } else if (substr($searchterm,0,1) == "-") {
                $searchterm          = substr($searchterm,1);
                $titlesearch        .= " title $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
                $descriptionsearch  .= " description $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            } else {
                $titlesearch        .= ' title '.       $LIKE .' \'%'. $searchterm .'%\' ';
                $descriptionsearch  .= ' description '. $LIKE .' \'%'. $searchterm .'%\' ';
            }
        }
        $selectsql  = '';
        $selectsqlor  = '';
        $selectsql .= '{sharedresource_entry} WHERE (';
        $selectsqlor    = '';
        if($fromform->title && $search){
            $selectsql     .= $titlesearch;
            $selectsqlor    = ' OR ';
        }
        if($fromform->description && $search){
            $selectsql     .= $selectsqlor.$descriptionsearch;
            $selectsqlor    = ' OR ';
        }
        $selectsql .= ')';
        $sort = "title ASC";
        $page = '';
        $recordsperpage = SHAREDRESOURCE_SEARCH_LIMIT;
        if ($fromform->title || $fromform->description) {
            // when given a complete wildcard, then this is browse mode
            if ($fromform->search == '*') {
                $resources = $DB->get_records('sharedresource_entry', null, $sort);    // A VERIFIER !!!
            } else {
                $sql = 'SELECT * FROM '. $selectsql .' ORDER BY '. $sort;
                $resources = $DB->get_records_sql($sql, null, $page, $recordsperpage); // A VERIFIER !!!
            }
        }
        // append the results
        if (!empty($resources)) {
            foreach ($resources as $resource) {
                //$result[] = new sharedresource_entry($resource);
            }
        }
    }

    function get_cardinality($element, &$fields, &$cardinality){
        if(!($this->METADATATREE[$element]['type'] == 'category' || $this->METADATATREE[$element]['type'] == 'root')) return;
        foreach($this->METADATATREE[$element]['childs'] as $elem => $value){
            if($value == 'list'){
                $cardinality[$elem] = 0;
                foreach($fields as $field){
                    if(strpos($field->element, "$elem:") === 0){
                        $cardinality[$elem]++;
                    }
                }
            }
            $this->get_cardinality($elem, $fields, $cardinality);
        }
    }

    /**
     * generates a full XML metadata document attached to the resource entry
     */
    function get_metadata(&$sharedresource_entry, $namespace = null){
        global $SITE, $DB, $CFG;
        if (empty($namespace)) ($namespace = $CFG->{'pluginchoice'}) or ($namespace = 'etec');
        // cleanup some values
        if ($sharedresource_entry->description == '$@NULL@$') $sharedresource_entry->description = '';
        // default
        $lang = substr(current_language(), 0, 2);
        $fields = $DB->get_records('sharedresource_metadata' , array('entry_id' => $sharedresource_entry->id, 'namespace' => $namespace));
        // construct cardinality table
        $cardinality = array();
        $this->get_cardinality('0', $fields, $cardinality);
        foreach($fields as $field){
            $parts = explode(':',$field->element);
            $element = $parts[0];
            $path = @$parts[1];
            if (!isset($metadata[$element])){
                $metadata[$element] =  array();
            }
            $metadata[$element][$path] = $field->value;
            if($element == '3_4') $lang = $field->value;
        }
        $languageattr = 'language="'.$lang.'"';
        $etec = "
            <etec:etec xmlns:etec=\"http://\"
            xmlns:etec=\"http://\">";
        $tmpstr = '';
        if($this->generate_xml('0', $metadata, $languageattr, $tmpstr, $cardinality, '')){
            $etec .= $tmpstr;
        }
        $etec .= "
            </etec:etec>
            ";
        return $etec;
    }

    function generate_xml($elem, &$metadata, &$languageattr, &$fatherstr, &$cardinality, $pathcode){
        $value = $this->METADATATREE[$elem];
        $tmpname = str_replace(' ','',$value['name']);
        $name = strtolower(substr($tmpname,0,1)).substr($tmpname,1);
        $valid = 0;
        $namespace = $value['source'];
        // category/root : we have to call generate_xml on each child
        if($elem == '0'){
            $tab = array();
            $childnum = 0;
            foreach($value['childs'] as $child => $multiplicity){
                $tab[$childnum] = '';
                if(isset($cardinality[$child]) && $cardinality[$child] != 0){
                    for ($i = 0; $i < $cardinality[$child]; $i++){
                        $valid = ($this->generate_xml($child, $metadata, $languageattr, $tab[$childnum], $cardinality, $i) || $valid);
                        $childnum++;
                    }
                } else {
                    $valid = ($this->generate_xml($child, $metadata, $languageattr, $tab[$childnum], $cardinality, '0') || $valid);
                    $childnum++;
                }
            }
            for ( $i = 0; $i < count($tab); $i++){
                $fatherstr .= $tab[$i];
            }
        } elseif($value['type'] == 'category') {
            $tab = array();
            $childnum = 0;
            foreach($value['childs'] as $child => $multiplicity){
                $tab[$childnum] = '';
                if(isset($cardinality[$child]) && $cardinality[$child] != 0){
                    for ($i = 0; $i < $cardinality[$child]; $i++){
                        $valid = ($this->generate_xml($child, $metadata, $languageattr, $tab[$childnum], $cardinality, $pathcode.'_'.$i) || $valid);
                        $childnum++;
                    }
                } else {
                    $valid = ($this->generate_xml($child, $metadata, $languageattr, $tab[$childnum], $cardinality, $pathcode.'_0') || $valid);
                    $childnum++;
                }
            }
            // at least one child has content
            if($valid){
                $fatherstr .= "
                    <{$namespace}:{$name}>";
                for ( $i = 0; $i < count($tab); $i++){
                    $fatherstr .= $tab[$i];
                }
                $fatherstr .= "
                    </{$namespace}:{$name}>";
            }
        } elseif(count(@$metadata[$elem]) > 0) {
            foreach ($metadata[$elem] as $path => $val){
                // a "node" that contains data
                if(strpos($path, $pathcode) === 0){
                    switch($value['type']){
                        case 'text':
                            $fatherstr .= "
                                <{$namespace}:{$name}>
                                <{$namespace}:string $languageattr>".$metadata[$elem][$path]."</{$namespace}:string>
                                </{$namespace}:{$name}>";
                            break;
                        case 'select':
                            $source = $this->DEFAULTSOURCE;
                            $fatherstr .= "
                                <{$namespace}:{$name}>
                                <{$namespace}:source>".$source."</{$namespace}:source>
                                <{$namespace}:value>".$metadata[$elem][$path]."</{$namespace}:value>
                                </{$namespace}:{$name}>";
                            break;
                        case 'date':
                            $fatherstr .= "
                                <{$namespace}:{$name}>
                                <{$namespace}:dateTime>".$metadata[$elem][$path]."</{$namespace}:dateTime>
                                </{$namespace}:{$name}>";
                            break;
                        case 'duration':
                            $fatherstr .= "
                                <{$namespace}:{$name}>
                                <{$namespace}:duration>".$metadata[$elem][$path]."</{$namespace}:duration>
                                </{$namespace}:{$name}>";
                            break;
                        default:
                            $fatherstr .= "
                                <{$namespace}:{$name}>".$metadata[$elem][$path]."</{$namespace}:{$name}>";
                    }
                    $valid = 1;
                }
            }
        }
        return $valid;
    }

    /**
     * Access to the sharedresource_entry object after a new object
     * is saved.
     *
     * @param sharedresource_entry   object, reference to sharedresource_entry object
     *        including metadata
     * @return bool, return true to continue to the next handler
     *        false to stop the running of any subsequent plugin handlers.
     */
    function after_save(&$sharedresource_entry){
        if (!empty($sharedresource_entry->keywords)){
            $this->setKeywords($sharedresource_entry->keywords);
        }
        if (!empty($sharedresource_entry->title)){
            $this->setTitle($sharedresource_entry->title);
        }
        if (!empty($sharedresource_entry->description)){
            $this->setDescription($sharedresource_entry->description);
        }
        return true;
    }

    function after_update(&$sharedresource_entry){
        if (!empty($sharedresource_entry->keywords)){
            $this->setKeywords($sharedresource_entry->keywords);
        }
        if (!empty($sharedresource_entry->title)){
            $this->setTitle($sharedresource_entry->title);
        }
        if (!empty($sharedresource_entry->description)){
            $this->setDescription($sharedresource_entry->description);
        }
        return true;
    }

    /**
     * function to get any element only with its number of node
     */
    function getElement($id){
        $element = new StdClass;
        $element->id = $id;
        $element->name = $this->METADATATREE[$id]['name'];
        $element->type = $this->METADATATREE[$id]['widget'];
        return $element;
    }

    /**
     * keyword have a special status in metadata form, so a function to find the keyword field is necessary
     */
    function getKeywordElement(){
        $element = new StdClass;
        $element->name = "1_5";
        $element->type = "list";
        return $element;
    }

    /**
     * keyword have a special status in metadata form, so a function to find the keyword values
     */
    function getKeywordValues($metadata){
        $keyelm = $this->getKeywordElement();
        $keykeys = preg_grep("/{$keyelm->name}:.*/", array_keys($metadata));
        $kwlist = array();
        foreach($keykeys as $k){
            $kwlist[] = $metadata[$k]->value;
        }
        return implode(', ', $kwlist);
    }

    /**
     * title have a special status in metadata form, so a function to find the title field is necessary
     */
    function getTitleElement(){
        $element = new StdClass;
        $element->name = "1_2";
        $element->type = "text";
        return $element;
    }

    /**
     * location have a special status in metadata form, so a function to find the location field is necessary
     */
    function getLocationElement(){
        $element = new StdClass;
        $element->name = "4_3";
        $element->type = "text";
        return $element;
    }

    /**
     * title have a special status in metadata form, so a function to find the description field is necessary
     */
    function getDescriptionElement(){
        $element = new StdClass;
        $element->name = "1_4";
        $element->type = "text";
        return $element;
    }
    function getTaxumpath(){
        $element = array();
        $element['main']="Taxon Path";
        $element['source'] = "9_2_1";
        $element['id'] = "9_2_2_1";
        $element['entry'] = "9_2_2_2";
        return $element;
    }

    function getClassification(){
        $element = "9";
        return $element;
    }

    /**
     * records keywords in metadata flat table
     */
    function setKeywords($keywords){
        global $DB;
        if (empty($this->entryid)) return; // do not affect metadata to unkown entries
        $DB->delete_records_select('sharedresource_metadata',
                                   'namespace = "etec" AND element LIKE "1_5:0_%" AND entry_id = '.$this->entryid);
        if ($keywordsarr = explode(',', $keywords)){
            $i = 0;
            foreach($keywordsarr as $aword){
                $aword = trim($aword);
                $mtdrec = new StdClass;
                $mtdrec->entry_id = $this->entryid;
                $mtdrec->element = '1_5:0_'.$i;
                $mtdrec->namespace = 'etec';
                $mtdrec->value = $aword;
                $DB->insert_record('sharedresource_metadata', $mtdrec);
                $i++;
            }
        }
    }

    /**
     * records title in metadata flat table from db attributes
     */
    function setTitle($title){
        global $DB;
        if ($this->entryid == 0) return;
        $DB->delete_records('sharedresource_metadata', array('entry_id'=> $this->entryid, 'namespace'=> 'etec', 'element'=> '1_2:0_0'));
        $mtdrec = new StdClass;
        $mtdrec->entry_id = $this->entryid;
        $mtdrec->element = '1_2:0_0';
        $mtdrec->namespace = 'etec';
        $mtdrec->value = $title;
        return $DB->insert_record('sharedresource_metadata', $mtdrec);
    }

    /**
     * records title in metadata flat table from db attributes
     */
    function setDescription($description){
        global $DB;
        if ($this->entryid == 0) return;
        $DB->delete_records('sharedresource_metadata', array('entry_id' => $this->entryid, 'namespace'=> 'etec', 'element'=> '1_4:0_0'));
        $mtdrec = new StdClass;
        $mtdrec->entry_id = $this->entryid;
        $mtdrec->element = '1_4:0_0';
        $mtdrec->namespace = 'etec';
        $mtdrec->value = $description;
        return $DB->insert_record('sharedresource_metadata', $mtdrec);
    }
}

<?php

/* <Step Functions> */
function render_node($nid = 3059){
	$node_ob_this = node_load($nid);
	$buffer = '';
	$buffer .= '<h4>Function: '. __FUNCTION__ . '()' . $line . '</h4>';
	$buffer .= '<pre>';
	$buffer .= print_r($node_ob_this, true);
	$buffer .= '</pre>';

	return $buffer;
}
/* </Step Functions> */

/* <Utility Functions> */
function gather_apt_sourceid($sourceid){
	$pseudo_empty = 'a:1:{s:5:"value";s:0:"";}';
	$query = db_select('npt_nodewords', 'nw')
			->fields('nw')
			->condition('nw.id', $sourceid)
			;
	$result = $query->execute()->fetchAll();

	foreach ($result as $src_index => $src_ob) {
		$content_unserialized = unserialize($src_ob->content);
		$result[$src_index]->content = $content_unserialized;
	}

	return $result;
}


function gatherMapped($options = array()){
		$mapped = 'db_select';
		$gather_metatags = gatherMetaTags($mapped, $options);
}

function gatherMetaTags($mapped, &$options) {
	$load_node_metatag = loadNodeMetatTags($mapped,$options);
}
function loadNodeMetatTags($mapped, &$options) {
	$update_mapped = updateMapped($mapped, $options);
}

function updateMapped($mapped, &$options){
}

function gather_mapped($table_name = 'nodeword_mapped_brad', $count = 0) {
	$line = ' Line: ' . (__LINE__ -1);
	$count_default = 2; // set to anything, ZERO to disable default
	$count = $count == 0?@$_GET['map_next_count'] + 0:$count; 
	$count = $count == 0?$count_default:$count;
	if ($count + 0 == 0) {
	 	return false;
	 } 
	
	// $random_sourceid_array[] = 26285; //12284
	// $random_sourceid_array[] = 6476; //3630
	// $random_sourceid_array[] = 23782; //7960
	// $random_sourceid_array[] = 5744; //3059
	// $random_sourceid_array[] = 23867; //8271
	// $random_sourceid_array[] = 10533; //6632
	// $random_sourceid_array = array( //TEST 10
	// 	4606, //2128 
	// 	10640, //6893 
	// 	4024, //2560 
	// 	9937, //6127 
	// 	7876, //4484 
	// 	7437, //4152 
	// 	26287, //12286 
	// 	24977, //8869 
	// 	24770, //8844 
	// 	8549, //4893 
	// );
	// $random_sourceid_array = array( //TEST 10 APPENDED (10 should be skipped) 
	// 	4606, //2128 
	// 	10640, //6893 
	// 	4024, //2560 
	// 	9937, //6127 
	// 	7876, //4484 
	// 	7437, //4152 
	// 	26287, //12286 
	// 	24977, //8869 
	// 	24770, //8844 
	// 	8549, //4893 
	// 	9638, //5899 
	// 	23140, //7501 
	// 	6341, //3525 
	// 	2701, //7989 
	// 	24213, //8275 
	// 	23499, //7714 
	// 	23545, //7745 
	// 	25237, //9077 
	// 	23392, //7606 
	// 	3945, //1594 
	// );
	//  $random_sourceid_array = array( //Total to 30
	// 	3948, //1596 
	// 	8168, //4680 
	// 	25412, //9229 
	// 	25948, //9637 
	// // );
	// $random_sourceid_array = array( //Total to 50
	// 	6429, //3674 z
	// 	4095, //1716 z
	// 	24296, //8339 z
	// 	10714, //6839 z
	// 	5451, //4116 z
	// 	9216, //5605 z
	// 	10648, //6720 z
	// 	3679, //5339 z
	// 	22755, //7162 z
	// 	10072, //6228 z
	// 	6196, //5284 z
	// 	26334, //12328 
	// 	7660, //4324 z
	// 	22983, //7354 z
	// 	23612, //7804 z
	// 	4379, //1942 z
	// 	9585, //5864 z
	// 	25346, //9172 z
	// 	24628, //8588 z
	// 	24808, //9059 z
	// );
	// $random_sourceid_array = array( //bread; failed to eliminate error 
	// 	5169, //2596 
	// 	8133, //4624 
	// 	25982, //9666 
	// 	8926, //5290 
	// 	26094, //9757 
	// 	4963, //2572 
	// 	25879, //9586 
	// 	5086, //2524 
	// 	23030, //7409 
	// 	24209, //8260 
	// 	23604, //7808 
	// 	5596, //2951 
	// 	6270, //3495 
	// 	10656, //6738 
	// 	26554, //12523 
	// 	7461, //4168 
	// 	25626, //9734 
	// 	22897, //7282 
	// 	24393, //8422 
	// 	6004, //3248 
	// 	25548, //9343 
	// 	10578, //6691 
	// 	6733, //3699 
	// 	4497, //2044 
	// 	25469, //9258 
	// 	22750, //7159 
	// 26334, //12328 again since page does not exist 
	// );

	// $random_sourceid_array = array( 
	// 	5200, //2626 
	// 	25009, //8897 
	// 	22931, //7323 
	// 	10458, //6576 
	// 	9907, //6112 
	// 	3963, //1610 
	// );
	// $random_sourceid_array = array( 
	// 	26558, //12524 
	// 	7620, //4304 
	// 	10801, //6843 
	// 	7394, //4111 
	// 	6388, //3559 
	// 	// 26334, //12328 again since page does not exist 
	// );
	// $count = 10;
	$query = db_select('nodeword_mapped_brad', 'nwmp')
			->fields('nwmp')
			->range(0,$count)
			->condition('nwmp.is_mapped', 0)
			// ->condition('nwmp.sourceid', $random_sourceid_array, 'IN')
			->orderBy('nwmp.destid')
			;
	$result = $query->execute()->fetchAll();

	if (count($result) == 0) {
		return '<h3>No Mappings to Process!</h3>';
	}

	$apt_nodeword_name_array = array(
		/* <after Wilbur return> from TeamWork task*/
		"page_title",
		"description",
		"abstract",
		"keywords",
		"copyright",
		/* </after Wilbur return> */
		);
	$metatag_overload_name_array = array(
		'page_title'=>'title',
		'copyright'=>'rights',
		);
	// $pseudo_empty = 'a:1:{s:5:"value";s:0:"";}';
	$mapping_count = 0;
	foreach ($result as $index => $mapping) {

		if ($mapping->sourceid + 0 == 0) {
			break;
		}
		$mapping_count++;
		$source_these = gather_apt_sourceid($mapping->sourceid);

		$result[$index]->last_imported = date('Y-m-d H:i:s');
		$result[$index]->count_skip = 0;
		$result[$index]->count_empty = 0;
		$result[$index]->count_write = 0;

		foreach ($source_these as $src_index => $src_ob) {
			if (in_array($src_ob->name, $apt_nodeword_name_array) === false) {
				$result[$index]->count_skip++;
			// }elseif(empty($src_ob->content['value']) == true || $src_ob->content['value'] == $pseudo_empty) {
			}elseif(empty($src_ob->content['value']) == true) {
				$result[$index]->count_empty++;
			}else{
				$result[$index]->count_write++;
				$name = empty($metatag_overload_name_array[$src_ob->name])?$src_ob->name:$metatag_overload_name_array[$src_ob->name];
				$result[$index]->meta_array[$name]['value'] = $src_ob->content['value'];
			}
		}
		if ($result[$index]->count_write > 0) {
			if (1 != 20150519) {
				$node_ob_this = node_load($mapping->destid);
				$node_ob_this->metatags[$node_ob_this->language] = $result[$index]->meta_array;
				node_save($node_ob_this);
			}
			$result[$index]->is_mapped = 7;
			$result[$index]->rollback_action = 'S:' . $result[$index]->count_skip . ';E:' . $result[$index]->count_empty . ';W:' . $result[$index]->count_write . ';';
		}else{
			$result[$index]->is_mapped = 9;
			$result[$index]->rollback_action = 'S:' . $result[$index]->count_skip . ';E:' . $result[$index]->count_empty . ';W:' . $result[$index]->count_write . ';';
		}
		$update = updateMapping($result[$index]->sourceid, $result[$index]->destid, $result[$index]->is_mapped, $result[$index]->rollback_action, $result[$index]->last_imported);

		$node_these[$mapping->destid] = $mapping->destid;
	}

	$mapped = $result;

	$buffer = '';
	$buffer .= '<h4>Counts: '. $count . ' (GET); '. $mapping_count . ' (result); ' . '</h4>';
	$buffer .= '<h4>Function: '. __FUNCTION__ . '()' . $line . '</h4>';
	$buffer .= '<pre>';
	$buffer .= print_r($mapped, true);
	$buffer .= '</pre>';

	return $buffer;
}

function updateMapping($sourceid, $destid, $is_mapped, $rollback_action, $last_imported) {
		$update = db_update('nodeword_mapped_brad')
		->fields(array(
			'is_mapped' => $is_mapped, 
			'rollback_action' => $rollback_action, 
			'last_imported' => $last_imported,
			))
    // ->expression('is_mapped', $is_mapped)
    // ->expression('rollback_action', $rollback_action)
    // ->expression('last_imported', $last_imported)
    ->condition('sourceid', $sourceid)
    ->condition('destid', $destid)
    ->execute()
    ;
    return $update;
}
function node_destid_load($nid = 0) {
	$line = ' Line: ' . (__LINE__ -1);

	// $mapped = gather_mapped($table_name, $count);
	$mapped = gather_mapped();
	// $node = noad_load($nid);
	// $node_this = $mapped;
	$sourceid_array = $mapped['sourceid'];
	$destid_array = $mapped['destid'];
	// $node_this = $mapped[0]['destid'] + 0;
	// $nodeid_this = $mapped[0]['destid'] + 0;
	// $node_this = node_load($nodeid_this);

	$buffer = '';
	$buffer .= '<h4>Function: '. __FUNCTION__ . '()' . $line . '</h4>';
	foreach ($sourceid_array as $index => $sourceid_this) {

		$query = db_select('npt_nodewords', 'nw')
				->fields('nw')
				->condition('nw.id', $sourceid_this);
		$result = $query->execute()->fetchAll();
		$output_this = $result;

		$buffer .= "<h3>Source: $index</h3><pre>";
		$buffer .= print_r($output_this, true);
		$buffer .= '</pre>';

		$destid_this = $destid_array[$index];
		$dest_node_this = node_load($destid_this);
		// $output_this = $destid_array;
		// $output_this = $destid_this;
		$output_this = $dest_node_this;

		$buffer .= "<h3>Destination: $index</h3><pre>";
		$buffer .= print_r($output_this, true);
		$buffer .= '</pre>';

	}


	return $buffer;
}
/* </Utility Functions> */

/* <Template Functions> */
function render_header($options){
	$buffer = '';
	$buffer .= '<h1>Mapping and Loading NodeWords to MetaTags</h1>';

	return $buffer;
}
function render_footer($options){
	$buffer = '';
	$human_stamp = date('\o\n M, d Y \a\t g:i:s a');
	$buffer .= "<h3>Page Loaded $human_stamp </h3>";
	$buffer .= "<h4>File: " . basename(__FILE__) . " </h4>";

	return $buffer;
}
/* </Template Functions> */

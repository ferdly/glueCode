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

function gather_mapped($table_name = 'nodeword_mapped_brad', $count = 0) {
	$line = ' Line: ' . (__LINE__ -1);
	$count_default = 2; // set to anything, ZERO to disable default
	$count = $count == 0?@$_POST['map_next_count'] + 0:$count; 
	$count = $count == 0?$count_default:$count;
	if ($count + 0 == 0) {
	 	return false;
	 } 
	
	$random_sourceid_array[] = 26285; //12284
	$random_sourceid_array[] = 6476; //3630
	$random_sourceid_array[] = 23782; //7960
	$random_sourceid_array[] = 5744; //3059
	$random_sourceid_array[] = 23867; //8271
	$random_sourceid_array[] = 10533; //6632

	$count = count($random_sourceid_array);
	$query = db_select('nodeword_mapped_brad', 'nwmp')
			->fields('nwmp')
			->range(0,$count)
			->condition('nwmp.is_mapped', 0)
			->condition('nwmp.sourceid', $random_sourceid_array, 'IN')
			->orderBy('nwmp.destid')
			;
	$result = $query->execute()->fetchAll();

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
	$pseudo_empty = 'a:1:{s:5:"value";s:0:"";}';
	foreach ($result as $index => $mapping) {

		// $source_array = gather_apt_sourceid($mapping->sourceid);
		$source_these = gather_apt_sourceid($mapping->sourceid);
		// $result[$index]->source_these = $source_these;

		$result[$index]->last_imported = date('Y-m-d H:i:s');
		$result[$index]->count_skip = 0;
		$result[$index]->count_empty = 0;
		$result[$index]->count_write = 0;
		// $result[$index]->source_these = $source_these;
		foreach ($source_these as $src_index => $src_ob) {
			if (in_array($src_ob->name, $apt_nodeword_name_array) === false) {
				$result[$index]->count_skip++;
			}elseif(empty($src_ob->content['value']) == true || $src_ob->content['value'] == $pseudo_empty) {
				$result[$index]->count_empty++;
			}else{
				$result[$index]->count_write++;
				$name = empty($metatag_overload_name_array[$src_ob->name])?$src_ob->name:$metatag_overload_name_array[$src_ob->name];
				$result[$index]->meta_array[$name]['value'] = $src_ob->content['value'];
			}
		}
		if ($result[$index]->count_write > 0) {
			if (1 == 1) {
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
		db_update('nodeword_mapped_brad')
    ->expression('is_mapped', ':is_mapped', array(':is_mapped' => $mapping->is_mapped))
    ->expression('rollback_action', ':rollback_action', array(':rollback_action' => $mapping->rollback_action))
    ->expression('last_imported', ':last_imported', array(':last_imported' => $mapping->last_imported))
    ->condition('sourceid', $mapping->sourceid)
    ->condition('destid', $mapping->destid)
    ->execute()
    ;
		$node_these[$mapping->destid] = $mapping->destid;
	}

		db_update('nodeword_mapped_brad')
    ->expression('is_mapped', ':is_mapped', array(':is_mapped' => $result[$index]->is_mapped))
    ->expression('rollback_action', ':rollback_action', array(':rollback_action' => $result[$index]->rollback_action))
    ->expression('last_imported', ':last_imported', array(':last_imported' => $result[$index]->last_imported))
    ->condition('sourceid', $result[$index]->sourceid)
    ->condition('destid', $result[$index]->destid)
    ->execute()
    ;

	$mapped = $result;

	// $mapped = $node_these;
	// $mapped = node_load_multiple($node_these);
	// unset($mapped);
	// $mapped = $sql;

	$buffer = '';
	$buffer .= '<h4>Function: '. __FUNCTION__ . '()' . $line . '</h4>';
	$buffer .= '<pre>';
	$buffer .= print_r($mapped, true);
	$buffer .= '</pre>';

	return $buffer;
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

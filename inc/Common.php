<?php

//parse xml to array
//parameters:
//	file_name: the name of the xml file
//	index_base: int, usually 0 or 1
//	value_key: the default key string inf the array for the xml value
//			default is null, this will use node name.
//			e.g. <x>this is a value</x>
//				will be converted to Array([value]=>'this is a value') 
//				if $value_key=value.
//				and Array([x]=>'this is a value')
//				if $value_key=null (default)
//precondition:
//1. attribute name should be unique for each node
//2. for each node, attribute name and node name cannot be identical
//3. for each node, attribute name and chile node name cannot be identical
//4. //root is unique
//this function converts xml into array according to following rules:
//1. a node is converted to an array. the count of this array is the
//   number of siblings including itself
//2. attributes are converted to entries of the array
//3. subnodes are treated recursively
//4. node value is treated as attribute of node name
function xml2array($file_name, $index_base=0, $value_key=null) {
	//read file content
	$content=file_get_contents($file_name);
	if (!$content) return array(); 
	
	//init parser and parse
	$parser = xml_parser_create(''); 
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); 
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
    xml_parse_into_struct($parser, trim($content), $xml_values); 
    xml_parser_free($parser); 
	
	if(!$xml_values) return;//file does not contain valid xml

    //initializations 
    $parents = array(); //output xml tree traverse
	
	//iteration......
    foreach($xml_values as $data) { 
		$tag = $data['tag']; //always exists
		
		switch ($data['type']) 	{
		case 'open':
			//create new node
			$current = array();
			//insert attributes
			if (isset($data['attributes'])) { //complete or open
				foreach($data['attributes'] as $attr => $val) { 
					$current[$attr] = $val; 
				} 
			}
			//push
			array_push($parents, $current);
			break;
		case 'close':
			//pop 
			$current = array_pop($parents);
			//add to parrent
			$pnode = array_pop($parents);
			if (isset($pnode[$tag])) { //if sibiling appeared before
				array_push($pnode[$tag], $current);
			} else { //create an array as the child of current write head
				$pnode[$tag] = array($index_base => $current);
			}
			array_push($parents, $pnode);
			break;
		case 'complete':
			//create onode
			$current = array();
			//value
			if (isset($data['value'])) { //complete or cdata
				$__value_key = $tag;
				if ($value_key!=null) $__value_key = $value_key;
				$current[$__value_key] = $data['value'];
			}
			//attributes
			if (isset($data['attributes'])) { //complete or open
				foreach($data['attributes'] as $attr => $val) { 
					$current[$attr] = $val; 
				} 
			}
			//add to parent
			$pnode = array_pop($parents);
			if (isset($pnode[$tag])) { //if sibiling appeared before
				array_push($pnode[$tag], $current);
			} else { //create an array as the child of current write head
				$pnode[$tag] = array($index_base => $current);
			}
			array_push($parents, $pnode);
			break;
		case 'cdata':
			//pop 
			$current = array_pop($parents);
			//value
			if (isset($data['value'])) { //complete or cdata
				$__value_key = $tag;
				if ($value_key!=null) $__value_key = $value_key;
				$current[$__value_key] = $data['value'];
			}
			//push for the close tag...
			array_push($parents, $current);
			break;
		default:
			
		}

	}//foreach $xml_value
	
	
	//debug_print($parents[0]);
	return($parents[0]);
}


//print an object or array for debug information
function debug_print($obj) {
	echo '<pre>';
	print_r($obj);
	echo '</pre>';
}


function getMissionsFromXML() {
	$obj = xml2array('xml/missions.xml', 1);
	return $obj['missions']['1'];
}

function getCardsFromXML() {
	$obj = xml2array('xml/cards.xml', 1);
	return $obj['cards']['1'];
}

function getSkillsFromXML() {
	$obj = xml2array('xml/skills.xml', 1);
	return $obj['skills']['1'];
}

function getBuffsFromXML() {
	$obj = xml2array('xml/buffs.xml', 1);
	return $obj['buffs']['1'];
}




?>
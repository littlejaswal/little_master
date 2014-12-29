<?
function ParseXML($xml) {
	// Gets XML in a string and parses it into an array.
	
	// Create the parser object
	if (!($parser = xml_parser_create())) {
	    DisplayErrorNoticeOfChioce("cannot create parser!");
	    exit();
	}
	
	// if we didn't get the argument then give them an error.
	if ($xml == "") {
	    DisplayErrorNoticeOfChioce("No XML Was found!");
	    exit;
	}
	
	xml_parse_into_struct($parser, trim($xml), $structure, $index);
	xml_parser_free($parser);
	
	// the parsed array will go here.
	$theArgs = array();
	
	// Hack up the XML and put it into the array
	foreach($structure as $s)
	{
	      if ($s["tag"] == "FOUND") {
	           $found = $s['value'];
	      }
	}
	return $found;
	}
?>
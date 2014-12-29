<?
class language
{
	function language()
	{
		global $lang;		
	}
	
	function get_lang_value($page, $type, $language, $item)
	{
		return isset($lang[$language][$page][$type][$item])?$lang[$language][$page][$type][$item]:$item;
	}
};
?>
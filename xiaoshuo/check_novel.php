<?php

require_once 'db/dbinterface.php';

class Novel
{
	private $novelInfo = array();

	function loadNovelInfo()
	{
		$db = new DBInterface();
		$sql = "SELECT * FROM novel";
		$result = $db->sql($sql);
		$num = mysql_num_rows($result);
		while($num && $item = mysql_fetch_assoc($result))
		{
			$novel['url'] = $item['url'];
			$novel['title'] = $item['title'];
			$novel['update_time'] = $item['update_time'];

			$novelInfo[] = $novel;
		}
	}
}

?>
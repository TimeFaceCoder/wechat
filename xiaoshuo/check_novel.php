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
		return $novelInfo;
	}

	function getWebpageByCUrl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_TIMEOUT,30);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function readFromFile($filename)
	{
		$fh = fopen($filename, 'rb');
		$data = fread($fh, 999999);
		return $data;
	}

	function getNovelUpdateTitleTime($webpage)
	{
		$lines = array();
		$lines = preg_split('/\r|\n/', $webpage);

		//step1 找出title
		$matchline = preg_grep("/(headline)/i", $lines);
		//<strong itemprop='headline' >第十五节恐怖的征兆</strong></font></a><span>(更新于
		foreach ($matchline as $line) 
		{
			preg_match('/([\x{4e00}-\x{9fa5}]+){1}/u',$line, $result);
			//print_r($result);
			$title = $result[0];
		}

		//step2 找出更新时间
		//<span itemprop='dateModified' >2013-10-18 22:23</span>)</span>
		$matchline = preg_grep("/('dateModified')/i", $lines);
		print_r($matchline);
		foreach ($matchline as $line) 
		{
			$rule = '/(([1-2][0-9]{3}-)((([1-9])|(0[1-9])|(1[0-2]))-)(([1-9])|(0[1-9])|([1-2][0-9])|(3[0-1])))/';
		//	$rule = '/(([1-2][0-9]{3}-)((([1-9])|(0[1-9])|(1[0-2]))-)((([1-9])|(0[1-9])|([1-2][0-9])|(3[0-1]))))( ((([0-9])|(([0-1][0-9])|(2[0-3]))):(([0-9])|([0-5][0-9]))(:(([0-9])|([0-5][0-9])))?))?/';
			preg_match($rule,$line, $result);
			print_r($result);
		}
		
		
	}

}

$info = new Novel();
//$data = $info->getWebpageByCUrl("http://www.qidian.com/Book/2641978.aspx");
$data = $info->readFromFile('tangzhuan.html');
$info->getNovelUpdateTitleTime($data);
?>
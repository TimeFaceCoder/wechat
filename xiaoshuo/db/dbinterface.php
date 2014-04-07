<?php

class DBInterface
{
	private $config = array(
		'dbuser' => 'root',
		'dbpass' => '',
		'dbdatabases' => 'weixin_db',
		'dbhost' => 'localhost'
		);

	private $dbConf;

	function __construct()
	{
		$dbname = $this->config['dbdatabases'];
		$dbhost = $this->config['dbhost'];
		$dbuser = $this->config['dbuser'];

		$this->dbConf = mysql_connect($dbhost, $dbuser, $dbpass, true);
		if( !$this->dbConf)
		{
			return false;
		}
		if( !mysql_select_db($dbname))
		{
			return fasle;
		}

		function __destruct()
		{
			if($this->dbConf)
			{
				mysql_close($this->dbConf);
			}
		}

		function sql($sql)
		{
			return mysql_query($sql, $this->dbConf);
		}
	}
}

?>
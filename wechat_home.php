<?php

require_once "wechat_svr.php";
require_once "wechat_clt.php";
require_once "wechat_receivestart.php";

$wechatObj = new WeChatServer('tobediffsvenyang1234',
	array(
		'receiveAllStart' => receiveAllStart,
//		'receiveMsg::text' => function($postData){echo $WeChatServer::getXml4Txt("1111")}
	)	
);
?>

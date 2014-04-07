<?php

require_once "wechat_svr.php";
function receiveAllStart($postData)
{
	echo WeChatServer::getXml4Txt("正在处理，稍等");
}

?>

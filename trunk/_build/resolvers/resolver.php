<?php
$modx =& $object->xpdo;
$modx->log(xPDO::LOG_LEVEL_INFO,"Forced Fail of Resolver");
return false;
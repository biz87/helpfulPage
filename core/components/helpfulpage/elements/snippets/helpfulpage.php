<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var helpfulPage $helpfulPage */
$helpfulPage = $modx->getService('helpfulPage', 'helpfulPage', MODX_CORE_PATH . 'components/helpfulpage/model/', $scriptProperties);
if (!$helpfulPage) {
    return 'Could not load helpfulPage class!';
}

$pdo = $modx->getService('pdoTools');

return $pdo->getChunk('tpl.helpfulPage.tpl');

<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var helpfulPage $helpfulPage */
$helpfulPage = $modx->getService('helpfulPage', 'helpfulPage', MODX_CORE_PATH . 'components/helpfulpage/model/', $scriptProperties);
if (!$helpfulPage) {
    return 'Could not load helpfulPage class!';
}

$pdo = $modx->getService('pdoTools');

$modx->regClientScript(MODX_ASSETS_URL.'components/helpfulpage/js/default.js');

$chunk = $modx->getOption('tpl', $scriptProperties, 'tpl.helpfulPageTpl');

return $pdo->getChunk($chunk);

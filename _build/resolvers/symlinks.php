<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/helpfulPage/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/helpfulpage')) {
            $cache->deleteTree(
                $dev . 'assets/components/helpfulpage/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/helpfulpage/', $dev . 'assets/components/helpfulpage');
        }
        if (!is_link($dev . 'core/components/helpfulpage')) {
            $cache->deleteTree(
                $dev . 'core/components/helpfulpage/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/helpfulpage/', $dev . 'core/components/helpfulpage');
        }
    }
}

return true;
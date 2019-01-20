<?php
switch ($modx->event->name) {
    case 'OnHandleRequest':
        if($_GET['action'] == 'test'){
            $modx->log(1, 'test');
            echo 123;
            die();
        }
        break;
}
<?php
switch ($modx->event->name) {
    case 'OnHandleRequest':
        if($_POST['action'] == 'helpfulPageVote'){

            $helpfulPage = $modx->getService('helpfulPage', 'helpfulPage', MODX_CORE_PATH . 'components/helpfulpage/model/', $scriptProperties);
            if (!$helpfulPage) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[helpfulPage] Could not load helpfulPage class!');
                die();
            }

            $resource_id = filter_input(INPUT_POST,'resource_id', FILTER_VALIDATE_INT);
            $vote_action = trim( filter_input(INPUT_POST,'vote_action',  FILTER_SANITIZE_STRING) );
            $response = $helpfulPage->vote($resource_id, $vote_action);
            echo $response;
            die();
        }


        break;
}
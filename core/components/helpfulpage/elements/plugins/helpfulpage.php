<?php
switch ($modx->event->name) {
    case 'OnHandleRequest':
        if($_POST['action'] == 'helpfulPageVote'){
            //Голосование

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

        if($_POST['action'] == 'helpfulPageStat'){
            //Подсчет голосов при загрузке

            $helpfulPage = $modx->getService('helpfulPage', 'helpfulPage', MODX_CORE_PATH . 'components/helpfulpage/model/', $scriptProperties);
            if (!$helpfulPage) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[helpfulPage] Could not load helpfulPage class!');
                die();
            }

            $resource_id = filter_input(INPUT_POST,'resource_id', FILTER_VALIDATE_INT);
            $response = $helpfulPage->getHelpfulness($resource_id);
            echo $response;
            die();
        }

        if($_POST['action'] == 'helpfulPageMessage'){
            //Отправка форм с сообщением

            $helpfulPage = $modx->getService('helpfulPage', 'helpfulPage', MODX_CORE_PATH . 'components/helpfulpage/model/', $scriptProperties);
            if (!$helpfulPage) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[helpfulPage] Could not load helpfulPage class!');
                die();
            }

            $resource_id = filter_input(INPUT_POST,'resource_id', FILTER_VALIDATE_INT);
            $message = filter_input(INPUT_POST,'message', FILTER_SANITIZE_STRING);
            $emailTpl = $modx->getOption('helpfulpage_email_tpl', null, 'tpl.helpfulPageEmailTpl');
            if(!empty($resource_id) && !empty($message)){
                $response = $helpfulPage->prepareEmail($resource_id, $message, $emailTpl);
                echo $response;
                die();
            }

        }


        break;
}
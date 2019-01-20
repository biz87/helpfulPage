<?php

class helpfulPage
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $corePath = MODX_CORE_PATH . 'components/helpfulpage/';
        $assetsUrl = MODX_ASSETS_URL . 'components/helpfulpage/';

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        $this->modx->addPackage('helpfulpage', $this->config['modelPath']);
        $this->modx->lexicon->load('helpfulpage:default');
    }

    function vote($resource_id = 0, $action = '')
    {

        if(empty($action)){
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[helpFulPage] vote empty action');
            return;
        }

        if(intval($resource_id) == 0  || !$page = $this->modx->getObject('modResource', array('id' => $resource_id))){
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[helpFulPage] vore incorrect or empty resource_id '.$resource_id);
            return;
        }

        $ses_id = $_COOKIE['PHPSESSID'];
        $user_id = $this->modx->user->get('id');
        $user_ip = $_SERVER['REMOTE_ADDR'];

        if($user_id > 0){
            $vote = $this->modx->getObject('helpfulPageVote', array('user_id' => $user_id, 'resource_id' => $resource_id));
        }else{
            $vote = $this->modx->getObject('helpfulPageVote', array('user_ip' => $user_ip, 'user_ses_id' => $ses_id, 'resource_id' => $resource_id));
        }


        if(!$vote){
            switch($action){
                case 'vote_for':
                    $response = $this->process_vote($resource_id, $user_id, 1, $user_ip, $ses_id);
                    if($response['success']){
                        $data = [];
                        $data['helpfullness'] = $this->getHelpfulness($resource_id);
                        $data['message'] = 'Ваш голос учтен';
                        $data['success'] = true;
                        return json_encode($data);
                    }
                    break;
                case 'vote_aganist':
                    $response = $this->process_vote($resource_id, $user_id, -1, $user_ip, $ses_id);
                    if($response['success']){
                        $data = [];
                        $data['helpfullness'] = $this->getHelpfulness($resource_id);
                        $data['message'] = 'Ваш голос учтен';
                        $data['success'] = true;
                        return json_encode($data);
                    }
                    break;
            }
        }else{
            $data = [];
            $data['message'] = 'Вы уже голосовали';
            $data['success'] = false;
            return json_encode($data);
        }

    }

    private function process_vote($resource_id, $user_id, $vote, $user_ip, $ses_id)
    {
        //  Голосую
        $voteObj = $this->modx->newObject('helpfulPageVote');
        $voteObj->fromArray(array(
            'resource_id' => intval($resource_id),
            'user_id' => intval($user_id),
            'vote' => $vote,
            'user_ip' => $user_ip,
            'user_ses_id' => $ses_id
        ));
        if($voteObj->save()){
            // Записываю количество положительных голосов в итоговую таблицу поста
//            $q = $this->modx->newQuery('helpfulPageVote', array(
//                'resource_id' => intval($resource_id),
//                'vote' => $vote
//            ));
//            $q->select(array(
//                "count(*) as count"
//            ));
//            $s = $q->prepare();
//            $s->execute();
//            $rows = $s->fetchAll(PDO::FETCH_ASSOC);
//            $count = $rows[0]['count'];


            $data = [];
            //$data['count'] = $count;
            $data['success'] = true;
            return $data;
        }
    }

    private function getHelpfulness($resource_id)
    {
        $q = $this->modx->newQuery('helpfulPageVote', array(
            'resource_id' => intval($resource_id),
        ));
        $q->select(array(
            "count(*) as count"
        ));
        $s = $q->prepare();
        $s->execute();
        $rows = $s->fetchAll(PDO::FETCH_ASSOC);
        $totalCount = $rows[0]['count'];


        $q = $this->modx->newQuery('helpfulPageVote', array(
            'resource_id' => intval($resource_id),
            'vote' => 1
        ));
        $q->select(array(
            "count(*) as count"
        ));
        $s = $q->prepare();
        $s->execute();
        $rows = $s->fetchAll(PDO::FETCH_ASSOC);
        $positiveCount = $rows[0]['count'];

        $helpfulness = ceil($positiveCount * 100 / $totalCount);
        if($helpfulness < 0){
            return 0;
        }
        return $helpfulness;

    }

}
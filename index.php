<?php
/**
 * https://developers.google.com/apis-explorer/#p/youtube/v3/
 * https://developers.google.com/youtube/v3/
 * https://console.developers.google.com
 */

ini_set('max_execution_time', 60*15);
require_once 'autoload.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'libs/google-api/src');
require_once 'Google/autoload.php';


$view = new stdClass();

try{
    DB::connect();

    $y = new YoutubeFinder();

    $singers = DataManager::getAllSingers();

    foreach ($singers as $singer) {
        $videos = $y->findVideoByTitle($singer['name']);
        DataManager::addClipsForSinger($singer['id'], $videos);
    }unset($singer);

    $viewCount = array();
    $clips = DataManager::getAllClips();
    foreach($clips as $clip){
        $viewCount[$clip['id']] = $y->getViewCountForVideo($clip['youtube_id']);
    }unset($clip);

    DataManager::updateViewCount($viewCount);
    $view->data = DataManager::getClipsBySinger();

    DB::disconnect();
    include('index.tpl');
}catch (\Exception $e){
    exit ($e->getMessage());
}


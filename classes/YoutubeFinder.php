<?php
class YoutubeFinder
{
    /**
     * @var YoutubeAPI $youtube
     */
    private $youtube;

    public function __construct(){
        $youtubeAPI = new YoutubeAPI(Config::DEVELOPER_KEY);
        $this->youtube = $youtubeAPI->getYoutubeProvider();
    }

    public function findVideoByTitle($videoCaption, $maxResults = 5){
        $searchResponse = $this->youtube->search->listSearch('snippet', array(
            'q' => $videoCaption,
            'type' => 'video',
            'videoCaption' => 'closedCaption',
            'maxResults' => $maxResults,
        ));

        $videos = array();
        foreach ($searchResponse['items'] as $searchResult) {
            switch ($searchResult['id']['kind']) {
                case 'youtube#video':
                    $tmp = array();
                    $tmp['id'] = $searchResult['id']['videoId'];
                    $tmp['title'] = $searchResult['snippet']['title'];
                    $videos[] = $tmp;
                    unset($tmp);
                    break;
                default:
                    break;
            }
        }
        return $videos;
    }


    public function getViewCountForVideo($youtube_id){
        $searchResponse = $this->youtube->videos->listVideos('statistics',array('id'=>$youtube_id));
        return $searchResponse['items'][0]['statistics']['viewCount'];
    }

}
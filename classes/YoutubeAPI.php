<?php

class YoutubeAPI{

    /**
     * @var Google_Client $client
     */
    private $client;
    /**
     * @var Google_Service_YouTube $youtube;
     */
    private $youtube = null;

    public function __construct($developerKey){
        $this->client = new Google_Client();
        $this->client->setDeveloperKey($developerKey);
    }

    public function getYoutubeProvider(){
        if(is_null($this->youtube)){
            $this->youtube = new Google_Service_YouTube($this->client);
        }
        return $this->youtube;
    }


}
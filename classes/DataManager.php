<?php


class DataManager
{
    static public function getAllSingers(){
        return DB::select('select `id`, `name` from `singers`');
    }

    static public function getAllClips(){
        return DB::select('select
                                `id`,
                                `youtube_id`,
                                `singer_id`,
                                `name`,
                                `view_count`
                            from
                               `clips`'
        );
    }


    static public function removeClipsForSinger($id){
        return DB::query('delete from `clips` where `singer_id` = '.intval($id));
    }

    static public function addClipsForSinger($id, $videos){
        // todo Check if singer exist
        // todo Singer is better to be an instance
        $id = intval($id);
        if(!$id || !$videos){
            return false;
        }


        $res = array();
        foreach($videos as $video){
            $res[] = '('.DB::escape_string($video['id']).','.intval($id).','.DB::escape_string($video['title']).')';
        }unset($video);


        $deleteQuery = 'delete from `clips` where `singer_id` = '.$id;
        $query = 'insert into `clips` (`youtube_id`, `singer_id`, `name`) values '.implode(',',$res);

        DB::query($deleteQuery);
        DB::query($query);
        return DB::affectedRows();


    }


    static public function updateViewCount(array $viewCount){
        if(!$viewCount){
            return 0;
        }
        $query = 'update `clips` set `view_count` =  case ';
        foreach ($viewCount as $clip_id => $view_count) {
            $query .= ' when `id` = '.intval($clip_id).' then ' . intval($view_count);
        }unset($clip_id, $view_count);
        $query .= ' end';
        DB::query($query);
        return DB::affectedRows();

    }


    static public function getClipsBySinger(){
        $clips = DB::select('
                    select
                    `c`.`youtube_id`,
                    `c`.`singer_id`,
                    `s`.`name` `singer_name`,
                    `c`.`name` `clip_name`,
                    `c`.`view_count`
                    from `clips` c
                    inner join
                    `singers` `s`
                    on `s`.`id` = `c`.`singer_id`
        ');

        uasort($clips, function($a, $b){
            $v1 = $a['view_count'];
            $v2 = $b['view_count'];
            if($v1 > $v2) return -1;
            if($v1 < $v2) return 1;
            return 0;
        });

        $data = array();
        foreach($clips as $clip){



            $data[$clip['singer_id']][] = $clip;

        }unset($clip);

        return $data;
    }

}
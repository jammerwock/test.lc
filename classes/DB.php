<?php

class DB
{
    private static $link = null;

    static public function connect(){
        if(!self::$link){
            self::$link = mysqli_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_DATABASE);
            if(!self::$link){
                throw new \Exception('Connection error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }
    }

    static public function query($query){
        if(!self::$link){
            self::connect();
        }
        $res = mysqli_query(self::$link, $query);
        if(mysqli_connect_errno()){
            throw new \Exception(mysqli_error(self::$link));
        }
        return $res;
    }

    static public function select($query){
        $result = self::query($query);
        $rows = array();
        if ($result && (mysqli_num_rows( $result) > 0) ) {
            while ( $rows[] = mysqli_fetch_assoc( $result) ) {}
        }
        array_pop( $rows );
        return $rows;
    }

    static public function disconnect(){
        if(self::$link){
            mysqli_close(self::$link);
            self::$link = null;
        }
    }

    static public function escape_string($val){
        if(!self::$link){
            self::connect();
        }
        return "'".mysqli_real_escape_string(self::$link, $val)."'";
    }

    static public function affectedRows(){
        if(!self::$link){
            return 0;
        }
        return mysqli_affected_rows(self::$link);
    }
}
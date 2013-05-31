<?php


class facebook{
    
    
    
    public static function details($id, $url, $parse){
        Video::$cUrl = true;
        $token = '?access_token=AAAAAAITEghMBAPZCTCMQL96uBG5RRjhDe0ZAMf6wcGRYP0JJRAbjpMXTDKehhjL0f1hrxnUibZBad9NkLZCJxFdTDqV0RPK7jOW9BIf7dwZDZD';
        //https://graph.facebook.com/817129783203?access_token=AAAAAAITEghMBAPZCTCMQL96uBG5RRjhDe0ZAMf6wcGRYP0JJRAbjpMXTDKehhjL0f1hrxnUibZBad9NkLZCJxFdTDqV0RPK7jOW9BIf7dwZDZD
        $url = 'https://graph.facebook.com/' . $id . $token;
        pr($url);
        //pr(Video::getContents($url));
        
        
        return array();
    }
    
}
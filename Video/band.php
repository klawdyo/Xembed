<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 16/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos do site da Band

*/
class band{
    
    /**
      * Pega os dados do vídeo do site Band
      *
      * @version
      *     0.1 16/09/2012 Initial
      */
    public static function details($id, $url){
        $data = Video::getContents($url);
        pr($data);
        #image
        //http://thumb.mais.uol.com.br/14471367-large.jpg?ver=2
        
        #title
        //og:title
        
        #player
        //'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id,
        return array();
        return array(
            'title' => $data['title'],
            'image' => 'http://thumb.mais.uol.com.br/' . $id . '-large.jpg?ver=2',
            'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id,
            'playerType' => 'iframe',
        );
    }
}
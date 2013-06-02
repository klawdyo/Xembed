<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 02/06/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos adicionados no Funny or Die

*/
class funnyordie{
    
    
    /**
      * Pega os dados de vídeos adicionados no Funny or Die
        
      * @version
      *     0.1 02/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        $data = Video::oEmbed('funnyordie', $url);
        
        return array(
            'title' => $data->title,
            'image' =>  $data->thumbnail_url,
            'player' => 'http://www.funnyordie.com/embed/' . $id,
            'playerType' => 'iframe',
        );
    }
}
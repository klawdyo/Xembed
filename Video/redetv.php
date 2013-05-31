<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.2 07/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos RedeTV

*/
class redetv{
    
    
    /**
      * Pega os dados do vídeo do site RedeTV
      *
      * @version
      *     0.1 07/09/2012 Initial
      *     0.2 15/09/2012 Agora forçando o uso do cURL
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = true;
        $return = Video::openGraph($url);
        
        return array_merge(
            $return,
            array(
                  'playerType' => 'iframe',
                  'player' => 'http://www.redetv.com.br/embed/' . $id,
            )
        );
    }
}
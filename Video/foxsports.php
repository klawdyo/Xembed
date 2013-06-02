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
    Retorna os dados do site de vídeos FOX Sports

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------

*/
class foxsports{
    
    /**
      * Pega os dados do vídeo do site FOX Sports
      * 
      * @version
      *     0.1 16/09/2012 Initial
      */
    public static function details($id, $url){
        $return = Video::openGraph($url);
        
        return array_merge( $return , array('playerType' => 'iframe') );
    }
}
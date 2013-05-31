<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 15/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Videolog.tv

*/
class videolog{
    
    
    /**
      * Pega os dados do vídeo do site Videolog.tv
      * 
      * @version
      *     0.1 15/09/2012 Initial
      */
    public static function details($id, $url, $parse){
        $return = Video::openGraph($url);
        
        return array_merge( $return , array('playerType' => 'iframe') );
    }
}
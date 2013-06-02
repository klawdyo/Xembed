<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.3 06/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos MSN Video

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------

*/
class msnvideo{
    
    
    /**
      * Pega os dados do vídeo do site MSN Video Brasil
      * msnvideo() é o primeiro dos métodos da classe Video que usa exclusivamente
      * o openGraph().
      * 
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.3 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      */
    public static function details($id, $url){
        $return = Video::openGraph($url);
        
        return array_merge( $return , array('playerType' => 'iframe') );
    }
}
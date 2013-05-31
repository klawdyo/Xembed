<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.3 27/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos IG.
*/
class ig{
    
    
    /**
      * Pega os dados do vídeo do site iG
      * 
      * @version
      *     0.1 05/09/2012 Initial
      *     0.2 06/09/2012 iG agora retorna um script JS que carrega o vídeo.
      *         A página precisa ter um elemento <body> para que o vídeo seja
      *         exibido
      *     0.3 27/05/2013 iG agora retorna o player em formato iframe
      */
    public static function details($id, $url, $parse){
        
        $return = array_merge(
            Video::openGraph($url),
            array(
                'player' => 'http://tvig.ig.com.br/_static/player/?v=' . $id,
                'playerType' => 'iframe'
            )
        );
        
        return $return;
    }
}
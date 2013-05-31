<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.4 27/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Esporte Interativo

*/
class esporteinterativo{
    
    /** 
      * Pega os dados do vídeo do site Esporte Interativo
      * 
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 15/09/2012 Aparentemente o site estava recusando as conexões
      *         mas esse problema foi consertado ao forçar o uso do cURL
      *     0.3 15/09/2012 Não estava retornando a chave 'playerType'
      *     0.4 27/05/2013 Modificado a url do player.
      */
    public static function details($id, $url){
        Video::$cUrl = true;
        
        $return = Video::openGraph($url);
        
        //http://br.esporteinterativo.yahoo.com/video/neymar-n%C3%BAmeros-veja-fez-craque-175851353.html
        //http://movies.yahoo.com/video/neymar-n%C3%BAmeros-veja-fez-craque-175851353.html?format=embed&player_autoplay=false
        
        return array_merge( $return , array(
            'player'=>'http://movies.yahoo.com/video/' . $id . '.html?format=embed&player_autoplay=false',
            'playerType' => 'iframe',
            'playerUrl' => $url . '?format=embed&player_autoplay=false'
        ));
    }
}
<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.2 128/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Wordpress.TV

*/
class wordpresstv{
    
    
    /**
      * Pega os dados do vídeo do Wordpress.TV
      * Mais informações em http://developer.wordpress.com/docs/oembed-provider-api/
      *
      * @example http://wordpress.tv/2012/09/09/kirk-wight-getting-started-with-theme-development/
      * @version
      *     0.1 15/09/2012 Initial
      *     0.2 28/05/2013 Retirado oEmbed, pois não estava retornando nem a imagem, nem
      *         o link para o vídeo
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = true;
        //Forçando a existência da barra final
        $url = trim($url, '/') . '/';
        
        $data = Video::openGraph($url);
        //pr($data);
        
        return array_merge($data, array('playerType' => 'iframe') );
    }
}
<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.6 06/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Vimeo

*/
class vimeo{
    
    
    /**
      * Pega os dados do vídeo do site Vimeo
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.3 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.4 05/09/2012 file_get_contents() substituído por Video::getContents()
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.6 06/09/2012 a chave 'html' foi removida
      *
      * @todo Usar oEmbed: $oembed = 'http://vimeo.com/api/oembed.xml?url=$1&format=json';
      */
    public static function details($id, $url){
        //$data = unserialize(file_get_contents("http://vimeo.com/api/v2/video/". $id . ".php"));
        $data = unserialize(Video::getContents("http://vimeo.com/api/v2/video/". $id . ".php"));
        
        return array(
            'title' => $data[0]['title'],
            'image' => $data[0]['thumbnail_large'],
            'playerType' => 'iframe',
            'player' => 'http://player.vimeo.com/video/' . $id,
        ); 
    }
}
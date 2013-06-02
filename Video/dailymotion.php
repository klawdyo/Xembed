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
    Retorna os dados do site de vídeos Dailymotion

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://www.dailymotion.com/video/xtlt9n_kate-middleton-pillada-en-topless_people
                                     [    ID DO VÍDEO                              ]
*/
class dailymotion{
    
    
    /**
      * Pega os dados do vídeo do site Dailymotion
      * Mais informações em http://www.dailymotion.com/doc/api/oembed.html#oembed
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 25/08/2012 Usando o oEmbed
      *     0.3 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.4 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.6 06/09/2012 a chave 'html' foi removida
      */
    public static function details($id, $url){
        $data = Video::oEmbed('dailymotion', $url);
        
        return array(
            'title' => $data->title,
            'image' => $data->thumbnail_url,
            'player' => 'http://dailymotion.com/embed/video/' . $id,
            'playerType' => 'iframe',
        );
    }
}
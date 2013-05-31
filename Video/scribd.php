<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.5 06/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site Scribd

*/
class scribd{
    
    
    /**
      * Pega os dados dos documentos do site scribd
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.3 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.4 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.5 06/09/2012 a chave 'html' foi removida
      */
    public static function details($id, $url){
        $data = Video::oEmbed('scribd', $url);
        
        return array(
            'title' => $data->title,
            'image' => $data->thumbnail_url,
            'playerType' => 'iframe',
            'player' => 'http://www.scribd.com/embeds/'. $id .'/content',
        );
    }
}
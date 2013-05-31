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
    Retorna os dados do site de vídeos Youtube

*/
class youtube{
    
    
    /**
      * Pega os dados do vídeo do site Youtube
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 25/08/2012 Usando oEmbed
      *     0.3 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.4 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.6 06/09/2012 a chave 'html' foi removida
      *     0.7 16/09/2012 Por padrão, agora todas as URLs usadas no oEmbed são
      *         codificadas com urlencode(), mas Youtube em sua url reduzida
      *         retorna erro 404 se houver algum parãmetro adicional, portanto,
      *         ao contrário dos outros sites, Youtube não terá suas urls
      *         codificadas.
      */
    public static function details($id, $url){
        $data = Video::oEmbed('youtube', $url, false);
        
        return array(
            'title' => $data->title,
            'image' => $data->thumbnail_url,
            'playerType' => 'iframe',
            'player' => 'http://www.youtube.com/embed/' . $id . '?fs=1&feature=oembed',
        );
    }
}
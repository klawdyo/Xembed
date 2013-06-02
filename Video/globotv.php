<?php
require 'Lib/Inflector.php';
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.5 06/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos GloboTV

*/
class globotv{
    
    
    /**
      * Pega os dados do vídeo do site Globo TV
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 25/08/2012 Usando a própria URL do vídeo para gerar o título
      *     0.3 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.4 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      */
    
    public function details($id, $url){
        preg_match('%/(?<title>[a-z0-9-]+)/([0-9]+)/?$%', $url, $out);
        
        $title = array_key_exists('title', $out) ? Inflector::humanize($out['title']) : null;
        
        return array(
            'title' => $title,
            'image' => 'http://s04.video.glbimg.com/320x200/' . $id . '.jpg',
            'playerType' => 'iframe',
            'player' => 'http://s.videos.globo.com/p2/player.swf?videosIDs=' . $id,
        );
    }
}
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
    Retorna os dados do site de vídeos UOL Mais

*/
class uolmais{
    
    
    /**
      * Pega os dados do vídeo do site Mais UOL
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 25/08/2012 Usando o elemento <title> da página
      *         para pegar o nome do vídeo
      *     0.3 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.4 05/09/2012 maisuol() renomado para uolmais()
      *     0.5 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.6 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      */
    public static function details($id, $url){
        $html = Video::getContents($url);
        //$html = Filesystem::read('e.txt');
        preg_match('%<title>(?<title>.*)</title>%', $html, $out);
        //pr($out);
        
        return array(
            'title' => $out['title'],
            'image' => 'http://thumb.mais.uol.com.br/' . $id . '-thb0-large.jpg?ver=0',
            'playerType' => 'iframe',
            'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id,
        );
    }
}
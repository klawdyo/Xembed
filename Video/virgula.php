<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.7 27/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Vírgula

*/
class virgula{
    
    
    /**
      * Pega os dados dos vídeos do portal Vírgula
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.3 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.4 05/09/2012 O método estava retornando a chave 'imagem' ao invés
      *         de 'image'
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.6 06/09/2012 a chave 'html' foi removida
      *     0.7 27/05/2013 oEmbed removido do site, além de modificações nas urls
      */
    public static function details($id, $url){
        //$data = Video::oEmbed('virgula', $url);
        #player
        //http://player.mais.uol.com.br/embed_v2.swf?mediaId=14467675&tv=0
        #id
        //<div class="player_uolmais" id="video_14430359" data-thumbnail="">
        #title
        //<h4 class="box-default-title">Trailer de O Diário de Tati</h4>
        //<title>Trailer de O Diário de Tati - TVirgula - Portal Vírgula</title>
        #image
        //http://thumb.mais.uol.com.br/14430359-thb0-large.jpg?ver=0

        $html = Video::getContents($url);
        preg_match('%<title>(?<title>.*) - TVirgula - Portal Vírgula</title>%', $html, $out);
        preg_match('%<div class="player_uolmais" id="video_(?<id>[0-9]+)" data-thumbnail="">%', $html, $out2);
        //pr($out);
        
        return array(
            'title' => $out['title'],
            'image' => 'http://thumb.mais.uol.com.br/' . $out2['id'] . '.jpg',
            //'image' => 'http://thumb.mais.uol.com.br/' . $out2['id'] . '-thb0-large.jpg?ver=0',
            'playerType' => 'iframe',
            'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $out2['id'],
        );


    }
}
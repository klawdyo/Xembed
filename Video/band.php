<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.3 02/06/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos do site da Band

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://esporte.band.uol.com.br/futebol/selecao/copa-das-confederacoes/2013/videos.asp?id=[ID]&t=filipe-luis-se-apresenta-e-diz-quebraria-cara-pela-selecao
    http://videos.band.uol.com.br/programa.asp?e=esporte&pr=os-donos-da-bola&v=[ID]

*/
class band{
    
    /**
      * Pega os dados do vídeo do site Band
      *
      * @version
      *     0.1 16/09/2012 Initial
      *     0.2 28/05/2013 Band agora usando os vídeos do UOL
      *     0.2 02/06/2013 Modificada a forma de adquirir o html, pegando somente
      *         o necessário com o método Video::getContents
      */
    public static function details($id, $url){
        $data = Video::openGraph(null, Video::getContents($url, 2048));
        
        return array(
            'title' => $data['title'],
            'image' => 'http://thumb.mais.uol.com.br/' . $id . '-large.jpg?ver=2',
            'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id,
            'playerType' => 'iframe',
        );
    }
}
<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.5 27/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos ESPN Brasil

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://www.espn.com.br/video/331885_relembre-golacos-e-grandes-momentos-de-neymar-com-a-camisa-do-santos
    http://espn.com.br/video/276730_campea-do-strikeforce-musa-ronda-rousey-posou-nua-para-a-revista-espn-nos-estados-unidos

*/
class espnbrasil{
    
    
    /**
      * Pega os dados dos vídeos do site ESPN Brasil
      *
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 01/09/2012 Consertado erro na url do player
      *     0.3 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.4 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.5 27/05/2013 'player' não utiliza mais o link do "estadao"
      */
    public static function details($id, $url){
        $data = Video::openGraph($url);
        
        return array(
            'title' => $data['title'],
            'image' => $data['image'],
            'playerType' => 'iframe',
            'player' => 'http://espn.com.br/swf/main.swf?contentId=' . $id . '&widthImage=622&widthThumb=131',
        );
    }
}
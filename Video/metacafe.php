<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.7 06/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos Metacafe

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------

*/
class metacafe{
    
    
    /**
      * Pega os dados do vídeo do site Metacafe
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
      *     0.6 06/09/2012 Usando openGraph()
      *     0.7 06/09/2012 A chave 'player' não estava retornando a url do vídeo
      *         corretamente
      */
    public static function details($id, $url, $parse){
        $return = Video::openGraph($url);
        
        return array_merge(
            $return,
            array(
                  'playerType' => 'iframe',
                  //http://www.metacafe.com/fplayer/8993220/dance_central_3_story_mode_interview_with_lead_designer_matt_boch_destructoid_dlc.swf
                  'player' => trim(str_replace('/watch/', '/fplayer/', $return['player']), '/') . '.swf',
            )
        );
    }
}
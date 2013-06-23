<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 23/06/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos adicionados no TVInfo
    http://info.abril.com.br/multimidia/tv/

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://info.abril.com.br/tvinfo-novo/infolab/acessorios/teclado-razer-oferece-conforto-gamers-c4df9b5e08569310c49fec0a365d8866.shtml
    http://info.abril.com.br/tvinfo-novo/infolab/som-video/micro-system-vocacao-dock-avancada-5774531d2682f6cde5ac80411e486fda.shtml
    http://info.abril.com.br/tvinfo-novo/[canal]/[subcanal]/[titulo]-[id].shtml
*/
class tvinfo{
    
    /**
      * Pega os dados de vídeos adicionados no TVInfo
        
      * @version
      *     0.1 23/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = true;
        
        $data = Video::openGraph($url);
        
        return array(
            'title' => $data['title'],
            'image' =>  $data['image'],
            'player' => 'http://videos.abril.com.br/info/id/' . $id, //http://videos.abril.com.br/info/id/5774531d2682f6cde5ac80411e486fda
            'playerType' => 'iframe',
        );
    }
}
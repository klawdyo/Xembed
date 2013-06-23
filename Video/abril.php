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
    Retorna os dados dos vídeos adicionados no site da Editora Abril
    

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://veja.abril.com.br/multimidia/video/confira-os-gols-da-partida-brasil-x-italia-na-arena-fonte-nova
    http://veja.abril.com.br/multimidia/video/[titulo]
    http://exame.abril.com.br/videos/direto-da-bolsa/parana-suspende-aumento-da-energia-e-leva-incerteza-a-bolsa
    
    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------
    Adicionar:
        4rodas
    OK  exame
        playboy
*/
class abril{
    
    /**
      * Pega os dados de vídeos adicionados no site da Editora Abril
        
      * @version
      *     0.1 23/06/2013 Initial
      *     0.2 23/06/2013 Métodos separados para adicionar suporte aos vários sites
      *         da Editora Abril. Nesta versão, somente as revistas Veja e Exame
      *         são suportadas
      */
    public static function details($id, $url, $parse){
        if(in_array($parse['site'], array('veja','exame', 'quatrorodas'))){
            return self::$parse['site']($id, $url, $parse);
        }
    }
    
    //23/06/13
    //Suporte para os links do padrão:
    //http://veja.abril.com.br/multimidia/video/confira-os-gols-da-partida-brasil-x-italia-na-arena-fonte-nova
    public static function veja($id, $url, $parse){
        $data = Video::getContents($url, 2048);
        $id = regex('%<meta content="http://videos.abril.com.br/[a-z-]+/(?<id>[a-z0-9]+)/thumb" name="preview"%', $data, 'id');
        $title = regex('%<meta content="(?<title>[^"]+)" name="titulo"%', $data, 'title');
        
        return array(
            'title' => $title,
            'image' =>  'http://videos.abril.com.br/' . $parse['site'] . '/' . $id . '/thumb', //http://videos.abril.com.br/veja/45d76c1de4dabd8c533fc30f4df6d028/thumb
            'player' => 'http://videos.abril.com.br/' . $parse['site'] . '/id/' . $id, //http://videos.abril.com.br/veja/id/5774531d2682f6cde5ac80411e486fda
            'playerType' => 'iframe',
        );
    }
    
    //23/06/2013
    //Suporte para os links do padrão:
    //http://exame.abril.com.br/videos/direto-da-bolsa/parana-suspende-aumento-da-energia-e-leva-incerteza-a-bolsa
    public static function exame($id, $url, $parse){
        $data = Video::getContents($url);
        $details = Video::openGraph(null, $data);
        $player = regex('%<meta itemprop="embedURL" content="(?<player>http://videos.abril.com.br/exame/id/(?<id>[a-f0-9]+))"%', $data, 'player');
        
        return array(
            'title' => $details['title'],
            'image' =>  $details['image'],
            'player' => $player,
            'playerType' => 'iframe',
        );
    }
    
    //23/06/2013
    //Suporte para os links do padrão:
    //http://quatrorodas.abril.com.br/qr-tv/carros/land-rover-freelander-2-2013-5390628a13be42e886b3ca47008d01bf.shtml
    public static function quatrorodas($id, $url, $parse){
        Video::$cUrl = true;
        $content = Video::getContents($url, 2048);
        $data = Video::openGraph(null, $content);
        
        return array(
            'title' => $data['title'],
            'image' =>  'http://videos.abril.com.br/' . $parse['site'] . '/' . $id . '/thumb', //http://videos.abril.com.br/veja/45d76c1de4dabd8c533fc30f4df6d028/thumb
            'player' => 'http://videos.abril.com.br/' . $parse['site'] . '/id/' . $id, //http://videos.abril.com.br/veja/id/5774531d2682f6cde5ac80411e486fda
            'playerType' => 'iframe',
        );
   }
    
}
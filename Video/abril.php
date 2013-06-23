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
        exame
        playboy
*/
class abril{
    
    /**
      * Pega os dados de vídeos adicionados no site da Editora Abril
        
      * @version
      *     0.1 23/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        $data = Video::getContents($url, 2048);
        //<meta content="http://videos.abril.com.br/veja/45d76c1de4dabd8c533fc30f4df6d028/thumb" name="preview" />
        //<meta content="Confira os gols da partida Brasil x Itália na Arena Fonte Nova" name="titulo" />
        //http://videos.abril.com.br/veja/id/45d76c1de4dabd8c533fc30f4df6d028
        
        $id = regex('%<meta content="http://videos.abril.com.br/[a-z-]+/(?<id>[a-z0-9]+)/thumb" name="preview"%', $data, 'id');
        $title = regex('%<meta content="(?<title>[^"]+)" name="titulo"%', $data, 'title');
        
        return array(
            'title' => $title,
            'image' =>  'http://videos.abril.com.br/' . $parse['site'] . '/' . $id . '/thumb', //http://videos.abril.com.br/veja/45d76c1de4dabd8c533fc30f4df6d028/thumb
            'player' => 'http://videos.abril.com.br/' . $parse['site'] . '/id/' . $id, //http://videos.abril.com.br/veja/id/5774531d2682f6cde5ac80411e486fda
            'playerType' => 'iframe',
        );
    }
}
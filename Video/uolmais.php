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
        $html = Video::getContents($url, 2048);
        /*
        //V.1 O mesmo site tem 2 versões de HTML. Nesta versão 1, não existe
        //suporte a openGraph, tornando-se necessário pegar a url da imagem a
        //partir do título da página
        $title = regex('%<title>(?<title>.*)</title>%', $html, 'title');
        
        //Ainda na V.1, preparamos o array com o retorno dos dados
        $return = array(
            'title' => $title,
            'image' => 'http://thumb.mais.uol.com.br/' . $id . '-thb0-large.jpg?ver=0',
            'playerType' => 'iframe',
        );
        
        //Analisando agora a V.2, 
        $og = Video::openGraph(null, $html);
        
        if(isset($og['title'])){ //v.2 O mesmo site tem 2 versões: uma que contém o openGraph e outra sem o openGraph.
            $return['title'] = $og['title'];
            $return['image'] = $og['image'];
            
            //Achando o ID na imagem: http://thumb.mais.uol.com.br/14476792.jpg
            $id = regex('%http://thumb.mais.uol.com.br/(?<id>[0-9]+).jpg%', $og['image'], 'id');
        }
        $return['player'] = 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id;
        /**/
        
        $title = regex('%<title>(?<title>.*)</title>%', $html, 'title');
        
        //<link rel="image_src" href="http://thumb.mais.uol.com.br/14476792-medium.jpg?ver=0" />
        //<link rel="image_src" href="http://thumb.mais.uol.com.br/13228999-medium.jpg?ver=0" />
        $image = regex('%<link rel="image_src" href="(?<image>.*?/(?<id>[0-9]+)\-medium\.jpg\?ver=0)" />%', $html);
        
        //pr($title);
        //pr($image);
        
        $return = array(
            'image' => $image['image'],
            'title' => $title,
            'playerType' => 'iframe',
            //'player' => 'http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=' . $id
            'player' => 'http://player.mais.uol.com.br/player_video_v3.swf?mediaId=' . $image['id'] . '&tv=1',
        );
        return $return;
    }
}
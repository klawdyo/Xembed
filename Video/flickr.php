<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 06/10/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados de uma galeria de fotos do Flickr

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://www.flickr.com/photos/shadowplay/sets/59801/
*/
class flickr{
    
    
    /**
      * Pega os dados de uma galeria de fotos do Flickr
        http://www.flickr.com/photos/klawdyo/sets/72157618525048702/
        http://www.flickr.com/photos/shadowplay/sets/59801/
        
        //Exemplo de Object
        <object width="400" height="300">
            <param name="flashvars" value="offsite=true&lang=pt-br&page_show_url=%2Fphotos%2Fklawdyo%2Fsets%2F72157618525048702%2Fshow%2F&page_show_back_url=%2Fphotos%2Fklawdyo%2Fsets%2F72157618525048702%2F&set_id=72157618525048702&jump_to="></param>
            <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=121572"></param>
            <param name="allowFullScreen" value="true"></param>
            <embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=121572" allowFullScreen="true" flashvars="offsite=true&lang=pt-br&page_show_url=%2Fphotos%2Fklawdyo%2Fsets%2F72157618525048702%2Fshow%2F&page_show_back_url=%2Fphotos%2Fklawdyo%2Fsets%2F72157618525048702%2F&set_id=72157618525048702&jump_to=" width="400" height="300"></embed>
        </object>
      
      * @version
      *     0.1 06/10/2012 Initial
      */
    public static function details($id, $url, $parse){
        //Força o uso da barra final
        $url = trim($url, '/') . '/';
        
        //Força o uso do cURL. Aparentemente quando o cURL não é usado
        //e mais de 1 álbum é carregado, o flickr devolve um erro 404
        Video::$cUrl = true;
        
        //Variáveis usadas para carregar o objeto
        $flashVars = array(
            'offsite' => 'true',
            'lang' => 'pt-br',
            'page_show_url' => '/photos/' . $parse['user'] . '/sets/' . $id . '/show/',
            'page_show_back_url' => '/photos/' . $parse['user'] . '/sets/' . $id . '/',
            'set_id' => $id,
            'jump_to' => '',
        );
        
        //Dados da página: título e imagem da capa
        $return = Video::openGraph($url);
        
        //Juntando as variáveis em um URL
        $params = http_build_query($flashVars);
        
        //Retorno
        return array_merge( $return , array(
            'player' => 'http://www.flickr.com/apps/slideshow/show.swf?v=121572&' . $params,
            'playerType' => 'iframe'
        ) );
    }
}
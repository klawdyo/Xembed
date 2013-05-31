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
    Retorna os dados de uma galeria de fotos do Photobucket
    
    ---------------------------------------------------------------------------
    TODO
    ---------------------------------------------------------------------------
    Photobucket está retornando erro 400 quando tentamos fazer o download de 2
    ou mais álbuns.
    

*/
class photobucket{
    
    
    /**
      * Pega os dados de uma galeria de fotos do Photobucket
        http://s55.photobucket.com/albums/g134/klawdyossauro/
        http://s55.photobucket.com/albums/g134/klawdyossauro/imagens%20para%20foruns/
      
      http://static.pbsrc.com/flash/rss_slideshow.swf?rssFeed=http://s55.photobucket.com/albums/g134/klawdyossauro/feed.rss
        
        //Exemplo de Object
        <embed width="480" height="360" src="http://static.pbsrc.com/flash/rss_slideshow.swf?rssFeed=http%3A%2F%2Ffeed55.photobucket.com%2Falbums%2Fg134%2Fklawdyossauro%2Ffeed.rss" type="application/x-shockwave-flash" wmode="transparent" />
        
        @bugs
        Aparentemente o Photobucket não está retornando os álbuns quando há mais de um.
        Se mais de 1 álbum é requerido, só o último é retornado e os demais recebem erro 404
        
      * @version
      *     0.1 06/10/2012 Initial
      */
    public static function details($id, $url, $parse){
        //Força o uso da barra final
        $url = trim($url, '/') . '/';
        
        //Força o uso do cURL.
        Video::$cUrl = true;
        
        //
        $data = Video::getContents($url);
        
        //
        preg_match_all('%<(meta name|link rel)="(?<name>title|image_src|video_src)" (content|href)="(?<content>.*?)"%', $data, $output);
        
        //
        $keys =  array('title'=>'title', 'image_src'=>'image', 'video_src'=>'player');
        
        foreach($output['name'] as $key => $value){
            $return[$keys[$value]] = $output['content'][$key];
        }
        
        //
        $return['playerType'] = 'iframe';
        
        //Retorno
        return $return;
    }
}
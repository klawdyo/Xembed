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
        <div style="width:480px;text-align:right;">
            <embed width="480" height="360" src="http://pic2.pbsrc.com/flash/rss_slideshow.swf" flashvars="rssFeed=http%3A%2F%2Ffeed55.photobucket.com%2Falbums%2Fg134%2Fklawdyossauro%2Ffeed.rss" type="application/x-shockwave-flash" wmode="transparent" /><a href="javascript:void(0);" target="_blank"><img src="http://pic.photobucket.com/share/icons/embed/btn_geturs.gif" style="border:none;" /></a><a href="http://s55.photobucket.com/user/klawdyossauro/library/" target="_blank"><img src="http://pic.photobucket.com/share/icons/embed/btn_viewall.gif" style="border:none;" alt="klawdyossauro&#039;s  album on Photobucket" /></a></div>
        //Exemplo de Object
        <embed width="480" height="360" src="http://static.pbsrc.com/flash/rss_slideshow.swf?rssFeed=http%3A%2F%2Ffeed55.photobucket.com%2Falbums%2Fg134%2Fklawdyossauro%2Ffeed.rss" type="application/x-shockwave-flash" wmode="transparent" />
        
        #title
        //meta name="description" content="klawdyossauro's Library slideshow." />
        
        @bugs
        Aparentemente o Photobucket não está retornando os álbuns quando há mais de um.
        Se mais de 1 álbum é requerido, só o último é retornado e os demais recebem erro 404
        
      * @version
      *     0.1 06/10/2012 Initial
      */
    public static function details($id, $url, $parse){
        //Força o uso da barra final
        $url = trim($url, '/') . '/feed.rss';
        pr($url);
        //Força o uso do cURL.
        //Video::$cUrl = true;
        
        //
        //$data = Video::getContents($url, 100);
        //pr($data);
        return array();
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
<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 28/06/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos adicionados no site da youporn
    

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://www.youporn.com/watch/8296838/i-love-em-tick-black-market/?from=vbwn
    
    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------

*/
class youporn{
    
    /**
      * Pega os dados de vídeos adicionados no site Xhmaster
        
      * @version
      *     0.1 28/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = false;
        
        //http://www.youporn.com/embed/8296838/
        //Usando a url do embed pra diminuir o código
        $url = 'http://www.youporn.com/embed/' . $id . '/' . $parse['slug'];
        
        //Eliminando espaços desnecessários
        $content = preg_replace("%([\s\n\t]+)%", " ", Video::getContents($url));
        
        //'image_url' : 'http://cdn1.image.youporn.phncdn.com/201303/29/8296838/640x480/8.jpg'
        $image = regex("%'image_url' ?: ?'(?<image>[^']+)',%", $content, 'image');
        //'video_title' : 'I love em tick! - Black Market'
        $title = regex("%'video_title' ?: ?'(?<title>[^']+)',%", $content, 'title');
        
        return array(
            'title' => $title,
            'image' =>  $image,
            'player' => $url,
            'playerType' => 'iframe',
        );
    }  
}
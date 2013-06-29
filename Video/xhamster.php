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
    Retorna os dados dos vídeos adicionados no site da Xhamster
    

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://xhamster.com/movies/1594325/schoolgirl_chokes_on_orgy_cocks.html
    
    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------

*/
class xhamster{
    
    /**
      * Pega os dados de vídeos adicionados no site Xhmaster
        
      * @version
      *     0.1 28/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = false;
        
        //Eliminando espaços desnecessários
        $content = preg_replace("%([\s\n\t]+)%", " ", Video::getContents($url, 3072));
        
        $image = regex("%'image':'(?<image>[^']+)',%", regex('%var flashvars ?= ?\{(?<f>[^}]+)%', $content, 'f'), 'image');
        $title = regex('%<title>(?<title>.*) - xHamster.com</title>%', $content, 'title');
        
        return array(
            'title' => $title,
            'image' =>  $image,
            'player' => 'http://xhamster.com/xembed.php?video=' . $id, //http://xhamster.com/xembed.php?video=1594325
            'playerType' => 'iframe',
        );
    }  
}
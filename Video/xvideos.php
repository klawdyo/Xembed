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
    Retorna os dados dos vídeos adicionados no site da Xvideos
    

    ---------------------------------------------------------------------------
    FORMATOS DAS URLS SUPORTADAS
    ---------------------------------------------------------------------------
    http://www.xvideos.com/video5032052/free_web_cam_sex_chat
    
    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------

*/
class xvideos{
    
    /**
      * Pega os dados de vídeos adicionados no site Xvideos
        
      * @version
      *     0.1 28/06/2013 Initial
      */
    public static function details($id, $url, $parse){
        Video::$cUrl = false;
        
        //Eliminando espaços desnecessários
        $content = preg_replace("%([\s\n\t]+)%", " ", Video::getContents($url));

        //<li id="tabVote"> <img src="http://img100.xvideos.com/videos/thumbs/86/f2/f3/86f2f38c3e02c6968ede0a413327e046/86f2f38c3e02c6968ede0a413327e046.1.jpg"
        $image = regex('%(<li id="tabVote"> <img src="(?<image>http://[^"]+)")%', $content, 'image');
        $title = regex('%<title>(?<title>.*) - XVIDEOS.COM</title>%', $content, 'title');

        return array(
            'title' => $title,
            'image' =>  $image,
            //http://flashservice.xvideos.com/embedframe/5032052
            'player' => 'http://flashservice.xvideos.com/embedframe/' . $id,
            'playerType' => 'iframe',
        );
    }  
}
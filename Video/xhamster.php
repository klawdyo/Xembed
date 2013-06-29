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
        
        $url = 'http://xhamster.com/xembed.php?video=' . $id;
        
        //Eliminando espaços desnecessários
        $content = preg_replace("%([\s\n\t]+)%", " ", Video::getContents($url, 3000));
        //pr($content);
        
        //<param name="flashvars" value="main_url=http://xhamster.com/movies/1594325/schoolgirl_chokes_on_orgy_cocks.html?embed=view&title=schoolgirl Chokes On Orgy Cocks&url_mode=1&srv=http://5.xhcdn.com&file=2YuKkEVnp-6,end=1372476686/data=99764D40/speed=83200/1594325_schoolgirl_chokes_on_orgy_cocks.flv&image=http://ut5.xhamster.com/t/325/8_b_1594325.jpg&video_id=1594325&bufferlength=3&id=player,
        $parse = regex('%<param name="flashvars" value="(?<flashvars>(.*)(title=(?<title>.*?))\&(.*)(image=(?<image>.*?))\&(.*))"%', $content);
        
        //$image = regex("%'image':'(?<image>[^']+)',%", regex('%var flashvars ?= ?\{(?<f>[^}]+)%', $content, 'f'), 'image');
        //$title = regex('%<title>(?<title>.*) - xHamster.com</title>%', $content, 'title');
        
        
        
        return array(
            'title' => $parse['title'],
            'image' =>  $parse['image'],
            'player' => 'http://xhamster.com/xembed.php?video=' . $id, //http://xhamster.com/xembed.php?video=1594325
            'playerType' => 'iframe',
        );
    }  
}
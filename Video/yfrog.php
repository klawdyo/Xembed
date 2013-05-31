<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 11/10/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos adicionados no Yfrog

*/
class yfrog{
    
    
    /**
      * Pega os dados de vídeos adicionados no Yfrog
        http://twitter.yfrog.com/mzbnczogslfypthuglyxolnaz
        
        embed:
        http://twitter.yfrog.com/mzbnczogslfypthuglyxolnaz
        http://twitter.yfrog.com/jv4a5grijbjslronrzlhdqzqz
        http://twitter.yfrog.com/5thfyzdxxkeehbfstfdsppftz
        
      * @version
      *     0.1 06/10/2012 Initial
      */
    public static function details($id, $url, $parse){
        //Força o uso da barra final
        //$url = trim($url, '/') . '/';
        
        //Força o uso do cURL.
        Video::$cUrl = true;
        
        //http://www.yfrog.com/api/oembed?url=http%3A%2F%2Fyfrog.com%2F2pswonj
        pr(Video::getContents($url));
        
        
        
        
        
        return array(
            'title' => 'hhh',
            'image' =>  'http://yfrog.com/' . $id . ':small',
            'player' => 'http://yfrog.com/' . $id . ':embed',
            'playerType' => 'iframe',
                     );
    }
}
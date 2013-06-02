<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.2 01/06/2013

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
      *     0.2 01/06/2013 Lendo o primeiro 1kb do html da página para pegar
      *         a descrição do vídeo
      *
      * @bugs
      *     - O oEmbed do Yfrog não retorna o título do vídeo. Para resolver, seria necessário ler
      *     o html da página. Nesse caso, leremos somente o primeiro 1kb do html para pegar o título
      *     da página
      */
    public static function details($id, $url, $parse){
        //Força o uso da barra final
        //$url = trim($url, '/') . '/';
        
        //Força o uso do cURL.
        //Video::$cUrl = true;
        
        //http://www.yfrog.com/api/oembed?url=http%3A%2F%2Fyfrog.com%2F2pswonj
        //pr(Video::getContents($url));
        
        $handle = @fopen($url, "r");
        $return = fread($handle, 1024);
        
        preg_match('(<title>(?<title>.*)(http://(.*)yfrog.com/(.*))</title>)', preg_replace('([\s]+|\t)', ' ', $return), $output);
        
        $title = '';
        if(isset($output['title'])){
            $title = $output['title'];
        }
        
        return array(
            'title' => $title,
            'image' =>  'http://yfrog.com/' . $id . ':small',
            'player' => 'http://yfrog.com/' . $id . ':embed',
            'playerType' => 'iframe',
        );
    }
}
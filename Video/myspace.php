<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.2 27/05/2013

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados dos vídeos em MySpace

*/
class myspace{
    
    
    /**
      * Pega os dados dos vídeos do site MySpace
      * 
      * @version
      *     0.1 18/09/2012 Initial
      *     0.2 27/05/2013 - Bug do erro 400 aparentemente resolvido.
      *                    - Player retorna dados corretamente
      *
      * @bugs
      *     myspace::retorna erro 400 quando fazemos várias requisições. Em todos
      *     os testes, somente a última requisição retornou os dados corretos.
      */
    public static function details($id, $url){
        //Video::$cUrl = true;
        //http://lads.myspace.com/videos/MSVideoPlayer.swf?m=109061388
        
        $return = Video::openGraph($url);
        
        return array_merge(
            $return ,
            array('playerType' => 'iframe',
                  'player' => 'http://lads.myspace.com/videos/MSVideoPlayer.swf?m=' . $id,
                )
          );
    }
}
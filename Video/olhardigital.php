<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.2 15/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos OlharDigital

*/
class olhardigital{
    
    
    /**
      * Pega os dados do vídeo do site OlharDigital
      *
      * @version
      *     0.1 15/09/2012 Initial
      *     0.2 15/09/2012 Removida a função regex() por não existir em todos
      *         os Spaghettis. Usando preg_match() e array_key_exists() ao invés
      */
    public static function details($id, $url, $parse){
        $content = Video::getContents($url);
        
        //Passando o HTML diretamente para o método openGraph(), para evitar
        //duas requisições
        $data = Video::openGraph(null, $content);
        
        preg_match('%(?<player>http://www.olhardigital.com.br/embed/[0-9]+)%', $content, $output);
        
        if(array_key_exists('player', $output)){
            $player = $output['player'];
        }
        
        return array(
            'title' => $data['title'],
            'image' => $data['image'],
            'player' => $player,
            'playerType' => 'iframe',
        );
    }
}
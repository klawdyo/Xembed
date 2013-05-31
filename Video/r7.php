<?php
/*
    ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.6 15/09/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Retorna os dados do site de vídeos R7

*/
class r7{
    
    
    /**
      * Pega os dados do vídeo do site R7.com
      * Este site tem duas versões diferentes para as páginas dos vídeos, portanto
      * existem 2 padrões de URLs nos 'patterns' da classe Video: v1 e v2.
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 26/08/2012 Adicionada a chave 'image' no retorno do método, pois
      *         os sites não disponibilizam tamanhos padronizados das miniaturas
      *         dos vídeos.
      *     0.3 01/09/2012 Agora usando 2 padrões diferentes de urls. Ver em self::$patterns
      *     0.4 05/09/2012 Método renomeado para details() e separado da classe Video
      *     0.5 06/09/2012 details() não retorna mais a chave 'thumbs', pois a chave
      *         'image' é mais unificada e todos os sites retornam por igual.
      *         - details() agora retorna a chave 'playerType', que indica
      *         se a exibição é através de iframe, object, script, etc.
      *     0.6 15/09/2012 As 2 versões possíveis, que antes ficavam dentro deste
      *         método, foram separadas em métodos diferentes.
      */
    public static function details($id, $url, $parse){
        //Video::$cUrl = true;
        
        if(array_key_exists('v1', $parse)){
            $method = 'v1';
        }
        else{
            $method = 'v2';
        }
        
        return array_merge(
            self::$method($url, $parse),
            array(
                'playerType' => 'iframe',
                'player' => 'http://videos.r7.com/r7/service/video/playervideo.html?idMedia=' . $id,
            )
        );
    }
    
    /**
      * Trata os dados do portal R7 em uma das versões possíveis do site
      * 
      * Tipo de url suportada nesta versão:
      * http://esportes.r7.com/videos/exclusivo-paulinho-fala-sobre-selecao-futuro-no-corinthians-e-mundial/idmedia/5038d63d6b71cc1ec4d91969.html
      *
      * @version 0.1 15/09/2012 Initial
      */
    public static function v1($url, $parse){
        $content = Video::getContents($url);
        
        //Pegando o título
        preg_match('%<title>(?<title>.*)</title>%', $content, $output);
        
        return array_merge(
            Video::openGraph(null, $content),
            array(
                'title' => $output['title'],
            )
        );
    }
    
    /**
      * Trata os dados do portal R7 em uma das versões possíveis do site.
      * Essa versão tem um redirecionamento que força a existência de uma barra no final da URL
      * 
      * Tipos de urls suportadas nesta versão:
      * http://rederecord.r7.com/video/homem-com-a-pele-mais-elastica-do-mundo-e-uma-das-noticias-mais-malucas-da-internet-505386206b713bde7246ff09/
      * http://rederecord.r7.com/video/antonia-fontenelle-fala-sobre-a-sua-personagem-na-novela-balacobaco-505473b86b71e8304f00bb0b
      *
      * @version 0.1 15/09/2012 Initial
      */
    public static function v2($url, $parse){
        //Forçando a barra final na url
        $url = trim($url, '/') . '/';
        
        return Video::openGraph($url);
    }
}
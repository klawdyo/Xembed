<?php
require_once 'Lib/Html.php';
require_once 'Lib/String.php';
require_once 'Video.php';

/** ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    @version 0.1 26/08/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Cria um html para a exibição de um vídeo, ou uma lista deles, usando os dados
    retornados pela classe Video
    
    ---------------------------------------------------------------------------
    HOW TO USE
    ---------------------------------------------------------------------------
    //Criando uma vitrine de vídeos, podendo receber 1 ou mais vídeos como
    //parâmetro
    echo Xembed::showcase('http://www.metacafe.com/watch/8993220/');
    echo Xembed::showcase(array(
                        'http://www.metacafe.com/watch/8993220/',
                        'http://pt.scribd.com/doc/103716634/Building-a-Desire-Engine'
                 ));
    
    //Exibe um vídeo
    echo Xembed::embed('http://www.metacafe.com/watch/8993220/');
    
    ---------------------------------------------------------------------------
    CHANGELOG
    ---------------------------------------------------------------------------
    26/08/2012
    [+] showcase() cria uma vitrine com 1 ou mais vídeos
    [+] embed() cria o html para exibição de um vídeo
    
    01/06/2013
    [m] Todos os métodos transformados em Static
    [m] Classe renomeada para Xembed
    
    ---------------------------------------------------------------------------
    KNOW BUGS
    ---------------------------------------------------------------------------
    
    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------
    
 
*/

class Xembed extends Html{
    /**
      * @var string
      * Classe css a ser incluída nos itens da lista de vídeos
      */
    public static $itemClass = 'xembed item';
    
    /**
      * @var string
      * Html dos itens da lista de vídeos. As palavras precedidas por dois-pontos
      * são variáveis que serão substituídas pelos dados retornados por Video::details()
      */
    public static $itemHtml = '<li class=":itemClass"><dl><dt><img src=":image"></dt><dd>:title</dd><dd><a href=":url">:url</a></dd></dl></li>';

    /**
      * Exibe uma vitrine com 1 ou mais vídeos
      *
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 31/08/2012 Nem sempre Video::details retornava um array, e isso
      *         gerava erro quando inseríamos um vídeo de um provedor não supor-
      *         tado
      *     0.3 01/06/2013 Método transformado em static
      */
    public static function showcase($url){
        $html = '';
        if(is_array($url)){
            foreach($url as $video){
                $html .= self::showcase($video);
            }
        }
        else{
            if(is_array($data = Video::details($url))){
                array_unset($data, 'thumbs');
                $data['itemClass'] = self::$itemClass;
                $html = String::insert(self::$itemHtml, $data);
            }
        }
        
        return $html;
    }
    
    /**
      * Exibe uma vitrine com 1 ou mais vídeos
      *
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 06/09/2012 embed() agora pode exibir vídeos de sites que usam
      *         scripts javascript ao invés de iframes. Para isso, Video::details()
      *         precisa passar a chave 'playerType'=>'script' e na chave 'player'
      *         vem a url do script
      *     0.3 16/09/2012 O segundo parâmetro pode passar atributos para o elemento
      *         gerado.
      *     0.4 01/06/2013 Método transformado em static
      */
    public static function embed($url, $params = array()){
        $data = Video::details($url);
        
        //pr($data);
        $playerType = (array_key_exists('playerType', $data) && $data['playerType'] == 'script') ?
                        'script' : 'iframe';
        
        $params = array_merge($params, array('src' => $data['player']));
        
        return self::tag($playerType, null, $params);
    }
    
    
    /**
      * Exibe os cabeçalhos que são incluídos nas páginas dos vídeos, especificamente
      * os de suporte ao openGraph
      *
      * @version
      *     0.1 06/09/2012 Initial
      */
    /*public function headers(){
        $headers = array(
            'og:video' => 'player',
            'og:image' => 'image',
            'og:url' => 'url',
            'og:title' => 'title'
        );
    }*/
}
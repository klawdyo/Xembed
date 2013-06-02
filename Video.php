<?php
set_time_limit(0);

/*  ---------------------------------------------------------------------------
    COPYRIGHT
    ---------------------------------------------------------------------------
    @author José Cláudio Medeiros de Lima <klawdyo@gmail.com>
    24/08/2012

    ---------------------------------------------------------------------------
    DESCRIPTION
    ---------------------------------------------------------------------------
    Class Video
    Tem por objetivo reunir uma forma simples de exibir vídeos de todos os sites
    especializados neste tema. Inicialmente, só estão disponíveis sites brasilei-
    ros, mas isso é fácil de mudar, pois é muito fácil de inserir suporte a outros
    sites.

    ---------------------------------------------------------------------------
    HOW TO USE
    ---------------------------------------------------------------------------
    É só informar a url do vídeo. A class identificará o site e exibirá os dados
    corretos.
    
    Ex.:
    Video::details('http://mais.uol.com.br/view/13228999');
    
    //Returns
    Array
    (
        [id] => 13228999
        [provider] => uolmais
        [url] => http://mais.uol.com.br/view/13228999
        [title] => UOL Mais > Isso foi somente a 195Km/h!
        [image] => http://thumb.mais.uol.com.br/13228999-thb0-large.jpg?ver=0
        [player] => http://player.mais.uol.com.br/embed_v2.swf?tv=2&mediaId=13228999
        [playerType] => iframe
    )

    ---------------------------------------------------------------------------
    CHANGELOG
    ---------------------------------------------------------------------------
    
    24/08/2012
    [+] Initial
    [+] id() localiza o id na url do vídeo
    
    25/05/2012
    [+] details() identifica qual o site do vídeo informado e retorna os dados dele
    [+] oEmbed() unifica a ação de pegar os dados via oEmbed
    [+] getContents() Substitui file_get_contents(), substituindo, se for necessário, pelo cUrl
    [+] dailymotion() trata os dados deste site
    [+] globotv() trata os dados deste site
    [+] maisuol() trata os dados deste site
    [+] metacafe() trata os dados deste site
    [+] scribd() trata os dados deste site
    [+] slideshare() trata os dados deste site
    [+] vimeo() trata os dados deste site
    [+] virgula() trata os dados deste site
    [+] youtube() trata os dados deste site
    [+] terratv() trata os dados deste site
    [m] id() agora retorna os dados a partir de details()
    [m] getContents() estava usando POST nas requisições via cUrl
    [m] dailymotion() agora usa o oEmbed
    [m] globotv() agora usa a própria url para pegar o nome do vídeo
    [m] maisuol() usa o elemento <title> da página para pegar o nome do vídeo
    [m] metacafe() agora usa a própria url para pegar o nome do vídeo
    [m] youtube() agora usa o oEmbed
    [-] terratv() foi removido temporariamente, pois nem todos os dados estão
        acessíveis para a requisição da classe.
    
    26/08/2012
    [+] esporteinterativo() trata os dados deste site
    [+] msnvideo() trata os dados deste site
    [+] espnbrasil() trata os dados deste site
    [-] esporteinterativo() Aparentemente o esporteinterativo está bloqueando
        a requisição. O método foi retirado da classe temporariamente
    [m] Todos os métodos agora retornam a chave 'image', que é a maior das imagens
        disponíveis, dando opção para o programador diminuir seu tamanho mais
        facilmente com o mínimo de perda de qualidade.
        
    01/09/2012
    [+] match() tenta casar uma url com os padrões existentes
    [m] details() agora usa match()
    [m] Com a inclusão de match(), e a consequente separação de códigos existentes
        em details(), tornou-se possível a inclusão de mais de um 'pattern' para
        cada 'provider'
    [m] Consertado erro na url do player da ESPN Brasil
    
    05/09/2012
    [m] Com modificações em Mapper::normalize(), os vídeos do globotv() que con-
        tinham '/' no final não estavam casando e não eram exibidos pelo XembedHelper
    [m] maisuol() renomeado para uolmais()
    [+] load() carrega as classes dos vídeos
    [m] Os métodos dos vídeos agora estão separados em classes e em arquivos
        separados, sendo carregados só quando forem necessários
    [+] ig adicionado
    [m] adicionado novo padrão de urls para o site de vídeos IG
    [m] Pequenos ajustes em openGraph() para suportar diferenças de um síte
        para outro
    
    07/09/2012
    [+] redetv() adicionado. No entanto, está acontecendo erros no acesso à página,
        provavelmente devido a bloqueios da requisição por parte do site da emissora
    [-] redetv() temporariamente removido.
    
    13/09/2012
    [+] olhardigital() adicionado
    [m] openGraph() modificado para receber o html de uma página ao invés de só
        a url. No entanto, um dos dois parâmetros deve estar preenchido, com prio
        ridade para a url.
    
    15/09/2012
    [m] openGraph() modificado para não casar com strings completas, evitando erros
    [m] openGraph() modificado para aceitar TABs e múltiplos espaços em seu interior
    [m] getContents() agora envia um USER_AGENT quando a conexão for feita via cURL
        para simular um navegador e evitar bloqueio das requisições
    [+] redetv adicionado novamente. Antes o site bloqueava as requisições. Agora,
        após as mudanças em getContents(), o site não bloqueou em nenhum dos testes
    [+] EsporteInterativo() readicionado após as mudanças em getContents()
    [+] WordpressTV() adicionado
    
    16/09/2012
    [m] Adicionado url encode à url em oEmbed()
    [m] Tornada o encode da url como opcional através de um terceiro parâmetro
        em Video::oEmbed(). O valor padrão é TRUE.
    [+] FoxSports adicionado
    
    18/09/2012
    [+] MySpace Adicionado
    
    19/09/2012
    [m] MySpace agora suporta 2 tipos de URLS:
        http://www.myspace.com/video/vid/108841799
        http://br.myspace.com/video/cezzonline/cezz-double-face/108841799
    [m] Refatoração total em openGraph()
    [-] MySpace removido temporariamente. O site está retornando erro 400 quando
        várias requisições são feitas ao mesmo tempo, só retornando corretamente
        a última
    
    20/09/2012
    [+] Facebook retorna os vídeos do site. Precisa de oAuth para dar acesso,
        portanto foi removido temporariamente.
    
    06/10/2012
    [+] Flickr Adicionado. Flickr está previsto para dar suporte aos albuns de
        de fotos
    [+] Photobucket adicionado. Photobucket está retornando erro 400 quando tentamos
        pegar os dados de 2 ou mais álbuns.
    
    11/10/2012
    [+] Yfrog Adicionado.
    
    27/05/2013
    [m] EspnBrasil não utiliza mais o link "estadao"
    [+] MySpace re-adicionado após a correção do bug que retornava erro 400 quando
        mais de 1 vídeo era solicitado em uma mesma conexão. Somente o último vídeo
        retornava corretamente.
    [m] Virgula alterado após mudanças no site. Agora não usa mais o oEmbed
    [m] WordpressTV não usa mais o oembed, pois não estava retornando a imagem
        nem a url do video
        
    28/05/2013    
    [m] Band teve suas urls modificadas, podendo ser de 2 tipos, e agora usa o
        padrão de vídeos do UolMais
    
    02/06/2013
    [+] FunnyOrDie adicionado
    
    ---------------------------------------------------------------------------
    KNOWN BUGS
    ---------------------------------------------------------------------------


    ---------------------------------------------------------------------------
    TO DO
    ---------------------------------------------------------------------------
    - Consertar TerraTV. O site não libera o player para ser acessado de fora dele.
 OK - Consertar MySpace. O site está retornando erro 400 quando várias requisições
        são feitas ao mesmo tempo. Só a última é retornada corretamente.
    - Consertar Photobucket. O site está retornando erro 400 quando várias requisições
        são feitas ao mesmo tempo. Só a última é retornada corretamente.
    - Facebook precisa de oAuth para dar acesso. Removido temporariamente.
 OK - Consertar EsporteInterativo, que aparentemente bloqueia as requisições
 OK - Consertar RedeTV. Aparentemente está havendo bloqueio da requisição
 OK - ESPN Brasil não disponibiliza o thumb da imagem, seriam necessárias pelo
        menos 2 requisições para exibir a miniatura do vídeo


 */


class Video{
    
    /**
      * @var array $patterns
      * Armazena os padrões de busca dos IDs dentro das URLs
      */
    public static $patterns = array(
        
        //'band' => '%http://videos.band.com.br/Exibir/[0-9A-Za-z-]+/(?<id>[0-9a-f]+)%', //16/05/2012 v.1
        //http://esporte.band.uol.com.br/futebol/selecao/copa-das-confederacoes/2013/videos.asp?id=14471367&t=filipe-luis-se-apresenta-e-diz-quebraria-cara-pela-selecao
        //http://videos.band.uol.com.br/programa.asp?e=esporte&pr=os-donos-da-bola&v=14471500
        //http://videos.band.uol.com.br/programa.asp?e=esporte&v=14466318&pr=
        'band' => array( //28/05/2013 v.2
            '%band.(uol.)?com.br/([a-z0-9\/-]+)videos.asp\?([^\s]*)id=(?<id>[0-9]+)%',
            '%videos.band.(uol.)?com.br/programa.asp\?([^\s]*)v=(?<id>[0-9]+)%',
        ),
        
        //25/08/2012 v.1
        'dailymotion' => '%(dailymotion.com/video/(?<id>[0-9a-z]+)_)%',
        
        //http://app.esporteinterativo.com.br/player/1803234653001
        //'esporteinterativo' => '%esporteinterativo.com.br/player/(?<id>[0-9]+)%', //26/08/2012 v.1
        //http://br.esporteinterativo.yahoo.com/video/kak%C3%A1-acerta-lindo-chute-e-223239588.html
        'esporteinterativo' => '%br.esporteinterativo.yahoo.com/video/(?<id>[^/]+)\.html%', //23/02/2013 v.2
        
        //http://espn.com.br/video/277733_ingles-gols-de-liverpool-2-x-2-manchester-city
        //'espnbrasil' => '%http://espn.(estadao.)?com.br/video/(?<id>[0-9]+)_([0-9a-z_-]+)%', //26/08/2012 v.1
        'espnbrasil' => '%http://(www.)?espn.com.br/video/(?<id>[0-9]+)_([0-9a-z_-]+)%', //27/05/2013 v.2
        
        //https://www.facebook.com/video/video.php?v=395556417176729
        //'facebook' => '%facebook.com/video/video\.php\?v=(?<id>\d+)%',
        
        //http://www.flickr.com/photos/klawdyo/sets/72157618525048702/
        'flickr' => '%flickr.com/photos/(?<user>[a-z0-9_-]+)/sets/(?<id>\d+)/?%', //06/10/2012 v.1
        
        //view-source:http://www.foxsports.com.br/videos/42664732-assista-aos-melhores-lances-de-chievo-1-x-3-lazio
        'foxsports' => '%foxsports.com.br/videos/(?<id>\d+)-[0-9a-z-]+%',
        
        //http://www.funnyordie.com/videos/fa60d86785/anchorman-2-official-teaser-trailer-2?playlist=featured_videos
        'funnyordie' => '%funnyordie.com/videos/(?<id>[0-9a-f]+)/%',
        
        //http://globotv.globo.com/rede-globo/globo-esporte-sp/v/globo-esporte-compara-os-discursos-de-apresentacao-de-adriano-no-flamengo-e-corinthians/2105335/
        //http://g1.globo.com/jornal-nacional/videos/t/edicoes/v/brasileiros-vao-as-compras-para-aproveitar-o-possivel-fim-do-ipi-reduzido/2107606/
        //'globotv' => '%globotv.globo.com(.*)/(?<id>[0-9]+)%', //25/08/2012 v.1
        //'globotv' => '%globo.com(.*)/v/([0-9a-z-]+)/(?<id>[0-9]+)/$%', //25/08/2012 v.2
        'globotv' => '%globo.com(.*)/v/([0-9a-z-]+)/(?<id>[0-9]+)/?$%', //05/09/2012 v.3
        
        //http://tvig.ig.com.br/variedades/cultura/cabeca-gigante-altera-paisagem-carioca-8a49802639368a220139977432e90e16.html
        //http://tvig.ig.com.br/id/8a49800e3979013c013996ea875e0446.html
        //'ig' => '%(tvig.ig.com.br/([a-z0-9-\/]+)-(?<id>[0-9a-f]+)\.html$)%', //05/09/2012 v.1
        'ig' => '%(tvig.ig.com.br/([a-z0-9-\/]+-|id/)(?<id>[0-9a-f]+)\.html$)%', //05/09/2012 v.2
        
        //25/08/2012 v.1
        //http://www.metacafe.com/watch/8993220/dance_central_3_story_mode_interview_with_lead_designer_matt_boch_destructoid_dlc/
        'metacafe' => '%(metacafe.com/watch/(?<id>[0-9]+))%',

        //http://video.br.msn.com/watch/video/zeze-di-camargo-em-entrevista-exclusiva-para-o-showlivre-com/2adyjfxh1
        'msnvideo' => '%video.br.msn.com/watch/video/[a-z0-9-]+/(?<id>[0-9a-z]+)%', //26/08/2012 v.1
        
        //http://br.myspace.com/video/cezzonline/cezz-double-face/108841799
        //http://www.myspace.com/video/vid/105178804
        //'myspace' => '%myspace.com/video/[\w\d-]+/[\w\d-]+/(?<id>\d+)%', //18/09/2012 v.1
        'myspace' => '%myspace.com/video/([\w\d-]+/[\w\d-]+|vid)/(?<id>\d+)%', //19/09/2012 v.2
        
        //http://olhardigital.uol.com.br/negocios/central_de_videos/twitter-pode-ser-usado-como-aula-de-historia#|0|0|1|99
        'olhardigital' => '%olhardigital.(uol.)?com.br/\w+/central_de_videos/(?<id>[\d\w-]+)%', //13/09/2012 v.1
        
        //http://s55.photobucket.com/albums/g134/klawdyossauro/
        //http://s55.photobucket.com/albums/g134/klawdyossauro/imagens%20para%20foruns/
        'photobucket' => '%photobucket.com/albums/(?<id>\w+)%', //06/10/2012 v.1
        
        //http://esportes.r7.com/videos/exclusivo-paulinho-fala-sobre-selecao-futuro-no-corinthians-e-mundial/idmedia/5038d63d6b71cc1ec4d91969.html
        //http://rederecord.r7.com/video/mulas-do-trafico-ministra-fala-sobre-situacao-de-brasileiros-presos-no-exterior-50413aec92bb9fbad9b652a0
        //'r7' => '%(r7.com/videos/([a-z0-9-]+)/idmedia/(?<id>[a-z0-9]+).html)%', //25/08/2012 v.1
        //'r7' => '%(r7.com/((videos/([a-z0-9-]+)/idmedia/(?<id>[a-z0-9]+).html)|(video/([0-9a-z-]+-)(?<id2>[0-9a-f]+)/?)))%', //01/09/2012 v.2
        'r7' => array(  //v.3 01/09/2012
                      '%(?<v1>r7.com/(videos/([a-z0-9-]+)/idmedia/(?<id>[a-z0-9]+).html))%',
                      '%(?<v2>r7.com/(video/([0-9a-z-]+-)(?<id>[0-9a-f]+)/?))%',
                    ),
        
        //http://www.redetv.com.br/Video.aspx?8,10,289012,entretenimento,tv-fama,vivi-araujo-requebra-na-rua-com-o-salgueiro
        //http://www.redetv.com.br/Video.aspx?8,10,289012
        'redetv' => '%redetv.com.br/Video.aspx\?\d+\,\d+\,(?<id>\d+)%', //07/09/2012 v.1

        'scribd' => '%(scribd.com/doc/(?<id>[0-9]+))%', //25/08/2012 v.1

        //http://www.slideshare.net/haraldf/business-quotes-for-2011
        'slideshare' => '%(slideshare.net/([a-z0-9_-]+)/(?<id>[0-9a-z-]+))%', //25/08/2012 v.1

        //http://mais.uol.com.br/view/13228999
        //http://mais.uol.com.br/view/ofj6vrny8naf/goleiro-da-alemanha-franga-contra-os-eua-04028C9C376CDCA14326?types=A&
        //'uolmais' => '%(mais.uol.com.br/view/(?<id>[0-9]+))%', //25/08/2012 v.1
        'uolmais' => '%(mais.uol.com.br/view/(?<id>[0-9a-z]+))%', //02/06/2013 v.2
        
        //http://www.videolog.tv/video.php?id=824625
        'videolog' => '%videolog.tv/video.php\?id=(?<id>\d+)%', //15/09/2012 v.1
        
        'vimeo' => '%(vimeo.com/(m/)?(?<id>[0-9]+))%', //24/08/2012 v.1
        
        //virgula.uol.com.br/ver/video/caliente/2011/12/15/11724-confira-toda-a-sensualidade-da-sabrina-boingboing
        //'virgula' => '%(virgula.uol.com.br/video/(([a-z0-9-]+)/([0-9]{4})/([0-9]{2})/([0-9]{2})/)?(?<id>[0-9]+)-)%', //25/08/2012 v.1
        //http://virgula.uol.com.br/video/caliente/confira-toda-a-sensualidade-da-sabrina-boingboing
        //http://virgula.uol.com.br/video/diversao/cinema/trailer-de-o-diario-de-tati
        'virgula' => '%(virgula.uol.com.br/video([a-z0-9-\/]+)/(?<id>([a-z0-9-]+)))%', //27/05/2013 v.2
        
        //http://wordpress.tv/2012/09/09/kirk-wight-getting-started-with-theme-development/
        'wordpresstv' => '%wordpress.tv/\d{4}/\d{2}/\d{2}/(?<id>[0-9a-z-]+)/?%', //15/09/2012 v.1
        
        //http://twitter.yfrog.com/mzbnczogslfypthuglyxolnaz
        'yfrog' => '%yfrog.(com|us)/(?<id>[a-z0-9]+)%', //11/10/2012 v.1
        
        'youtube' => '(((youtube.com(.br)?/watch/?\?v=)|(youtu.be/))(?<id>[0-9a-zA-Z_-]+))', //24/08/2012 v.1
    );
    
    /**
      * @var array oEmbedUrls
      * Armazena as urls de acesso aos dados oEmbed. Nesta propriedade ficam apenas
      * os endereços dos sites que dão acesso ao oEmbed. Nem todos os sites tem
      * o oEmbed
      */
    public static $oEmbedUrls = array(
        'dailymotion' => 'http://www.dailymotion.com/api/oembed?url=:url&format=json',
        'funnyordie' => 'http://www.funnyordie.com/oembed?format=json&url=:url',
        'scribd' => 'http://www.scribd.com/services/oembed?url=:url&format=json',
        'slideshare' => 'http://www.slideshare.net/api/oembed/1?url=:url&format=json',
        'vimeo' => 'http://vimeo.com/api/oembed.xml?url=:url&format=json',
        //'virgula' => 'http://virgula.uol.com.br/ver/video/oembed.json?url=:url',
        //'wordpresstv' => 'http://public-api.wordpress.com/oembed/?format=json&url=:url&for=wpcom-auto-discovery',
        //'yfrog' => 'http://www.yfrog.com/api/oembed?url=:url',
        'youtube' => 'http://www.youtube.com/oembed?url=:url&format=json',
    );
    
    /**
      * @var array $loadedClasses
      * Armazena as classes carregadas
      */
    public static $loadedClasses = array();
    
    /**
      * @var array $cUrl
      * Define se está usando cUrl ou não
      */
    public static $cUrl = false;

    
    /**
      * @var array $data
      * Armazena os dados dos vídeos pesquisados no objeto
      */
    public static $data = array(
        //'id' => id do video
        //'url' => url do vídeo
        //'provider' => o nome do serviço de vídeos
        //'title' => Título do vídeo
        //'player' => o endereço direto para o player, para ser incluído em um iframe
        //'image' => A melhor imagem, dentre as disponíveis
        //'playerType' => O tipo do player, se será exibido através de um script ou iframe
    );
    
    /**
      * Pega os detalhes da url passada
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 01/09/2012 Usando Video::match() a partir de agora; Dando possi-
      *         bilidade de adicionar mais de um 'pattern' para cada 'provider'
      *     0.3 05/09/2012 Usando Video::load() para carregar os dados dos vídeos
      */
    public static function details($url){
        if($parse = self::match($url)){
            $details = array(
                        'id' => $parse['id'],
                        'provider' => $parse['provider'],
                        'url' => $url
                    );
            
            return self::load($details, $parse);
        }
    }
    
    /**
      * Carrega a classe e retorna os dados do vídeo
      *
      * @version
      *     0.1 Initial
      */
    public static function load($details, $parse){
        $provider = $details['provider'];
        
        if(!in_array($provider, self::$loadedClasses)){
            self::$loadedClasses []= $provider;
            require 'Video/' . $provider . '.php';
        }
        
        $object = new $provider;
        
        return array_merge(
            $details,
            $object->details($details['id'] , $details['url'] , $parse)
        );
    }
    
    /**
      * Tenta casar a url informada com os 'patterns' existentes
      *
      * @version
      *     0.1 01/09/2012 Initial
      */
    public static function match($url, $patterns = array()){
        if(empty($patterns)){$patterns = self::$patterns;}
        
        foreach($patterns as $provider => $pattern){
            
            if(is_array($pattern)){
                $return = self::match($url, self::$patterns[$provider]);
            }
            else{
                preg_match($pattern, $url, $return);
            }
            
            if(!empty($return) && is_array($return)){
                $return['provider'] = $provider;
                return $return;
            }
        }
        
        return false;
    }
    
    
    /**
      * Pega os dados dos vídeos em sites com suporte a oEmbed
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 15/09/2012 Retirada a dependência à classe lib\core\common\String.php
      *     0.3 16/09/2012 Adicionado o encode da url que fará parte da requisição
      *         ao oEmbed
      */
    public static function oEmbed($service, $url, $encodeUrl = true){
        if($encodeUrl){
            $url = urlencode($url);
        }
        
        $url = preg_replace('%:url%', $url, self::$oEmbedUrls[$service]);
        
        return json_decode(self::getContents($url));
    }
    
    /**
      * Pega os dados dos vídeos em sites com suporte ao OpenGraph.
      *
      * @version
      *     0.1 26/08/2012 Initial
      *     0.2 05/09/2012 Alguns sites usam o padrão
      *         <meta property="og:title" content="conteúdo" />
      *         e outros usam
      *         <meta property="og:title" content='conteúdo' />
      *         openGraph() foi adequado para casar com os 2 tipos.
      *     0.3 13/09/2012 Adicionado o parâmetro $content, que pode
      *         receber o html completo ao invés de só a url.
      *     0.4 15/09/2012 Alteração na expressão regular para que ela só
      *         case com uma meta property completa, evitando erros
      *     0.5 15/09/2012 A expressão regular agora suporta TABs em seu interior
      *     0.6 16/09/2012 A Regex agora suporta <meta property> e <meta name>
      *     0.7 19/09/2012 openGraph() agora casa com qualquer <meta og:*>, inde-
      *         pendente da ordem dos parâmetros, das aspas, etc
      */
    public static function openGraph($url = null, $html = null){
        //Expressão que procura as <meta og:*>
        $regex = '((?<row><meta[^>]+(property|name) ?= ?[\'\"]{1}og:(?<type>video|image|title)[\'\"]{1}[^>]+>))si';
        //Retira o "content" dos <meta og:*> localizados
        $regex2= '(content[\s\t]*=[\s\t]*[\'\"]{1}(?<content>.*?)[\'\"]{1})si';
        //Array de retorno
        $return = array();
        //Chaves retornadas
        $vars = array(
            'title' => 'title',
            'image' => 'image',
            'video' => 'player',
        );
        
        //Pelo UM dos DOIS parâmetros precisa estar preenchido
        if(is_null($url) && is_null($html)){
            return $return;
        }
        else{
            if(!is_null($url)){
                $html = self::getContents($url);
            }
        }
        
        preg_match_all($regex, $html, $out);
        
        if(!empty($out['type'])){
            foreach($out['row'] as $key => $meta){
                if(preg_match($regex2, $meta, $content)){
                    $return[$vars[$out['type'][$key]]] = $content['content'];
                }
            }
        }
    
        return $return;
    }
    
    
    /**
      * Pega o conteúdo da url passada, podendo ser via http input, ou cUrl,
      * dependendo do valor da propriedade self::$cUrl
      *
      * @version
      *     0.1 25/08/2012 Initial
      *     0.2 25/08/2012 Quando a requisição for via cURL, não é mais feita
      *         usando o POST, para ter o mesmo efeito do file_get_contents()
      *     0.3 15/09/2012 Adicionado USERAGENT no cURL para simular o acesso via
      *         navegador e evitar bloqueio das conexões em alguns sites.
      *     0.4 01/06/2013 Adicionado segundo parâmetro "filesize", que limita
      *         o download dos dados, economizando banda
      *
      * @todo
      *     Armazenar o html na memória para caso seja necessário seu uso por
      *     vários métodos sem fazer duas requisições. O impedimento aqui é o
      *     gasto da memória.
      */
    public static function getContents($url, $filesize = false){
        if(self::$cUrl){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_PORT, 80);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            $output = curl_exec($ch);
            curl_close($ch);
            
            return $output;
        }
        else{
            if(!$filesize){
                return file_get_contents($url);
            }
            else{
                return fread(@fopen($url, 'r'), $filesize);
            }
        }
    }
}
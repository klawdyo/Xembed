<?php
    set_time_limit(0);
    require 'Lib/Utils.php';
    require 'Xembed.php';
?>
<style>
    .xembed.video iframe, .xembed.video object{
        width:700px;
        height:400px;
        border:1px solid #c0c0c0;
    }
    
    .xembed.item{
        width:600px;
        height:90px;
        list-style:none;
        font:12px tahoma;
    }
        .xembed.item dt{
            width:80px;
            float:left;
        }
            .xembed.item dt img{
                width:80px;
            }
        .xembed.item dd{
            margin-left:90px
        }
</style>
<body>
<?php
    Xembed::$itemHtml = '<li class="xembed item"><dl><dt><img src=":image"></dt><dd>:provider</dd><dd>'. Xembed::link(':title','examples.view.php?v=:url').'</dd></dl></li>';

    echo Xembed::showcase(array(
        
        #abril
        //'http://veja.abril.com.br/multimidia/video/confira-os-gols-da-partida-brasil-x-italia-na-arena-fonte-nova',
        //'http://veja.abril.com.br/multimidia/video/falta-grandeza-a-dilma-rouseff',
        //'http://exame.abril.com.br/videos/direto-da-bolsa/parana-suspende-aumento-da-energia-e-leva-incerteza-a-bolsa',
        //'http://quatrorodas.abril.com.br/qr-tv/carros/volkswagen-golf-variant-6af463cab21c8523ff417cbef869eecb.shtml',
        //'http://info.abril.com.br/tvinfo-novo/infolab/acessorios/teclado-razer-oferece-conforto-gamers-c4df9b5e08569310c49fec0a365d8866.shtml',
        //'http://info.abril.com.br/tvinfo-novo/infolab/som-video/micro-system-vocacao-dock-avancada-5774531d2682f6cde5ac80411e486fda.shtml',
        
        #band
        //'http://esporte.band.uol.com.br/futebol/selecao/copa-das-confederacoes/2013/videos.asp?id=14471367&t=filipe-luis-se-apresenta-e-diz-quebraria-cara-pela-selecao',
        //'http://videos.band.uol.com.br/programa.asp?e=esporte&pr=os-donos-da-bola&v=14471500',
        //'http://videos.band.uol.com.br/programa.asp?v=14466318&e=esporte&pr=',
        
        #dailymotion
        //'http://www.dailymotion.com/video/xtlt9n_kate-middleton-pillada-en-topless_people',
        
        #espnbrasil
        //'http://www.espn.com.br/video/331885_relembre-golacos-e-grandes-momentos-de-neymar-com-a-camisa-do-santos',
        //'http://espn.com.br/video/276730_campea-do-strikeforce-musa-ronda-rousey-posou-nua-para-a-revista-espn-nos-estados-unidos'        ,
        
        #esporteinterativo
        //'http://br.esporteinterativo.yahoo.com/video/flamengo-sai-perdendo-por-2-010024496.html',
        //'http://br.esporteinterativo.yahoo.com/video/saint-andre-usar%C3%A1-tour-nova-194641930.html',
        
        #flickr
        //'http://www.flickr.com/photos/klawdyo/sets/72157618525048702/',
        //'http://www.flickr.com/photos/shadowplay/sets/59801/',
        
        #foxsports
        //'http://www.foxsports.com.br/videos/42637275-assista-ao-gol-de-all-boys-0-x-1-argentinos-juniors',
        //'http://www.foxsports.com.br/videos/42664732-assista-aos-melhores-lances-de-chievo-1-x-3-lazio',
        
        #funnyordie
        //'http://www.funnyordie.com/videos/fa60d86785/anchorman-2-official-teaser-trailer-2?playlist=featured_videos',
        
        #globotv
        //'http://globotv.globo.com/rede-globo/globo-esporte-sp/t/edicoes/v/arouca-curte-a-primeira-convocacao-para-a-selecao-brasileira/2106745/',
        //'http://g1.globo.com/jornal-nacional/videos/t/edicoes/v/brasileiros-vao-as-compras-para-aproveitar-o-possivel-fim-do-ipi-reduzido/2107606/',
        //'http://sportv.globo.com/videos/fluminense/t/ultimos/v/abel-diz-que-nao-vai-secar-o-atletico-mg-nao-sou-cruzeirense-sou-tricolor/2107683/',
        //'http://globotv.globo.com/globocom/globoesportecom/v/neymar-faz-golaco-em-treino-da-selecao-brasileira/2124562/',
        
        #ig
        //'http://tvig.ig.com.br/variedades/cultura/cabeca-gigante-altera-paisagem-carioca-8a49802639368a220139977432e90e16.html',
        //'http://tvig.ig.com.br/id/8a49800e3979013c013996ea875e0446.html',
        //'http://tvig.ig.com.br/esporte/futebol/futebol-internacional/conca-marca-golaco-em-vitoria-do-guangzhou-evergrande-8a49800e3563e3360136076c2e920f72.html',
        //'http://tvig.ig.com.br/esporte/futebol/futebol-internacional/goleiro-suico-mata-bola-no-peito-e-faz-golaco-incrivel-8a49800e399b957801399d96be8700c7.html',
        
        #metacafe
        //'http://www.metacafe.com/watch/8993220/',
        //'http://www.metacafe.com/watch/8993220/dance_central_3_story_mode_interview_with_lead_designer_matt_boch_destructoid_dlc/',
        
        #msnvideo
        //'http://video.br.msn.com/watch/video/tv-famosidades-27-05/b9w1cup8'        ,
        //'http://video.br.msn.com/watch/video/lg-por-tras-da-porta-o-documentario-episodio-4/1yhosragn',
        
        #myspace
        //'http://br.myspace.com/video/cezzonline/cezz-les-beaux-parleurs/109061388',
        //'http://www.myspace.com/video/vid/109061388',
        
        #olhardigital
        //'http://olhardigital.uol.com.br/negocios/central_de_videos/iphone-5-conheca-os-recursos-que-podem-pintar-no-novo-aparelho#|0|0|1|99',
        //'http://olhardigital.uol.com.br/produtos/central_de_videos/dia-dos-pais-geek#|0|0|1|99',
        
        #PhotoBucket - NÃO FUNCIONA
        //'http://s55.photobucket.com/albums/g134/klawdyossauro/',
        //'http://s55.photobucket.com/albums/g134/klawdyossauro/imagens%20para%20foruns/',
        
        #R7
        //'http://esportes.r7.com/videos/exclusivo-paulinho-fala-sobre-selecao-futuro-no-corinthians-e-mundial/idmedia/5038d63d6b71cc1ec4d91969.html',
        //'http://rederecord.r7.com/video/homem-com-a-pele-mais-elastica-do-mundo-e-uma-das-noticias-mais-malucas-da-internet-505386206b713bde7246ff09/',
        //'http://rederecord.r7.com/video/antonia-fontenelle-fala-sobre-a-sua-personagem-na-novela-balacobaco-505473b86b71e8304f00bb0b',
        
        #redetv
        //'http://www.redetv.com.br/Video.aspx?8,10,289012,entretenimento,tv-fama,vivi-araujo-requebra-na-rua-com-o-salgueiro',
        //'http://www.redetv.com.br/Video.aspx?8,10,289035',
        //'http://www.redetv.com.br/Video.aspx?8,10,289008',
        //'http://www.redetv.com.br/Video.aspx?8,10,289010,entretenimento,tv-fama,lia-khey-conta-se-quer-voltar-em-nova-edicao-do-bbb',
        //'http://www.redetv.com.br/Video.aspx?8,10,289009,entretenimento,tv-fama,ricardo-tozzi-revela-inspiracao-para-fabian',
        
        #scribd
        //'http://pt.scribd.com/doc/103716634/Building-a-Desire-Engine',
        
        #slideshare
        //'http://www.slideshare.net/haraldf/business-quotes-for-2011',
        
        #terratv - Temporariamente removido
        //'http://terratv.terra.com.br/videos/Noticias/Destaques-Noticias/4404-436374/Mundo-linear-da-midia-acabou-diz-Aurelio-Lopes.htm',
        //'http://terratv.terra.com.br/videos/Noticias/vc-reporter/4204-436889/Bueiros-de-area-escolar-de-Ribeirao-Preto-oferecem-risco.htm',
        
        #uolmais
        //'http://mais.uol.com.br/view/13228999',
        //'http://mais.uol.com.br/view/ofj6vrny8naf/goleiro-da-alemanha-franga-contra-os-eua-04028C9C376CDCA14326?types=A&',
        
        #videolog
        //'http://www.videolog.tv/video.php?id=824625',
        //'http://www.videolog.tv/video.php?id=937536',
        //'http://www.videolog.tv/video.php?id=821108',
        
        #vimeo
        //'http://vimeo.com/47698513',
        
        #virgula
        //'http://virgula.uol.com.br/video/esporte/futebol/pes-2013-e-lancado-com-ai-se-eu-te-pego',
        //'http://virgula.uol.com.br/video/diversao/cinema/trailer-de-o-diario-de-tati',
        //'http://virgula.uol.com.br/video/libido/veja-o-making-of-do-ensaio-da-modelo-dani-giacomelli',
        
        #wordpress.tv
        //'http://wordpress.tv/2013/02/14/andrew-nacin-y-u-no-code-well/',
        //'http://wordpress.tv/2013/03/17/chris-lema-success-in-distributed-contexts/',
        //'http://wordpress.tv/2013/05/20/bronson-quick-my-wordpress-development-workflow/',
        
        #yfrog
        //'http://twitter.yfrog.com/mzbnczogslfypthuglyxolnaz',
        //'http://twitter.yfrog.com/jv4a5grijbjslronrzlhdqzqz',
        //'http://yfrog.com/jj7zrsaetuufhrtbhdfargcrz',
        
        #youtube
        //'http://www.youtube.com/watch?v=r_vf4ENRua8&feature=g-all-u',
        //'http://youtu.be/r_vf4ENRua8',
        //'http://youtu.be/r_vf4ENRua8&feature=g-all-u',
        
        #
        #   ADULTOS
        #
        
        
        #xvideos
        //'http://www.xvideos.com/video5032052/free_web_cam_sex_chat',
        //'http://www.xvideos.com/video3374422/perfect_teagen_presley_gets_an_anal_creampie_in_her_tight_teen_ass',
        //'http://www.xvideos.com/video4165253/his_friend_s_super_busty_mom_',
        
        #xhamster
        //'http://xhamster.com/movies/1594325/schoolgirl_chokes_on_orgy_cocks.html',
        //'http://xhamster.com/movies/1542126/broke_slut_pays_her_way_with_pussy.html',
        //'http://xhamster.com/movies/1525582/her_first_time_orgy_exposed.html',
        
        #youporn
        //'http://www.youporn.com/watch/8296838/i-love-em-tick-black-market/?from=vbwn',
        //'http://www.youporn.com/watch/8451044/cum-swapping-sluts-love-that-black-cock-black-market/?from=related3&al=5&from_id=8451044&pos=2',
        //'http://www.youporn.com/watch/8296822/boom-look-at-em-butts-black-market/?from=related3&al=5&from_id=8296822&pos=1',
        
        
        
        
        
/**/));

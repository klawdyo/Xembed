<?php

class String{
    
    
    protected static $self;
    
    /**
      * Construtor
      *
      */
    public function __construct(){
        mb_internal_encoding(Config::read('App.encoding'));
        //mb_internal_encoding('utf-8');
    }
    
    /**
      * Instância singleton
      * 
      * @version
      *     0.1 18/05/2011 Initial
      * 
      * @param string $text Texto a ser verificado
      * @param int $length Tamanho máximo
      */
    public static function instance(){
        if(empty(self::$self)){
            self::$self = new String;
        }
        
        return self::$self;
    }
    
    /**
      * Corta um texto, exibindo somente os $num caracteres do início
      * 
      * @version
      *     0.1 18/05/2011 Initial
      * 
      * @param string $text Texto a ser verificado
      * @param int $length Tamanho máximo
      */
    public static function left($text, $length){
        self::instance();
        return mb_substr($text, 0, $length);
    }
    
    /**
      * Corta um texto, exibindo somente os $num caracteres ao final
      * 
      * @version
      *     0.1 18/05/2011 Initial
      * 
      * @param string $text Texto a ser verificado
      * @param int $length Tamanho máximo
      */
    public static function right($text, $length){
        self::instance();
        return mb_substr($text, -1 * $length);
    }
    
    
    /**
      * Corta um texto em um tamanho definido, adicionando reticências ou outro
      * indicador de continuação ao final.
      * 
      * @version
      *     0.1 Initial
      *     0.2 09/10/2010 Adicionado suporte às funções multi-byte.
      * 
      * @param string $text Texto a ser verificado
      * @param int $length Tamanho máximo
      * @param string $complement Complemento para o texto cortado. O padrão
      *     é reticências: "..."
      * @param bool $cut Define se as palavras podem ser cortadas, caso o
      *     tamanho máximo seja atingido no meio de uma delas.
      *     
      */
    public function slice($text, $length, $complement = '...', $cut = false){
        $newText = mb_substr($text, 0, $length);
        
        //Se na string original, o tamanho definido já representar um espaço,
        //ou seja, o tamanho requerido não decepará a palavra, ou então, se
        //é permitido cortar a palavra na metade com $cut = true
        if(mb_substr($text, $length, 1) == ' ' || $cut === true):
            return $newText . $complement;
        endif;
        
        if(mb_strlen($text) > $length):
            //O último espaço encontrado na string
            $lastSpacePos = mb_strrpos($newText, " ");

            //Tem que encontrar pelo menos 1 espaço. Se encontrar, defina o
            //tamanho a ser cortado como sendo a posição desse espaço
            if($lastSpacePos !== false):
                $length = $lastSpacePos;
            endif;
            
            return mb_substr($newText, 0, $length) . $complement;
        else:
            return $text;
        endif;        
    }
    
    /**
      * Checa se a string passada está em UTF-8
      *
      * @version
      *     0.1 09/10/2010 Initial
      * 
      * @param string $text
      * @return bool TRUE caso a string esteja em utf-8
      */
    public function isUtf8($text){
        return mb_check_encoding($text, 'utf-8');
    }
    
    
    /**
      * Checa se a string passada está em UTF-8
      *
      * @version
      *     0.1 09/10/2010 Initial
      *     
      * @param string $text
      * @param mixed $verifyFollowings A lista dos charsets que serão usados
      *     para verificar se a string informada está em um deles.
      * @return string O nome do charset utilizado na string. A busca é feita
      *     entre os charsets indicados em $verifyFollowings
      */
    public function getCharset($text,
                               $verifyFollowings = array('utf-8', 'iso-8859-1')){
        
        //O "x" corrige um bug da função "mb_detect_string", que falha caso
        //a última letra da string seja acentuada.
        return mb_detect_encoding($text . 'x', $verifyFollowings);
    }
    
    /**
      * Converte para utf8 se ainda não estiver
      *
      * @version
      *     0.1 09/10/2010 Initial
      *
      * @param string $text A string que será convertida
      * @return String O texto convertido
      */
    public function toUtf8($text){
        if(!$this->isUtf8($text)):
            return utf8_encode($text);
        endif;
        
        return $text;
    }
    
    /**
      * Insere os itens do array $data dentro do texto $string em substituição
      * às variáveis precedidas por : (dois-pontos).
      *
      * @example
      *     echo String::insert('Eu gosto de tomar :liquido!', array('liquido' => 'café'));
      *     resultado: Eu gosto de tomar café!
      *     
      * @version
      *     0.1 18/05/2011 Initial
      *     0.2 16/08/2012 Usando a class lib\core\common\String
      * 
      * @param string $string Texto original
      * @param array  $data   Dados a serem adicionados dentro de $string
      */
    public static function insert($string, $data) {
        foreach($data as $key => $value):
            $regex = '%(:' . $key . ')%';
            $string = preg_replace($regex, $value, $string);
        endforeach;
        return $string;
    }

    /**
      * Retorna as variáveis encontradas no texto $string. Variáveis são quaisquer
      * palavras precedidas por dois-pontos.
      *
      * @example
      *     String::extract('Seu nome é :nome e sua idade é :idade');
      *     Retorna array('nome', 'idade');
      *     
      * @version
      *     0.1 18/05/2011 Initial
      *     0.2 16/08/2012 Usando a class lib\core\common\String
      * 
      * @param string $string Texto a ser verificado
      */
    public static function extract($string) {
        preg_match_all('%:([a-zA-Z-_]+)%', $string, $extracted);
        return $extracted[1];
    }

    /**
      * Acrescenta um texto $put em uma posição específica $at dentro de um
      * outro texto $initialText
      * 
      * @version
      *     0.1 18/05/2011 Initial
      * 
      * @param string $initialText Texto inicial
      * @param string $put Texto que será incluído
      * @param int $length Posição de $initialText em que receberá a inclusão de $put
      */
    public static function putAt($initialText, $put, $at){
        return self::left($initialText, $at) . $put . mb_substr($initialText, $at);
    }

    /**
      * Aplica uma máscara $mask a um texto $text.
      * Se $text for maior que $mask, ele será truncado.
      * 
      * @version
      *     0.1 18/05/2011 Initial
      *     0.2 16/08/2012 Adicionado suporte a multi-byte
      * 
      * @param string $text Texto a ser verificado
      * @param string $mask Máscara
      */
    public static function applyMask($text, $mask){
        $length = mb_strlen($text);
        $buff = '';

        $special = array('/', '.', '-', '_', ' ');

        for($i = 0, $j = 0; $i < $length; $i++, $j++){
            if(!isset($text[$i]) || !isset($mask[$j])) break;
            
            if(in_array($mask[$j], $special)){
                $buff .= $mask[$j];
                $j++;
            }
                $buff .= $text[$i];
        }
        
        return $buff;
    }
    
}
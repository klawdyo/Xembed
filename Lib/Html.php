<?php

class Html{
    public static function openTag($tag, $attr = array(), $empty = false) {
        $html = '<' . $tag;
        $attr = self::attr($attr);
        if(!empty($attr)):
            $html .= ' ' . $attr;
        endif;
        $html .= ($empty ? ' /' : '') . '>';
        
        return $html;
    }
    public static function closeTag($tag) {
        return '</' . $tag . '>';
    }
    public static function tag($tag, $content = '', $attr = array(), $empty = false) {
        $html = self::openTag($tag, $attr, $empty);
        if(!$empty):
            $html .= $content . self::closeTag($tag);
        endif;
        
        return $html;
    }
    public static function attr($attr) {
        $attributes = array();
        foreach($attr as $name => $value):
            if($value === true):
                $value = $name;
            elseif($value === false):
                continue;
            endif;
            $attributes []= $name . '="' . $value . '"';
        endforeach;
        
        return join(' ', $attributes);
    }
    public static function link($text, $url = null, $attr = array(), $full = false) {
        if(is_null($url)):
            $url = $text;
        endif;
        
        $attr['href'] = $url;
        
        return self::tag('a', $text, $attr);
    }
    public static function image($src, $attr = array()) {
        $attr += array(
            'alt' => '',
            'title' => array_key_exists('alt', $attr) ? $attr['alt'] : ''
        );

        $attr['src'] = $src;

        return self::tag('img', null, $attr, true);
    }
}
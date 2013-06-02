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
<body><?php
set_time_limit(0);
require_once 'lib/utils/Request.php';

//$this->Xembed->itemHtml = '<li class="xembed item"><dl><dt><img src=":image"></dt><dd>:provider</dd><dd>'.$this->Html->link(':title','/videos/ver/?v=:url').'</dd></dl></li>';

//echo $this->Xform->form()->post()->autoValues(Request::getData())
    //->textarea('urls')->attr('cols', 60)->attr('rows', 8)
    //->close('enviar');
    
//if(Request::isPost()){
    //$d = explode("\n", Request::getData('urls'));
    //pr($d);
    
    //echo $this->Xembed->showcase($d);
//}
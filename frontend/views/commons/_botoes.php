<?php 
use kartik\icons\Icon;

$url = urlencode(Yii::$app->request->absoluteUrl);
$titulo = urlencode($this->title);

$whatsapp = 'https://api.whatsapp.com/send?text='.$titulo.' '.$url;
$facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
$linkedin = 'https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$titulo;
$twitter = 'https://twitter.com/intent/tweet?url='.$url.'&text='.$titulo;
?>


<a href="<?=$whatsapp?>" target="_blank" class="icone icone-whatsapp"><i><?=Icon::show('whatsapp',['framework'=>'fab'])?></i></a>
<a href="<?=$facebook?>" target="_blank" class="icone icone-facebook"><i><?=Icon::show('facebook-f',['framework'=>'fab'])?></i></a>
<a href="<?=$linkedin?>" target="_blank" class="icone icone-linkedin"><i><?=Icon::show('linkedin-in',['framework'=>'fab'])?></i></a>
<a href="<?=$twitter?>" target="_blank"  class="icone icone-twitter"><i><?=Icon::show('twitter',['framework'=>'fab'])?></i></a>

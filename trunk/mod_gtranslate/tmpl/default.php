<?php
/**
* @version   $Id$
* @package   GTranslate
* @copyright Copyright (C) 2008-2012 Edvard Ananyan. All rights reserved.
* @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

if($pro_version or $enterprise_version)
    $method = 'standard';

$lang_array = array('en'=>'English','ar'=>'Arabic','bg'=>'Bulgarian','zh-CN'=>'Chinese (Simplified)','zh-TW'=>'Chinese (Traditional)','hr'=>'Croatian','cs'=>'Czech','da'=>'Danish','nl'=>'Dutch','fi'=>'Finnish','fr'=>'French','de'=>'German','el'=>'Greek','hi'=>'Hindi','it'=>'Italian','ja'=>'Japanese','ko'=>'Korean','no'=>'Norwegian','pl'=>'Polish','pt'=>'Portuguese','ro'=>'Romanian','ru'=>'Russian','es'=>'Spanish','sv'=>'Swedish','ca'=>'Catalan','tl'=>'Filipino','iw'=>'Hebrew','id'=>'Indonesian','lv'=>'Latvian','lt'=>'Lithuanian','sr'=>'Serbian','sk'=>'Slovak','sl'=>'Slovenian','uk'=>'Ukrainian','vi'=>'Vietnamese','sq'=>'Albanian','et'=>'Estonian','gl'=>'Galician','hu'=>'Hungarian','mt'=>'Maltese','th'=>'Thai','tr'=>'Turkish','fa'=>'Persian','af'=>'Afrikaans','ms'=>'Malay','sw'=>'Swahili','ga'=>'Irish','cy'=>'Welsh','be'=>'Belarusian','is'=>'Icelandic','mk'=>'Macedonian','yi'=>'Yiddish','hy'=>'Armenian','az'=>'Azerbaijani','eu'=>'Basque','ka'=>'Georgian','ht'=>'Haitian Creole','ur'=>'Urdu');
$flag_map = array();
$i = $j = 0;
foreach($lang_array as $lang => $lang_name) {
    $flag_map[$lang] = array($i*100, $j*100);
    if($i == 7) {
        $i = 0;
        $j++;
    } else {
        $i++;
    }
}

$flag_map_vertical = array();
$i = 0;
foreach($lang_array as $lang => $lang_name) {
    $flag_map_vertical[$lang] = $i*16;
    $i++;
}

asort($lang_array);
// Move the default language to the first position
$lang_array = array_merge(array($language => $lang_array[$language]), $lang_array);

if(!defined('GTRANSLATE_INCLUDED')) {
    define('GTRANSLATE_INCLUDED', 1);
    echo '<noscript>Javascript is required to use <a href="http://gtranslate.net/">GTranslate</a> <a href="http://gtranslate.net/">website translator</a>, <a href="http://gtranslate.net/">free translator</a></noscript>';
?>

<?php if($method == 'standard' or $method == 'ajax'): ?>
<script type="text/javascript">
/* <![CDATA[ */
<?php if($new_tab): ?>
    function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}
    <?php if($pro_version): ?>
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);<?php endif; ?>var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';openTab(location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang+'/', '/')+location.search);}
    <?php elseif($enterprise_version): ?>
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);<?php endif; ?>var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw')plang='<?php echo $language; ?>';openTab(location.protocol+'//'+(lang == '<?php echo $language; ?>' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(plang + '.', '')+location.pathname+location.search);}
    <?php else: ?>
    if(top.location!=self.location)top.location=self.location;
    window['_tipoff']=function(){};window['_tipon']=function(a){};
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);<?php endif; ?>if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')openTab(unescape(gfg('u')));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href));else openTab('http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u')));}
    function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
    <?php endif; ?>
<?php else: ?>
    <?php if($pro_version): ?>
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);<?php endif; ?>var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW')plang='<?php echo $language; ?>';location.href=location.protocol+'//'+location.host+'/'+lang+location.pathname.replace('/'+plang+'/', '/')+location.search;}
    <?php elseif($enterprise_version): ?>
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);<?php endif; ?>var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw')plang='<?php echo $language; ?>';location.href=location.protocol+'//'+(lang == '<?php echo $language; ?>' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(plang + '.', '')+location.pathname+location.search;}
    <?php else: ?>
    if(top.location!=self.location)top.location=self.location;
    window['_tipoff']=function(){};window['_tipon']=function(a){};
    function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;if(location.hostname=='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')return;var lang=lang_pair.split('|')[1];<?php if($analytics): ?>if(typeof _gaq=='undefined')alert('Google Analytics is not installed, please turn off Analytics feature in GTranslate');else _gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);<?php endif; ?>if(location.hostname!='<?php echo $main_url; ?>' && lang_pair=='<?php echo $language; ?>|<?php echo $language; ?>')location.href=unescape(gfg('u'));else if(location.hostname=='<?php echo $main_url; ?>' && lang_pair!='<?php echo $language; ?>|<?php echo $language; ?>')location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+escape(location.href);else location.href='http://translate.google.com/translate?client=tmpg&hl=en&langpair='+lang_pair+'&u='+unescape(gfg('u'));}
    function gfg(name) {name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(location.href);if(results==null)return '';return results[1];}
    <?php endif; ?>
<?php endif; ?>
/* ]]> */
</script>
<?php endif; ?>

<?php if($method == 'onfly'): ?>
<script type="text/javascript">
/* <![CDATA[ */
function GTranslateFireEvent(element, event) {try {if (document.createEventObject){var evt = document.createEventObject();element.fireEvent('on'+event,evt);} else {var evt = document.createEvent("HTMLEvents");evt.initEvent(event, true, true );element.dispatchEvent(evt);}} catch (e) {}}
function doGTranslate(lang_pair) {
    if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];
    if(document.getElementById('google_translate_element') == null || document.getElementById('google_translate_element').innerHTML.length == 0 || document.getElementsByClassName('goog-te-combo').length == 0  || document.getElementsByClassName('goog-te-combo')[0].innerHTML.length == 0) {setTimeout(function() { doGTranslate(lang_pair); }, 500);}
    else {
        document.getElementsByClassName('goog-te-combo')[0].value = lang;
        GTranslateFireEvent(document.getElementsByClassName('goog-te-combo')[0],'change');
        GTranslateFireEvent(document.getElementsByClassName('goog-te-combo')[0],'change');
    }
}
/* ]]> */
</script>
<?php endif; ?>

<?php if($method == 'google_default'): ?>
<?php
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-gadget-icon {background-image:url(http://joomla-gtranslate.googlecode.com/svn/trunk/gt_logo_19x19.gif) !important;background-position:0 0 !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
");
?>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: '<?php echo $language; ?>',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay: false,
    includedLanguages: '<?php
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo $lang.',';
    }
    ?>'
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php return; endif; ?>

<?php if($method == 'onfly'): ?>
<?php
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element {display:none!important;}
");
?>
<div id="google_translate_element"></div>
<script type="text/javascript">function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: '<?php echo $language; ?>', autoDisplay: false}, 'google_translate_element');}</script>
<script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php endif; ?>

<?php
    $document =& JFactory::getDocument();
    $document->addStyleDeclaration("
        a.flag {font-size:{$flag_size}px;padding:1px 0;background-repeat:no-repeat;background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/' . $flag_size . 'a.png' . "');}
        a.flag:hover {background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/' . $flag_size.'.png' . "');}
        a.flag img {border:0;}
        a.alt_flag {font-size:{$flag_size}px;padding:1px 0;background-repeat:no-repeat;background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/alt_flagsa.png' . "');}
        a.alt_flag:hover {background-image:url('" . JURI::root(true) . '/modules/mod_gtranslate/tmpl/lang/alt_flags.png' . "');}
        a.alt_flag img {border:0;}
    ");
}

if($look == 'flags') {
    $session =& JFactory::getSession();
    $uri = JURI::getInstance();
    foreach($lang_array as $lang => $lang_name) {
        if($pro_version)
            $href = ($language == $lang) ? $uri->toString() : '/' . $lang . str_replace('/' . $session->get('glang', $language) . '/', '/', $uri->toString(array('path', 'query')));
        elseif($enterprise_version)
            $href = ($language == $lang) ? $uri->toString() : $uri->getScheme() . '://' . $lang . '.' . str_replace('www.', '', $uri->toString(array('host', 'path', 'query')));
        else
            $href = '#';

        $show_this = 'show_'.str_replace('-', '', $lang);
        list($flag_x, $flag_y) = $flag_map[$lang];
        if($$show_this) {
            if($$show_this == '3') {
                switch($lang) {
                    case 'en':
                        $flag_x = 0;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                    case 'pt':
                        $flag_x = 100;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                    case 'es':
                        $flag_x = 200;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                }
            }
            else
                echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="flag nturl" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a>';
            if($orientation == 'v')
                echo '<br />';
            else
                echo ' ';
        }
    }
} elseif ($look == 'dropdown') {
    echo '<select onchange="doGTranslate(this);">';
    echo '<option value="">Select Language</option>';
    $i = 0;
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        $flag_y = $flag_map_vertical[$lang];
        if($$show_this)
            echo '<option value="'.$language.'|'.$lang.'" style="'.($lang == $language ? 'font-weight:bold;' : '').'background:url(\''.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/16l.png\') no-repeat scroll 0 -'.$flag_y.'px;padding-left:18px;">'.$lang_name.'</option>';
    }
    echo '</select>';
} else {
    $session =& JFactory::getSession();
    $uri = JURI::getInstance();
    foreach($lang_array as $lang => $lang_name) {
        if($pro_version)
            $href = ($language == $lang) ? $uri->toString() : '/' . $lang . str_replace('/' . $session->get('glang', $language) . '/', '/', $uri->toString(array('path', 'query')));
        elseif($enterprise_version)
            $href = ($language == $lang) ? $uri->toString() : $uri->getScheme() . '://' . $lang . '.' . str_replace('www.', '', $uri->toString(array('host', 'path', 'query')));
        else
            $href = '#';

        $show_this = 'show_'.str_replace('-', '', $lang);
        list($flag_x, $flag_y) = $flag_map[$lang];
        if($$show_this == '2')
            echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="flag nturl" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
        elseif($$show_this == '3') {
            switch($lang) {
                    case 'en':
                        $flag_x = 0;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag nturl" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                    case 'pt':
                        $flag_x = 100;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag nturl" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                    case 'es':
                        $flag_x = 200;
                        if($flag_size == 16)
                            $flag_y = 0;
                        if($flag_size == 24)
                            $flag_y = 100;
                        if($flag_size == 32)
                            $flag_y = 200;
                        echo '<a href="'.$href.'" onclick="doGTranslate(\''.$language.'|'.$lang.'\');return false;" title="'.$lang_name.'" class="alt_flag nturl" style="background-position:-'.$flag_x.'px -'.$flag_y.'px;"><img src="'.JURI::root(true).'/modules/mod_gtranslate/tmpl/lang/blank.png" height="'.$flag_size.'" width="'.$flag_size.'" alt="'.$lang_name.'" /></a> ';
                        break;
                }
        }
    }
    echo '<br/><select onchange="doGTranslate(this);">';
    echo '<option value="">Select Language</option>';
    foreach($lang_array as $lang => $lang_name) {
        $show_this = 'show_'.str_replace('-', '', $lang);
        if($$show_this)
            echo '<option '.($lang == $language ? 'style="font-weight:bold;"' : '').' value="'.$language.'|'.$lang.'">'.$lang_name.'</option>';
    }
    echo '</select>';
}
?>
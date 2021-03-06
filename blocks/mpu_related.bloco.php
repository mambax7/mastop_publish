<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Bloco de Páginas Relacionadas
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
if (!defined('MPU_MOD_DIR')) {
    if (file_exists(XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
        require_once XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/language/' . $xoopsConfig['language'] . '/modinfo.php';
    } else {
        require_once XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/language/portuguesebr/modinfo.php';
    }
}
function mpu_related_exibe($options)
{
    require_once XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/class/Publish.class.php';
    $tac               = \Xmf\Request::getInt('tac', 0, 'GET');
    $tac               = is_int($tac) ? $tac : str_replace('_', ' ', $tac);
    $block             = [];
    $block['relateds'] = 0;
    $style             = "style='font-size:" . $options[0] . '; color:#' . $options[1] . "'";
    if (!$tac) {
        return false;
    } else {
        $mpu_classe = new Publish($tac);
        if ('' != $mpu_classe->getVar('mpb_10_id') && 0 != $mpu_classe->getVar('mpb_10_idpai')) {
            $rel_crit = new \CriteriaCompo(new \Criteria('mpb_10_idpai', $mpu_classe->getVar('mpb_10_idpai')));
            $rel_crit->add(new \Criteria('mpb_10_id', $mpu_classe->getVar('mpb_10_id'), '<>'));
            $rel_crit->add(new \Criteria('mpb_12_semlink', 0));
            $rel_crit2 = new \CriteriaCompo(new \Criteria('mpb_11_visivel', 2));
            $rel_crit2->add(new \Criteria('mpb_11_visivel', 3), 'OR');
            $rel_crit->add($rel_crit2);
            $rel_crit->setSort('mpb_10_ordem');
            $all_related = $mpu_classe->PegaTudo($rel_crit);
            if ($all_related) {
                foreach ($all_related as $k => $v) {
                    if (strlen($v->getVar($options[2])) > $options[3]) {
                        $titulo = substr($v->getVar($options[2]), 0, $options[3]) . '...';
                    } else {
                        $titulo = $v->getVar($options[2]);
                    }
                    $block['relpages'][$k]['titulo'] = $titulo;
                    $block['relpages'][$k]['link']   = $v->pegaLink();
                }
                $block['relateds'] = 1;
                $block['style']    = $style;

                return $block;
            }
        } else {
            return false;
        }
    }
}

function mpu_related_edita($options)
{
    $picker_url = XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/assets/js/color_picker';
    $form       = '
    <style type="text/css">
<!--
#plugin { BACKGROUND: #0d0d0d; COLOR: #AAA; CURSOR: move; DISPLAY: none; font-family: Arial, sans-serif; FONT-SIZE: 11px; PADDING: 7px 10px 11px 10px; _PADDING-RIGHT: 0; Z-INDEX: 1;  POSITION: absolute; WIDTH: 199px; _width: 210px; _padding-right: 0px; }
#plugin br { CLEAR: both; MARGIN: 0; PADDING: 0;  }
#plugin select { BORDER: 1px solid #333; BACKGROUND: #FFF; POSITION: relative; TOP: 4px; }

#plugHEX { FLOAT: left; }
#plugCLOSE { CURSOR: pointer; FLOAT: right; MARGIN: 0 8px 3px; _MARGIN-RIGHT: 10px; COLOR: #FFF; -moz-user-select: none; -khtml-user-select: none; user-select: none; }
#plugHEX:hover,#plugCLOSE:hover { COLOR: #FFD000;  }

#SV { background: #FF0000 url("' . $picker_url . '/SatVal.png"); _BACKGROUND: #FF0000; POSITION: relative; CURSOR: crosshair; FLOAT: left; HEIGHT: 166px; WIDTH: 167px; _WIDTH: 165px; MARGIN-RIGHT: 10px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . $picker_url . '/SatVal.png", sizingMethod="scale"); -moz-user-select: none; -khtml-user-select: none; user-select: none; }
#SVslide { BACKGROUND: url("' . $picker_url . '/slide.gif"); HEIGHT: 9px; WIDTH: 9px; POSITION: absolute; _font-size: 1px; line-height: 1px; }

#H { BORDER: 1px solid #000; CURSOR: crosshair; FLOAT: left; HEIGHT: 154px; POSITION: relative; WIDTH: 19px; PADDING: 0; TOP: 4px; -moz-user-select: none; -khtml-user-select: none; user-select: none; }
#Hslide { BACKGROUND: url("' . $picker_url . '/slideHue.gif"); HEIGHT: 5px; WIDTH: 33px; POSITION: absolute; _font-size: 1px; line-height: 1px; }
#Hmodel { POSITION: relative; TOP: -5px; }
#Hmodel div { HEIGHT: 1px; WIDTH: 19px; font-size: 1px; line-height: 1px; MARGIN: 0; PADDING: 0; }
-->
</style>
 <script src="' . $picker_url . '/plugin.js" type="text/JavaScript"></script>
 <script type="text/javascript">
var atual_color = "campo_img";
var atual_campo = "campo";
function pegaPicker(campo, e)
{
atual_color = campo.name+"_img";
atual_campo = campo.name;
$S("plugin").left= (XY(e)-10)+"px";
$S("plugin").top= (XY(e,1)+10)+"px";
toggle("plugin");
loadSV();
updateH(campo.value);
$("plugHEX").innerHTML=campo.value
}

function mkColor(v)
{
$S(atual_color).background="#"+v;
$(atual_campo).value=v;
}
function troca(campo, nome)
{
if (campo.checked) {
$(nome).value = 1;
} else {
$(nome).value = 0;
}
}
</script>
    ';
    $form       .= <<< PICKER
    <div id="plugin" onmousedown="HSVslide('drag','plugin',event)" style="Z-INDEX: 20; display:none">
 <div id="plugHEX" onmousedown="stop=0; setTimeout('stop=1',100); toggle('plugin');">&nbsp</div><div id="plugCLOSE" onmousedown="toggle('plugin')">X</div><br>
 <div id="SV" onmousedown="HSVslide('SVslide','plugin',event)" title="Saturation + Value">
  <div id="SVslide" style="TOP: -4px; LEFT: -4px;"><br></div>
 </div>
 <div id="H" onmousedown="HSVslide('Hslide','plugin',event)" title="Hue">
  <div id="Hslide" style="TOP: -7px; LEFT: -8px;"><br></div>
  <div id="Hmodel"></div>
 </div>
</div>
PICKER;
    $form       .= MPU_BLO_OPT_FONTSIZE . " <input type='text' name='options[0]' value='" . $options[0] . "'><br>";
    $form       .= MPU_BLO_OPT_FONTCOLOR
                   . ' #<input size="6" type="text" name="options[1]" id="options[1]" value="'
                   . $options[1]
                   . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[1]_img" align="absmiddle" src="'
                   . $picker_url
                   . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[1]"), event)\' style="border: 2px solid #DEE3E7; background: #'
                   . $options[1]
                   . '"><br>';
    $form       .= MPU_BLO_SHOW . " <select name='options[2]'>
    <option value='mpb_30_menu'";
    $form       .= ('mpb_30_menu' === $options[2]) ? 'selected' : ' ';
    $form       .= '>' . MPU_BLO_MPB_30_MENU . "</option>
    <option value='mpb_30_titulo'";
    $form       .= ('mpb_30_titulo' === $options[2]) ? 'selected' : ' ';
    $form       .= '>' . MPU_BLO_MPB_30_TITULO . '</option></select><br>';
    $form       .= MPU_BLO_OPT_CARACTS . " <input type='text' name='options[3]' value='" . $options[3] . "'>";

    return $form;
}

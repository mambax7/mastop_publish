<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Bloco do Menu Horizontal CSS
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
function mpu_menuhor_exibe($options)
{
    require_once XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/class/Publish.class.php';
    $mpu_classe            = new Publish();
    $block                 = [];
    $options[0]            = empty($options[0]) ? mt_rand(0, 9999) : $options[0];
    $block['menuID']       = 'menu_' . $options[0];
    $block['menuHome']     = $options[1];
    $block['textHome']     = $options[2];
    $block['menuWidth']    = $options[4];
    $block['menuWidthSub'] = $options[5];
    $block['menuArrow']    = $options[6];
    $block['menuBG']       = $options[7];
    $block['menuBGO']      = $options[8];
    $block['menuTColor']   = $options[9];
    $block['menuTOColor']  = $options[10];
    $block['menuVisited']  = $options[11];
    $block['menuN']        = (!empty($options[12])) ? 'bold' : 'normal';
    $block['menuI']        = (!empty($options[13])) ? 'italic' : 'normal';
    $block['menuU']        = (!empty($options[14])) ? 'underline' : 'none';
    $block['menuON']       = (!empty($options[15])) ? 'bold' : 'normal';
    $block['menuOI']       = (!empty($options[16])) ? 'italic' : 'normal';
    $block['menuOU']       = (!empty($options[17])) ? 'underline' : 'none';
    $block['menuBorderW']  = $options[18];
    $block['menuBorderS']  = $options[19];
    $block['menuBorderC']  = $options[20];
    $block['menuBorderOW'] = $options[21];
    $block['menuBorderOS'] = $options[22];
    $block['menuBorderOC'] = $options[23];
    $block['menuPadding']  = $options[24];
    $exibe_subpgs          = ($options[25] > 0) ? new \CriteriaCompo(new \Criteria('mpb_10_idpai', $options[25])) : null;
    $block['menuHOR']      = $mpu_classe->geraMenuCSS($exibe_subpgs, ((0 == $options[25]) ? $options[3] : false));
    $block['variante']     = $options[0];

    return $block;
}

function mpu_menuhor_edita($options)
{
    require_once XOOPS_ROOT_PATH . '/modules/' . MPU_BLO_MODDIR . '/class/Publish.class.php';
    if (!defined('MPU_ADM_MENUP')) {
        define('MPU_ADM_MENUP', _ALL);
    }
    $mpu_classe = new Publish();
    $paginas    = $mpu_classe->geraMenuSelect(0, false);
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

    $form .= MPU_BLO_OPT_ID . " <input type='text' name='options[0]' value='" . (empty($options[0]) ? mt_rand(0, 9999) : $options[0]) . "'><br>";
    $form .= MPU_BLO_OPT_HOME . "&nbsp;<input type='radio' name='options[1]' value='1'";
    if (1 == $options[1]) {
        $form .= ' checked';
    }
    $form .= '>&nbsp;' . _YES . "<input type='radio' name='options[1]' value='0'";
    if (0 == $options[1]) {
        $form .= ' checked';
    }
    $form .= '>&nbsp;' . _NO . '<br>';
    $form .= MPU_BLO_OPT_HOMETEXT . " <input type='text' name='options[2]' value='" . $options[2] . "'><br>";
    $form .= MPU_BLO_OPT_MOD . "&nbsp;<input type='radio' name='options[3]' value='1'";
    if (1 == $options[3]) {
        $form .= ' checked';
    }
    $form .= '>&nbsp;' . _YES . "<input type='radio' name='options[3]' value='0'";
    if (0 == $options[3]) {
        $form .= ' checked';
    }
    $form .= '>&nbsp;' . _NO . '<br>';
    $form .= MPU_BLO_OPT_WIDTH . " <input type='text' size='4' name='options[4]' value='" . $options[4] . "'><br>";
    $form .= MPU_BLO_OPT_WIDTH_SUB . " <input type='text' size='4' name='options[5]' value='" . $options[5] . "'><br>";
    $form .= MPU_BLO_OPT_URLARROW . " <input type='text' size='35' name='options[6]' value='" . $options[6] . "' onblur=\"document.getElementById('menuImage').src=this.value\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id='menuImage' src='" . $options[6] . "'><br>";
    $form .= MPU_BLO_OPT_BGMENU
             . ' #<input size="6" type="text" name="options[7]" id="options[7]" value="'
             . $options[7]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[7]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[7]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[7]
             . '"><br>';
    $form .= MPU_BLO_OPT_BGMENUO
             . ' #<input size="6" type="text" name="options[8]" id="options[8]" value="'
             . $options[8]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[8]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[8]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[8]
             . '"><br>';
    $form .= MPU_BLO_OPT_MENUTCOLOR
             . ' #<input size="6" type="text" name="options[9]" id="options[9]" value="'
             . $options[9]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[9]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[9]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[9]
             . '"><br>';
    $form .= MPU_BLO_OPT_MENUTOCOLOR
             . ' #<input size="6" type="text" name="options[10]" id="options[10]" value="'
             . $options[10]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[10]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[10]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[10]
             . '"><br>';
    $form .= MPU_BLO_OPT_MENUVISITED
             . ' #<input size="6" type="text" name="options[11]" id="options[11]" value="'
             . $options[11]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[11]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[11]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[11]
             . '"><br>';
    $form .= MPU_BLO_OPT_FONT
             . "<input type='hidden' name='options[12]' id='options[12]' value='"
             . ((!empty($options[12])) ? '1' : '0')
             . "'><label><input type='checkbox' name='chk[12]' value='1' "
             . ((!empty($options[12])) ? ' checked' : '')
             . " onclick='troca(this, \"options[12]\")'> <b>"
             . MPU_BLO_OPT_BOLD
             . "</b></label>&nbsp;&nbsp;&nbsp;<input type='hidden' name='options[13]' id='options[13]' value='"
             . ((!empty($options[13])) ? '1' : '0')
             . "'><label><input type='checkbox' name='chk[13]' value='1' "
             . ((!empty($options[13])) ? ' checked' : '')
             . " onclick='troca(this, \"options[13]\")'> <i>"
             . MPU_BLO_OPT_ITALIC
             . "</i></label>&nbsp;&nbsp;&nbsp;<input type='hidden' name='options[14]' id='options[14]' value='"
             . ((!empty($options[14])) ? '1' : '0')
             . "'><label><input type='checkbox' name='options[14]' value='1' "
             . ((!empty($options[14])) ? ' checked' : '')
             . " onclick='troca(this, \"options[14]\")'> <u>"
             . MPU_BLO_OPT_UNDERLINE
             . '</u></label><br>';
    $form .= MPU_BLO_OPT_FONTO
             . "<input type='hidden' name='options[15]' id='options[15]' value='"
             . ((!empty($options[15])) ? '1' : '0')
             . "'><label><input type='checkbox' name='options[15]' value='1' "
             . ((!empty($options[15])) ? ' checked' : '')
             . " onclick='troca(this, \"options[15]\")'> <b>"
             . MPU_BLO_OPT_BOLD
             . "</b></label>&nbsp;&nbsp;&nbsp;<input type='hidden' name='options[16]' id='options[16]' value='"
             . ((!empty($options[16])) ? '1' : '0')
             . "'><label><input type='checkbox' name='options[16]' value='1' "
             . ((!empty($options[16])) ? ' checked' : '')
             . " onclick='troca(this, \"options[16]\")'> <i>"
             . MPU_BLO_OPT_ITALIC
             . "</i></label>&nbsp;&nbsp;&nbsp;<input type='hidden' name='options[17]' id='options[17]' value='"
             . ((!empty($options[17])) ? '1' : '0')
             . "'><label><input type='checkbox' name='options[17]' value='1' "
             . ((!empty($options[17])) ? ' checked' : '')
             . " onclick='troca(this, \"options[17]\")'> <u>"
             . MPU_BLO_OPT_UNDERLINE
             . '</u></label><br>';
    $form .= MPU_BLO_OPT_BORDER . " <input size='4' type='text' name='options[18]' value='" . $options[18] . "'> <select name='options[19]'>
    <option value='none'";
    $form .= ('none' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_NONE . "</option>
    <option value='solid'";
    $form .= ('solid' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_SOLID . "</option>
    <option value='double'";
    $form .= ('double' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DOUBLE . "</option>
    <option value='outset'";
    $form .= ('outset' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_OUTSET . "</option>
    <option value='inset'";
    $form .= ('inset' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_INSET . "</option>
    <option value='groove'";
    $form .= ('groove' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_GROOVE . "</option>
    <option value='ridge'";
    $form .= ('ridge' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_RIDGE . "</option>
    <option value='dashed'";
    $form .= ('dashed' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DASHED . "</option>
    <option value='dotted'";
    $form .= ('dotted' === $options[19]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DOTTED . '</option></select>';
    $form .= ' #<input size="6" type="text" name="options[20]" id="options[20]" value="'
             . $options[20]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[20]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[20]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[20]
             . '"><br>';
    $form .= MPU_BLO_OPT_BORDERO . " <input size='4' type='text' name='options[21]' value='" . $options[21] . "'> <select name='options[22]'>
    <option value='none'";
    $form .= ('none' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_NONE . "</option>
    <option value='solid'";
    $form .= ('solid' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_SOLID . "</option>
    <option value='double'";
    $form .= ('double' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DOUBLE . "</option>
    <option value='outset'";
    $form .= ('outset' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_OUTSET . "</option>
    <option value='inset'";
    $form .= ('inset' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_INSET . "</option>
    <option value='groove'";
    $form .= ('groove' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_GROOVE . "</option>
    <option value='ridge'";
    $form .= ('ridge' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_RIDGE . "</option>
    <option value='dashed'";
    $form .= ('dashed' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DASHED . "</option>
    <option value='dotted'";
    $form .= ('dotted' === $options[22]) ? 'selected' : ' ';
    $form .= '>' . MPU_BLO_OPT_DOTTED . '</option></select>';
    $form .= ' #<input size="6" type="text" name="options[23]" id="options[23]" value="'
             . $options[23]
             . '" onblur=\'$S(this.name+"_img").background="#"+this.value;\'><img id="options[23]_img" align="absmiddle" src="'
             . $picker_url
             . '/color.gif" onmouseover="this.style.border=\'2px solid black\'"  onmouseout="this.style.border=\'2px solid #DEE3E7\'" onclick=\'pegaPicker($("options[23]"), event)\' style="border: 2px solid #DEE3E7; background: #'
             . $options[23]
             . '"><br>';
    $form .= MPU_BLO_OPT_PADDING . " <input type='text' size='4' name='options[24]' value='" . $options[24] . "'><br>";
    $form .= MPU_BLO_OPT_EXIBE . " <select name='options[25]'>";
    if (!empty($paginas) && is_array($paginas)) {
        foreach ($paginas as $k => $v) {
            $form .= "<option value='$k'";
            if ($k == $options[25]) {
                $form .= ' selected';
            }
            $form .= '>' . $v . '</option>';
        }
    }
    $form .= '</select>';

    return $form;
}

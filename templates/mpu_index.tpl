<!-- Mastop Publish V.<{$mpversion}>  - http://www.mastop.com.br -->
<{$navigation}>
<{if $mpb_30_titulo}><h1><{$mpb_30_titulo}></h1><{/if}>
<{$content}>
<{if $relateds}>
<b>
    <b><{$related_label}></b>
    <ul>
        <{foreach item=rel from=$relpages}>
            <li><a href="<{$rel.link}>"><{$rel.titulo}></a></li>
        <{/foreach}>
    </ul>
    <{/if}>


    <div style="padding: 0px; text-align: right; margin-right:3px;">
        <{if $xoops_isadmin||$mpu_isauthor}>
            <{$tools_image}>
            <div id="admin_page"
                 style="text-align:left; clear: right; float: right;    width: 270px; padding-left: 10px; padding-bottom: 5px; border: 2px solid #9C9C9C; background-color: #F2F2F2; display:none; margin: 10px 10px 10px 10px; z-index:10000">
                <h4><{$infos}></h4>
                <{$autor}><b>
                    <{$criado}><b>
                        <{$atualizado}><b><b>
                                <{$contador}><b><b>
                                        <{$zerar_cont}> <{$editar_pagina}>
            </div>
        <{/if}><{$recomendar}><{$imprimir}>
    </div>

    <{if $comentarios == 1}>
        <br>
        <br>
        <div style="text-align: center; padding: 3px; margin: 3px;">
            <{$commentsnav}>
            <{$lang_notice}>
        </div>
        <div style="margin: 3px; padding: 3px;">
            <!-- Comentários -->
            <{if $comment_mode == "flat"}>
                <{include file="db:system_comments_flat.tpl"}>
            <{elseif $comment_mode == "thread"}>
                <{include file="db:system_comments_thread.tpl"}>
            <{elseif $comment_mode == "nest"}>
                <{include file="db:system_comments_nest.tpl"}>
            <{/if}>
            <!-- /Comentários -->
        </div>
    <{/if}>

<{if $block.relateds}>
    <ul>
        <{foreach item=rel from=$block.relpages}>
            <li><a <{$block.style}> href="<{$rel.link}>"><{$rel.titulo}></a></li>
        <{/foreach}>
    </ul>
<{/if}>

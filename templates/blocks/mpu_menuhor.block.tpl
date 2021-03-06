<style type="text/css">
    .<{$block.menuID}> ul {
        border-left: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBorderC}> !important;
        margin: 0;
        padding: 0;
        list-style: none outside;
        z-index: 10;
    }

    /*Top level list items*/
    .<{$block.menuID}> ul li {
        position: relative;
        display: inline;
        float: left;
        margin: 0;
        z-index: 15;
    }

    /*Top level menu link items style*/
    .<{$block.menuID}> ul li a {
        display: block;
        width: <{$block.menuWidth}> !important; /*Width of top level menu link items*/
        padding: <{$block.menuPadding}> !important;
        border: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBorderC}> !important;
        border-left-width: 0;
        text-decoration: <{$block.menuU}> !important;
        color: # <{$block.menuTColor}> !important;
        font-style: <{$block.menuI}> !important;
        font-weight: <{$block.menuN}> !important;
        background-color: # <{$block.menuBG}> !important; /*overall menu background color*/
    }

    .<{$block.menuID}> ul li a:visited {
        color: # <{$block.menuVisited}> !important;
    }

    /*1st sub level menu*/
    .<{$block.menuID}> ul li ul {
        list-style: none outside;
        left: 0;
        position: absolute;
        top: 1em; /* no need to change, as true value set by script */
        display: block;
        visibility: hidden;
        z-index: 20;
    }

    /*Sub level menu list items (undo style from Top level List Items)*/
    .<{$block.menuID}> ul li ul li {
        list-style: none outside;
        display: list-item;
        float: none;
    }

    /*All subsequent sub menu levels offset after 1st level sub menu */
    .<{$block.menuID}> ul li ul li ul {
        list-style: none outside;
        left: 159px; /* no need to change, as true value set by script */
        top: 0;
    }

    /* Sub level menu links style */
    .<{$block.menuID}> ul li ul li a {
        display: block;
        width: <{$block.menuWidthSub}> !important; /*width of sub menu levels*/
        border: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBorderC}> !important;
    }

    .<{$block.menuID}> ul li a:hover {
        background-color: # <{$block.menuBGO}> !important;
        color: # <{$block.menuTOColor}> !important;
        text-decoration: <{$block.menuOU}> !important;
        font-style: <{$block.menuOI}> !important;
        font-weight: <{$block.menuON}> !important;
        border: <{$block.menuBorderOW}> <{$block.menuBorderOS}> # <{$block.menuBorderOC}> !important;
        border-left-width: 0;
    }

    /*Background image for top level menu list links */
    .<{$block.menuID}> .mainfoldericon {
        background: url('<{$block.menuArrow}>') no-repeat center right;
        background-color: # <{$block.menuBG}> !important;
    }

    /*Background image for subsequent level menu list links */
    .<{$block.menuID}> .subfoldericon {
        background: url('<{$block.menuArrow}>') no-repeat center right;
        background-color: # <{$block.menuBG}> !important;
    }

    #<{$block.menuID}>_iframe {
        z-index: 10;
        position: absolute;
        display: none;
        background-color: transparent !important;
    }

    /* Holly Hack for IE \*/
    * html .<{$block.menuID}> ul li {
        float: left;
        height: 1%;
    }

    * html .<{$block.menuID}> ul li a {
        height: 1%;
    }

    /* End */

</style>

<script type="text/javascript">

    //SuckerTree Horizontal Menu (Sept 14th, 06)
    //By Dynamic Drive: http://www.dynamicdrive.com/style/

    var menuhorids<{$block.variante}>= ["<{$block.menuID}>1"] //Enter id(s) of SuckerTree UL menus, separated by commas

    function geraMenuHOR <{$block.variante}>() {
        for (var i = 0; i < menuhorids<{$block.variante}>.length; i++) {
            var ultags = document.getElementById(menuhorids<{$block.variante}>[i]).getElementsByTagName("ul")
            for (var t = 0; t < ultags.length; t++) {
                if (ultags[t].parentNode.parentNode.id == menuhorids<{$block.variante}>[i]) { //if this is a first level submenu
                    ultags[t].style.top = ultags[t].parentNode.offsetHeight + "px" //dynamically position first level submenus to be height of main menu item
                    ultags[t].parentNode.getElementsByTagName("a")[0].className = "mainfoldericon"
                }
                else { //else if this is a sub level menu (ul)
                    ultags[t].style.left = ultags[t - 1].getElementsByTagName("a")[0].offsetWidth + "px" //position menu to the right of menu item that activated it
                    ultags[t].parentNode.getElementsByTagName("a")[0].className = "subfoldericon"
                }
                ultags[t].parentNode.onmouseover = function () {
                    this.getElementsByTagName("ul")[0].style.visibility = "visible";
                    if (document.getElementById("<{$block.menuID}>_iframe")) {
                        var iframe = document.getElementById("<{$block.menuID}>_iframe");
                        var submenu = this.getElementsByTagName("UL");
                        if (submenu.length) {
                            iframe.style.top = submenu[0].offsetTop + this.offsetTop;
                            iframe.style.left = submenu[0].offsetLeft + this.offsetLeft;
                            iframe.style.width = submenu[0].scrollWidth + iframe.scrollWidth;
                            iframe.style.height = submenu[0].clientHeight;
                            iframe.style.display = "inline";
                        }
                    }
                }
                ultags[t].parentNode.onmouseout = function () {
                    this.getElementsByTagName("ul")[0].style.visibility = "hidden";
                    if (document.getElementById("<{$block.menuID}>_iframe")) {
                        var iframe = document.getElementById("<{$block.menuID}>_iframe");
                        iframe.style.display = "none";
                    }
                }
            }
        }
    }

    if (window.addEventListener)
        window.addEventListener("load", geraMenuHOR<{$block.variante}>, false)
    else if (window.attachEvent)
        window.attachEvent("onload", geraMenuHOR<{$block.variante}>)

</script>
<div class="<{$block.menuID}>">
    <ul id="<{$block.menuID}>1">
        <{if $block.menuHome}>
            <li><a href="<{$xoops_url}>"
                   style="border-left-width:<{$block.menuBorderW}> !important;"><{$block.textHome}></a></li>
        <{/if}>
        <{$block.menuHOR}>
    </ul>
</div>
<iframe id="<{$block.menuID}>_iframe" scrolling="no" frameborder="0"></iframe>

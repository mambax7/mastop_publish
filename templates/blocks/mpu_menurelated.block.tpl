<{if $block.menurelateds}>
    <style type="text/css">
        .<{$block.menuID}> ul {
            background-color: # <{$block.menuBG}> !important;
            margin: 0px;
            padding: 0px;
            list-style-type: none;
            list-style-position: outside;
            width: <{$block.menuWidth}> !important; /* Largura Menu */
            border-bottom: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBorderC}> !important;
        }

        .<{$block.menuID}> ul li {
            position: relative;
            list-style-type: none;
            list-style-position: outside;
            margin: 0px;
            padding: 0px;
            z-index: 20;
        }

        /*Itens Sub-menu */
        .<{$block.menuID}> ul li ul {
            background-color: # <{$block.menuBG}> !important;
            position: absolute;
            width: <{$block.menuWidthSub}> !important; /*Largura Sub-Menu*/
            top: 0;
            visibility: hidden;
            list-style-type: none;
            list-style-position: outside;
        }

        /* Links Sub-menu */
        .<{$block.menuID}> ul li a {
            display: block;
            overflow: auto; /*force hasLayout in IE7 */
            color: # <{$block.menuTColor}> !important;
            text-decoration: <{$block.menuU}> !important;
            font-style: <{$block.menuI}> !important;
            font-weight: <{$block.menuN}> !important;
            background-color: # <{$block.menuBG}> !important;
            padding: <{$block.menuPadding}> !important;
            border: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBorderC}> !important;
            border-bottom: <{$block.menuBorderW}> <{$block.menuBorderS}> # <{$block.menuBG}> !important;
        }

        .<{$block.menuID}> ul li a:visited {
            color: # <{$block.menuVisited}> !important;
        }

        .<{$block.menuID}> ul li a:hover {
            text-decoration: <{$block.menuOU}> !important;
            font-style: <{$block.menuOI}> !important;
            font-weight: <{$block.menuON}> !important;
            color: # <{$block.menuTOColor}> !important;
            background-color: # <{$block.menuBGO}> !important;
            border: <{$block.menuBorderOW}> <{$block.menuBorderOS}> # <{$block.menuBorderOC}> !important;
        }

        .<{$block.menuID}> .submenuRelated {
            background: url('<{$block.menuArrow}>') no-repeat center right;
            background-color: # <{$block.menuBG}> !important;
        }

        #<{$block.menuID}>_iframe {
            z-index: 10;
            position: absolute;
            display: none;
            background-color: transparent !important;
        }

        /* Hack Maldito IE \*/
        * html .<{$block.menuID}> ul li {
            float: left;
            height: 1%;
        }

        * html .<{$block.menuID}> ul li a {
            height: 1%;
        }

        /* Fim */

    </style>
    <script type="text/javascript">
        var menurelatedids = ["<{$block.menuID}>1"] // id(s) dos menus, separados por vírgula

        function geraMenuRelated() {
            for (var i = 0; i < menurelatedids.length; i++) {
                var ultags = document.getElementById(menurelatedids[i]).getElementsByTagName("ul")
                for (var t = 0; t < ultags.length; t++) {
                    ultags[t].parentNode.getElementsByTagName("a")[0].className = "submenuRelated"
                    if (ultags[t].parentNode.parentNode.id == menurelatedids[i]) //se for um submenu do primeiro nível
                        ultags[t].style.left = ultags[t].parentNode.offsetWidth + "px" //posiciona dinamicamente a posição do primeiro nível de submenu exatamente após o menu principal
                    else //ou se for um sub nível de sub-menu (ul)
                        ultags[t].style.left = ultags[t - 1].getElementsByTagName("a")[0].offsetWidth + "px" //posiciona o menu à direita e ativa
                    ultags[t].parentNode.onmouseover = function () {
                        this.getElementsByTagName("ul")[0].style.display = "block";
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
                        this.getElementsByTagName("ul")[0].style.display = "none";
                        if (document.getElementById("<{$block.menuID}>_iframe")) {
                            var iframe = document.getElementById("<{$block.menuID}>_iframe");
                            iframe.style.display = "none";
                        }
                    }
                }
                for (var t = ultags.length - 1; t > -1; t--) { //outro loop sobre todos os sub menus e usa "display:none" para escondê-los (prevenindo possíveis barras de rolagem)
                    ultags[t].style.visibility = "visible"
                    ultags[t].style.display = "none"
                }
            }
        }

        if (window.addEventListener)
            window.addEventListener("load", geraMenuRelated, false)
        else if (window.attachEvent)
            window.attachEvent("onload", geraMenuRelated)
    </script>
    <div class="<{$block.menuID}>">
        <ul id="<{$block.menuID}>1">
            <{$block.menuRelated}>
        </ul>
    </div>
    <iframe id="<{$block.menuID}>_iframe" scrolling="no" frameborder="0"></iframe>
<{/if}>
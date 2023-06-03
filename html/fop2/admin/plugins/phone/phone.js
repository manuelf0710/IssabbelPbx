plugins['phone'] = (function() {

    //var transfer_code  = pluginconfig['phone']['transfer_code'][''];

    return { 

        loadLang: function(values) {
            var hash = hex_md5(secret+lastkey);
            queuedcommand = "<msg data=\"" + myposition + "|pluginlang|" + language + "~phone" + "|" + hash + "\" />";
            sendcommand();
        },

        setLang: function() {
           $('#phoneframeTitle').html(lang.phone);
           try {
               document.getElementById("phoneiframe").contentWindow.setText();
           } catch(e) { }
        },
        init: function() {

        },
        getImage: function(number) {

            var xhr = jQuery.ajax({
                type: "GET",
                data: {
                    image: number
                },
                url: "vphonebook.php",
                success: function(output, status) {
                    var iframe = $('#phoneiframe');
                    if (output != '') {
                        $('#contact', iframe.contents()).attr('src','../../../../uploads/'+output);
                        $('#phonedialpad', iframe.contents()).hide();
                        $('#contactimage', iframe.contents()).show();
                        $('#dialpadicon', iframe.contents()).show();
                    } else {
                        $('#contact', iframe.contents()).attr('src','../../../../images/user.png');
                        $('#phonedialpad', iframe.contents()).hide();
                        $('#contactimage', iframe.contents()).show();
                        $('#dialpadicon', iframe.contents()).show();
                    }
                }
            });
        },
        notify_popup: function(type,title,text,icon) {
             console.log('phone popup '+type+', title '+title+',text '+text+', icon '+icon);
             var iframe = $('#phoneiframe');
             $('#contact', iframe.contents()).attr('src',icon);
             $('#phonedialpad', iframe.contents()).hide();
             $('#contactimage', iframe.contents()).show();
             $('#dialpadicon', iframe.contents()).show();
        },
        callback_notionline: function(nro,texto,slot) {

            debug("phone callback notionline my position="+myposition+" and texto = "+texto);

            if(myposition==texto) {
               if(typeof(sipcredentials)=='string') {
                    // prevent positions popup to show on fop2 server reload
                } else {
                    send("<msg data=\""+myposition+"|sipcredentials|0\" />");
                }
            }
        },
        callback_zbuttons: function(nro,texto,slot) {

           if (!(jQuery.inArray('phone', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0)) {
               debug('User does not have phone permissions!');
               return;
           }

           if($('#box_phoneframebox').length<=0) {

               // New bootstrap client
               var newklon = $('<div class="grid-stack-item" id="box_phoneframebox" ><div class="grid-stack-item-content boxstyle boxstylebg"><div id="phoneframecontent" class="widgetcontent widget widget-color"><header role="heading"><div class="widget-ctrls" role="menu"><a class="myclick button-icon widget-toggle-btn langcollapse" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-caret-square-o-up"></i></a><a class="myclick button-icon widget-lock-btn langlockunlock" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="Lock/Unlock"><i class="fa fa-unlock-alt"></i></a></div><span class="handle widget-icon"><i class="fa fa-bars"></i></span><h3><span id="phoneframeTitle">Phone</span></h3></header><div class="widgetscroll" id="phoneframelist" style="height:100%;"><iframe id="phoneiframe" name="phoneiframe" src="" data-isloaded="0" sandbox="allow-modals allow-same-origin allow-scripts allow-popups allow-forms" style="width:100%; height:100%; min-height:500px; border:0; overflow-y: auto;"></iframe><form id="phonevariables" method="post" target="phoneiframe" action="admin/plugins/phone/webrtcphone/index.php"><input type=hidden name="phone_login" id="phone_login" value=""><input type=hidden name="phone_pass" id="phone_pass" value=""><input type=hidden name="server" id="server" value=""></form></div></div></div></div>');
               grid = $('.grid-stack').data('gridstack');

               window.resizinggrid=1;
               if(parseInt(currentrelease.replace(/\./g,''))>23101) {
                   grid.addWidget(newklon,0,0,3,6,true);
               } else {
                   grid.add_widget(newklon,0,0,3,6,true);
               }
               restoreGrid(Base64.decode(mypreferences.grid));
               window.resizinggrid=0;
               $('#box_phoneframebox [data-toggle="tooltip"]').tooltip({container:'body'});

               window.resizinggrid=1;
               var jsongrid = Base64.decode(mypreferences.grid);
               grid.batchUpdate();
               if(jsongrid.length>0) {
                   try {
                       var dita = JSON.parse(jsongrid);
                       for (var item in dita) {
                           if(dita[item].id=='box_phoneframebox') {
                               grid.update($('#'+dita[item].id),dita[item].x,dita[item].y,dita[item].width,dita[item].height);
                           }
                       }
                   } catch(e) {
                       debug('phone Invalid JSON in grid pref');
                   }
               }
               grid.commit();
               window.resizinggrid=0;

               // hide dialbox and dialpad from regular FOP2 gui, handle those from phone plugin
               //$('#dialtext').parent().parent().remove();
               //$('.navinputfilter').css('width','238px');
               $('.dialpad-dropdown').hide();

           }
        },
        callback_SIPCredentials: function(nro,texto,slot) {
            if(myposition==nro) {
                sipcredentials = texto;
                var decoded = Base64.decode(texto);
                var pl = decoded.split('^')[0];
                var pp = decoded.split('^')[1];
                $('#phone_login').val(pl);
                $('#phone_pass').val(pp);
                $('#server').val(window.location.hostname);
                if(pl!='' && pp!='') {
                    $('#phonevariables').submit();
                }
            }
        }
    }
}());

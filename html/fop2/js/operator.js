// Cookie life
var validez = 365;
var caduca = new Date();
caduca.setTime(caduca.getTime() + (validez * 24 * 60 * 60 * 1000));
var return_from_reg_result = 0;
var isMac = navigator.platform.toUpperCase().indexOf('MAC') !== -1;
var audioWav = !! (document.createElement('audio').canPlayType && document.createElement('audio').canPlayType('audio/wav; codecs="1"').replace(/no/, ''));

var grid;
var grid_serialized = '';
var cellheight;

var last_uuid        = '';
var preauth          = 0;
var finalerror       = 0;
var resizinggrid     = 0;
var fopexit          = 0;
var authorized       = 0;
var cuantosBotones   = 0;
var myposition       = 0;
var lostConnection   = 0;
var demora_conexion  = 0;
var attempt          = 1;
var conectado        = 0;
var enable_ping      = 0;
var tlscert          = 0;
var notiChatTitle    = 0;
var sms_enabled      = 0;
var sms_messagesend  = 0;
var chatadm_enabled  = 0;
var ping             = 30;
var pingcount        = 0;
var fullyGetPref     = 0;
var wsconnect        = 0;
var wsdowngrade      = 0;
var xmlsocketdowngrade = 0;
var chatFocus        = 0;
var flashSuccess     = 0;
var port             = 4445;
var host             = '';
var lastkey          = '';
var secret           = '';
var myextension      = '';
var entered_secret   = '';
var entered_extension= '';
var currentrelease   = '';
var currentrlicense  = '';
var voicemailpath    = '';
var queuedcommand    = '';
var currentpresence  = '';
var demoversion      = -1;
var licenselevel     = 1;
var timerID;
var ws;
var smstimer;
var globalselected   = undefined;
var execute          = new commandCenter();
var executeMenu      = new menuCommandCenter();
var plugins          = new Object();
var saveGridPos      = new Object();
var savedTitle       = document.title;
var wsproto          = 'ws://';
var wsprotook        = '';
var alreadynotified  = 0;

var unableToSetAuthSession=1;
var buttontype       = [];
var mypreferences    = [];
var botonitos        = [];
var membercache      = {};
var dict_queue       = [];
var deferredSetVar   = [];
var countDeferredSetVar = [];
var postponedSetVar  = [];
var printy_queue     = {};
var printy_queue_r   = {};
var extenlistGroup   = [];
var queuelistGroup   = [];
var extennumber      = [];
var chanvars         = [];
var extenpos         = [];
var extenlabel       = [];
var extengroup       = [];
var extencontext     = [];
var extenchan        = [];
var extenmail        = [];
var externalnumber   = [];
var extencss         = [];
var extentags        = [];
var availablequeues  = [];
var waitingCalls     = [];
var numAgentes       = [];
var ringclidnum      = [];
var ringfromqueue    = [];
var ringfromqueuenmr = [];
var ringclidname     = [];
var popup_connect_done = [];
var dialednum        = [];
var dialedname       = [];
var permisos         = [];
var displaygroups    = [];

var doingatxfer      = {};
var lastlink         = {};
var lastchat         = {};
var lastmechat       = {};
var myplaceholder    = {};
var tiempos          = {};
var tiemposdirection = {};
var tiemposformat    = {};
var queueindex       = {};
var permisosbtn      = {};
var restrictqueue    = {};
var openchats        = {};
var animado          = {};
var sonido           = {};
var disableActionBtn = {};
var curVmailPage     = {};
var pluginParam      = {};
var ringingchan      = {};

var getExten           = gup("exten");
var getPass            = gup("pass");
var getQueuechannel    = gup("queuechannel");
var getChannel         = gup("channel");
var getPopupUrlRinging = gup("popupurlringing");
var getPopupUrlConnect = gup("popupurlconnect");
var getPopupUrlHangup  = gup("popupurlhangup");

var rtime;
var rtimeout = false;
var rdelta = 200;

$(window).resize(function() {
    rtime = new Date();
    if (rtimeout === false) {
        rtimeout = true;
        setTimeout(resizeend, rdelta);
    }
});

function resizeend() {
    if (new Date() - rtime < rdelta) {
        setTimeout(resizeend, rdelta);
    } else {
        rtimeout = false;
        var headheight = $('#head').height();
        $('body').css('paddingTop',headheight+5);
    }               
}

if (typeof(consoleDebug) == "undefined") {
    consoleDebug = true;
}

if (isSecure()) { wsproto = "wss://"; }

if(typeof(context) === "undefined") {
    context = gup("context");
}

if(typeof(context) === "undefined") {
    context = '';
}

if (context === "") {
    context = 'general';
    setSessionVariable('context', '',1);
} else {
    setSessionVariable('context', context,1);
}

if (typeof(voicemailFormat) == "undefined") {
    voicemailFormat = "wav";
}

if (typeof(enableDragTransfer) == "undefined") {
    enableDragTransfer=true;
}

if (typeof(showLines) == "undefined") {
    showLines = 2;
    debug("show lines " + showLines);
}

if (typeof disableWebSocket == 'undefined') {
    disableWebSocket = false;
}

if (typeof(desktopNotify) == "undefined") {
    desktopNotify = true;
}

if (typeof(disablePresenceOther) == "undefined") {
    disablePresenceOther = false;
}

if (typeof(disablePresence) == "undefined") {
    disablePresence = false;
}

if (typeof disableQueueFilter == 'undefined') {
    disableQueueFilter = false;
}

if (typeof(hideUnregistered) == "undefined") {
    hideUnregistered = false;
}

if (typeof(consoleDebug) == "undefined") {
    consoleDebug = false;
}

$(window).on('beforeunload ', function(evt) {
    debug(evt);
    if (fopexit === 0 && warnClose !== false) {
        if (conectado == 1) {
            var message = lang.areyousure;
            if (typeof evt == 'undefined') {
                evt = window.event;
            }
            if (evt) {
                evt.returnValue = message;
            }
            return message;
        }
    }
});

// Call a php file to keep php sessions open for long time
var refreshTime = 300000; // every 5 minutes in milliseconds
window.setInterval( function() {
    $.ajax({
        cache: false,
        type: "GET",
        data: "refresh=1",
        url: "setvar.php",
        success: function(data) {
        }
    });
}, refreshTime );

function isFloat(n){
    return n === Number(n) && n % 1 !== 0;
}

function mathEval (exp) {
    var reg = /(?:[a-z$_][a-z0-9$_]*)|(?:[;={}\[\]"'!&<>^\\?:])/ig,
        valid = true;

    // Detect valid JS identifier names and replace them
    exp = exp.replace(reg, function ($0) {
        // If the name is a direct member of Math, allow
        if (Math.hasOwnProperty($0))
            return "Math."+$0;
        // Otherwise the expression is invalid
        else
            valid = false;
    });

    // Don't eval if our replace function flagged as invalid
    if (!valid) {
        debug("Invalid arithmetic expression");
        return 0;
    } else {
        try { return (eval(exp)); } catch (e) { debug("Invalid arithmetic expression"); return 0;};
    }
}

dust.helpers.formula = function (chunk, context, bodies, params) {
    var value = dust.helpers.tap(params.value, chunk, context);
    var returnvalue = mathEval(value);
    if(isNaN(returnvalue)) { returnvalue = 0; }
    if(isFloat(returnvalue)) {
        returnvalue = Math.round(returnvalue * 100) / 100;
    }
    return chunk.write(returnvalue);
};

dust.helpers.filter = function(chunk, context, bodies, params) {
    var type = dust.helpers.tap(params.type, chunk, context);
    return chunk.capture(bodies.block, context, function(data, chunk) {
      if (type != null) {
        data = dust.filters[type](data);
      }
      chunk.write(data);
      return chunk.end();
    });
};

dust.filters.hhmmss = function(value) {

    var hours = parseInt(value / 3600, 10);
    var remaining = value - (hours * 3600);
    // minutes
    var minutes = parseInt(remaining / 60, 10);
    remaining = remaining - (minutes * 60);
    // seconds
    var seconds = parseInt(remaining, 10);

    if (hours < 0)    { hours = Math.abs(hours); }
    if (minutes < 0)  { minutes = Math.abs(minutes); }
    if (seconds < 0)  { seconds = Math.abs(seconds); }
    if (hours < 10)   { hours = "0" + hours; }
    if (minutes < 10) { minutes = "0" + minutes; }
    if (seconds < 10) { seconds = "0" + seconds; }
    var texto = "" + hours + ":" + minutes + ":" + seconds;
 
    return texto;
}

dust.filters.mmss = function(value) {

    if(value=="Infinity") { value=0; }

    // minutes
    var minutes = parseInt(value / 60, 10);
    remaining = value - (minutes * 60);
    // seconds
    var seconds = parseInt(remaining, 10);

    if (minutes < 0)  { minutes = Math.abs(minutes); }
    if (seconds < 0)  { seconds = Math.abs(seconds); }
    if (minutes < 10) { minutes = "0" + minutes; }
    if (seconds < 10) { seconds = "0" + seconds; }
    var texto = minutes + ":" + seconds;
 
    return texto;
};

dust.filters.piechart = function(value) {
    var rounded = Math.round(value);
    return "<div class='dustjs easyPieChart chart' data-percent='"+value+"'><span class='percent'>"+value+"</span></div>";
};

dust.filters.ajax = function(url) {
    return $.ajax({
        type: "GET",
        url: url,
        async: false
    }).responseText;
}

// Map slash to filter box
Mousetrap.bind("/", function() {
    $('#filtertext').focus();
    return false;
});

Mousetrap.bind(["t", "d"], function() {
    $('#dialtext').focus();
    return false;
});

Mousetrap.bind(["n"], function() {
    $('.dialpad-dropdown').addClass("open");
    return false;
});

Mousetrap.bind(["0","1","2","3","4","5","6","7","8","9","*","#"], function(e,combo) {
    if( $('.dialpad-dropdown').hasClass("open") ) {
        sendDtmf(combo,0);
    }
    return false;
});

Mousetrap.bind("esc", function() {

    if(($("#logindialog").data('bs.modal') || {}).isShown) {
        // login modal is shown
        $('#myextension').val();
        $('#securitycode').val();
        $('#myextension').focus();
        return;
    }

    $('#filtertext').val('');
    $('#dialtext').val('');
    $('#dialtext').typeahead('val','');
    $('.dialpad-dropdown').removeClass("open");
    filter_list();
});

function gup(name) {
    // Get URI Parameter
    // Extrae parametro de http URI
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null) {
        var resalts = regex.exec(window.name);
        if (resalts == null) {
            return "";
        } else {
            return resalts[1];
        }
    } else {
        return results[1];
    }
}

function debug(message) {
    if (window.console !== undefined && consoleDebug === true) {
        var timestamp = '[' + Date.now() + '] ';
        console.log(timestamp,message);
    }
}

function embed_flash() {

    if(flashSuccess == 0) {
        debug('embed flash');
        var flashvars = {
            callback: "flashConnect"
        };
        var params = {
            allowScriptAccess: "sameDomain"
        };
        swfobject.embedSWF("fop2.swf", "flashconnector", "1", "1", "9.0.0", "expressInstall.swf", flashvars, params, null, flashStatus);
    } else {
        debug('no embed flash, it was already ok');
        flashConnect();
    }
}

function menuCommandCenter() {

    // Acciones de Menu Contextual

    function addmember(target, source) {
        target = availablequeues[target];
        do_addmember(target, source);
    }

    function delmember(target, source) {
        target = availablequeues[target];
        do_delmember(target, source);
    }

    function pause(target, source) {
        if (target == -1) {
            target = '';
        } else {
            target = availablequeues[target];
        }
        qpause(target, source);
    }

    function pausemember(target, source) {
         // Pause with reason from extension menu
         var reason = target;
         qpause('', source, reason);
    }

    function pausequeuemember(queue, source, reason) {
         // Pause with reason from queue menu
         qpause(availablequeues[queue], source, reason);
    }

    function setpenalty(queue, source, penalty) {
         // Set Penalty from queue menu
         qpenalty(availablequeues[queue], source, penalty);
    }

    function unpause(target, source) {
        if (target == -1) {
            target = '';
        } else {
            target = availablequeues[target];
        }
        qunpause(target, source);
    }

    function sms(target, source) {
        if (externalnumber[source] !== undefined) {
            debug("Send sms to " + externalnumber[source]);
            sendsms(externalnumber[source], source);
        } else {
            debug("Try MessageSend to "+source);
            sendsms(0, source);
        }
    }

    function email(target, source) {
        if (extenmail[source] !== undefined) {
            fopexit=1;
            debug("Send mail to " + extenmail[source]);
            $('#mailform').get(0).setAttribute('action', "mailto:" + extenmail[source]);
            $('#mailform').submit();
            myClearTime=setTimeout(function(){fopexit=0;},3000);
        }
    }

    function chat(target, source) {
        debug('chat ' + target + ' con ' + source);
        var chattitle = extennumber[source] + ' ' + extenlabel[source];
        createChat(source, chattitle, 0, '');
    }

    function chatbroadcast(target, title) {
        debug('chat broadcast ' + target + ' con titulo ' + title);
        createChat(target, title, 0, '');
    }

    function notybroadcast(target, title) {
        alertify.set({
            labels: {
                ok: lang.accept,
                cancel: lang.cancel
            }
        });
        alertify.prompt(lang['message'], function(e, str) {
            // str is the input text
            if (e) {
                debug('mando un notify broadcast a ' + target);
                var msg = Base64.encode(str);
                var hash = hex_md5(secret + lastkey);
                var comando = "<msg data=\"" + myposition + "|notify|" + target + "!" + msg + "|" + hash + "\" />";
                send(comando);
            } else {
                // user clicked "cancel"
            }
        }, "");
    }

    function muteall(nro) {
        do_muteall(nro);
    }

    function lock(nro) {
        do_meetmeLock(nro);
    }

    function mute(meetme, usernum, id) {
        do_mute(meetme, usernum, id);
    }

    function kick(meetme, usernum, id) {
        do_kick(meetme, usernum, id);
    }

    function pickup(channel) {
        pickupActive(channel);
    }

    this.addmember = addmember;
    this.delmember = delmember;
    this.pause = pause;
    this.pausemember = pausemember;
    this.pausequeuemember = pausequeuemember;
    this.unpause = unpause;
    this.sms = sms;
    this.email = email;
    this.chat = chat;
    this.chatbroadcast = chatbroadcast;
    this.notybroadcast = notybroadcast;
    this.muteall = muteall;
    this.lock = lock;
    this.mute = mute;
    this.kick = kick;
    this.pickup = pickup;
    this.setpenalty = setpenalty;
}

function commandCenter() {

    function key(nro, texto, slot) {
        enable_ping = 1;
        lastkey = texto;
        if(typeof secret != 'undefined') { sends_auth(); }
        if (getQueuechannel !== "") {
            send("<msg data=\"GENERAL|qchan|" + getQueuechannel + "|\" />");
        }
        if (getChannel !== "") {
            send("<msg data=\"GENERAL|mychan|" + getChannel + "|\" />");
        }
        // show sec box when we receive the key
        showSecBox();
    }

    function reload(nro, texto, slot) {
        // not implemented
    }

    function getvar(nro, texto, slot) {
        // no hace nada
        var textdecode = Base64.decode(texto);
        debug("getvar texto = " + textdecode);
    }

    function agentconnect(nro, texto, slot) {
        // no hace nada
        var partes = texto.split(",");
        var uniqueid = partes[0];
        var queue = partes[1];
    }

    function version(nro, texto, slot) {
        var pepe = texto.split("!");
        currentrelease = pepe[0];
        currentlicense = Base64.decode(pepe[1]);
        licenselevel = pepe[2];
        $('#footer').css('visibility', 'visible');
        $('#footer').css('display', 'block');
        $('#footer').css('background', '#333');
    }

    function incorrect(nro, texto, slot) {
        secret='';
        authorized=0;
        entered_secret = '';
        window.name = '';
        $('#invalidcredentials').html("<div class='alert alert-danger'>" + lang.invalid_credentials + "</div>");

        if (consoleDebug === true) {
            tenants_excluded = parseInt(texto);
            if(tenants_excluded>0) {
                alertify.log('Notice: '+texto+' tenants were excluded due to license limits.');
            }
        }

        showSecBox();
    }

    function correct(nro, texto, slot) {
        setSessionVariableAuth('key', lastkey);
        setSessionVariable('extension', myextension,1);
        $('#invalidcredentials').html("");
        authorized=1;
        $('#myextensionnavbar').html(myextension);
        stored_extension = gup('exten');
        
        if(entered_extension!='' && entered_extension != stored_extension) { 
            window.name = '';  
            debug('clear window name because entered extension '+entered_extension+' is different than stored '+stored_extension); 
        } 
        window.name = addUrlParameter(window.name,'exten',myextension);
        window.name = addUrlParameter(window.name,'pass',secret);
    }

    function defaultpreferences(nro, texto, slot) {
        var textdecode = Base64.decode(texto);
        debug("Got default preferences " + textdecode);
        eval(textdecode);
        var langfile = "js/lang_" + language + ".js";
        jQuery.getScript(langfile, function() {
              setLang();
        });
    }

    function defaultpresence(nro, texto, slot) {
        var textdecode = Base64.decode(texto);
        var data = JSON.parse(textdecode);

        presence = new Object();
        presence[''] = '';

        for (var item in data) {
             var reason = item;
             var hexcolor = data[item];
             presence[reason]=hexcolor;
        }

        setPresenceOptions();

    }


    function preferences(nro, texto, slot) {
        var textdecode = Base64.decode(texto);

        debug("Got stored preferences " + textdecode);

        mypreferences = jQuery.parseJSON(textdecode);

        defaultPreferences();

        if (mypreferences.language !== undefined) {
            if (mypreferences.language != language) {
                language = mypreferences.language;
                var langfile = "js/lang_" + mypreferences.language + ".js";
                jQuery.getScript(langfile, function() {
                    setLang();
                });
            }
        }
    }

    function vmailpath(nro, texto, slot) {
        voicemailpath = texto;
        setSessionVariable('vpath', texto);
    }

    function vmaildetail(nro, texto, slot) {

        if(nro != myposition) {
            return;
        }

        partes = texto.split("!");

        folder = partes[0];

        datos = Base64.decode(partes[1]);

        $('#panel_' + folder).html('');

        var data = jQuery.parseJSON(datos);
        var resp = "<div class='xstable'><table id='vmtable' class='table table-striped'>";
        resp += "<thead><tr><th width='9%'></th><th width='5%'>" + lang.vmail_number + "</th><th width='36%'>" + lang.vmail_date + "</th><th width='40%'>" + lang.vmail_callerid + "</th><th width='10%'>" + lang.vmail_duration + "</th></tr></thead>";
        resp += "<tbody id='table_" + folder + "'>";
        drags = [];
        for (a = 0; a < data[folder].length; a++) {
            if (data[folder][a]['callerid']) {
                var num = a + 1;
                var mid = '';
                if (data[folder][a]['msgid'] === undefined) {
                    mid = "" + data[folder][a]['id'];
                } else {
                    mid = "" + data[folder][a]['msgid'];
                }
                drags.push("drag_" + folder + "_" + mid);
                if (a % 2) {
                    rowclass = "odd";
                } else {
                    rowclass = "data";
                }
                var millitime = data[folder][a]['origtime'] * 1000;
                var tzdate = new Date(millitime);

                var transcript = data[folder][a]['transcript'];
                if(typeof transcript==='undefined') { transcript=''; }

                resp += "<tr class='" + rowclass + " vmdraggable' id='drag_" + folder + "_" + mid + "'>";
                resp += "<td>";
                resp += "<div onclick='javascript:playVmail(\"" + folder + "\",\"" + mid + "\",\"playvm_" + folder + "_" + a + "\");' class='audioButton' data-toggle='tooltip' data-original-title='" + lang.play + "' id='playvm_" + folder + "_" + a + "'>";
                resp += "<img src='images/pixel.gif' width=16 height=16 alt='pixel' border='0' />";
                resp += "</div>"; 
                resp += "<div onclick='javascript:downloadVmail(\"" + folder + "\",\"" + mid + "\",\"downloadvm_" + folder + "_" + a + "\");' class='audioButton dload' data-toggle='tooltip' data-original-title='" + lang.download + "' id='downloadvm_" + folder + "_" + a + "'>";
                resp += "<img src='images/pixel.gif' width=16 height=16 alt='pixel' border='0' />"; 
                resp += "</div>";
                if(transcript!='') {
                    resp += "<i style='font-size: 1.3em; margin-top:2px; margin-left:2px;' class='fa fa-info-circle transcript-tooltip' data-placement='right' data-trigger='hover' data-toggle='popover' title='Transcript' data-content='"+transcript+"'></i>";
                }
                resp += "</td>";
                resp += "<td><span class='msgnum'>" + num + "</span></td>";
                resp += "<td>" + tzdate + "</td><td>" + data[folder][a]['callerid'] + "</td>";
                resp += "<td>" + data[folder][a]['duration'] + " secs.</td></tr>";
            }
        }
        resp += "</tbody></table></div>";
        resp += "<form id='dloadfrm' method='post' onsubmit='resetExit();'><input type=hidden id='file' name='file'/></form>";
        $('#panel_' + folder).html(resp);
        $('#panel_' + folder).css('opacity', '1');

        $(".vmdraggable").draggable({
            scroll: false,
            helper: function() {
                return $("<div class='mailicon' style='visibility:visible;'></div>").append($(this).find('.msgnum').clone().css({fontWeight: 'bold', marginLeft:'5px', marginTop:'3px'}));
            },
            cursorAt: {
                left: 24
            }
        });

        $('#panel_' + folder).find('table').each(function() {

            var currentPage = 0;
            var numPerPage = 10;
            var $table = $(this);
            if (typeof curVmailPage['panel_' + folder] != 'undefined') {
                currentPage = curVmailPage['panel_' + folder];
            }
            $table.bind('repaginate', function() {
                $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
            });
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            if(currentPage > numPages) { currentPage=numPages-1; }
            $table.trigger('repaginate');

            var $pager = $('<ul class="pagination"></ul>');
            var navcont = $('<nav class="text-center"></nav>');
            $pager.appendTo(navcont);

            if (numPages > 1) {
                for (var page = 0; page < numPages; page++) {
                    var li = $('<li></li>');
                    $('<a class="page-number pg_' + (page + 1) + '"></a>').text(page + 1).bind('click', {
                        newPage: page
                    }, function(event) {
                        currentPage = event.data['newPage'];
                        $table.trigger('repaginate');
                        $(this).parent().addClass('active').siblings().removeClass('active');
                        curVmailPage[$(this).parent().parent().parent().attr('id')] = currentPage;
                    }).appendTo(li).addClass('clickable');
                    li.appendTo($pager);
                }
                navcont.insertAfter($table);
                $('<hr>').insertAfter($table);
                $pager.find('a.pg_' + (currentPage + 1)).parent().addClass('active').siblings().removeClass('active');
            }
        });

        setThisTip('vmtable');
        $('[data-toggle="popover"]').popover({ container: 'body' });

    }

    function permit(nro, texto, slot) {

        var textodecode = Base64.decode(texto);
        debug(textodecode);
        permisos = textodecode.split(",");
        setSessionVariable('permit', textodecode);

        // First we receive a permit with general permissions, we clear specific permissions stored in permisosbtn
        permisosbtn = {};
        hideshowtoolbaricons();

        // Esto esta mal, permit incluye permisos custom que pueden estar limitados
        // Usamos permit solo para no deshabilitar botones de accion, pero no son permisos generales con seguridad
        //for (var a=0; a<permisos.length;a++) {
        // Permiso general se aplica a todas las extensiones
        //    if(permisosbtn[permisos[a]]===undefined) { permisosbtn[permisos[a]] = []; }
        //    permisosbtn[permisos[a]].push(0);
        //    debug('hagu un push de cero para '+permisos[a]+' en permisosbtn');
        //}
    }

    function permitbtn(nro, texto, slot) {
        var textodecode = Base64.decode(texto);
        var partes = textodecode.split('!');
        var permisito = partes[0];
        var posiciones = partes[1];
        permisosbtn[permisito] = posiciones.split(',');
        debug('permisosbtn (' + permisito + ')=' + posiciones);

        if (permisito == 'all' && posiciones == 0) {
            debug('Tiene permiso all en general, pongo sesion admin');
            setSessionVariable('admin', 1);
            $('.broadcast').show();
            //if($('#contactsframe').attr('src')=='') {
            //    $('#contactsframe').attr('src','contacts.php');
            //}
        }

        hideshowtoolbaricons();
    }

    function restrictq(nro, texto, slot) {
        var textodecode = Base64.decode(texto);
        var partes = textodecode.split("!");
        var colita = partes[0];
        var posiciones = partes[1];
        restrictqueue[colita] = posiciones;
        debug("queue restrict " + textodecode);
    }

    function zbuttons(nro, texto, slot) {
        debug('en zbuttons');
        membercache = {};  // clear member cache because on automatic reconection we want to show all members as new
        var drawme = 0;
        var lineas = Base64.decode(texto).split("\n");
        for (var x = 0; x < lineas.length; x++) {
            var pepe = lineas[x].split("!");
            var nritoPartes = pepe[0].split("@");
            var nrito = nritoPartes[0];
            pepe.shift(); // Discard first part 1@GENERAL|button
            hasgroup=0;
            isextension=0;
            isqueue=0;
            for (var s = 0; s < pepe.length; s++) {
                var partos = pepe[s].split(/=(.+)/, 2);
                if (partos[0] !== "") {
                    if (botonitos[nrito] == undefined) {
                        // force refresh with drawme=2 as there is a difference
                        // setting drawme > 1 will do a window.reload to start fresh
                        debug("botonitos de ("+nrito+") esta undefined, hay un nuevo botonito!, pongo drawme en 2");
                        drawme = 2;
                        botonitos[nrito] = {};
                    }
                    if (botonitos[nrito][partos[0]] !== undefined) {
                        // 2da vez que recibe botones, por HUP o poll
                        //debug("Second time receiving button "+nrito+" key "+partos[0]);
                        if (partos[0] == "MAINCHANNEL") {
                            if (botonitos[nrito][partos[0]] != partos[1]) {
                                drawme = 10;
                                debug("A different channel for the same button position on "+nrito+", we must window.reload, drawme is now = "+drawme);
                            } else {
                                debug("Same channel on position "+nrito+" = " + partos[1]);
                            }
                        } else
                        if (partos[0] == "GROUP") {
                            hasgroup=1;
             
                            if (botonitos[nrito][partos[0]] != partos[1]) {
                                var posi = jQuery.inArray(partos[1], displaygroups);
                                if (posi<0) {
                                    displaygroups.push(partos[1]);
                                } 
                                for(i=0;i<displaygroups.length;i++) {
                                    if(partos[1]==displaygroups[i]) {
                                        if(partos[1]=='') { i=-1; }
                                        var newgroup = i+'^'+displaygroups[i];
                                        changegroup(nrito,newgroup,0);
                                    }
                                }
                            }
                        } else
                        if (partos[0] == "LABEL") {
                            var decoded_label = Base64._utf8_decode(partos[1]);

                            if (botonitos[nrito][partos[0]] != decoded_label) {
                               debug('previous label ('+botonitos[nrito][partos[0]]+') is different that current ('+partos[1]+')');
                               rename(nrito,decoded_label,0);
                            }
                        } else
                        if (partos[0] == "TYPE") {
                            if(partos[1] == "extension") {
                                isextension=1;
                            }
                            else if(partos[1] == "queue") {
                                isqueue=1;
                            }
                        } else if(partos[0] == "TAGS") {
                            // en un reload, releer los tags tambien
                            extentags[nrito] = Base64._utf8_decode(partos[1]);
                            $('#taggs' + nrito).html(extentags[nrito]);
                        }
                        botonitos[nrito][partos[0]] = partos[1];
                    } else {
                        //debug("First time receiving button "+nrito+" key "+partos[0]);
                        // primera vez que recibe botones
                        if(partos[0] == "LABEL") { partos[1] = Base64._utf8_decode(partos[1]); }
                        botonitos[nrito][partos[0]] = partos[1];
                        if (partos[0] == "EXTENSION") {
                            extenpos[partos[1]] = nrito;
                            if (partos[1] == myextension) {
                                myposition = nrito;
                            }
                        }
                    }
                }
            }
            // If button has no group, and had a group before, catch that to move it to the main Extensions view
            if(hasgroup==0 && (isextension==1 || isqueue==1)) {
                if (botonitos[nrito]['GROUP'] !== undefined) {
                    if(botonitos[nrito]['GROUP']!='') {
                        if(isextension==1) {
                            changegroup(nrito,"-1^Extensions",0);
                        }
                        if(isqueue==1) {
                            changegroup(nrito,"-1^Queues",0);
                        }
                        botonitos[nrito]['GROUP']='';
                    }
                }
            } 
        }
        if (cuantosBotones == 0) {
            // en caso de nueva conexion
            debug("cuantosBotones is at zero, this is a new connection. Setting drawme = 1 so it draws and does not reload");
            drawme = 1;
        }

        cuantosRecibidosEnZbuttons = lineas.length;
        cuantosRecibidosEnZbuttons = cuantosRecibidosEnZbuttons - 1;

        debug("cuantos recibidos en zbuttons = "+cuantosRecibidosEnZbuttons);
        debug("cuantos botones habia ya = "+cuantosBotones);

        if (cuantosBotones > 0) {
            debug("cuantos botones > 0 = "+cuantosBotones);
            if (lostConnection == 1) {
                //if (drawme == 0) {
                     // if we lost connection, it is better to window.reload so we set drawme at 2
                     //debug("we have lost connection at some point, so it is better to refresh the display setting drawme to 2");
                     //drawme = 2;
                //}
                lostConnection = 0;
            }

            if (cuantosRecibidosEnZbuttons != cuantosBotones) {
                // setting drawme >1 will force a window.reload
                drawme = 2;
                debug("Received " + cuantosRecibidosEnZbuttons + " buttons, different than "+cuantosBotones + " that we had before, so set drawme to "+drawme+ " forcing a reload");
            } else {
                debug("Received " + cuantosRecibidosEnZbuttons + " buttons, the same number we had before (" + cuantosBotones + "), and drawme = " + drawme);
            }

        }

        debug('drawme final value = ' + drawme);

        if (drawme > 0) {

            if (drawme > 1) {
                debug('we must reload because drawme > 1');
                warnClose = false;

                var moreparams = [];

                if(entered_extension != myextension) {
                    fillextension = entered_extension;
                } else {
                    fillextension = myextension;
                }

                if(entered_secret != secret) {
                    fillsecret = entered_secret;
                } else {
                    fillsecret = secret;
                }

                window.location.reload();
            } else {
                debug('drawme = 1, no need for reload, but we must actually draw buttons/toolbar');
                cuantosBotones = cuantosRecibidosEnZbuttons;
                drawButton();
            }
        }

        askFirstState();

        setLang();

        // Altura automatica para gridstack

        grid_auto_height('park');

        grid_auto_height('conference');

        grid_auto_height('trunk');

        grid_auto_height('ringgroup');

        grid_auto_height('queue');

        grid_auto_height('sms');

        grid_auto_height('extension');

        for(i=0;i<displaygroups.length;i++) {
            grid_auto_height('box_grp'+i);
            debug('grupo '+displaygroups[i]);
        }

        if(AutoAnswer) { auto=1; } else { auto=0; }
        send("<msg data=\""+myposition+"|autoanswer|"+auto+"|\" />");

        restoreGrid(Base64.decode(mypreferences.grid));

        $('.clid').dblclick(function(e){ dblclickFunc(e, this);  })

    }

    function demo(nro, texto, slot) {
        debug('function demo');
        demoversion = texto;
        debug('demo ' + demoversion);
        var zh = findHighestZ();
        debug('high z ' + zh);
        var foot = $('#footer');
        foot.css('visibility', 'visible');
        foot.css('display', 'block');
        foot.css('background', '#AAA');
        foot.css('color', '#000');
        foot.css('bottom', '0');
        foot.css('left', '0');
        foot.css('opacity', '0.8');
        foot.css('paddingTop', '3px');
        foot.css('width', '100%');
        foot.css('position', 'fixed');
        foot.css('zIndex', zh);
    }

    function pong(nro, texto, slot) {
        pingcount--;
        if(demoversion==-1) { return; }  // abort if we do not know demo type
        var code = Base64.decode(texto);
        code = replace(code, 'footer', '#footer');
        code = replace(code, 'new Te', 'jQuery.te');
        code = replace(code, 'evaluate', 'eval');
        code = replace(code, ', "after"', '');
        code = replace(code, 'foot.update', 'foot.html');
        code = replace(code, 'foot.style', '//foot.style');
        eval(code);

        foot.css('visibility', 'visible');
        foot.css('display', 'block');
        foot.css('background', '#AAA');
        foot.css('color', '#000');
        foot.css('bottom', '0');
        foot.css('left', '0');
        foot.css('opacity', '0.8');
        foot.css('paddingTop', '3px');
        foot.css('width', '100%');
        foot.css('position', 'fixed');
        foot.css('zIndex', zh);
    }

    function qualify(nro, texto, slot) {
        var boton = $('#boton' + nro);
        if (texto == "notok") {
            boton.addClass("notregistered");
            if(hideUnregistered===true) {
                if(nro!=myposition) {
                    boton.hide();
                }
                hayalguno=0;
                boton.siblings().each(function() {
                    if($(this).hasClass('extenbutton')) {
                       if($(this).is(':visible')) {
                           hayalguno++;
                       }
                    }
                });
                if(hayalguno==0) {
                    boton.parent().parent().parent().hide();
                }
            } 
        } else {
            boton.removeClass("notregistered");
            if(hideUnregistered===true) {
                boton.show();
                boton.parent().parent().parent().show();
                filter_list();
            } 
        }
    }

    function voicemail(nro, texto, slot) {
        var mwi = $("#mwi" + nro);
        if (texto == "1" || texto == "2") {
            mwi.css('visibility', 'visible');
            if (texto == "2") {
                mwi.addClass("notregistered");
            } else {
                mwi.removeClass("notregistered");
            }
        } else {
            mwi.css('visibility', 'hidden');
        }
    }

    function voicemailcount(nro, texto, slot) {
        var mwi = $("#mwi" + nro);
        var textoorig = texto;

        if (texto.substring(0, 1) == "&") {
            texto = translate(texto);
        }

        if (mwi !== null) {
            mwi.attr('data-original-title', texto);
            mwi.attr('data-mwi', textoorig);
        }
        debug('voicemail count '+texto);
    }

    function unlock(nro, texto, slot) {
        var elem = $('#meetme' + nro);
        elem.addClass('meetmeIcon');
        elem.removeClass('meetmeLock');
    }

    function lock(nro, texto, slot) {
        var elem = $('#meetme' + nro);
        elem.addClass('meetmeLock');
        elem.removeClass('meetmeIcon');
    }

    function devtype(nro, texto, slot) {
        var boton = $('#boton' + nro);
        if (texto.indexOf("adhoc") > -1) {
            boton.addClass("adhoc");
        }
    }

    function astdbcust(nro, texto, slot) {
        var einfo = $("#extrainfo" + nro);
        einfo.attr('data-original-title', texto);

        if (texto !== '') {
            einfo.addClass('custom');
        } else {
            einfo.removeClass('custom');
        }
    }

    function queuemember(nro, texto, slot) {

        var boton = $('#boton' + nro);
        var textodecode = Base64.decode(texto);

        if(textodecode=='') { debug('no hay cambios'); return; }

        var data = jQuery.parseJSON(textodecode);
        var memblist = '';
        var membertimer = {};
        var membernow   = {};

        for (var pepe in data) {
            if (data[pepe].state == 'busy' || data[pepe].state == "hold" ) {
                if (data[pepe].paused == 1 || data[pepe].state =="hold") {
                    membclass = 'memberbusypaused';
                } else {
                    membclass = 'memberbusy';
                }
            } else if (data[pepe].state == "invalid" || data[pepe].state == "unavail") {
                if (data[pepe].paused == 1) {
                    membclass = 'memberpaused memberpausedinvalid';
                } else {
                    membclass = 'memberinvalid';
                }
            } else if (data[pepe].state == "ringing") {
                    membclass = 'memberready animated infinite tada';
            } else {
                if (data[pepe].paused == 1) {
                    membclass = 'memberpaused';
                } else {
                    membclass = 'memberready';
                }
            }

            var queuetooltip = '';
            if(data[pepe].fromqueue!='') {
                var coli = data[pepe].fromqueue.substring(6, data[pepe].fromqueue.length);
                var printqueue = dict_queue[coli];
                queuetooltip = ", "+lang.from_queue+" "+printqueue;
            }

            var titl = '';
            var titlpaused = '';

            if(data[pepe].paused==0) { data[pepe].reason=''; }

            if(data[pepe].reason != '') {
                //titl = lang.reason + ": "+data[pepe].reason+", ";
                titlpaused = lang.reason + ": "+data[pepe].reason;
            } else {
                titlpaused = '';
            }

            titl += lang.penalty + " " + data[pepe].pty + ", " + lang.calls_taken + " " + data[pepe].callstaken + queuetooltip;

            var ttimerid = "tick_"+ data[pepe].queue + "_" + data[pepe].loc;
            ttimerid = ttimerid.replace(/[!\"#$%&'\(\)\*\+,\.\/:;<=>\?\@\[\\\]\^`\{\|\}~]/g, '');

            var agentid  = "qm~" + data[pepe].queue + "~" + data[pepe].loc;
            agentid = agentid.replace(/[!\"#$%&'\(\)\*\+,\.\/:;<=>\?\@\[\\\]\^`\{\|\}~]/g, '');

            $('#'+agentid).attr('class','ctxmenuqueue '+membclass).attr('data-original-title',titlpaused).tooltip({container:'body',html:true});
            $('#title'+agentid).attr('data-html',true).attr('data-original-title',titl).tooltip({container:'body',html:true});

            if(data[pepe].currentcall>0) {
                var serverDuration = data[pepe].now - data[pepe].currentcall;
                var sDate = new Date();
                var ahora = Math.round(sDate.getTime() / 1000);
                var finaltime = ahora - serverDuration;
                tiempos[ttimerid] = finaltime * 1000;
                tiemposdirection[ttimerid] = 'UP';
            } else {
                $('#'+ttimerid).html('');
                delete tiempos[ttimerid];
                delete tiemposdirection[ttimerid];
            }
        }
    }
 
    function queuemembers(nro, texto, slot) {

        var boton = $('#boton' + nro);
        var textodecode = Base64.decode(texto);
        var data = jQuery.parseJSON(textodecode);
        var memblist = '';

        if(typeof window.countqueues == 'undefined') {
            window.countqueues = 0;
        }

        if(typeof window.queuesismember == 'undefined') {
            window.queuesismember = new Object();
        }

        // keep count of number of queues received
        window.countqueues++;
        // and know how many queues we have visible
        largo = availablequeues.length;

        data.sort(function(a, b) {
            var nameA = (parseFloat(a.pty) + 100000) + ' ' + a.name.toLowerCase();
            var nameB = (parseFloat(b.pty) + 100000) + ' ' + b.name.toLowerCase();
            if (nameA < nameB) {
                return -1;
            }
            if (nameA > nameB) {
                return 1;
            }
            return 0 //default return value (no sorting)
        })

        var membertimer = {};
        var membernow = {};

        window.queuesismember[nro] = Array();

        for (var pepe in data) {

            window.queuesismember[nro].push(data[pepe].loc);

            if (data[pepe].state == 'busy' || data[pepe].state == "hold" ) {
                if (data[pepe].paused == 1) {
                    membclass = 'memberbusypaused';
                } else {
                    membclass = 'memberbusy';
                }
            } else if (data[pepe].state == "invalid" || data[pepe].state == "unavail") {
                if (data[pepe].paused == 1) {
                    membclass = 'memberpaused memberpausedinvalid';
                } else {
                    membclass = 'memberinvalid';
                }
            } else {
                if (data[pepe].paused == 1) {
                    membclass = 'memberpaused';
                } else {
                    membclass = 'memberready';
                }
            }

            var queuetooltip = '';
            var printqueue = '';
            if(data[pepe].fromqueue!='') {
                var coli = data[pepe].fromqueue.substring(6, data[pepe].fromqueue.length);
                printqueue = dict_queue[coli];
                queuetooltip = ", "+lang.from_queue+" "+printqueue;
            }

            var titl = '';
            var titlpaused = '';

            if(data[pepe].paused==0) { data[pepe].reason=''; }

            if(data[pepe].reason != '') {
                //titl = lang.reason + ": "+data[pepe].reason+", ";
                titlpaused = lang.reason + ": "+data[pepe].reason;
            } else {
                titlpaused = '';
            }

            titl += lang.penalty + " " + data[pepe].pty + ", " + lang.calls_taken + " " + data[pepe].callstaken + queuetooltip;
            var ttimerid = "tick_"+ data[pepe].queue + "_" + data[pepe].loc;
            ttimerid = ttimerid.replace(/[!\"#$%&'\(\)\*\+,\.\/:;<=>\?\@\[\\\]\^`\{\|\}~]/g, '');
            var agentid  = "qm~" + data[pepe].queue + "~" + data[pepe].loc;
            agentid = agentid.replace(/[!\"#$%&'\(\)\*\+,\.\/:;<=>\?\@\[\\\]\^`\{\|\}~]/g, '');

            memblist += "<div class='" + membclass + " ctxmenuqueue' data-channel='qm~"+data[pepe].queue + "~" + data[pepe].loc +"'  id='"+ agentid + "' data-toggle='tooltip' data-original-title='"+titlpaused+"'></div><span id='title"+agentid+"' class='qimember' data-toggle='tooltip' data-original-title='" + titl + "'>" + data[pepe].name + "</span><span class='timer' id='"+ttimerid+"'></span><br/>";

            if(data[pepe].currentcall>0) {
                membertimer[ttimerid]=data[pepe].currentcall;
                membernow[ttimerid]=data[pepe].now;
            } else {
                $('#'+ttimerid).html('');
                delete tiempos[ttimerid];
                delete tiemposdirection[ttimerid];
            }
        }
        var htmlelement = $('#agententries_' + nro);

        if(memblist == membercache[nro]) {

            debug('no hay cambios en la lista de miembros en el boton '+nro+', no cambiamos nada');

        } else {

            htmlelement.html(memblist);
            membercache[nro]=memblist;

            var sDate = new Date();
            var ahora = Math.round(sDate.getTime() / 1000);

            for (var ttimerid in membertimer) {
                var serverDuration = parseInt(membernow[ttimerid])-parseInt(membertimer[ttimerid]);
                debug('qtimer cada member timer '+ttimerid);
                var finaltime = ahora - serverDuration;
                debug('qtimer finaltime = '+finaltime);

                tiempos[ttimerid] = finaltime * 1000;
                tiemposdirection[ttimerid] = 'UP';
            }

            var numAgentesThis = data.length;
            $('#agentsummary_' + nro).html(translate('&agents!' + numAgentesThis));
            numAgentes[nro] = numAgentesThis;

            if (boton.hasClass('selected')) {
                var misagentes = $('#agententries_' + nro).children();
                filter_agentes(misagentes);
            }

            $('#agententries_'+nro+' [data-toggle="tooltip"]').tooltip({container:'body'});

        }

        if(window.countqueues == largo) {
            window.countqueues = 0;
            grid_auto_height('queue');
            for (var a = 0; a < queuelistGroup.length; a++) {
                var mydiv = queuelistGroup[a].substring(0,queuelistGroup[a].length-3);
                grid_auto_height(mydiv);
            }
        } 

    }

    function usersonline(nro, texto, slot) {

        var textodecode = Base64.decode(texto);
        var posiciones = textodecode.split(",");

        for (var s = 0; s < posiciones.length; s++) {
            $('#presence' + posiciones[s]).html('√');
        }
    }

    function settext(nro, texto, slot) {
        var clidnum = $("#clid" + slot + "_" + nro);
        $(clidnum).trigger('flipflopstop'); // kill current instance, if any
        if (texto.substring(0, 1) == "&") {
            texto = translate(texto);
            clidnum.html(texto);
            clidnum.removeAttr('data-original-title');
        } else {
            if (clidnum.length) {
                if (texto.trim().indexOf(' ') > 1) {  // assume contains caller name
                    var idx = texto.indexOf(' ');
                    var num = texto.substring(0, idx);
                    var name = texto.substring(idx);
                    $(clidnum).flipflop({text1: num, text2: name});
                    dialednum[nro]=Base64.encode(num);
                    dialedname[nro]=Base64.encode(name);
                } else {
                    dialednum[nro]=Base64.encode(texto);
                    dialedname[nro]='';
                }
                clidnum.html(texto);
                clidnum.attr('data-original-title', texto).tooltip({container:'body'});
            }
        }
    }

    function state(nro, texto, slot) {

        var boton = $('#boton' + nro);
        var presen = $('#presence' + nro);
        var einfo = $("#extrainfo" + nro);
        var ephone = $("#phone" + nro);
        var phoni = $('#phone' + slot + '_' + nro);

        var estados = texto.split("+");

        if (jQuery.inArray('DOWN', estados) >= 0) {

            if (slot == "0") {
                boton.removeClass("busy");
                boton.addClass("free");
                if (presen.length) {
                    presen.removeClass("presenceBusy");
                    presen.addClass("presenceNormal");
                    presen.removeClass('cassette');
                }

                if(nro==myposition) { 
                    alreadynotified=0; 

                    // refresh call history
                    if($('#iframecdr').attr('src')!='') {
                        var iframe = document.getElementById('iframecdr');
                        iframe.src = iframe.src;
                    }
                }

            }

            if (buttontype[nro] == "extension") {
                if (phoni.length) {
                    phoni.removeClass('ringing2');
                    phoni.removeClass('entrante');
                    phoni.removeClass('saliente');
                    phoni.removeClass('hold');

                    if (mypreferences.dynamicLineDisplay == "on") {
                        $('#acline_' + slot + '_' + nro).addClass('invisible');
                    }

                    if (enableDragTransfer === true) {
                        if (phoni.hasClass('ui-draggable')) {
                            phoni.draggable('destroy');
                        }
                    }

                }
                einfo.removeClass("extrainfo");
                if (einfo.hasClass('paused') || einfo.hasClass('custom')) {} else {
                    // Quitamos title si no tiene clases con texto
                    einfo.removeAttr('data-original-title');
                    einfo.removeAttr('title');
                }

            }

            if(ringingchan[nro] !== undefined ) {
                delete ringingchan[nro][slot];
            }


            if (chanvars[nro] !== undefined) {

                if(myposition==nro) {
                    if(typeof(chanvars[nro]['UNIQUEID'])!=='undefined') {
                        delete popup_connect_done[chanvars[nro]['UNIQUEID']];
                        notify('hangup', nro, texto, slot);
                    }
                }

                for (var j in chanvars[nro]) {
                    debug("delete " + j + " = " + chanvars[nro][j]);
                    delete chanvars[nro][j];
                }

                delete dialednum[nro];
                delete dialedname[nro];
                delete ringclidnum[nro];
                delete ringclidname[nro];
                delete ringfromqueue[nro];
                delete ringfromqueuenmr[nro];
            }

            if (nro == myposition && mypreferences.soundRing !== "") {
                sonido['ring'].pause();
            }

        } else if (jQuery.inArray('HOLD', estados) >= 0) {
            if (phoni.length) {
                phoni.addClass('hold');
                if (mypreferences.dynamicLineDisplay == "on") {
                    $('#acline_' + slot + '_' + nro).removeClass('invisible');
                }
            }
        } else if (jQuery.inArray('UP', estados) >= 0) {
            boton.addClass("busy");
            boton.removeClass("free");

            if (presen.length) {
                if (presen.hasClass('presenceNormal')) {
                    presen.removeClass("presenceNormal");
                }
                presen.addClass("presenceBusy");
            }

            if (phoni.length) {
                if (enableDragTransfer === true) {
                    $('#phone' + slot + '_' + nro).draggable({
                        helper: function() { return $("<div></div>").addClass('extension').appendTo('body').css({'zIndex':5}); },
                        revert: false,
                        stop: function(elm, evt) {
                            debug('drag stop');
                        }
                    });
                }

                phoni.removeClass('hold');
                phoni.removeClass('ringing2');
                if (mypreferences.dynamicLineDisplay == "on") {
                    $('#acline_' + slot + '_' + nro).removeClass('invisible');
                }
            }

            if (nro == myposition && mypreferences.soundRing !== "") {
                sonido['ring'].pause();
            }

        } else if (jQuery.inArray('RINGING', estados) >= 0) {
            debug('esta en ringing');

            if (enableDragTransfer === true) {
                $('#phone' + slot + '_' + nro).draggable({
                    helper: function() { return $("<div></div>").addClass('extension').appendTo('body').css({'zIndex':5}); },
                    revert: false,
                    stop: function(elm, evt) {
                        debug('drag stop');
                    }
                });
            }

            if (nro == myposition && mypreferences.soundRing !== "") {
                try {
                    sonido['ring'].play();
                } catch(e) {}
            }

            if (phoni.length) {
                phoni.addClass('ringing2');
                if (mypreferences.dynamicLineDisplay == "on") {
                    $('#acline_' + slot + '_' + nro).removeClass('invisible');
                }
            }
        } else {

            if (nro == myposition && mypreferences.soundRing !== "") {
                sonido['ring'].pause();
            }

            if (phoni.length) {
                phoni.removeClass('ringing2');
                if (mypreferences.dynamicLineDisplay == "on") {
                    $('#acline_' + slot + '_' + nro).removeClass('invisible');
                }
            }
        }

    }

    function enablesms(nro, texto, slot) {
        debug("ENABLE SMS! "+texto);
        if(texto=='1') {
            sms_enabled = 1;
        }
        if(texto=='2') {
            sms_messagesend = 1;
        }
    }

    function enablechatadmin(nro, texto, slot) {
        debug("ENABLE CHAT ADMIN!");
        chatadm_enabled = 1;
    }

    function link(nro, texto, slot) {
        if (myposition == nro) {
            $('#dialtext').val("");
            $('#dialtext').typeahead('val','');
            $('dialtext').focus();

            if(typeof lastlink[nro] == 'undefined') { lastlink[nro]=texto; }
            if(lastlink[nro] != texto) {
                // tenemos link a un canal distinto del anterior, entonces borro doingatxfer por si la transferencia ya no se puede abortar
                delete doingatxfer[nro];
            } 
            
            lastlink[nro]=texto;
        }
    }

    function direction(nro, texto, slot) {
        var phoni = $('#phone' + slot + '_' + nro)
        if (phoni.length) {
            if (texto == "outbound") {
                phoni.addClass('saliente');
                phoni.removeClass('entrante');
            } else {
                phoni.addClass('entrante');
                phoni.removeClass('saliente');
            }
        }
    }

    function xpresence(nro, texto, slot) {

        var presen = $('#presence' + nro);

        var textodecode = Base64.decode(texto);

        if (lang.hasOwnProperty(textodecode)) {
            presen.attr('data-original-title', lang[textodecode]);
        } else {
            presen.attr('data-original-title', textodecode);
        }

        setThisTip('presence'+nro);

        if (textodecode === "") {
            presen.removeClass("presenceOther");
            presen.css('backgroundColor', '');
        } else {
            presen.addClass("presenceOther");
            if (typeof(presence[textodecode]) == 'undefined') {
                presen.css('backgroundColor', '#00d020');
            } else {
                presen.css('backgroundColor', presence[textodecode]);
            }
        }

        if (myposition == nro) {
            var ok = 0;
            var cont = 0;
            for (var sel in presence) {
                if (sel == textodecode) {
                    $('#presence')[0].selectedIndex = cont;
                    $('.selectpicker').selectpicker('refresh');
                    ok = 1;
                }
                cont++;
            }
            if (ok === 0 && textodecode !== "") {
//                $('#presence')[0].selectedIndex = cont;
                $('#presence')[0].selectedIndex =  $('#presence')[0].length - 1;
                $('.selectpicker').selectpicker('refresh');
            }
            setSelectedPresenceClass();
        }
    }

    function managerproblem(nro, texto, slot) {
        alertify.error("Manager Connection Problem");
    }

    function Monitor(nro, texto, slot) {
        var presen = $('#presence' + nro);
        if (hasPerm(0, 'record') || hasPerm(0, 'all') || hasPerm(0, 'recordself')) {
            presen.addClass('cassette');
        }
    }

    function StopMonitor(nro, texto, slot) {
        var presen = $('#presence' + nro);
        if (hasPerm(0, 'record') || hasPerm(0, 'all') || hasPerm(0, 'recordself')) {
            presen.removeClass('cassette');
        }
    }

    function PauseMonitor(nro, texto, slot) {
        var presen = $('#presence' + nro);
        if (hasPerm(0, 'record') || hasPerm(0, 'all') || hasPerm(0, 'recordself')) {
            presen.removeClass('cassette');
        }
    }

    function UnpauseMonitor(nro, texto, slot) {
        var presen = $('#presence' + nro);
        if (hasPerm(0, 'record') || hasPerm(0, 'all') || hasPerm(0, 'recordself')) {
            presen.addClass('cassette');
        }
    }

    function xstatus(nro, texto, slot) {

        var einfo = $("#extrainfo" + nro);

        if (texto == "unpaused") {
            einfo.removeClass('paused');
            einfo.attr('title', '');
        } else {
            if(texto!='paused') {
                if(lang[texto]!==undefined) {
                    reason = lang[texto];
                } else {
                    reason = texto;
                }
                einfo.attr('data-original-title', lang['paused']+' ('+reason+')');
            } else {
                einfo.attr('data-original-title', lang['paused']);
            }
            einfo.addClass('paused');
        }
    }

    function ip(nro, texto, slot) {
        var elabel = $("#label" + nro);
        elabel.attr('data-original-title', texto);
    }

    function settimer(nro, texto, slot) {

        var partes = texto.split("@");
        var seconds = partes[0];
        var type = partes[1];

        var timerindex = "timer_" + nro + "_" + slot;

        var sDate = new Date();
        if (type == "UP" || type == "IDLE" || type == "DOWN") {
            tiempos[timerindex] = sDate.getTime() - parseInt(seconds, 10) * 1000;
            tiemposdirection[timerindex] = type;
        }
        if (type == "STOP") {
            //delete tiempos[nro];
            delete tiempos[timerindex];
            delete tiemposdirection[timerindex];
            var ticktime = $('#tick' + slot + '_' + nro);
            if (ticktime.length) {
                ticktime.html('');
            } 
        }
    }

    function rename(nro,texto,slot) {

        if (noExtenInLabel === false) {
            if(typeof(extennumber[nro])=='undefined') {
                textolabel = texto;
            } else {
                textolabel = extennumber[nro] + " " + texto;
            }
        } else {
            textolabel = texto;
        }
 
        $('#label'+nro).html(textolabel);
        $('#label'+nro).attr('data-original-title', texto);

        if(botonitos[nro]['LABEL'] != texto) {
            botonitos[nro]['LABEL']=texto;
        }
    }

    function changegroup(nro,texto,slot) {

        var partes = texto.split('^');

        if(partes[0]==-1) {

            if (buttontype[nro] == "extension") {
                maindiv    = 'extensionbox';
                contentdiv = 'extensioncontent';
                tagdiv     = 'extensiontag';
                listdiv    = 'extensionlist';
                bcasttag   = 'chatbroadcast_Extensions';
                autoheight = 'extension';
                groupname  = lang.extensions;
            } else if(buttontype[nro] == "queue") {
                maindiv    = 'queuebox';
                contentdiv = 'queuecontent';
                tagdiv     = 'queuetag';
                listdiv    = 'queuelist';
                bcasttag   = 'chatbroadcast_Extensions';
                autoheight = 'queue';
                groupname  = lang.queues;
            }

        } else {
            maindiv    = 'box_grp'+partes[0]+'box';
            contentdiv = 'box_grp'+partes[0]+'content';
            tagdiv     = 'box_grp'+partes[0]+'tag';
            listdiv    = 'box_grp'+partes[0]+'list';
            bcasttag   = 'chatbroadcast_grp'+partes[0];
            autoheight = 'box_grp'+partes[0];
            groupname = partes[1];
        }

        if ($('#'+maindiv).length == 0) {
 
            if (buttontype[nro] == "extension") {
                var la = $.parseHTML(jQuery.template('<div id="#{maindiv}" data-gs-width="9"><div class="grid-stack-item-content boxstyle boxstylebg"> <div id="#{contentdiv}" class="widgetcontent widget widget-color"><header role="heading"><div class="widget-ctrls" role="menu"><a href="javascript:void(0);" class="myclick button-icon widget-broadcast-btn ctxmenugroup broadcast" id="#{bcasttag}" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{broadcast}"><i class="fa fa-bullhorn "></i></a><a href="javascript:void(0);" class="myclick button-icon widget-toggle-btn langcollapse" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{langcollapse}"><i class="fa fa-caret-square-o-up"></i></a><a href="javascript:void(0);" class="myclick button-icon widget-lock-btn langlockunlock" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{lockunlock}"><i class="fa fa-unlock-alt"></i></a></div><span class="handle widget-icon"><i class="fa fa-bars"></i></span><h3><span id="#{tagdiv}">#{groupname}</span></h3></header><div class="widgetscroll" id="#{listdiv}"></div></div></div></div>').eval({
                    maindiv: maindiv,
                    contentdiv: contentdiv,
                    tagdiv: tagdiv,
                    listdiv: listdiv,
                    bcasttag: bcasttag,
                    groupname: groupname,
                    broadcast: lang.broadcast,
                    lockunlock: lang.toggle_lock,
                    langcollapse: lang.collapse
                }));

                grid = $('.grid-stack').data('gridstack');
                grid.addWidget(la,0,0,9,2,true);
                extenlistGroup.push(maindiv);

                if (!(hasPerm(0, 'broadcast') || hasPerm(0, 'all'))) {
                    $('#'+bcasttag).hide();
                }
            } else if (buttontype[nro] == "queue") {

                var la = $.parseHTML(jQuery.template('<div id="#{maindiv}" data-gs-width="9"><div class="grid-stack-item-content boxstyle boxstylebg"> <div id="#{contentdiv}" class="widgetcontent widget widget-color"><header role="heading"><div class="widget-ctrls" role="menu"><a href="javascript:void(0);" class="myclick button-icon widget-toggle-btn langcollapse" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{langcollapse}"><i class="fa fa-caret-square-o-up"></i></a><a href="javascript:void(0);" class="myclick button-icon widget-lock-btn langlockunlock" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{lockunlock}"><i class="fa fa-unlock-alt"></i></a></div><span class="handle widget-icon"><i class="fa fa-bars"></i></span><h3><span id="#{tagdiv}">#{groupname}</span></h3></header><div class="widgetscroll" id="#{listdiv}"></div></div></div></div>').eval({
                    maindiv: maindiv,
                    contentdiv: contentdiv,
                    tagdiv: tagdiv,
                    listdiv: listdiv,
                    groupname: groupname,
                    broadcast: lang.broadcast,
                    lockunlock: lang.toggle_lock,
                    langcollapse: lang.collapse
                }));

                grid = $('.grid-stack').data('gridstack');
                grid.addWidget(la,0,0,9,2,true);
                queuelistGroup.push(maindiv);
 
            }
        }

        var oldparent = $("#boton"+nro).parent().parent().parent().parent();
        var newparent = $("#"+listdiv);

        newparent.find(".clearfix").detach(); 
  
        $("#boton"+nro).detach().appendTo(newparent)
        $("<div class='clearfix bottommargin'></div>").appendTo(newparent);

        grid_auto_height(autoheight);

        // Remuevo grupo original si queda vacio
        var Children = oldparent.find('[class*="labelname"]');
        var cuantos = Children.length;
        if(cuantos == 0) {
           oldparent.detach();
        }

    }

    function notionline(nro, texto, slot) {

        debug("noti online nro " + nro + " y texto " + texto);

        if(texto=='') { return; } // if we o not have a slot, then it will overwrite the presence select box

        for (var id in openchats) {
            if (id == texto) {
                newChat(id, myposition, "NOWONLINE");
            }
        }

        if (nro == 0 && slot == 1 && myposition == texto) {
            // Este es un cliente RTMP, cargo el softphone
            /*if($('#box_fonapbox')===null) {
               debug("Add script softphone.js");
               msAddScript('plugins/rtmp/softphone.js');
               msAddCss('plugins/rtmp/softphone.css');
            }*/
        } else {
            debug(nro + " distinto " + myposition);
        }
        $('#presence' + texto).html('√');

    }

    function notioffline(nro, texto, slot) {

        debug("noti offline nro " + nro + " y texto " + texto);

        if(texto=='') { return; } // if we o not have a slot, then it will overwrite the presence select box

        for (var id in openchats) {
            if (id == texto) {
                newChat(id, myposition, "NOTONLINE");
            }
        }

        $('#presence' + texto).html('');
    }

    function fromqueue(nro, texto, slot) {
        var einfo = $("#extrainfo" + nro);
        var textoprint = texto;
        var textoprintnro = texto;
        if(typeof printy_queue[texto] !== 'undefined') {
            textoprint = printy_queue[texto];
        } 
        if(typeof printy_queue_r[texto] !== 'undefined') {
            textoprintnro = printy_queue_r[texto];
        } 
        einfo.attr('data-original-title', lang['from_queue'] + ' ' + textoprint);
        ringfromqueue[nro] = textoprint;
        ringfromqueuenmr[nro] = textoprintnro;
        einfo.addClass("extrainfo");
        debug(einfo);
    }

    function details(nro, texto, slot) {

        var textodecode = Base64.decode(texto);
        var htmlelement = $('#trunkentries_' + nro);

        if (textodecode == '') {
            htmlelement.html('');
            return;
        }

        if (buttontype[nro] == "park") {
            //htmlelement.html( jQuery.template(textodecode).eval({btnnumero: nro}));
            var data = jQuery.parseJSON(textodecode);
            debug(data);
            var parklist = '';
            var cont = 1;
            for (var pepe in data) {
                parklist += "<div id='park-park!" + data[pepe].lot + "!" + data[pepe].slot + "' class='ctxmenupickup'><div class='saliente parkedcall'></div><div style='float:left; font-style:italic;'>" + data[pepe].slot + "</div><div style='float:left;'>&nbsp;&nbsp;</div><div style='float:left;'>" + data[pepe].clidnum + " " + data[pepe].clidname + "</div></div><div style='float:right;'>(" + data[pepe].from + ") <div id='tick" + cont + "_" + nro + "'>" + data[pepe].timeout + "</div></div><br class='clear' />\n";
                cont++;
            }

            htmlelement.html(parklist);
            htmlelement.children('.ctxmenupickup').each(function() {
                $(this).draggable({
                    helper: function() { return $(this).clone().appendTo('body').css({'zIndex':5}); },
                    revert: true,
                    stop: function(elm, evt) {
                        debug($(this));
                    }
                });
            });

        } else {

            var data = jQuery.parseJSON(textodecode);

            var trunklist = '';
            var dirclass = '';

            for (var pepe in data) {
                if (data[pepe].direction == 'outbound') {
                    dirclass = 'saliente';
                } else {
                    dirclass = 'entrante';
                }
                trunklist += "<div class='" + dirclass + " ctxmenupickup trunkcall' id='trnk-" + data[pepe].channel + "'></div><div style='float:left;'>" + data[pepe].channel + "</div><div style='float:right;'>" + data[pepe].callerid + "</div><br class='clear' />\n";
            }

            htmlelement.html(trunklist);
            htmlelement.children('.ctxmenupickup').each(function() {
                $(this).draggable({
                    helper: function() { return $(this).clone().appendTo('body').css({'zIndex':5}); },
                    revert: true,
                    stop: function(elm, evt) {
                        debug($(this));
                    }
                });
            });
        }
        grid_auto_height(buttontype[nro]);
    }

    function queueentry(nro, texto, slot) {

        var htmlelement = $('#queueentries_' + nro);

        var elementos = texto.split("!");
        var canal = elementos[1];
        var wait = elementos[2];
        var clidnum = elementos[3];
        var clidname = Base64.decode(elementos[4]);

        var timerindex = "timer_" + nro + "_" + slot;
        var timerid = 'tick' + slot + "_" + nro;

        if (clidname == clidnum) {
            clidname = "";
        }
        var texto = slot + ". <" + clidnum + "> " + clidname;

        var li = document.createElement('li');
        $(li).addClass('qentrylabel').addClass('ctxmenupickup').attr('id', 'qe_' + nro + '_' + slot).data('channel', canal).html(texto);
        htmlelement.append(li);

        var li = document.createElement('li');
        $(li).addClass('qentrytimer').attr('id', timerid).html('00:00:00');
        htmlelement.append(li);

        var li = document.createElement('li');
        $(li).addClass('clear').attr('id', 'qclear_' + nro + '_' + slot);
        htmlelement.append(li);

        var sDate = new Date();
        tiempos[timerindex] = sDate.getTime() - parseInt(wait, 10) * 1000;

        var numCallsWaiting = $('#queueentries_' + nro + ' li').length;
        numCallsWaiting = numCallsWaiting / 3;
        $('#queuesummary_' + nro).html(translate('&calls!' + numCallsWaiting));

        if (enableDragTransfer === true) {
            $('#qe_' + nro + '_' + slot).draggable({
                helper: function() { return $(this).clone().appendTo('body').css({'zIndex':5}); },
                revert: true,
                stop: function(elm, evt) {
                    debug('drag stop');
                    debug($(this));
                }
            });
        }
    }

    function soundjoin(nro, texto, slot) {
        if (mypreferences.soundQueue !== "") {
            sonido['enterqueue'].play();
        }
    }

    function waitingcalls(nro, texto, slot) {
        waitingCalls[nro] = texto;
        grid_auto_height('queue');
        for (var a = 0; a < queuelistGroup.length; a++) {
            var mydiv = queuelistGroup[a].substring(0,queuelistGroup[a].length-3);
            grid_auto_height(mydiv);
        }
    }

    function clearentries(nro, texto, slot) {
        $('#queueentries_' + nro).children().remove();
        for (var j in tiempos) {
            var miparte = j.split("_");
            if (miparte[1] == nro) {
                delete tiempos[j];
                delete tiemposdirection[j];
            }
        }
        numCallsWaiting = 0;
        $('#queuesummary_' + nro).html(translate('&calls!' + numCallsWaiting));
        waitingCalls[nro] = numCallsWaiting;
        debug("cola " + nro + " quedo con llamados: " + waitingCalls[nro]);
    }

    function members(nro, texto, slot) {
        var data = jQuery.parseJSON(Base64.decode(texto));
        var htmlelement = $('#meetmeentries_' + nro);
        var classmark = '';
        var classtalk = '';
        var memblist = '';

        for (var pepe in data) {
//            debug(pepe+" = "+data[pepe]);
            classtalk='';

            if (data[pepe].ismarked == 'on') {
                if (data[pepe].ismuted == 'on') {
                    classmark = 'meetmeadminmuted';
                } else {
                    classmark = 'meetmeadmin';
                }
            } else {
                if (data[pepe].ismuted == 'on') {
                    classmark = 'meetmemuted';
                } else {
                    classmark = 'meetmeready';
                }
            }

            if (data[pepe].istalking == 'on') {
                classtalk = "meetmetalking";
            }

            var partes = data[pepe].conference.split('/');
            var confno = partes[1];
            var id = confno + '-' + data[pepe].channel;

            memblist += "<div class='" + classmark + " " + classtalk + " ctxmenuparticipant' id='" + id + "'></div><span class='cparticipant'>" + data[pepe].channel + " - " + data[pepe].name + "</span><br class='clear'/>";
        }

        var numMembersThis = data.length;
        if (numMembersThis > 0) {
            $("#extrainfo" + nro).html("(" + numMembersThis + ")");
        } else {
            $("#extrainfo" + nro).html("");
        }

        htmlelement.html(memblist);
    }

    function clidnum(nro, texto, slot) {
        if (myposition == nro) {
            ringclidnum[nro] = texto;
        }
    }

    function clidname(nro, texto, slot) {
        if (myposition == nro) {
            ringclidname[nro] = texto;
        }
    }

    function dialingchannel(nro, texto, slot) {
         if(!ringingchan[nro]) {
             ringingchan[nro] = {};
         }
         if(!ringingchan[nro][slot]) {
             ringingchan[nro][slot] = texto;
         }
    }

    function setZero(nro, texto, slot) {
        var boton = $('#boton' + nro);
        var presen = $('#presence' + nro);
        var einfo = $("#extrainfo" + nro);
        var ephone = $("#phone" + nro);

        boton.removeClass("busy");
        boton.addClass("free");
        if (presen.length) {
            presen.removeClass("presenceBusy");
            presen.addClass("presenceNormal");
            presen.removeClass('cassette');
        }

        if (buttontype[nro] == "extension") {
            for(slot=1;slot<4;slot++) {
                var phoni   = $('#phone' + slot + '_' + nro);
                var clidnum = $('#clid'  + slot + '_' + nro);
                var timerindex = "timer_" + nro + "_" + slot;
                var ticktime = $('#tick' + slot + '_' + nro);

                if (ticktime.length) {
                    ticktime.html('');
                }

                if (phoni.length) {
             
                    delete tiempos[timerindex];
                    delete tiemposdirection[timerindex];

                    clidnum.trigger('flipflopstop');
                    clidnum.html(translate('&inactive_line!' + slot));

                    phoni.removeClass('ringing2');
                    phoni.removeClass('entrante');
                    phoni.removeClass('saliente');
                    phoni.removeClass('hold');

                    if (mypreferences.dynamicLineDisplay == "on") {
                        $('#acline_' + slot + '_' + nro).addClass('invisible');
                    }

                    if (enableDragTransfer === true) {
                        if (phoni.hasClass('ui-draggable')) {
                            phoni.draggable('destroy');
                        }
                     }
                }
            }
        }
        einfo.removeClass("extrainfo");
        if (einfo.hasClass('paused') || einfo.hasClass('custom')) {} else {
              // Quitamos title si no tiene clases con texto
              einfo.removeAttr('data-original-title');
              einfo.removeAttr('title');
        }
    }

    function setvar(nro, texto, slot) {
        var textdecode = Base64.decode(texto);
        if (textdecode.indexOf("=") >= 1) {
            // Solo agregamos si tiene signo igual
            if (chanvars[nro] === undefined) {
                chanvars[nro] = {};
            }
            // Split on first = and value all the rest even if it has multiple variables with | = 
            curvar = textdecode.substring(0,textdecode.indexOf('='));
            curval = textdecode.substring(textdecode.indexOf('=')+1);

            if(curvar=='DIALERVAR') {

               partes = curval.split("|");
               for (var j in partes) {
                   pertes = partes[j].split("=");
                   chanvars[nro][pertes[0]]=pertes[1];
               }

            } else {
                chanvars[nro][curvar] = curval;
            }
        }
    }

    function notifybroadcast(nro, texto, slot) {
        notify('broadcast', nro, texto, slot);
    }

    function notifyringing(nro, texto, slot) {
        if(nro==myposition) {
            alreadynotified=0;
        }
        notify('ringing', nro, texto, slot);
    }

    function notifyconnect(nro, texto, slot) {
        if(alreadynotified==0) {
            notify('connect', nro, texto, slot);
            if(nro==myposition) {
                alreadynotified=1;
            }
        } else {
            if(nro==myposition) {
                debug('Skipping notify connect as I was already notified');
            }
        }
    }

    function notify(poptype, nro, texto, slot) {

        var popupUrlDecoded = '';

        if (poptype == 'broadcast') {
            if (myposition == nro && extennumber[nro] != extennumber[slot]) {
                textoDecoded = Base64.decode(texto);
                alertify.log(extennumber[slot] + ": " + textoDecoded, '', 0);
            }
        } else {

            // if popup url is set via request parameters, force autopoup
            //
            if(poptype == 'ringing') {
                popupUrl = popupUrlRinging;
                if(getPopupUrlRinging != '') {
                    autoPopup=true;
                }
            } else if (poptype == 'connect') {
                popupUrl = popupUrlConnect;
                if(getPopupUrlConnect != '') {
                    autoPopup=true;
                }
            } else if (poptype == 'hangup') {
                popupUrl = popupUrlHangup;
                if(getPopupUrlHangup != '') {
                    autoPopup=true;
                }
            }

            if (myposition == nro) {

                if (chanvars[nro] === undefined) {
                    chanvars[nro] = {};
                }

                if (popupUrl != '') {

                    popupUrlDecoded = Base64.decode(popupUrl);

                    var patt1 = /#\{[^\}]*\}/g;
                    var coinciden = popupUrlDecoded.match(patt1);

                    if(typeof(ringclidnum[nro])!=='undefined') {
                        chanvars[nro]['CLIDNUM']  = ringclidnum[nro];
                        chanvars[nro]['CLIDNAME'] = ringclidname[nro];
                    } else {
                        chanvars[nro]['CLIDNUM']  = dialednum[nro];
                        chanvars[nro]['CLIDNAME'] = dialedname[nro];
                    }

                    chanvars[nro]['EXTEN']    = myextension;

                    if (ringfromqueue[nro] !== undefined) {
                        chanvars[nro]['FROMQUEUE'] = ringfromqueue[nro];
                    }
                    if (ringfromqueuenmr[nro] !== undefined) {
                        chanvars[nro]['FROMQUEUENUMBER'] = ringfromqueuenmr[nro];
                    }

                    if (coinciden !== null) {
                        for (var a = 0; a < coinciden.length; a++) {
                            var vari = coinciden[a].substr(2, coinciden[a].length - 3);
                            var valor = '';
                            if (vari == 'CLIDNUM' || vari == 'CLIDNAME') {
                                valor = Base64.decode(chanvars[nro][vari]);
                            } else {
                                valor = chanvars[nro][vari];
                            }
                            valor = encodeURIComponent(valor);
                            popupUrlDecoded = replace(popupUrlDecoded, coinciden[a], valor);
                        }
                    } else {
                        debug("no variable match");
                    }
                }

                if(poptype=='connect') {
                    if(typeof(popup_connect_done[chanvars[nro]['UNIQUEID']])!=='undefined') {
                         debug('skip connect popup porque ya mande par ese unique');
                    } else {
                         debug('muestro popup porque no tengo done para unique '+chanvars[nro]['UNIQUEID']);
                    }
                }

                popup_connect_done[chanvars[nro]['UNIQUEID']]=1;

                if (autoPopup === true && popupUrlDecoded != '') {
                    debug('URL Popup set and Auto Popup set, lets open it! ' + popupUrlDecoded);
                    openNewBackgroundTab(popupUrlDecoded);
                }

                if(autoPopup !== true) {
                    debug('No autopopup set for this extension');
                    debug(autoPopup);
                }
                if(popupUrlDecoded == '') {
                    debug('No popup because there is no url set');
                }

                // Usar checkdir.php para popups
                //
                //
                if(notifyDuration>0) {

                    if(typeof(ringclidnum[nro])==='undefined') {
                        // for notify we should always have ringclidnumber defined
                        debug('No popup because there is no callerid number');
                        return;
                    }

                    var popupurl = "checkdir.php";
                    var extenbut = myextension;
                    var pars = "poptype=" + poptype + "&clidnum=" + ringclidnum[nro] + "&clidname=" + ringclidname[nro] + "&exten=" + extenbut;


                    if (ringfromqueue[nro] !== undefined) {
                        pars = pars + "&fromqueue=" + Base64.encode(ringfromqueue[nro]);
                    }

                    if (ringfromqueuenmr[nro] !== undefined) {
                        pars = pars + "&fromqueuenumber=" + ringfromqueuenmr[nro];
                    }

                    if (chanvars[nro] !== undefined) {
                        for (var j in chanvars[nro]) {
                            debug(j + " = " + chanvars[nro][j]);
                            pars = pars + "&" + j + "=" + chanvars[nro][j];
                            //delete chanvars[nro][j];
                        }
                    }

                    if (popupUrlDecoded != '') {
                        pars = pars + "&url=" + Base64.encode(popupUrlDecoded);
                    }

                    if (poptype == 'ringing') {
                        titulo = lang.incoming_call;
                    } else if (poptype == 'connect') {
                        titulo = lang.call_connected;
                    } else if (poptype == 'hangup') {
                        titulo = lang.call_ended;
                    } else {
                        titulo = lang.note;
                    }

                    var xhr = jQuery.ajax({
                        type: "GET",
                        data: pars,
                        url: "checkdir.php",
                        success: function(output, status) {
                            var oJSON = jQuery.parseJSON(xhr.getResponseHeader('X-JSON'));

                            var clidnum = Base64.decode(oJSON.clidnum);
                            var clidname = Base64.decode(oJSON.clidname);
                            var picture = oJSON.picture;
                            var queue = Base64.decode(oJSON.queue);
                            var url = Base64.decode(oJSON.url);
                            var urlicon = window.location.protocol + "//" + window.location.host + window.location.pathname.slice(0, window.location.pathname.lastIndexOf("/")) + "/" + picture;
                            var texto = clidnum + " " + clidname;
                            var textonoti = clidnum + " " + replace(clidname, "<br/>", "\n");

                            if (queue != '') {
                                texto += "<br/>" + lang['from_queue'] + " " + queue;
                                textonoti += "\n" + lang['from_queue'] + " " + queue;
                            }

                            if (url != '') {
                                if (lang.hasOwnProperty('Popup')) {
                                    poptext = lang.Popup;
                                } else {
                                    poptext = 'Popup';
                                };
                                texto += "<br/><a style='color:#ff0;' href='" + url + "' target='_blank'>" + poptext + "</a>";
                            }

                            if(poptype == 'ringing' && notifyRinging === false) {
                                return;
                            }

                            if(poptype == 'connect' && notifyConnect === false) {
                                return;
                            }

                            if(poptype == 'hangup' && notifyHangup === false) {
                                return;
                            }

                            if (desktopNotify === true) {
                                window.notifylib.notify({
                                    "title": titulo,
                                    "description": textonoti,
                                    "icon": urlicon,
                                    "timeout": notifyDuration,
                                    "url": oJSON.url
                                });
                            }

                            var textofinal = "<div class='container-fluid'><div class='row'><div class='col-xs-12 col-lg-12 nopad notifyTitle'>"+titulo+"</div></div><div class='row'><div class='col-xs-4 col-lg-4 nopad'><img class='img-responsive' src='"+urlicon+"'/></div><div class='col-xs-8 col-lg-8 notifyText'>"+texto+"</div></div></div>";

                            var notydurms = notifyDuration * 1000;
                            alertify.set({
                                delay: notydurms
                            });
                            alertify.log(textofinal);

                            for (var iplug in plugins) {
                                if (typeof(plugins[iplug]['notify_popup']) == 'function') {
                                    plugins[iplug]['notify_popup'](poptype,titulo,texto,urlicon);
                                }
                            }

                        },
                        error: function(output) {
                            debug(output);
                        }
                    });
                } else {
                    debug("No Popup because notify duration is set to zero");
                }
            } else {
                debug("No Popup as it is not for me, my position: " + myposition);
            }
        }
    }

    function handshake(nro, texto, slot) {
        var deco = Base64.decode(texto);
        eval(deco);
    }

    function smsok(nro, texto, slot) {
        // OJO FALTA PROBAR
        debug("sms ok en nro " + nro + " el texto uniqueid es " + texto);
        var partes = texto.split("!");
        var uni = partes[0];
        var result = Base64.decode(partes[1]);

        if (nro == myposition) {
            alertify.success(result);
            window.clearTimeout(smstimer);
        }
    }

    function smsfail(nro, texto, slot) {
        debug("sms fail fail en nro " + nro + " el texto uniqueid es " + texto);
        var partes = texto.split("!");
        var uni = partes[0];
        var err = Base64.decode(partes[1]);

        if (nro == myposition) {
            alertify.error(err);
            window.clearTimeout(smstimer);
        }
    }

    function chat(nro, texto, slot) {
        if (myposition == nro) {
            var origen = slot;
            var dstn = nro;
            var textdecode = Base64.decode(texto);

            var partes = textdecode.split("~",2);
            message = partes[0];
            uuid = partes[1];

            if(last_uuid != uuid) {
                last_uuid = uuid;
                if (textdecode == "notlogged") {
                    newChat(origen, 0, message);
                } else {
                    newChat(origen, dstn, message);
                }
            }
        }
    }

    function note(nro, texto, slot) {
        if (myposition == nro) {
            var origen = extenpos[slot];
            var dstn = nro;
            var textdecode = Base64.decode(texto);
            var tstamp = textdecode.substring(0, textdecode.indexOf("!"));
            var nota = textdecode.substring(textdecode.indexOf("!") + 1, textdecode.length);

            newNote(origen, dstn, nota, tstamp);
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|noteack|" + slot + "!" + tstamp + "|" + hash + "\" />";
            send(comando);
        }
    }

    function leavingvoicemail(nro, texto, slot) {
        var mwi = $("#mwi" + nro);
        if (texto == "1") {
            mwi.css('visibility', 'visible');
            mwi.removeClass("notregistered");
            $('#mwi' + nro).effect('pulsate', {
                times: 10
            }, 5000, function() {});
        } else {
            mwi.css('opacity', 1);
        }
    }

    function regresult(nro, texto, slot) {
        var resultado = texto.substring(0, 1);
        var resto = texto.substring(2);
        var textdecode = Base64.decode(resto);
        document.body.style.cursor = 'default';
        if (resultado == 0) {
            alertify.error(textdecode);
        } else {
            alertify.success(textdecode);
            return_from_reg_result = 1;
            ping = 1;
        }
    }

    function plugin(nro, texto, slot) {
        plugin_data = Base64.decode(texto);
        var partes = plugin_data.split("!",2);
        debug('hago eval del plugin '+partes[0]);
        var code = plugin_data.substr(plugin_data.indexOf('!')+1);
        delete plugins[partes[0]];
        eval(code);
        plugins[partes[0]].init();
        debug('fin eval del plugin '+partes[0]);
    }

    function style(nro, texto, slot) {
        var css = Base64.decode(texto);
        $('<style type="text/css"></style>')
        .html(css)
        .appendTo("head");
    }

    function setpluginlang(nro, texto, slot) {
        var partes = texto.split("!",2);
        plugin_data = Base64.decode(partes[1]);
        debug('set plugin lang for '+partes[0]);
        eval(plugin_data);
        plugins[partes[0]].setLang();
    }

    this.key = key;
    this.version = version;
    this.reload = reload;
    this.getvar = getvar;
    this.incorrect = incorrect;
    this.correct = correct;
    this.preferences = preferences;
    this.defaultpreferences = defaultpreferences;
    this.defaultpresence = defaultpresence;
    this.vmailpath = vmailpath;
    this.permit = permit;
    this.permitbtn = permitbtn;
    this.restrictq = restrictq;
    this.zbuttons = zbuttons;
    this.demo = demo;
    this.pong = pong;
    this.qualify = qualify;
    this.voicemail = voicemail;
    this.voicemailcount = voicemailcount;
    this.lock = lock;
    this.unlock = unlock;
    this.astdbcust = astdbcust;
    this.devtype = devtype;
    this.fromqueue = fromqueue;
    this.queuemember = queuemember;
    this.queuemembers = queuemembers;
    this.settext = settext;
    this.usersonline = usersonline;
    this.xstatus = xstatus;
    this.presence = xpresence;
    this.ip = ip;
    this.state = state;
    this.link = link;
    this.direction = direction;
    this.settimer = settimer;
    this.rename = rename;
    this.changegroup = changegroup;
    this.notionline = notionline;
    this.notioffline = notioffline;
    this.details = details;
    this.queueentry = queueentry;
    this.waitingcalls = waitingcalls;
    this.clearentries = clearentries;
    this.members = members;
    this.soundjoin = soundjoin;
    this.clidnum = clidnum;
    this.clidname = clidname;
    this.setvar = setvar;
    this.dialingchannel = dialingchannel;
    this.setZero = setZero;
    this.notifyringing = notifyringing;
    this.notifyconnect = notifyconnect;
    this.notifybroadcast = notifybroadcast;
    this.notify = notify;
    this.enablesms = enablesms;
    this.enablechatadmin = enablechatadmin;
    this.handshake = handshake;
    this.smsok = smsok;
    this.smsfail = smsfail;
    this.vmaildetail = vmaildetail;
    this.chat = chat;
    this.note = note;
    this.agentconnect = agentconnect;
    this.leavingvoicemail = leavingvoicemail;
    this.Monitor = Monitor;
    this.StopMonitor = StopMonitor;
    this.PauseMonitor = PauseMonitor;
    this.UnpauseMonitor = UnpauseMonitor;
    this.managerproblem = managerproblem;
    this.regresult = regresult;
    this.plugin = plugin;
    this.style = style;
    this.setpluginlang = setpluginlang;
}

function hideshowtoolbaricons() {

    if (jQuery.inArray('record', permisos) >= 0 || jQuery.inArray('recordself', permisos) >= 0  || jQuery.inArray('all', permisos) >= 0) {
        $('#lirecordingsmenu').show();
    } else {
        $('#lirecordingsmenu').hide();
    }

    if (jQuery.inArray('chatadmin', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
        if (licenselevel & 4 && chatadm_enabled == 1) {
            $('#lichatmenu').show();
        } else {
            $('#lichatmenu').hide();
        }
    } else {
        $('#lichatmenu').hide();
    }

    if (jQuery.inArray('preferences', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
        $('#lipreferencesmenu').show();
    } else {
        $('#lipreferencesmenu').hide();
    }

    if (jQuery.inArray('phonebook', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
        $('#licontactsmenu').show();
    } else {
        $('#licontactsmenu').hide();
    }
 
    if (jQuery.inArray('callhistory', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
        $('#licdrmenu').show();
    } else {
        $('#licdrmenu').hide();
    }
 
    $('#actionbar').children().each(function() {

        if ($(this).attr('id')=='action_transfer' || $(this).attr('id')=='action_supervisedtransfer' || $(this).attr('id')=='action_vmail') {
           if (jQuery.inArray('transfer', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
              $(this).show();
           } else {
              $(this).hide();
           }
        } else if ($(this).attr('id')=='action_originate') {
            if (jQuery.inArray('dial', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        } else if ($(this).attr('id')=='action_transferexternal') {
            if (jQuery.inArray('transferexternal', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        } else if ($(this).attr('id')=='action_pickup') {
            if (jQuery.inArray('pickup', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        } else if ($(this).attr('id')=='action_spy' || $(this).attr('id')=='action_whisper') {
            if (jQuery.inArray('spy', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        } else if ($(this).attr('id')=='action_hangup') {
            if (jQuery.inArray('hangup', permisos) >= 0 || jQuery.inArray('hangupself', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        } else if ($(this).attr('id')=='action_record') {
            if (jQuery.inArray('record', permisos) >= 0 || jQuery.inArray('recordself', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
               $(this).show();
            } else {
               $(this).hide();
            }
        }
    });

    $('#actionbar [data-toggle="tooltip"]').tooltip({container:'body'});

    var largo1 = $('#actionbar').find(':visible').length;
    var largo2 = $('#custombar').find(':visible').length;
    var hayvisibles = largo1 + largo2;
    if(hayvisibles == 0) {
        // hacemos un pull de el filter dial porque  no hay acciones
        $('#dialfilterbar').addClass('col-md-pull-5');
        $('#dialfilterbar').addClass('col-lg-pull-5');
        $('#dialfilterbar').addClass('col-xs-pull-1');
    } else {
        $('#dialfilterbar').removeClass('col-md-pull-5');
        $('#dialfilterbar').removeClass('col-lg-pull-5');
        $('#dialfilterbar').removeClass('col-xs-pull-1');
    }
}

var drawButton = function(t) {

    resizinggrid=1;
    if(jQuery.inArray('extensionlist', extenlistGroup)==-1) {
        extenlistGroup.push("extensionlist");
    }

    $('#loader').hide();
    $('#head').show();
    $('#allbuttons').show();

    var hide_extension = 1;
    var hide_park = 1;
    var hide_trunk = 1;
    var hide_queue = 1;
    var hide_conference = 1;
    var hide_ringgroup = 1;

    for (var s = 0; s < botonitos.length; s++) {
        for (var i in botonitos[s]) {
            if (botonitos[s].hasOwnProperty(i)) {
                if (i == "LABEL") {
                    extenlabel[s] = botonitos[s][i];
                }
                if (i == "TYPE") {
                    buttontype[s] = botonitos[s][i];
                }
                if (i == "EXTENSION") {
                    extennumber[s] = botonitos[s][i];
                }
                if (i == "CONTEXT") {
                    extencontext[s] = botonitos[s][i];
                }
                if (i == "GROUP") {
                    extengroup[s] = Base64._utf8_decode(botonitos[s][i]);
                    var posi = jQuery.inArray(extengroup[s], displaygroups);
                    if (posi<0) {
                        displaygroups.push(extengroup[s]);
                    } 
                }
                if (i == "MAINCHANNEL") {
                    extenchan[s] = botonitos[s][i];
                }
                if (i == "EMAIL") {
                    extenmail[s] = botonitos[s][i];
                }
                if (i == "EXTERNAL") {
                    externalnumber[s] = botonitos[s][i];
                }
                if (i == "CSSCLASS") {
                    extencss[s] = botonitos[s][i];
                }
                if (i == "TAGS") {
                    extentags[s] = Base64._utf8_decode(botonitos[s][i]);
                }
            }
        }
    }
    var todas_extensiones = [];
    var descendant = $("#allbuttons").children(':first');

    if (myposition > 0) {
        todas_extensiones.push(myposition);
    }

    for (var z = 1; z < extenlabel.length; z++) {
        if (extenlabel[z] === undefined) {
            continue;
        }
        if (z != myposition) {
            todas_extensiones.push(z);
        }
    }

    contqueue = 0;
    for (var m = 0; m < todas_extensiones.length; m++) {
        var a = todas_extensiones[m];
        if (extenlabel[a] === undefined) {
            continue;
        }

        var textolabel = "";
        if (extennumber[a] != " " && extennumber[a] !== undefined) {
            if (noExtenInLabel === false) {
                textolabel = extennumber[a] + " " + extenlabel[a];
            } else {
                textolabel = extenlabel[a];
            }
        } else {
            textolabel = extenlabel[a];
        }

        var ul = document.createElement('div');

        $(ul).addClass('free').addClass('noselect').addClass('myclick').attr('id', 'boton' + a);

        if (buttontype[a] == "extension") {
            if (startNotRegistered === true) {
                $(ul).addClass('notregistered');
            } else {
                $(ul).addClass('free');
            }
        } else {
            $(ul).addClass('free');
        }

        if (buttontype[a] == "queue") {

            var posi = jQuery.inArray(extengroup[a], displaygroups);
            if(posi>-1) {

                maindiv    = 'box_grp'+posi+'box';
                contentdiv = 'box_grp'+posi+'content';
                tagdiv     = 'box_grp'+posi+'tag';
                listdiv    = 'box_grp'+posi+'list';
                autoheight = 'box_grp'+posi;
                groupname = extengroup[a];

                if ($('#'+maindiv).length == 0) {
                    var la = $.parseHTML(jQuery.template('<div id="#{maindiv}" data-gs-width="9"><div class="grid-stack-item-content boxstyle boxstylebg"> <div id="#{contentdiv}" class="widgetcontent widget widget-color"><header role="heading"><div class="widget-ctrls" role="menu"><a href="javascript:void(0);" class="myclick button-icon widget-toggle-btn langcollapse" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{langcollapse}"><i class="fa fa-caret-square-o-up"></i></a><a href="javascript:void(0);" class="myclick button-icon widget-lock-btn langlockunlock" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{lockunlock}"><i class="fa fa-unlock-alt"></i></a></div><span class="handle widget-icon"><i class="fa fa-bars"></i></span><h3><span id="#{tagdiv}">#{groupname}</span></h3></header><div class="widgetscroll" id="#{listdiv}"></div></div></div></div>').eval({
                        maindiv: maindiv,
                        contentdiv: contentdiv,
                        tagdiv: tagdiv,
                        listdiv: listdiv,
                        groupname: groupname,
                        broadcast: lang.broadcast,
                        lockunlock: lang.toggle_lock,
                        langcollapse: lang.collapse
                    }));

                    grid = $('.grid-stack').data('gridstack');
                    grid.addWidget(la,0,0,9,2,true);
                    //extenlistGroup.push(maindiv);
                    queuelistGroup.push(maindiv);
                }

                $('#'+listdiv).append(ul);

            } else {
                // Agrega el boton de cola al DOM
                hide_queue = 0;
                $('#queuelist').append(ul);
            }
            $(ul).addClass('queuebutton');
            var coli = extenchan[a].substring(6, extenchan[a].length);
            availablequeues.push(coli);
            dict_queue[coli] = extenlabel[a];
            var partesqueue = coli.split("^");
            printy_queue[partesqueue[0]] = extenlabel[a];
            printy_queue_r[extenlabel[a]] = partesqueue[0];

            queueindex[a] = contqueue;
            contqueue++;
        } else if (buttontype[a] == "trunk") {
            hide_trunk = 0;
            $('#trunklist').append(ul);
            $(ul).addClass('trunkbutton');
        } else if (buttontype[a] == "conference") {
            hide_conference = 0;
            $('#conferencelist').append(ul);
            $(ul).addClass('conferencebutton');
        } else if (buttontype[a] == "park") {
            hide_park = 0;
            $('#parklist').append(ul);
            $(ul).addClass('parkbutton');
        } else if (buttontype[a] == "ringgroup") {
            hide_ringgroup = 0;
            $('#ringgrouplist').append(ul);
            $(ul).addClass('ringgroupbutton');
        } else {

            if (extengroup[a] !== undefined) {
                debug("boton tiene grupo "+extengroup[a]);

                var posi = jQuery.inArray(extengroup[a], displaygroups);

                if(extengroup[a]=='') { 
                    extengroup[a] = lang.extensions; 
                    maindiv    = 'extensionbox';
                    contentdiv = 'extensioncontent';
                    tagdiv     = 'extensiontag';
                    listdiv    = 'extensionlist';
                    bcasttag   = 'chatbroadcast_Extensions';
                    autoheight = 'extension';
                    groupname  = lang.extensions;
                    hide_extension = 0;
                } else {
                    maindiv    = 'box_grp'+posi+'box';
                    contentdiv = 'box_grp'+posi+'content';
                    tagdiv     = 'box_grp'+posi+'tag';
                    listdiv    = 'box_grp'+posi+'list';
                    bcasttag   = 'chatbroadcast_grp'+posi;
                    autoheight = 'box_grp'+posi;
                    groupname = extengroup[a];
                }

                if ($('#'+maindiv).length == 0) {
                    var la = $.parseHTML(jQuery.template('<div id="#{maindiv}" data-gs-width="9"><div class="grid-stack-item-content boxstyle boxstylebg"> <div id="#{contentdiv}" class="widgetcontent widget widget-color"><header role="heading"><div class="widget-ctrls" role="menu"><a href="javascript:void(0);" class="myclick button-icon widget-broadcast-btn ctxmenugroup broadcast" id="#{bcasttag}" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{broadcast}"><i class="fa fa-bullhorn "></i></a><a href="javascript:void(0);" class="myclick button-icon widget-toggle-btn langcollapse" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{langcollapse}"><i class="fa fa-caret-square-o-up"></i></a><a href="javascript:void(0);" class="myclick button-icon widget-lock-btn langlockunlock" data-toggle="tooltip" rel="tooltip" title="" data-placement="bottom" data-original-title="#{lockunlock}"><i class="fa fa-unlock-alt"></i></a></div><span class="handle widget-icon"><i class="fa fa-bars"></i></span><h3><span id="#{tagdiv}">#{groupname}</span></h3></header><div class="widgetscroll" id="#{listdiv}"></div></div></div></div>').eval({
                        maindiv: maindiv,
                        contentdiv: contentdiv,
                        tagdiv: tagdiv,
                        listdiv: listdiv,
                        bcasttag: bcasttag,
                        groupname: groupname,
                        broadcast: lang.broadcast,
                        lockunlock: lang.toggle_lock,
                        langcollapse: lang.collapse
                    }));

                    grid = $('.grid-stack').data('gridstack');
                    grid.addWidget(la,0,0,9,2,true);
                    extenlistGroup.push(maindiv);

                    if (!(hasPerm(0, 'broadcast') || hasPerm(0, 'all'))) {
                        $('#c' + bcasttag).hide();
                    }
                }
                // Agregamos boton en lista de extensiones  de grupo
                $(ul).addClass('extenbutton');
                $('#'+listdiv).append(ul);
                debug('set tips '+listdiv);
                debug('set tips '+listdiv);
                debug('set tips '+listdiv);
                debug('set tips '+listdiv);
                setThisTip(maindiv);

            } else {
                // Agregamos boton en lista de extensiones regular
                hide_extension = 0;
                $(ul).addClass('extenbutton').addClass('noselect');
                $('#extensionlist').append(ul);
            }
        }

        if (extencss[a] !== undefined) {
            $(ul).addClass(extencss[a]);
        }

        // Div contenedor de LABEL e icono MWI e INFO
        var la = document.createElement('div');
        $(la).addClass('linewrapper');
        $(ul).append(la);

        if (buttontype[a] == "extension") {
            var li = document.createElement('div');
            $(li).addClass('presenceNormal').addClass('ctxmenu').attr({'id': 'presence' + a,'data-toggle':'tooltip'}).css({
                color: '#8a8',
                textAlign: 'center'
            }).html('').tooltip({container:'body'});
            $(la).append(li);
        } else if (buttontype[a] == "conference") {
            var li = document.createElement('div');
            $(li).addClass('meetmeIcon').addClass('ctxmenumeetme').attr('id', 'meetme' + a);
            $(la).append(li);
        }

        if (extentags[a] !== undefined) {
            var li = document.createElement('div');
            $(li).addClass('tags').attr({
                id: 'taggs' + a
            }).html(extentags[a]);
            $(la).append(li);
        }

        var li = document.createElement('div');
        $(li).addClass('labelname').attr({
            id: 'label' + a,
            'data-original-title': textolabel
        }).html(textolabel).tooltip({delay: { "show": 500, "hide": 100 }, container: 'body'});
        if (a == myposition || buttontype[a] == "queue") {
            $(li).addClass('bold');
        }
        if (buttontype[a] == "queue" || buttontype[a]=="ringgroup") {
            $(li).width('85%');
        }
        $(la).append(li);

        if (buttontype[a] == "extension" || buttontype[a] == "queue" || buttontype[a]=="ringgroup") {
            var li = document.createElement('div');

            $(li).addClass('mwi').addClass('myclick').attr({'id': 'mwi' + a, 'data-toggle': 'tooltip', 'data-placement': 'bottom'}).html(' ').tooltip({container:'body'});
            if(buttontype[a]=="queue") {
                $(li).css('float','left');
            }
            $(la).append(li);
        }

        var li = document.createElement('div');
        $(li).addClass('extrainvisible').attr({'id': 'extrainfo' + a, 'data-toggle': 'tooltip'}).html(' ').tooltip({container:'body'});
        $(la).append(li);

        var li = document.createElement('div');
        $(li).addClass('clear');
        $(li).html('');
        $(ul).append(li);

        if (buttontype[a] == "extension") {

            // Las lineas 1 y 2 se dibujan solo para extensiones, no para colas
            for (conti = 1; conti <= showLines; conti++) {

                var la = document.createElement('div');
                $(la).attr('id', 'acline_' + conti + '_' + a).addClass('linewrapper').addClass('acline');
                if (mypreferences.dynamicLineDisplay == "on") {
                    $(la).addClass('invisible');
                }
                $(ul).append(la);


                li = document.createElement('div');
                $(li).addClass('extension').attr('id', 'phone' + conti + '_' + a);
                $(la).append(li);

                li = document.createElement('div');
                $(li).attr('id', 'clid' + conti + '_' + a).addClass('clid myclick').html(translate('&inactive_line!' + conti));
                $(la).append(li);

                li = document.createElement('div');
                $(li).addClass('timer').attr('id', 'tick' + conti + '_' + a);
                $(la).append(li);

                li = document.createElement('div');
                $(li).addClass('clear');
                $(ul).append(li);

            }

            if (enableDragTransfer === true) {
                $('#boton' + a).droppable({
                    accept: '.extension, .qentrylabel, .parkedcall, .trunkcall',
                    hoverClass: 'selected',
                    drop: function(event, ui) {
                        var source = ui.draggable.attr('id');
                        if (ui.draggable.data('channel') !== undefined) {
                            debug(ui.draggable.data('channel'));
                            source = replace(ui.draggable.attr('id'), "_", "!");
                            source += '!' + ui.draggable.data('channel');

                        }
                        var target = $(this).attr('id');
                        dragtransfer(source, target)
                    }
                });
            }
        } else
        if (buttontype[a] == "park") {
            li = document.createElement('div');
            $(li).addClass('pentry').attr('id', 'trunkentries_' + a);
            $(ul).append(li);
        } else
        if (buttontype[a] == "trunk") {
            la = document.createElement('div');
            $(la).addClass('linewrapper');
            $(ul).append(la);

            li = document.createElement('div');
            $(li).addClass('clid').attr('id', 'clid0_' + a);
            $(la).append(li);

            li = document.createElement('div');
            $(li).addClass('tentry').attr('id', 'trunkentries_' + a);
            $(ul).append(li);
        } else
        if (buttontype[a] == "conference") {
            li = document.createElement('div');
            $(li).addClass('centry').attr('id', 'meetmeentries_' + a);
            $(ul).append(li);
            $('#extrainfo' + a).removeClass('extrainvisible').addClass('extraconference');
        } else
        if (buttontype[a] == "queue") {

            waitingCalls[a] = 0;

            if (mypreferences.displayQueue == "max") {
                showMax = 1;
            } else {
                showMax = 0;
            }

            $('#extrainfo' + a).append('<img src="./images/switch_minus.gif" alt="Minimize" data-toggle="tooltip" data-placement="left" data-original-title="' + lang.changeDisplayType + '" class="myclick queueType" id="queueType' + a + '" />');

            li = document.createElement('div');
            $(li).addClass('aentry').attr('id', 'agententries_' + a);
            $(ul).append(li);
            if (showMax === 0) {
                $(li).hide();
            }

            li = document.createElement('div');
            $(li).addClass('qentry').attr('id', 'queueentries_' + a);
            $(ul).append(li);
            if (showMax === 0) {
                $(li).hide();
            }

            li = document.createElement('div');
            $(li).addClass('qentry').attr('id', 'agentsummary_' + a);
            $(ul).append(li);
            if (showMax === 1) {
                $(li).hide();
            }

            li = document.createElement('div');
            $(li).addClass('qentry').attr('id', 'queuesummary_' + a);
            $(ul).append(li);
            $('#queuesummary_' + a).html(translate('&calls!' + '0'));
            if (showMax === 1) {
                $(li).hide();
            }

            if (enableDragTransfer === true) {
                $('#boton' + a).droppable({
                    accept: '.extension, .qentrylabel, .parkedcall, .trunkcall',
                    hoverClass: 'selected',
                    drop: function(event, ui) {
                        var source = ui.draggable.attr('id');
                        if (ui.draggable.data('channel') !== undefined) {
                            debug(ui.draggable.data('channel'));
                            source = replace(ui.draggable.attr('id'), "_", "!");
                            source += '!' + ui.draggable.data('channel');

                        }
                        var target = $(this).attr('id');
                        dragtransfer(source, target)
                    }
                });
            }
        };
        $('#boton' + a).disableSelection();
        $('#extrainfo'+a+' [data-toggle="tooltip"]').tooltip()
    };

    $('#parklist').append('<div class="clearfix bottommargin"></div>');
    $('#queuelist').append('<div class="clearfix bottommargin"></div>');
    $('#trunklist').append('<div class="clearfix bottommargin"></div>');
    $('#conferencelist').append('<div class="clearfix bottommargin"></div>');
    $('#ringgrouplist').append('<div class="clearfix bottommargin"></div>');
    $('#extensionlist').append('<div class="clearfix bottommargin"></div>');

    for(i=0;i<displaygroups.length;i++) {
        $('#box_grp'+i+'list').append('<div class="clearfix bottommargin"></div>');
    }

    setMenuExtensions();
    setMenuQueues();
    setMenuMeetme();
    setMenuPickup();
    setMenuGroup();

    var bar = $('#actionbar');

    if (myposition > 0) {

        var but;
        var img;
        var txt;

        but = document.createElement('div');
        $(but).attr({
            id: 'action_originate',
            'data-toggle': 'tooltip',
            'data-original-ztitle': lang.dial,
            'data-placement': 'bottom'
        }).addClass('actionbutton myclick');
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_dial_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-dial').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).attr({
            id: 'action_transfer',
            'data-original-title': lang.blind_transfer,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        }).addClass('actionbutton myclick');
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_blindtransfer_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-transfer').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('actionbutton myclick').attr({
            id: 'action_supervisedtransfer',
            'data-original-title': lang.attendant_transfer,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_supervisedtransfer_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-supervised_transfer').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('actionbutton myclick').attr({
            id: 'action_vmail',
            'data-original-title': lang.transfer_vmail,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_voicemailtransfer_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-vmail_transfer').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('actionbutton myclick').attr({
            id: 'action_transferexternal',
            'data-original-title': lang.transfer_external,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_mobiletransfer_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-mobile_transfer').addClass('tbutton');

        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('myclick actionbutton').attr({
            id: 'action_pickup',
            'data-original-title': lang.pickup,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_pickup_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-pickup').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('myclick actionbutton').attr({
            id: 'action_spy',
            'data-original-title': lang.spy,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_spy_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-spy').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('myclick actionbutton').attr({
            id: 'action_whisper',
            'data-original-title': lang.whisper,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_whisper_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-whisper').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('myclick actionbutton').attr({
            id: 'action_hangup',
            'data-original-title': lang.hangup,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_hangup_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-hangup').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        but = document.createElement('div');
        $(but).addClass('myclick actionbutton').attr({
            id: 'action_record',
            'data-original-title': lang.record,
            'data-toggle': 'tooltip',
            'data-placement': 'bottom'
        });
        //img = document.createElement('img');
        //$(img).attr({'width': '40px', 'height': '40px', 'src': 'images/pixel.gif'}).addClass('toolbar_record_button tbutton');
        img = document.createElement('span');
        $(img).addClass('fop2-record').addClass('tbutton');
        $(but).append(img);
        bar.append(but);

        hideshowtoolbaricons();
    } else {
        // We still want a logout if no position is set
        var but;
        var img;
        var txt;

    }

    //$('#slider').slideReveal({'position':'right','push':false,'trigger':$('#action_phonebook')});

    grid = $('.grid-stack').data('gridstack');

    if (hide_extension) {
        if($('#extensionbox').length>0) {
            grid.removeWidget($('#extensionbox'));
        }
    }
    if (hide_park) {
        if($('#parkbox').length>0) {
            grid.removeWidget($('#parkbox'));
        }
    }
    if (hide_trunk) {
        if($('#trunkbox').length>0) {
            grid.removeWidget($('#trunkbox'));
        }
    }
    if (hide_queue) {
        if($('#queuebox').length>0) {
            grid.removeWidget($('#queuebox'));
        }
    }
    if (hide_conference == 1) {
        if($('#conferencebox').length>0) {
            grid.removeWidget($('#conferencebox'));
        }
    }
    if (hide_ringgroup == 1) {
        if($('#ringgroupbox').length>0) {
            grid.removeWidget($('#ringgroupbox'));
        }
    }

    setPresenceOptions();

    if (typeof(mypreferences.leftColumnOrder) == 'string') {
        ordenarDiv('left_column', mypreferences.leftColumnOrder);
    }

    var display_none = 0;
    var Right_Children = $('#right_column').children().each(function() {
        if ($(this).css('display') == 'none') {
            display_none++;
        }
    });

    if ($('#right_column').children().length == display_none) {
        // Son todos invisibles
        $("#left_column").removeClass();
    }

    $('#smsbox').hide(); 
    if(sms_enabled==1) {
        if (hasPerm(0, 'smsmanager') || hasPerm(0, 'all')) {
            if ($('#smsbox').length > 0) {
                $('#smsbox').show(); 
            }
        }
    }

    //askFirstState();

    $('#allbuttons').disableSelection();

    if (hasPerm(0, 'broadcast') || hasPerm(0, 'all')) {
        $('.broadcast').show();
    } else {
        $('.broadcast').hide();
    }

    debug('in draw button setvar phonebook');
    if (hasPerm(0, 'phonebook') || hasPerm(0, 'all')) {
        setSessionVariable('phonebook', "yes");
    } else {
        setSessionVariable('phonebook', "no");
    }

    // We do not want to gray out buttons in case of a soft reload
    startNotRegistered=false;

    debug("FIN DRAW BUTTON");

    resizinggrid=0;

};

var setPresenceOptions = function() {
    // Presence Options

    $('#presence').find('option').remove();

    for (var item in presence) {
        if (presence.hasOwnProperty(item)) {
            if (item === "") {
                itemPrint = lang['available'];
            } else {
                if (lang.hasOwnProperty(item)) {
                    itemPrint = lang[item];
                } else {
                    itemPrint = item;
                }
            }
            $('#presence').append($('<option>', {
                value: item,
                text: itemPrint
            }));
        }
    }

    $("#presence option").each(function() {
        $(this).css({'backgroundColor': presence[$(this).val()], 'color': '#000'});
    });

    if (disablePresenceOther === false) {
        // Do not show the other option in presence box if disabled
        $('#presence').append($('<option>', {
            value: "!",
            text: lang.other
        }));

        $('#presence option:last').css({'backgroundColor': '#00d020', 'color': '#000'});
    }

    setCurrentPresence();
    setSelectedPresenceClass();

    $('#presence.selectpicker').selectpicker('refresh');

    if (disablePresence === true) {
        $('.navinputpresence').hide();
    }
}

var setCurrentPresence = function() {

    if(currentpresence!='') {
       var presen = $('#presence' + myposition);
       var ok = 0;
       var cont = 0;
       for (var sel in presence) {
           if (sel == currentpresence) {
               $('#presence')[0].selectedIndex = cont;
               ok = 1;
           }
           cont++;
       }
       if (ok === 0) {
           $('#presence')[0].selectedIndex = cont-1;
       }
       $('.selectpicker').selectpicker('refresh');
   }
}

var setSelectedPresenceClass = function () {
    debug('set selected presence class');
    if(typeof $('#presence.selectpicker').data('selectpicker') !== 'undefined') {
        var elegido = $('#presence.selectpicker').val();
        var color   = presence[elegido]; 
        if (elegido == '!') {
            color =  '#00d020';
        } 
        $('#presence.selectpicker').data('selectpicker').$button.css('backgroundColor', color);
    }
};

function resetExit() {
    fopexit = 0;
    return true;
}

function playVmail(folder, file, iconid) {

    var playpos = currentVmailbox;

    debug("play vmail folder " + folder);
    debug("play vmail file " + file);
    debug("play icon " + iconid);

    if (botonitos[playpos]['MAILBOX'] !== undefined) {

        pos = botonitos[playpos]['MAILBOX'].indexOf("@") + 1;
        ctx = botonitos[playpos]['MAILBOX'].substr(pos, botonitos[playpos]['MAILBOX'].length);
        xte = botonitos[playpos]['MAILBOX'].substr(0, pos - 1);

        var hash = hex_md5(lastkey);
        var url = 'setvar.php';
        var pars = {};

        if (audioWav === true && voicemailFormat == 'mp3') {
            voicemailFormat = audioExtension();
        }

        if (voicemailpath.indexOf('dbi:ODBC') >= 0) {
            pars['sesvar'] = 'vfile';
            pars['value'] = file;
            pars2 = hash + "!" + file + "." + voicemailFormat;
            url2 = 'downloadOdbc.php?file=' + pars2;
            debug("Attempt to download odbc msg " + file);
        } else {
            mfile = voicemailpath + "/" + ctx + "/" + xte + "/" + folder + "/msg" + file + "." + voicemailFormat;
            pars['sesvar'] = 'vfile';
            pars['value'] = mfile;
            pars2 = hash + "!" + mfile;
            url2 = 'download.php?file=' + pars2;
            debug("Attempt to download disk file " + mfile);
        }

        if (voicemailFormat == 'gsm') {
            idaudioblock = "tinyblock";
        } else {
            idaudioblock = "audioblock";
        }

        jQuery.ajax({
            type: 'POST',
            url: url,
            data: pars,
            success: function(output, status) {
                debug("sesvar ok, now play with " + url2 + " on icon " + iconid + " id audio block "+idaudioblock);
                if ($('#' + iconid).hasClass('playing')) {
                    debug('deberia poner pausa');
                    soundPlay(idaudioblock, url2, iconid)
                } else {
                    soundPlay(idaudioblock, url2, iconid)
                }
            }
        });

    }
}


function downloadVmail(folder, file, iconid) {

    //var playpos = myposition;
    fopexit = 1;
    var playpos = currentVmailbox;
    if (botonitos[playpos]['MAILBOX'] !== undefined) {
        pos = botonitos[playpos]['MAILBOX'].indexOf("@") + 1;
        ctx = botonitos[playpos]['MAILBOX'].substr(pos, botonitos[playpos]['MAILBOX'].length);
        xte = botonitos[playpos]['MAILBOX'].substr(0, pos - 1);

        var hash = hex_md5(lastkey);
        var url = 'setvar.php';
        var pars = {};
        var pars2 = '';

        if (voicemailpath.indexOf('dbi:ODBC') >= 0) {
            pars['sesvar'] = 'vfile';
            pars['value'] = file;
            pars2 = hash + "!" + file + "." + voicemailFormat;
            url2 = 'downloadOdbc.php';
            debug("Attempt to download odbc msg " + file);
        } else {
            mfile = voicemailpath + "/" + ctx + "/" + xte + "/" + folder + "/msg" + file + "." + voicemailFormat;
            pars['sesvar'] = 'vfile';
            pars['value'] = mfile;
            pars2 = hash + "!" + mfile;
            url2 = 'download.php';
            debug("Attempt to download disk file " + mfile);
        }

        jQuery.ajax({
            type: 'POST',
            url: url,
            data: pars,
            success: function(output, status) {
                debug("success now try downloadFile with url " + url2 + " on file " + pars2);
                downloadFile(url2, pars2);
            }
        });
    }
}

function olddownloadFile(url, pars) {
    $('#dloadfrm').attr('action', url);
    $('#file').val(pars);
    debug($('#dloadfrm'));
    $('#dloadfrm').submit();
}

function downloadFile(url,pars) {

    var hiddenIFrameID = 'hiddenDownloader', iframe = document.getElementById(hiddenIFrameID);
    url = url + "?file=" + pars;

    //debug('In downloadRecording. url <'+url+'>');

    if (iframe === null) {
        iframe = document.createElement('iframe');
        iframe.id = hiddenIFrameID;
        iframe.style.display = 'none';
        document.body.appendChild(iframe);
    }
    iframe.src = url;
}

function moveVoicemail(num, originfolder, destinationfolder) {
    debug("muevo " + num + " a " + destinationfolder);
    var playpos = currentVmailbox;
    if (secret !== "") {
        var hash = hex_md5(secret + lastkey);
        command = "<msg data=\"" + playpos + "|movevmail|" + destinationfolder + "!" + originfolder + "!" + num + "|" + hash + "\" />";
        debug(command);
        $('#panel_' + originfolder).css('opacity', '0.3');
        send(command);
    }
}

// This function removes non-numeric characters
function stripNonNumeric(str) {
    str += '';
    var rgx = /^\d|\.|-|,$/;
    var out = '';
    for (var i = 0; i < str.length; i++) {
        if (rgx.test(str.charAt(i))) {
            if (!((str.charAt(i) == '.' && out.indexOf('.') != -1) || (str.charAt(i) == '-' && out.length != 0))) {
                out += str.charAt(i);
            }
        }
    }
    return out;
}

function formsms(nro) {
    if (hasPerm(0, 'smsmanager') || hasPerm(0, 'all')) {
        var nro = Base64.encode('X' + stripNonNumeric($('#smsNumber').val()));
        var msg = Base64.encode($('#smsMsg').val());
        if (myposition > 0) {
            if (secret !== "") {

                if ($('#smsSend').length > 0) {
                    $('#smsSend').prop('disabled', true);
                    //idSmsSend = Form.enable.delay(60,'smsSend');
                    //if($('#smsStatus').length > 0) {
                    //    $('#smsStatus').html('<img src="images/sending.gif">'+lang.sending);
                    //    idSmsStatus = Element.update.delay(60,'smsStatus',lang.noResponse);
                    //}
                }

                var hash = hex_md5(secret + lastkey);
                var ko = new Date();
                var ji = ko.getTime();
                var randy = Math.random() * 1000;
                var unique = "sms" + ji + randy;
                send("<msg data=\"" + myposition + "!" + nro + "!" + msg + "!" + unique + "|sendsms|0|" + hash + "\" />");
            }
        }
    }
}

function msAddScript(url, pars) {
    eltScript = document.createElement("script");
    eltScript.setAttribute("type", "text/javascript");
    if (url.indexOf('?') > -1) {
        url += '&';
    } else {
        url += '?';
    }
    if (pars === undefined) {
        url += 'rand=' + Math.random();
    } else {
        url += 'rand=' + pars;
    }
    eltScript.setAttribute("src", url);
    document.getElementsByTagName('head')[0].appendChild(eltScript);
};

function msAddCss(url) {
    newstyle = document.createElement("link");
    newstyle.setAttribute('rel', "stylesheet");
    newstyle.setAttribute('type', "text/css");
    newstyle.setAttribute('href', url);
    document.getElementsByTagName('head')[0].appendChild(newstyle);
};

function sendreg() {
    //jQuery.modal.close();
    warnClose = false;
    var regcode = $('#regcode').val();
    var regname = $('#regname').val();
    var regcodeEncoded = Base64.encode(regcode);
    var regnameEncoded = Base64.encode(regname);
    document.body.style.cursor = 'wait';
    debug("regcode " + regcode + " y regname " + regname);
    send("<msg data=\"" + regcodeEncoded + "|register|" + regnameEncoded + "|\" />");
    return false;
}

function fop2_register() {
    warnClose = false;
    $('#registerdialog').modal('show');
    return false;
}

function sends_auth() {

    if(myextension.length==0) { return; }

    if(myextension.indexOf('@')>0) {
       debug("sending context again based on login extension");
       partes = myextension.split("@");
       myextension = partes[0];
       context     = partes[1];
       var context_upper = context.toUpperCase();
       send("<msg data=\"" + context_upper + "|contexto|1|\" />");
       setSessionVariable('context', context_upper, 1);
       return;
    }

    skiplocalauth=0;
    if (typeof plugins['auth'] !== 'undefined' && typeof plugins['auth'].postAuth == "function") {
        skiplocalauth=1;
        fillextension=myextension;
        fillsecret=secret;
        if(entered_extension!='') { fillextension=entered_extension; }
        if(entered_secret!='') { fillsecret=entered_secret; }

        debug('sends auth via plugin context '+context.toUpperCase()+' extension '+fillextension+' secret '+fillsecret);
        plugins['auth'].postAuth(context.toUpperCase(),fillextension,fillsecret);
    }

    if(skiplocalauth==0) {
        debug('sends builtin auth '+secret+' y '+lastkey);
        var hash = hex_md5(secret + lastkey);
        var comando = "<msg data=\"1|auth|" + myextension + "|" + hash + "\" />";
        send(comando);
    }
}

function spy(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + destino);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring spy request');
            return;
        }
        if ( hasPerm(0,'spy') || hasPerm(0,'all') ||  hasPerm(destino,'spy') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|tospy|" + destino + "|" + hash + "\" />";
            send(comando);
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function whisper(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + destino);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring whisper request');
            return;
        }
        if ( hasPerm(0,'spy') || hasPerm(0,'all') ||  hasPerm(destino,'spy') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|towhisper|" + destino + "|" + hash + "\" />";
            send(comando);
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function record(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + destino);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring record request');
            return;
        }
        if ( hasPerm(0,'record') || hasPerm(0,'all') ||  hasPerm(destino,'record') || hasPerm(destino,'all') || ( hasPerm(0,'recordself') && myposition == destino)) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|record|" + destino + "|" + hash + "\" />";
            send(comando);
        } 
    } else {
        debug("No origin extension defined for actions");
    }
}

function dial(numerodestino) {

    var hash      = hex_md5(secret + lastkey);
    var useorigin = myposition;

    if (globalselected !== undefined) {
        var desti = ExtraeNumero(globalselected.id);
        if (buttontype[desti] == "conference") {
            useorigin = desti;
        }
    }

    if (useorigin > 0) {
        var clidname='';
        let re = /([^<]*)<?([^>]*)>?/gm;
        var partes = re.exec(numerodestino);
        if(partes[2]!='') {
            numerodestino=partes[2];
            clidname = Base64.encode(partes[1]);
        }

        numerodestino = numerodestino.replace(/[^A-Za-z0-9@\.-_#\* ]+/g, '');
        numerodestino = numerodestino.replace(/\s/g, "");

        var dprefix = '';
        if(typeof(dialPrefix) !== 'undefined') {
            if(dialPrefix != '') {
                numerodestino = dialPrefix + numerodestino;
            }
        }

        if ( clidname != '' ) {
            numerodestino += "!"+clidname;
        }

        if ( hasPerm(0,'dial') || hasPerm(0,'all') ) {
            // Soft Phone?
            if(useorigin == myposition && typeof(sipcredentials)!=='undefined' && $('#phoneiframe').length > 0) {
                if(numerodestino.indexOf('!')>0) {
                    numerodestino = numerodestino.split('!')[0];
                }
                document.getElementById("phoneiframe").contentWindow.setOutput(numerodestino);
                document.getElementById("phoneiframe").contentWindow.dial(numerodestino);
            } else {
                var comando = "<msg data=\"" + useorigin + "|dial|" + numerodestino + "|" + hash + "\" />";
                send(comando);
            }
        } else {
            debug('No permission to dial');
        }

    } else {
        debug("No origin extension defined for actions");
    }

}

function hangup(destino) {

    if (hasPerm(destino,'hangup') || hasPerm(0,'hangup') || hasPerm(destino,'all') || hasPerm(0,'all') || 
       (hasPerm(0,'hangupself') && destino == myposition)) {
        debug('Hangup acction allowed');
    } else {
        debug('no tiene permisos para cortar, ignoro');
        return;
    }

    if(typeof doingatxfer[myposition] !=='undefined') {
        for (var slot in ringingchan[destino]) {
            if(ringingchan[destino][slot].indexOf('Local')==0) {
                var canceltransfer = Base64.encode(ringingchan[destino][slot] + ";1" );
                var hash = hex_md5(secret + lastkey);
                queuedcommand = "<msg data=\"" + destino + "|cortar|" + canceltransfer + "|" + hash + "\" />";
                sendcommand();
                delete doingatxfer[myposition];
            }
        }
        return;
    } 

    if (myposition > 0) {
        //if (secret !== "") {

            var boton = $('#boton' + destino);
            if (!boton.hasClass('busy')) {
                // No eta busy, chequeamos por ringing
                debug('not busy, count ringing');
                var cuantos = 0;
                var Children = boton.find('.ringing2');
                cuantos += Children.length;
                debug('ringing = ' + cuantos);
                if (cuantos == 0) {
                    debug('Extension not busy nor ringing, ignoring hangup request');
                    return;
                }
            }

            var hash = hex_md5(secret + lastkey);
            queuedcommand = "<msg data=\"" + destino + "|cortar|" + destino + "|" + hash + "\" />";

            if (warnHangup !== false) {

                alertify.set({
                    labels: {
                        ok: lang['yes'],
                        cancel: lang['no']
                    }
                });

                alertify.confirm(lang['confirm_hangup'] + ' ' + extennumber[destino] + '<br/>' + lang['areyousure'], function(e) {
                    if (e) {
                        sendcommand();
                    }
                });

            } else {
                sendcommand();
            }
    } else {
        debug("No origin extension defined for actions");
    }
}

function originate(destino) {

    if (myposition > 0) {
        var hash = hex_md5(secret + lastkey);

        if ( hasPerm(0,'dial') || hasPerm(0,'all') ||  hasPerm(destino,'dial') || hasPerm(destino,'all') ) { 
            if(typeof(sipcredentials)!=='undefined' && $('#phoneiframe').length > 0) {
                num = botonitos[destino]['EXTENSION'];
                document.getElementById("phoneiframe").contentWindow.setOutput(num);
                document.getElementById("phoneiframe").contentWindow.dial(num);
            } else {
                var comando = "<msg data=\"" + myposition + "|originate|" + destino + "|" + hash + "\" />";
                send(comando);
            }
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function dragtransfer(draggedid, droppedid) {

    var numbers = '';
    var destinonbr = droppedid.substr(5);

    if (draggedid.indexOf('qe') == 0) {
        numbers = draggedid.substr(3);
        miparte = numbers.split("!");
    } else if (draggedid.indexOf('park') == 0) {
        numbers = draggedid;
        miparte = numbers.split("!");
    } else if (draggedid.indexOf('trnk') == 0) {
        numbers = draggedid;
        miparte = numbers.split("!");
    } else {
        numbers = draggedid.substr(5);
        miparte = numbers.split("_");

        if($('#'+draggedid).hasClass('ringing2')) { 
            numbers = "1!1!"+ringingchan[miparte[1]][miparte[0]];
            debug('tiene ringing! '+numbers); 
        }
 
    }
    var slot = miparte[0];
    var btnnro = miparte[1];

    debug("transfiero llamado de boton " + btnnro + " en el slot " + slot + " hacia el boton " + destinonbr);

    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + numbers + "|dragatxfer|" + destinonbr + "|" + hash + "\" />";
    send(comando);
}

function blind_transfer_dialbox(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring blind transfer request');
            return;
        }

        if ( hasPerm(0,'transfer') || hasPerm(0,'all') ||  hasPerm(destino,'transfer') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|blindxfernumber|" + destino + "|" + hash + "\" />";
            send(comando);
        }

    } else {
        debug("No origin extension defined for actions");
    }
}

function transfer(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring blind transfer request');
            return;
        }

        if ( hasPerm(0,'transfer') || hasPerm(0,'all') ||  hasPerm(destino,'transfer') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|blindxfer|" + destino + "|" + hash + "\" />";
            send(comando);
        }

    } else {
        debug("No origin extension defined for actions");
    }
}

function supervised_transfer(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring supervised transfer request');
            return;
        }

        if ( hasPerm(0,'transfer') || hasPerm(0,'all') ||  hasPerm(destino,'transfer') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|atxfer|" + destino + "|" + hash + "\" />";

            if (botonitos[destino]['TYPE'] == 'extension') {
                doingatxfer[myposition]=destino;
            }

            send(comando);
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function supervised_transfer_dialbox(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {
            debug('Extension not busy, ignoring supervised transfer request');
            return;
        }

        if ( hasPerm(0,'transfer') || hasPerm(0,'all') ||  hasPerm(destino,'transfer') || hasPerm(destino,'all') ) { 
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|atxfernumber|" + destino + "|" + hash + "\" />";

            send(comando);
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function transfer_to_voicemail(destino) {
    if (myposition > 0) {

        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {

            if ( hasPerm(0,'dial') || hasPerm(0,'all') ||  hasPerm(destino,'dial') || hasPerm(destino,'all') ) { 
                debug('Extension not busy, originate the call instead.');

                if(botonitos[destino]['EXTENVOICEMAIL']!=='undefined') {
                    var partes = botonitos[destino]['EXTENVOICEMAIL'].split("@");
                    var externalnumber = partes[0];
                    var hash = hex_md5(secret + lastkey);
                    var comando = "<msg data=\"" + myposition + "|dial|" + externalnumber + "|" + hash + "\" />";
                    send(comando);
                }
            }

        } else {

            if ( hasPerm(0,'transfer') || hasPerm(0,'all') ||  hasPerm(destino,'transfer') || hasPerm(destino,'all') ) { 
                var hash = hex_md5(secret + lastkey);
                var comando = "<msg data=\"" + myposition + "|tovoicemail|" + destino + "|" + hash + "\" />";
                send(comando);
            }

        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function transfer_to_external(destino) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (!boton.hasClass('busy')) {

            if ( hasPerm(0,'dial') || hasPerm(0,'all') ||  hasPerm(destino,'dial') || hasPerm(destino,'all') ) { 
                debug('Extension not busy, originating call instead');
                if(botonitos[destino]['EXTERNAL']!=='undefined') {
                    var externalnumber = botonitos[destino]['EXTERNAL'];
                    var hash = hex_md5(secret + lastkey);
                    var comando = "<msg data=\"" + myposition + "|dial|" + externalnumber + "|" + hash + "\" />";
                    send(comando);
                }
            }
        } else {

            if ( hasPerm(0,'transferexternal') || hasPerm(0,'all') ||  hasPerm(destino,'transferexternal') || hasPerm(destino,'all') ) { 
                var hash = hex_md5(secret + lastkey);
                var comando = "<msg data=\"" + myposition + "|xferxternal|" + destino + "|" + hash + "\" />";
                send(comando);
            }
        }
    } else {
        debug("No origin extension defined for actions");
    }
}

function pickup_ringing(destino) {

    if (myposition > 0) {

        var boton = $('#boton' + myposition);
        if (boton.hasClass('busy')) {
            debug('Extension busy, ignoring pickup action');
            return;
        }

        var cuantos=0;
        boton = $('#boton' + destino);
        var Children = boton.find('.ringing2');
        cuantos += Children.length;

        if (cuantos > 0) {
            if ( hasPerm(0,'pickup') || hasPerm(0,'all') ||  hasPerm(destino,'pickup') || hasPerm(destino,'all') ) { 
                var hash = hex_md5(secret + lastkey);
                var comando = "<msg data=\"" + myposition + "|pickupRinging|" + destino + "|" + hash + "\" />";
                send(comando);
            }
        } else {
            debug("No ringing extension. Ignoring pickup ringing action");
        }

    } else {
        debug("No origin extension defined for actions");
    }

}

function filter_queue(nro) {

    if(disableQueueFilter === true ) {
        return;
    }

    var Children = $('#queuelist').find('[class="labelname bold"]');
    Children.each(function() {
        var btnnro = $(this).attr('id').substring(5);
        if (nro == btnnro || nro === undefined) {
            $('#boton' + btnnro).show();
        } else {
            $('#boton' + btnnro).hide();
        }
    });
    $('#container').scrollTop(0);
}

function filter_agentes(misagentes) {

    if(disableQueueFilter === true ) {
        return;
    }
    resizinggrid=1;
    grid.batchUpdate();

    for (var a = 0; a < extenlistGroup.length; a++) {
        var hidediv = extenlistGroup[a];
        if(hidediv=='extensionlist') { hidediv='extensionbox'; }
        var Children = $('#' + hidediv ).find('[class*="labelname"]');
        var agentes_mostrados = 0;
        Children.each(

        function() {
            var btnnro = $(this).attr('id').substring(5);
            var contiene = $(this).text().toLowerCase();
            var boton = $('#boton' + btnnro);
            boton.hide();
            if (btnnro == myposition) {
                boton.show();
                agentes_mostrados++;
            }
            misagentes.each(function(ag) {
                var boton = $('#boton' + btnnro);
                var text_filter = escapeRegExp(misagentes[ag].innerHTML.toLowerCase());
                if (text_filter !== "") {
                    if (btnnro != myposition) {
                        var patt1 = new RegExp(text_filter+'$');
                        if (patt1.test(contiene) === true) {
                            if(hideUnregistered===true) {
                                if(boton.hasClass('notregistered')) {
                                } else {
                                    boton.show();
                                    agentes_mostrados++;
                                }
                            } else {
                                boton.show();
                                agentes_mostrados++;
                            }
                        }
                    }
                }
            });
        });

        debug(hidediv+" "+agentes_mostrados);

        var griddiv = hidediv.substr(0,hidediv.length - 3);
        grid_auto_height(griddiv,1);

        if (agentes_mostrados == 0) {
            if($('#'+hidediv).is(':visible')) {
                debug('set save muevo grid '+hidediv);
                grid.move($('#'+hidediv),0,1000);
                $('#' + hidediv).hide();

            }
        } else {
            if(typeof(saveGridPos[hidediv])=='object') {
                if($('#'+hidediv).is(':hidden')) {
                    // If filter is empty, restore all widgets to original position, as other widgets might have taken its place when moved out
                    var coor = saveGridPos[hidediv];
                    grid.update($('#'+hidediv), coor[0], coor[1], coor[2], coor[3]);
                    $('#' + hidediv).show();
                }
            }
        }
    }
    grid.commit();
    resizinggrid=0;
}

function setState() {
    elem = $(this);
    if (elem.val() == '!') {
        // var val = prompt(lang['enter_state'], '');
        alertify.set({
            labels: {
                ok: lang.accept,
                cancel: lang.cancel
            }
        });
        alertify.prompt(lang['enter_state'], function(e, str) {
            // str is the input text
            if (e) {
                setinfo(str);
            } else {
                // user clicked "cancel"
            }
        }, "");

    } else {
        setinfo(elem.val());
    }
    setSelectedPresenceClass();
}

function setinfo(astkey) {
    //if (secret !== "") {
        currentpresence = astkey;
        var myext = myextension;
        if (myext > 0) {
            var astkey64 = Base64.encode(astkey);
            var hash = hex_md5(secret + lastkey);
            var comando = "<msg data=\"" + myposition + "|setastdb|fop2state~" + myext + "~" + astkey64 + "|" + hash + "\" />";
            send(comando);
        }
}

function replace(string, text, by) {
    // Replaces text with by in string
    var strLength = string.length,
        txtLength = text.length;
    if ((strLength === 0) || (txtLength === 0)) {
        return string;
    }

    var i = string.indexOf(text);
    if ((!i) && (text != string.substring(0, txtLength))) {
        return string;
    }
    if (i == -1) {
        return string;
    }

    var newstr = string.substring(0, i) + by;

    if (i + txtLength < strLength) {
        newstr += replace(string.substring(i + txtLength, strLength), text, by);
    }

    return newstr;
};

function hasPerm(target, permission) {
    target = target.toString();
    if (jQuery.inArray(target, permisosbtn[permission]) >= 0 ) {
        return true;
    } else {
        return false;
    }
}

function newNote(from, to, msg, tstamp) {

    debug("New note from " + from + " to " + to + " msg " + msg);

    if (extennumber[from] !== undefined) {
        createChat(from, extennumber[from] + ' ' + extenlabel[from], 1, msg);
        var formattedTime = dateFormat(tstamp * 1000, pdateFormat);
        var msgdiv = document.createElement('div');
        $(msgdiv).attr('class', 'chatboxmsgNote');

        $(msgdiv).html(jQuery.template('<span class="chatboxmsgfromNote">#{username}:  </span><span class="chatboxmsgcontent">#{message}</span> <span class="chatTime">#{formattedTime}</span><div class="clear"></div>').eval({
            message: msg,
            username: lang.note,
            formattedTime: formattedTime
        }));

        if (mypreferences.soundChat !== "") {
            sonido['newchat'].play();
        }

        $('#chatboxcontent_' + from).append(msgdiv);
        $('#chatboxcontent_' + from).scrollTop($('#chatboxcontent_' + from).prop('scrollHeight'));
        pulseChat(from);
    }
}

function newChat(from, to, msg) {

    debug("New chat from " + from + " to " + to + " msg " + msg);

    var soni = createChat(from, extennumber[from] + ' ' + extenlabel[from], 1, msg);

    var thistime = new Date();
    var diftime = 60001;
    if (lastchat[from] !== undefined) {
        diftime = thistime - lastchat[from];
    }

    var msgdiv = document.createElement('div');
    $(msgdiv).attr('class', 'chatboxmsgBubble');

    if (to == '0' || msg == 'NOTONLINE' || msg == 'NOWONLINE') {
        // system message
        msg = lang[msg];
        if (to == '0') {
            $(msgdiv).html(jQuery.template('<div class="chatboxmsgcontentSystem">#{message}</div>').eval({
                message: msg
            }));
        } else {
            var sDate = new Date();
            var tstamp = sDate.getTime();
            var formattedTime = dateFormat(tstamp, pdateFormat);
            $(msgdiv).html(jQuery.template('<div class="chatboxmsgcontentSystem">#{fdate} #{message}</div>').eval({
                message: msg,
                fdate: formattedTime
            }));
        }
    } else {

        if (mypreferences.soundChat !== "") {
            sonido[soni].play();
        }

        var sDate = new Date();
        var tstamp = sDate.getTime();
        var formattedTime = dateFormat(tstamp, pdateFormat);

        if (diftime > 60000) {
            lastchat[from] = thistime;
            $(msgdiv).html(jQuery.template('<div class="chatboxmsgcontentSystem">#{fdate}</div>').eval({
                fdate: formattedTime
            }));
        }
        $(msgdiv).append(jQuery.template('<div class="bubbledRight">#{message}</div>').eval({
            fdate: formattedTime,
            message: msg
        }));

    }

    $('#chatboxcontent_' + from).append(msgdiv);
    $('#chatboxcontent_' + from).scrollTop($('#chatboxcontent_' + from).prop('scrollHeight'));

    pulseChat(from, msg);
    lastmechat[from] = 20000;

}

function pulseChat(id, msg) {
    if (!$('#chatboxcontent_' + id).is(':visible')) {
        $('#cbt_' + id).effect('pulsate', {}, 1000, function() {});
    }
    if (chatFocus === 0) {
        notiChatTitle = 1;
        chatTitle = extennumber[id] + " " + lang.says;
    } else {
        notiChatTitle = 0;
        document.title = savedTitle;
    }
}

function askFirstState() {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"1|initState||" + hash + "\" />";
    send(comando);
};

function defaultPreferences() {

    debug("Setting default preferences if needed or undefined");

    // Language
    if (typeof(language) == 'undefined') {
        language = "en";
    }

    // No Extension in Label
    if (typeof(noExtenInLabel) == 'undefined') {
        noExtenInLabel = false;
    }

    if (typeof(mypreferences.grid) == "undefined") {
        mypreferences.grid = '';
    }

    if (typeof(mypreferences.language) == "undefined") {
        mypreferences.language = language;
    }

    // Sound Chat
    if (typeof(soundChat) == 'undefined') {
        soundChat = true;
    }

    if (typeof(alwaysNotifyChat) == 'undefined') {
        alwaysNotifyChat = false;
    }

    if (typeof(autoPopup) == 'undefined') {
        autoPopup = false;
    }

    if (typeof(notifyRinging) == 'undefined') {
        notifyRinging = false;
    }

    if (typeof(notifyConnect) == 'undefined') {
        notifyConnect = false;
    }

    if (typeof(notifyHangup) == 'undefined') {
        notifyHangup = false;
    }

    if (typeof(popupUrlRinging) == 'undefined') {
        popupUrlRinging = '';
    }

    if (typeof(popupUrlConnect) == 'undefined') {
        popupUrlConnect = '';
    }

    if (typeof(popupUrlHangup) == 'undefined') {
        popupUrlHangup = '';
    }

    // use old popupUrl if new popupUrlRinging is not set
    if (typeof(mypreferences.popupUrl) !== "undefined") {
        if(mypreferences.popupUrl!='') {
            if (typeof(mypreferences.popupUrlRinging) === "undefined") {
                mypreferences.popupUrlRinging = mypreferences.popupUrl;
                var urldecoded = Base64.decode(mypreferences.popupUrlRinging);
                $('#prefPopupUrlRinging').val(urldecoded);
            }
        }
    }

    if (typeof(mypreferences.popupUrlRinging) !== "undefined") {
        if(mypreferences.popupUrlRinging!='') {
            popupUrlRinging = mypreferences.popupUrlRinging;
        }
    }

     if (typeof(mypreferences.popupUrlConnect) !== "undefined") {
        if(mypreferences.popupUrlConnect!='') {
            popupUrlConnect = mypreferences.popupUrlConnect;
        }
    }

    if (typeof(mypreferences.popupUrlHangup) !== "undefined") {
        if(mypreferences.popupUrlHangup!='') {
            popupUrlHangup = mypreferences.popupUrlHangup;
        }
    }

    if (typeof(AutoAnswer) == 'undefined') {
        AutoAnswer = false;
    }

    if (typeof(mypreferences.soundChat) == "undefined") {
        if (soundChat === true) {
            mypreferences.soundChat = "on";
        } else {
            mypreferences.soundChat = "";
        }
    }

    if (typeof(mypreferences.alwaysNotifyChat) == "undefined") {
        if (alwaysNotifyChat === true) {
            mypreferences.alwaysNotifyChat = "on";
        } else {
            mypreferences.alwaysNotifyChat = "";
        }
    }
 
    // Sound Queue
    if (typeof(soundQueue) == 'undefined') {
        soundQueue = true;
    }

    if (typeof(mypreferences.soundQueue) == "undefined") {
        if (soundQueue === true) {
            mypreferences.soundQueue = "on";
        } else {
            mypreferences.soundQueue = "";
        }
    }

    // Sound Ring
    if (typeof(soundRing) == 'undefined') {
        soundRing = true;
    }

    if (typeof(mypreferences.soundRing) == "undefined") {
        if (soundRing === true) {
            mypreferences.soundRing = "on";
        } else {
            mypreferences.soundRing = "";
        }
    }

    if (typeof(logoutUrl) == 'undefined') {
        logoutUrl = '';
    }

    // Start Not Registered
    if (typeof(startNotRegistered) == 'undefined') {
        startNotRegistered = false;
    }

    // display Queue
    if (typeof(displayQueue) == 'undefined') {
        displayQueue = "max";
    }
    if (typeof(mypreferences.displayQueue) == "undefined") {
        mypreferences.displayQueue = displayQueue;
    }

    // Notify Duration
    if (typeof(notifyDuration) == 'undefined') {
        notifyDuration = 6;
    }

    if (typeof(mypreferences.notifyDuration) == "undefined") {
        mypreferences.notifyDuration = notifyDuration;
    } else {
        notifyDuration = mypreferences.notifyDuration;
    }

    // dynamic Line Display
    if (typeof(dynamicLineDisplay) == 'undefined') {
        dynamicLineDisplay = false;
    }

    if (typeof(mypreferences.dynamicLineDisplay) == "undefined") {
        if (dynamicLineDisplay === true) {
            mypreferences.dynamicLineDisplay = "on";
        } else {
            mypreferences.dynamicLineDisplay = "";
        }
    }

    if (typeof(mypreferences.grid) == 'string') {
        jsongrid = Base64.decode(mypreferences.grid);
        try {
            restoreGrid(jsongrid);
        } catch(e) {

            if(mypreferences.grid=='') {
                mypreferences.grid = grid_serialized;
                setPreference("grid", grid_serialized);
            }
        }
    }

    if (typeof(mypreferences.autoPopup) != "undefined") {
        if (mypreferences.autoPopup == '') {
            autoPopup = false;
        } else {
            mypreferences.autoPopup = 'on';
            autoPopup = true;
        }
    } else {
        mypreferences.autoPopup = '';
        autoPopup = false;
    }

    if (typeof(mypreferences.autoAnswer) != "undefined") {
        if (mypreferences.autoAnswer == '') {
            AutoAnswer = false;
        } else {
            mypreferences.autoAnswer = 'on';
            AutoAnswer = true;
        }
    } else {
        mypreferences.autoAnswer = '';
        AutoAnswer = false;
    }

    if (typeof(mypreferences.notifyRinging) != "undefined") {
        if (mypreferences.notifyRinging == '') {
            notifyRinging = false;
        } else {
            mypreferences.notifyRinging = 'on';
            notifyRinging = true;
        }
    } else {
        if(notifyRinging=== true) {
            mypreferences.notifyRinging = 'on';
        } else {
            mypreferences.notifyRinging = '';
        }
    }

    if (typeof(mypreferences.notifyConnect) != "undefined") {
        if (mypreferences.notifyConnect == '') {
            notifyConnect = false;
        } else {
            mypreferences.notifyConnect = 'on';
            notifyConnect = true;
        }
    } else {
        if(notifyConnect=== true) {
            mypreferences.notifyConnect = 'on';
        } else {
            mypreferences.notifyConnect = '';
        }
    }

    if (typeof(mypreferences.notifyHangup) != "undefined") {
        if (mypreferences.notifyHangup == '') {
            notifyHangup = false;
        } else {
            mypreferences.notifyHangup = 'on';
            notifyHangup = true;
        }
    } else {
        if(notifyHangup=== true) {
            mypreferences.notifyHangup = 'on';
        } else {
            mypreferences.notifyHangup = '';
        }
    }

    if(getPopupUrlRinging != '') { 
        popupUrlRinging = getPopupUrlRinging;
    }

    if(getPopupUrlConnect != '') { 
        popupUrlConnect = getPopupUrlConnect;
    }

    if(getPopupUrlHangup != '') { 
        popupUrlHangup = getPopupUrlHangup;
    }

    debug('End of set default preferences');

}

function flashConnect() {

    debug("Attempt Flash xmlsocket connection on port " + port);

    $('#descriptiveMessage').html(lang['connecting_server'] + ": " + attempt);

    var parametros = host + "," + port + "," + "onConnectEvent,onDataEvent,onCloseEvent";
    
    if (typeof $('#flashconnector')[0].AttachSocketEvents != 'undefined') {
        $('#flashconnector')[0].AttachSocketEvents(parametros);
    }

    $('#loader').show();
    $('#slider').slideReveal("hide");
}

function flashStatus(e) {
    // Se llama a esta funciona cuando se conecta bien con flash xmlsocket

    if (e.success === true) {
        var playerVersion = swfobject.getFlashPlayerVersion();
        if (playerVersion.major >= 9) {
            flashSuccess = 1;
        }
    }

    if (flashSuccess == 1) {
        if (getExten !== "" && getPass !== "") {
            myextension = getExten;
            secret = getPass;
            $('#loader').show();
        } 
    } else {
        $('#fatalmessage').html('Unable to connect');
        $('#fatalerror').show();
    }
}

function limpiaTodo() {

    debug('limpia todo');

    for (var id in openchats) {
        $('#chatbox_' + id).remove();
        delete openchats[id];
    }

    for (var i in tiempos) {
        delete tiempos[i];
        delete tiemposdirection[i];
    }

    queueindex = {};
    dict_queue = [];
    availablequeues = [];

    // limpio botonitos si desconecta
    botonitos        = [];
    cuantosBotones   = 0;

    $('#allbuttons').find('div[id^="extensionlist"]').empty();

    // limpia grupos
    for(a=0;a<displaygroups.length;a++) { $('#box_grp'+a+'list').empty();}

    $('#queuelist').empty();
    $('#trunklist').empty();
    $('#conferencelist').empty();
    $('#parklist').empty();
    $('#ringgrouplist').empty();
    $('#actionbar').empty();
    $('#presence').empty();

    $('#footer').html('');

    if ($('#liteversion').length > 0) {
        $('#liteversion').remove();
    }

    $('#actionbar').unbind('click');
    $('#custombar').unbind('click');
    $('#allbuttons').unbind('click');

    //jQuery.modal.close();

    debug('termine de limpiar');
}

function sendDtmf(digit,updatedialstring) {
    if (myposition > 0) {
        if (secret !== "") {

            if(updatedialstring==1) {
                $('#dialtext').focus();
                texto = $('#dialtext').val();
                texto = texto + digit;
                $('#dialtext').typeahead('val',texto);
            }
            sonido['dtmf'+digit].play();

            if (typeof(sp) == 'function') {
                fon['sendDTMF'](digit, 2000);
            } else {
                var hash = hex_md5(secret + lastkey);
                queuedcommand = "<msg data=\"" + myposition + "|playdtmf|" + digit + "|" + hash + "\" />";
                sendcommand();
            }
        }
    }
}

function showSecBox() {

    debug('show sec box');

    limpiaTodo();

    if (typeof plugins['auth'] !== 'undefined' && typeof plugins['auth'].preAuth == "function" && preauth==0) {
        // Only run preauth ONCE, if it fails, it will prompt again for showSecBox and it should continue and actually show sec box
        // as pre auth is a way to do authentication *before* asking for user/pass, possible by session id or similar
        preauth++;
        plugins['auth'].preAuth();

    } else {

        if (myextension !== "" && secret !== "") {
            debug('ya tenia user y clave, estoy conectado '+conectado+' extension '+myextension+' secret '+secret);
            init();
        } else {
            $('#logindialog').modal({backdrop:'static',keyboard:false});
        }
    }


}

function init() {

    // Funcion de inicializacion, se llama luego de tener la extension/clave
    // Al setear conectado=0 inicia los intentos de conexion
    debug('funcion init');

    demora_conexion = 11;

    $('#actionbar').off('click', '.myclick');

    if ($('#actionbar').length > 0) {
        $('#actionbar').on('click', '.myclick', function(event) {
            ElementBehaviors.clicky(this);
        });
    }

    $('#custombar').off('click', '.myclick');

    if ($('#custombar').length > 0) {
        $('#custombar').on('click', '.myclick', function(event) {
            ElementBehaviors.clicky(this);
        });
    }

    $('#allbuttons').off('click', '.myclick');

    $('#allbuttons').on('click', '.myclick', function(event) {
        event.stopPropagation();
        ElementBehaviors.clicky(this);
    });

    $('#fatalerror').hide();

}

function toObject(texto) {
    var pairs = texto.split('&');
    var params = {};
    for (a = 0; a < pairs.length; a++) {
        var pair = pairs[a].split('=');
        params[pair[0].toLowerCase()] = pair[1];
    }
    return params;
}

var errFunc = function(t) {
    debug("error function");
    finalerror=1;
    $('#loader').hide();
    $('#fatalmessage').html(lang['not_available']);
    $('#fatalerror').show();
    $('#head').hide();
    $('#allbuttons').hide();
    $('#slider').slideReveal("hide");
    fopexit = 1;
    conectado = 1;
    if (timerID) {
        clearTimeout(timerID);
    }
};

function UpdateTimer() {

    if (conectado === 0) {
        demora_conexion++;
        debug(demora_conexion);
        if (demora_conexion > 5) { 
            attempt++;
            connectXML();
            demora_conexion = 1;
        }
        if (attempt > 15) {
            errFunc();
            return;
        }
    } else {
        ping++;
        if (return_from_reg_result != 0) {
            if (ping % 10 == 1) {
                window.location = window.location.href;
            }
        }

        if (ping > 30) {
            ping = 1;
            pingcount++;
            if (enable_ping == 1) {
                var comando = "<msg data=\"1|ping||\" />";
                send(comando);
                debug("envio ping " + pingcount);
            }
            if (pingcount > 3) {
                debug("lost connection, lack of pong reply");
                onCloseEvent();
            }
        }
    }

    if (notiChatTitle) {
        if (document.title == savedTitle) {
            document.title = chatTitle;
        } else {
            document.title = savedTitle;
        }
    }

    if (timerID) {
        clearTimeout(timerID);
    }

    for (var j in tiempos) {

        var miparte = j.split("_");
        var i = miparte[1];
        var slot = miparte[2];

        var tick = $("#tick" + slot + "_" + i);
        var phone = $("#phone" + slot + "_" + i);

        if (tick.length ==0 && $('#'+j).length == 0) {
            debug("timer en slot "+slot+" para boton "+i+" no esta definido");
            delete tiempos[j];
            continue;
        }

        var tDate = new Date();
        var elapsedTime = 0;
     
        elapsedTime = tDate.getTime() - tiempos[j];

        if (tiemposdirection[j] == 'DOWN') {
            if (typeof(parkTimeout) !== "undefined") {
                if (typeof(parkTimeout[context]) !== "undefined") {
                    // If parkTimeout is set, the park timer will count forward
                    var dif = (parkTimeout[context] * 1000) - elapsedTime;
                    elapsedTime = dif;
                }
            }
            tiempos[j] += 2000;
        }

        if (phone.length) {
            if(i==myposition) {
                if (phone.hasClass("ringing2")) {
                    if (animado['phone' + slot + "_" + i] == 0 || animado['phone' + slot + "_" + i] === undefined) {
                        animado['phone' + slot + "_" + i] = 1;
                        phone.effect('pulsate', {}, 1000, function() {
                            animado[$(this).attr('id')] = 0;
                        });
    
                        if($('#phoneiframe').length > 0) {
                            var iframe = $('#phoneiframe');
                            $('#output', iframe.contents()).effect('pulsate',{},1000,function() {});
                        }
                    }
                }
            }
        }

        // hours
        var hours = parseInt(elapsedTime / 3600000, 10);
        var remaining = elapsedTime - (hours * 3600000);
        // minutes
        var minutes = parseInt(remaining / 60000, 10);
        remaining = remaining - (minutes * 60000);
        // seconds
        var seconds = parseInt(remaining / 1000, 10);

        if (hours < 0)    { hours   = Math.abs(hours);   }
        if (minutes < 0)  { minutes = Math.abs(minutes); }
        if (seconds < 0)  { seconds = Math.abs(seconds); }

        var fullminutes = parseInt((hours * 60) + minutes);
        var fullseconds = parseInt((fullminutes * 60) + seconds);

        if (hours < 10)   { hours   = "0" + hours;   }
        if (minutes < 10) { minutes = "0" + minutes; }
        if (fullminutes < 10) { fullminutes = "0" + fullminutes; }
        if (seconds < 10) { seconds = "0" + seconds; }

        var timertexto = new Object;

        timertexto['hhmmss'] = "" + hours + ":" + minutes + ":" + seconds;
        timertexto['mmss']   = "" + fullminutes + ":" + seconds;
        timertexto['ss']     = "" + fullseconds;

        if(typeof tiemposformat[j] != 'undefined') {
            timerformat = tiemposformat[j];
            if(!timertexto.hasOwnProperty(timerformat)) {
                timerformat = 'hhmmss';
            }
        } else {
            timerformat = 'hhmmss';
        }
 
        if(tick.length == 0) {
            $('#'+j).html(timertexto[timerformat]);
        } else {
            tick.html(timertexto[timerformat]);
        }
    }
    timerID = setTimeout("UpdateTimer()", 1000);
}

function connectXML(name) {

    debug('connectxml');

    if ("WebSocket" in window && disableWebSocket === false) {

        $('#flashconnector').hide();
        var wshost = wsproto + window.location.hostname + ":" + port;

        debug("intento conectar web socket en " + wshost);

        $('#descriptiveMessage').html(lang['connecting_server'] + ": " + attempt);

        try {
            ws = new WebSocket(wshost);
        } catch(err) {
            // To catch firefox connect to WS over ssl or similar, other browsers generate onerror
            onWebsocketError();
        }

        ws.onopen = function() {
            debug("websocket connect ok with proto "+wsproto);
            $('#logindialogaccept').prop('disabled',false);
            $('#descriptiveMessage').html(lang['connecting_server'] + ": " + 1);
            conectado = 1;
            attempt   = 1;
            pingcount = 1;
            wsconnect = 1;
            wsprotook = wsproto;
            timerID = setTimeout("UpdateTimer()", 1000);
            debug('puso timer '+timerID);
            connectContext();
            //showSecBox();
            // Callback functions in jscallbacks.js
            if (typeof mycallback['socketconnect'] == "function") {
                debug("Ejecutando Callback onConnect");
                mycallback['socketconnect']();
                debug("Ejecutado Callback onConnect");
            }
        };
        ws.onmessage = function(evt) {
            var data = jQuery.parseJSON(evt.data);
            appendData(data);
        };
        ws.onclose = function(evt) {
            onCloseEvent();
        };
        ws.onerror = function(evt) {
            onWebsocketError();
        };
    } else {
        embed_flash();
        if(attempt>2  && xmlsocketdowngrade>2) {
            xmlsocketdowngrade++;
            last_tried_protocol='flash xmlsockets';

            if(lang['Could not connect to port %s using %s protocol']===undefined) {
                lang['Could not connect to port %s using %s protocol']='Could not connect to port %s using %s protocol';
            }
            if(lang['Could not connect to port %s using %s protocol']===undefined) {
                lang['Could not connect to port %s using %s protocol']='Could not connect to port %s using %s protocol';
            }
            finaltexto = sprintf(lang['Could not connect to port %s using %s protocol'], port, last_tried_protocol);
            $('#debugMessage').html(finaltexto);

            if(xmlsocketdowngrade>5) {
                disableWebSocket=false;
                xmlsocketdowngrade=0;
                if (isSecure()) { wsproto = "wss://"; }
            }
        }

    }
    if(typeof(timerID)=='undefined') {
        timerID = setTimeout("UpdateTimer()", 1000);
    }
}

function onWebsocketError() {

    debug("WebSocket Error");
    debug('wsproto = '+wsproto);
    debug('wsprotook = '+wsprotook);
    debug('wsconnect = '+wsconnect);

    if(attempt>1) {

        var last_tried_protocol='';

        if(xmlsocketdowngrade>2) {
            last_tried_protocol='flash xmlsockets';
        } else {
            if(wsproto.substr(0,wsproto.length-3)=='wss') {
                last_tried_protocol = " secure websocket ";
            } else {
                last_tried_protocol = " regular websocket ";
            }
        }

        if(lang['Could not connect to port %s using %s protocol']===undefined) {
            lang['Could not connect to port %s using %s protocol']='Could not connect to port %s using %s protocol';
        }
        finaltexto = sprintf(lang['Could not connect to port %s using %s protocol'], port, last_tried_protocol);
        $('#debugMessage').html(finaltexto);
    }

    if(wsproto=='wss://') {
        if(wsprotook=='wss://') {
            // Si pudo conectar ok antes, no hacemos downgrade a ws://
            debug('no downgrade to ws as we did wss ok before');
        } else {
            wsdowngrade++;
            if(wsdowngrade>2) {
                debug('Could not connect via secure websocket (wss), attempt downgrade to standard websocket (ws)');
                wsproto="ws://";
            } else {
                debug('attempt one more time with wss');
            }
            // attempt++;
        }
    } else {
        // Si habia conectado websockets, no hacemos downgrade a flash
        if(wsconnect==0) {
            xmlsocketdowngrade++;
            if(xmlsocketdowngrade>2) {
                debug('could not connect via ws, attempt flash xmlsockets');
                disableWebSocket=true;
                // attempt++;
            } else {
                debug('attempt one more time with ws');
            }
        } else {
            debug('what to do here? should I increase attempt with no changing proto?');
        }
    }
}

function onConnectEvent(val) {
    if (val) {
        debug("Connection successful flash xmlsockets " + context);
        $('#descriptiveMessage').html(lang['connecting_server'] + ": 1");
        //timerID = setTimeout("UpdateTimer()", 1000);
        connectContext();
        conectado = 1;
        //showSecBox();
        attempt = 0;
        pingcount = 1;

        // Callback functions in jscallbacks.js
        if (typeof mycallback['socketconnect'] == "function") {
            debug("Ejecutando Callback onConnect");
            mycallback['socketconnect']();
        }

    } else {
        debug("Could not connect");
        //alertify.alert(lang['not_connect']);
    }
}

function connectContext() {

    if (context !== "") {
        var context_upper = context.toUpperCase();
        send("<msg data=\"" + context_upper + "|contexto|1|\" />");
    } else {
        send("<msg data=\"GENERAL|contexto|0|\" />");
    }

};

function onCloseEvent() {
    debug("close event " + conectado);

    if(($("#logindialog").data('bs.modal') || {}).isShown) {
        console.log('on login dialog, do nothing');
        $('#logindialogaccept').prop('disabled',true);
        conectado = 0;
        authorized = 0;
        lostConnection = 1;
        pingcount = 0;
        sms_enabled = 0;
        sms_messagesend = 0;
        return;
    }

    if (conectado == 0 && finalerror == 0) {
        $('#loader').show();
    }
    $('#head').hide();
    $('#allbuttons').hide();
    $('#slider').slideReveal("hide");
    $('.modal').modal('hide');

    for (var iplug in plugins) {
        if (typeof(plugins[iplug]['callback_onclose']) == 'function') {
            plugins[iplug]['callback_onclose'](0,'',0);
        }
    }

    conectado = 0;
    authorized = 0;
    lostConnection = 1;
    pingcount = 0;
    sms_enabled = 0;
    sms_messagesend = 0;
    limpiaTodo();
    debug("on close reseteo a cero");
}

function onDataEvent(str) {
    var data = jQuery.parseJSON(str);
    appendData(data);
}

function appendData(data) {
    var textobtn = data.btn;
    if (textobtn.indexOf("@") >= 1) {
        textobtn = textobtn.substring(0, textobtn.indexOf("@"));
    }
    docommand(textobtn, data.cmd, data.data, data.slot);
}

function docommand(nro, comando, texto, slot) {

    if (comando == "status") {
        // status is a reserved word
        comando = "xstatus";
    }

    if (comando != "zbuttons" && comando != "pong" && comando != "plugin" ) {
        debug(nro + "," + comando + "=" + texto + " en slot " + slot);
    }

    if (typeof execute[comando] == "function") {
        execute[comando](nro, texto, slot);
    } else {
        debug("Comando " + comando + " no implementado");
    }

    // Callback functions in jscallbacks.js
    if (typeof mycallback[comando] == "function") {
        debug("Ejecutando Callback Comando " + comando);
        mycallback[comando](nro, texto, slot);
    }

    // Try action_ with plugins
    for (var iplug in plugins) {
        if (typeof(plugins[iplug]['callback_'+comando]) == 'function') {
            plugins[iplug]['callback_'+comando](nro,texto,slot);
        }
    }
}

function sendcommand() {
    if (queuedcommand != "") {
        send(queuedcommand);
        queuedcommand = "";
    } else {
        debug("no command in queue");
    }
}

function send(str) {

    for (var iplug in plugins) {
        if (typeof(plugins[iplug]['filter_send_command']) == 'function') {
            str = plugins[iplug]['filter_send_command'](str);
        }
    }

    if (wsconnect === 0) {
        debug("flash send " + str);
        $('#flashconnector')[0].envia_comando(str);
    } else {
        debug("ws send " + str);
        ws.send(str);
    }
}

function hideContacts() {
    $('#slider').slideReveal("hide");
}

function setLangContacts() {
    $('#contactsframe').contents().find('#contactstitle').html(lang.contacts);
    $('#contactsframe').contents().find('.closetitle').html(lang.close);
    $('#contactsframe').contents().find('#areyousure').html(lang.areyousure);
    $('#contactsframe').contents().find('#yesstring').html(lang.yes);
    $('#contactsframe').contents().find('#nostring').html(lang.no);
}

function setLang() {

    debug("setLang");

    setLangContacts();

    for (var iplug in plugins) {
        if (typeof(plugins[iplug].loadLang) == 'function') {
            plugins[iplug].loadLang();
        }
    }

    $(".broadcast").attr('data-original-title', lang.broadcast);
    $(".langcollapse").attr('data-original-title', lang.collapse);
    $(".langlockunlock").attr('data-original-title', lang.toggle_lock);
    $(".queueType").attr('data-original-title', lang.changeDisplayType);

    $('#filtertext').attr('placeholder', lang.filter);
    $('#dialtext').attr('placeholder', lang.dial);

    $('#filtertext').val('');
    $('#dialtext').val('');
    $('#dialtext').typeahead('val','');

    var i;
    for (i = $('#presence')[0].options.length - 1; i >= 0; i--) {
        if ($('#presence')[0].options[i].value == "!") {
            $('#presence')[0].options[i].text = lang['other'];
        } else if ($('#presence')[0].options[i].value == "") {
            $('#presence')[0].options[i].text = lang['available'];
        } else {
            if (lang.hasOwnProperty($('#presence')[0].options[i].value)) {
                $('#presence')[0].options[i].text = lang[$('#presence')[0].options[i].value]
            }
        }
    }

    $('.selectpicker').selectpicker('refresh');

    $('#filtertext').blur();
    $('#dialtext').blur();

    $('#descriptiveMessage').html(lang.connecting_server + ": " + attempt);
    $('#loadermessage').html(lang.one_moment);
    $('#queuestag').html(lang.queues);
    $('#ringgrouptag').html(lang.ringgroups);
    $('#extensionstag').html(lang.extensions);
    $('#conferencestag').html(lang.conferences);
    $('#trunkstag').html(lang.trunks);
    $('#parkstag').html(lang.parkingslots);
    $('#vmail_new').html(lang.vmail_new);
    $('#vmail_old').html(lang.vmail_old);
    $('#vmail_work').html(lang.vmail_work);
    $('#vmail_family').html(lang.vmail_family);
    $('#vmail_friends').html(lang.vmail_friends);
    $('#prefSounds').html(lang.prefSounds);
    $('.butReset').html(lang.reset);
    $('.butAccept').html(lang.accept);
    $('.butCancel').html(lang.cancel);
    $('#prefDisplay').html(lang.prefDisplay);
    $('#prefPhone').html(lang.prefPhone);
    $('#prefPopup').html(lang.prefPopup);
    $('#labelSoundChat').html(lang.labelSoundChat);
    $('#labelSoundQueue').html(lang.labelSoundQueue);
    $('#labelSoundRing').html(lang.labelSoundRing);
    $('#labelDisplayQueue').html(lang.labelDisplayQueue);
    $('#labelDisplayDynamicLine').html(lang.labelDisplayDynamicLine);
    $('#labelDisplayNotifyDuration').html(lang.labelDisplayNotifyDuration);
    $('#labelDisplayLanguage').html(lang.labelDisplayLanguage);
    $('#labelAutoPopup').html(lang.labelAutoPopup);
    $('#labelNotification').html(lang.labelNotification);
    $('#prefDisplayQueue')[0].options[0].text = lang.summary;
    $('#prefDisplayQueue')[0].options[1].text = lang.detailed;
    $('#regcodelabel').html(lang.reg_code);
    $('#regnamelabel').html(lang.reg_name);
    $('#registration_accept').html(lang.accept);
    $('#registration_cancel').html(lang.cancel);
    $('#enterregcode').html(lang.enter_reg_code);
    $('.preferencestitle').html(lang.preferences);
    $('.contactstitle').html(lang.contacts);
    $('.recordingstitle').html(lang.recordings);
    $('.chattitle').html(lang.chat);
    $('.cdrhistorytitle').html(lang.cdrrecords);
    $('.chathistorytitle').html(lang.chathistory);
    $('.logouttitle').html(lang.logout);
    $('#extenlabel').html(lang.exten);
    $('#secretlabel').html(lang.password);
    $('#enterseccode').html(lang.enter_sec_code);
    $('.sendlabel').html(lang.send);

    if ($('#voiceinputsms').length > 0) {
        $('#voiceinputsms').attr("lang", language);
    }

    if ($('#labelSmsNumber').length > 0) {
        $('#labelSmsNumber').html(lang['number']);
    }

    if ($('#labelSmsMsg').length > 0) {
        $('#labelSmsMsg').html(lang.message);
    }

    if ($('#smstag').length > 0) {
        $('#smstag').html(lang.send_sms);
    }

    if ($('#btnSendSMS').length > 0) {
        $('#btnSendSMS').html(lang.send_sms);
    }

    if ($('#action_originate').length > 0) {
        $('#action_originate').attr('data-original-title', lang.dial);
    }

    if ($('#action_transfer').length > 0) {
        $('#action_transfer').attr('data-original-title', lang.blind_transfer);
    }

    if ($('#action_supervisedtransfer').length > 0) {
        $('#action_supervisedtransfer').attr('data-original-title', lang.attendant_transfer);
    }

    if ($('#action_vmail').length > 0) {
        $('#action_vmail').attr('data-original-title', lang.transfer_vmail);
    }

    if ($('#action_transferexternal').length > 0) {
        $('#action_transferexternal').attr('data-original-title', lang.transfer_external);
    }

    if ($('#action_pickup').length > 0) {
        $('#action_pickup').attr('data-original-title', lang.pickup);
    }

    if ($('#action_spy').length > 0) {
        $('#action_spy').attr('data-original-title', lang.spy);
    }

    if ($('#action_whisper').length > 0) {
        $('#action_whisper').attr('data-original-title', lang.whisper);
    }

    if ($('#action_hangup').length > 0) {
        $('#action_hangup').attr('data-original-title', lang.hangup);
    }

    if ($('#action_record').length > 0) {
        $('#action_record').attr('data-original-title', lang.record);
    }

    if ($('#action_preferences').length > 0) {
        $('#action_preferences').attr('data-original-title', lang.preferences);
    }

    if ($('#action_phonebook').length > 0) {
        $('#action_phonebook').attr('data-original-title', lang.phonebook);
    }

    if ($('#action_logout').length > 0) {
        $('#action_logout').attr('data-original-title', lang.logout);
    }
    for (var a in buttontype) {
        if (buttontype[a] == "extension") {
            for (conti = 1; conti <= showLines; conti++) {
                idx = 'timer_' + a + '_' + conti;
                if (tiempos[idx] === undefined) {
                    if($('#clid' + conti + '_' + a).length) {
                        $('#clid' + conti + '_' + a).html(translate('&inactive_line!' + conti));
                    }
                }
            }
        } else if (buttontype[a] == "queue") {
            if($('#queueType'+a).lenght) {
                $('#queueType' + a).attr('data-original-title', lang.changeDisplayType);
            }
            if($('#queuesummary_'+a).lenght) {
                $('#queuesummary_' + a).html(translate('&calls!' + waitingCalls[a]));
            }
            if($('#agentsummary_'+a).lenght) {
                $('#agentsummary_' + a).html(translate('&agents!' + numAgentes[a]));
            }
        }
    }

    $('.mwi').each(function() { 
        texto = $(this).attr('data-mwi'); 
        if(texto!==undefined) {
            if (texto.substring(0, 1) == "&") {
                texto = translate(texto);
                $(this).attr('data-original-title', texto);
            }
        }
    });

    if(authorized==1) {
        setSessionVariable('language', language,1);
    }

    $('abbr.timeago').timeago()
}

function setTips(element) {
    element.tooltip({container:'body'});
    return;
}

function setThisTip(element) {
    // Compatibility for old plugins
    debug('set this tip '+element);
    $('#'+element+' [data-toggle="tooltip"]').tooltip({container:'body'});
    return;
}

jQuery.fn.sortDivs = function sortDivs() {
    $("> div", this[0]).sort(dec_sort).appendTo(this[0]);

    function dec_sort(a, b) {
        return ($(b).data("sort")) < ($(a).data("sort")) ? 1 : -1;
    }
}

function ordenarDiv(midiv, elementos) {
    var elemento = elementos.split(",");
    jQuery.each(elemento, function(idx, val) {
        $('#' + val).attr('data-sort', idx);
    });
    $('#' + midiv).sortDivs();
}

function setSessionVariable(variable, valor, setanyway) {
    if(typeof(setanyway)=='undefined') { setanyway=0; }

    if(unableToSetAuthSession==0 || setanyway==1) {
        // only fire the ajax call IF the set session variable with auth succeeds
        debug('try setvar '+variable+' with value '+valor);

        jQuery.ajaxSetup({async: true});
        jQuery.ajax({
            type: "POST",
            url: "setvar.php",
            data: {
                sesvar: variable,
                value: valor
            }
        }).done(function(msg) {
            debug("setvar variable "+variable+" to value "+valor+" returned: ("+msg+"), authorized="+authorized);
            if(msg!="ok" && authorized==1) {
               // if return from sesvar is javascript code, eval it
               if(msg.indexOf('javascript')==0) {
                   var code = msg.substring(11);
                   eval(code);
               } else {
                   debug('setvar not ok for variable '+variable+ ', lets postpone it');
                   postponedSetVar[variable]=valor;
                   clearTimeout(deferredSetVar['key']);
                   deferredSetVar['key'] = setTimeout(function() { setSessionVariableAuth('key', lastkey);}, 5000);
               }
            } else {
               if(msg=='ok') {
                   if(authorized==1) {
                       debug('setvar variable '+variable+' ok ('+msg+'), or authorized == 1 ('+authorized+') so we remove postponedSetVar');
                       delete postponedSetVar[variable];
                   } else {
                       debug('setvar variable '+variable+' ok ('+msg+'), but not authorized? What to do ?');
                      
                   }
               } else {
                   debug('setvar variable '+variable+' not ok ('+msg+'), let it be postponed...');
                   postponedSetVar[variable]=valor;
               }
            }
        });
    } else {
        debug('skip setvar '+variable+' as there is no authenticated key session set yet');

        postponedSetVar[variable]=valor;

    }
}

function setSessionVariableAuth(variable, valor) {
    debug('try setvar with authentication for variable '+variable+' with value '+valor);
    var hash = hex_md5(secret + valor);
    jQuery.ajax({
        type: "POST",
        url: "setvar.php",
        data: {
            sesvar: variable,
            value: valor,
            exten: myextension,
            pass: hash
        }
    }).done(function(msg) {
        debug("setvar set session with auth " + variable);
        debug("setvar return msg "+msg);
        if(msg!="ok") {
           debug("setvar with auth not ok, deferring setvar auth");
           clearTimeout(deferredSetVar[variable]);
           if(typeof(countDeferredSetVar[variable])=="undefined") {
               countDeferredSetVar[variable]=0;
           }
           if(countDeferredSetVar[variable]<10) {
               deferredSetVar[variable] = setTimeout(function() { setSessionVariableAuth(variable,valor);}, 5000);
           }
           unableToSetAuthSession=1;
           countDeferredSetVar[variable]++;
        } else {
           unableToSetAuthSession=0;
           countDeferredSetVar[variable]=0;
           debug("setvar with auth ok, do all postponed setvars now");
           for (var j in postponedSetVar) {
              debug(j+' = '+postponedSetVar[j]);
              setSessionVariable(j,postponedSetVar[j]);
           }
        }
    });
}

function translate(texto) {
    texto = texto.substring(1, texto.length);
    var finaltexto = "";
    var params = texto.split("!");
    var format = params.shift();
    if (params.length == 0) {
        finaltexto = lang[format];
    } else if (params.length == 1) {
        finaltexto = sprintf(lang[format], params[0]);
    } else if (params.length == 2) {
        finaltexto = sprintf(lang[format], params[0], params[1]);
    } else if (params.length == 3) {
        finaltexto = sprintf(lang[format], params[0], params[1], params[2]);
    } else if (params.length == 4) {
        finaltexto = sprintf(lang[format], params[0], params[1], params[2], params[3]);
    }
    return finaltexto;
}

function filter_list() {
    $('#container').scrollTop(0);
    var mostrar = [];
    var text_filter = $('#filtertext').val();
    text_filter = text_filter.toLowerCase();


    for (var a = 0; a < extenlistGroup.length; a++) {
        var hidediv = extenlistGroup[a];
        if(hidediv=='extensionlist') { hidediv='extensionbox'; }

        if(typeof(saveGridPos[hidediv])=='undefined') {
            coor = $('#'+hidediv).data('_gridstack_node');
            if(typeof(coor) != 'undefined') {
                saveGridPos[hidediv]= [ coor.x, coor.y, coor.width, coor.height ]
                debug('set save grid de '+hidediv+' en '+coor.x+' y '+coor.y + ' resizing grid '+resizinggrid);
            } 
        }
    }

    grid.batchUpdate();
    resizinggrid=1;

    for (var a = 0; a < extenlistGroup.length; a++) {
        var hidediv = extenlistGroup[a];
        if(hidediv=='extensionlist') { hidediv='extensionbox'; }
        var Children = $('#' + hidediv).find('.labelname, .tags');
        var itemInGroup = 0;
        Children.each(
        function() {
            var btnnro = $(this).attr('id').substring(5);
            var boton   = $('#boton' + btnnro);
            if(text_filter=="") {
                boton.show();
                if(hideUnregistered===true) {
                    if(boton.hasClass('notregistered') && btnnro!=myposition) {
                        boton.hide();
                    } 
                }
                itemInGroup=1;
            } else {
                if(mostrar[btnnro]===undefined) { boton.hide(); }
                if($(this).html().toLowerCase().indexOf(text_filter)>=0 || btnnro==myposition) {
                     if(hideUnregistered===true) {
                         if(boton.hasClass('notregistered') && btnnro!=myposition) {
                             boton.hide();
                         } else {
                             boton.show();
                             mostrar[btnnro]=1;
                             itemInGroup++;
                         }
                     } else {
                         boton.show();
                         mostrar[btnnro]=1;
                         itemInGroup++;
                     }
                }
            }
        });
        // Oculto grupos sin elementos
        var griddiv = hidediv.substr(0,hidediv.length - 3);
        grid_auto_height(griddiv,1);
        if (itemInGroup == 0) {
            if($('#'+hidediv).is(':visible')) {
                debug('set save muevo grid '+hidediv);
                grid.move($('#'+hidediv),0,1000); 
                $('#' + hidediv).hide();
            }
        } else {
            if(typeof(saveGridPos[hidediv])=='object') {
                if($('#'+hidediv).is(':hidden') || text_filter=='') { 
                    // If filter is empty, restore all widgets to original position, as other widgets might have taken its place when moved out
                    var coor = saveGridPos[hidediv];
                    grid.update($('#'+hidediv),coor[0],coor[1],coor[2],coor[3]);
                    $('#' + hidediv).show();
                }
            }
        }
    }
    grid.commit();
    resizinggrid=0;
}

function toolBarPrivacy(nro) {
    var ret = 0;
    if (botonitos[nro]['PRIVACY'] !== undefined) {
        if (botonitos[nro]['PRIVACY'] == "all" || botonitos[nro]['PRIVACY'] == "monitor") {
            ret = 1;
        }
    }
    return ret;
}

function getVmail(vmailpos) {
    // myposition en lugar de vmailpos
    if (vmailpos > 0) {
        if (secret !== "") {
            var hash = hex_md5(secret + lastkey);
            command = "<msg data=\"" + vmailpos + "|getvmail|INBOX|" + hash + "\" />";
            send(command);
        }
    }
}

function showVmail(vmailpos) {
    currentVmailbox = vmailpos;
    $('#vmailcontainer').modal();
}

function showPref() {
    $('#preferencePane').modal();
}

function showRecordings() {
    if($('#iframerecordings').attr('src')=='') {
        $('#iframerecordings').attr('src','recordings.php');
    } else {
        var iframe = document.getElementById('iframerecordings');
        iframe.src = iframe.src;
    }
    $('#recordingscontainer').modal();
}

function showChats() {
    if($('#iframechats').attr('src')=='') {
        $('#iframechats').attr('src','chatadmin.php');
    }
    $('#chatscontainer').modal();
}


function showCDR() {
    if($('#iframecdr').attr('src')=='') {
        $('#iframecdr').attr('src','calldetailrecords.php');
    }
    $('#cdrcontainer').modal();
}

function gridDataSerialized() {
    // Get Grid Positions and save
    var res = _.map($('.grid-stack .grid-stack-item:visible'), function (el) {
        el = $(el);
        var node = el.data('_gridstack_node');

        saveGridPos[el.attr('id')] = [ node.x, node.y, node.width, node.height ];

        return {
            id: el.attr('id'),
            x: node.x,
            y: node.y,
            width: node.width,
            height: node.height,
            locked: ''+node.locked
        };
    });
    debug(JSON.stringify(res)); 
    grid_serialized    = Base64.encode(JSON.stringify(res));
    return grid_serialized; 
}

function savePreferences() {


    var stringPref = [];

    if (fullyGetPref == 1) {
    
        debug('save preferences');
        // Get Grid Positions and save
        /*
        var res = _.map($('.grid-stack .grid-stack-item:visible'), function (el) {
            el = $(el);
            var node = el.data('_gridstack_node');

            return {
                id: el.attr('id'),
                x: node.x,
                y: node.y,
                width: node.width,
                height: node.height,
                locked: node.locked
            };
        });
        debug(JSON.stringify(res)); 
        grid_serialized    = Base64.encode(JSON.stringify(res));
        mypreferences.grid = grid_serialized;
        */
        mypreferences.grid = gridDataSerialized();

        stringPref.push("grid!"+mypreferences.grid);

        if ($('#prefSoundChat').is(':checked')) {
            debug('sound chat on');
            stringPref.push("soundChat!on");
            mypreferences.soundChat = "on";
        } else {
            debug('sound chat off');
            stringPref.push("soundChat!");
            mypreferences.soundChat = "";
        }

        if ($('#prefAlwaysNotifyChat').is(':checked')) {
            debug('always notify chat on');
            stringPref.push("alwaysNotifyChat!on");
            mypreferences.alwaysNotifyChat = "on";
        } else {
            debug('always notify chat off');
            stringPref.push("alwaysNotifyChat!");
            mypreferences.alwaysNotifyChat = "";
        }
 
        if ($('#prefSoundQueue').is(':checked')) {
            mypreferences.soundQueue = "on";
            stringPref.push("soundQueue!on");
        } else {
            stringPref.push("soundQueue!");
            mypreferences.soundQueue = "";
        }

        if ($('#prefSoundRing').is(':checked')) {
            mypreferences.soundRing = "on";
            stringPref.push("soundRing!on");
        } else {
            stringPref.push("soundRing!");
            mypreferences.soundRing = "";
        }

        if ($('#prefDisplayDynamicLine').is(':checked')) {

            stringPref.push("dynamicLineDisplay!on");
            mypreferences.dynamicLineDisplay = "on";

            $('div.acline').each(function(fid) {
                fid = $(this);
                var btnname = fid.attr('id').substring(0, 6);
                if (btnname == "acline") {
                    fid.addClass('invisible');
                }
            });

            for (var j in tiempos) {
                var miparte = j.split("_");
                var nro = miparte[1];
                var slot = miparte[2];
                if ($('#acline_' + slot + '_' + nro).length) {
                    $('#acline_' + slot + '_' + nro).removeClass('invisible');
                }
            }

        } else {
            stringPref.push("dynamicLineDisplay!off");
            mypreferences.dynamicLineDisplay = "";

            $('div.acline').each(function() {
                fid = $(this);
                var btnname = fid.attr('id').substring(0, 6);
                if (btnname == "acline") {
                    fid.removeClass('invisible');
                }
            });

            // Recalcula height de extensiones luego de dynamic line display cambiado
            grid_auto_height('extension');
            for(i=0;i<displaygroups.length;i++) {
                grid_auto_height('box_grp'+i);
            }

        }

        if ($('#prefDisplayQueue')[0].options[$('#prefDisplayQueue')[0].selectedIndex].value == "min") {
            stringPref.push("displayQueue!min");
            mypreferences.displayQueue = "min";
            domshow = 'summary';
            domhide = 'entries';
        } else {
            stringPref.push("displayQueue!max");
            mypreferences.displayQueue = "max";
            domhide = 'summary';
            domshow = 'entries';
        }

        if ($('#prefAutoPopup').is(':checked')) {
            stringPref.push("autoPopup!on");
            mypreferences.autoPopup = "on";
            autoPopup = true;
        } else {
            stringPref.push("autoPopup!");
            mypreferences.autoPopup = "";
            autoPopup = false;
        }

        if ($('#prefNotifyRinging').is(':checked')) {
            stringPref.push("notifyRinging!on");
            mypreferences.notifyRinging = "on";
            notifyRinging = true;
        } else {
            stringPref.push("notifyRinging!");
            mypreferences.notifyRinging = "";
            notifyRinging = false;
        }

        if ($('#prefNotifyConnect').is(':checked')) {
            stringPref.push("notifyConnect!on");
            mypreferences.notifyConnect = "on";
            notifyConnect = true;
        } else {
            stringPref.push("notifyConnect!");
            mypreferences.notifyConnect = "";
            notifyConnect = false;
        }

        if ($('#prefNotifyHangup').is(':checked')) {
            stringPref.push("notifyHangup!on");
            mypreferences.notifyHangup = "on";
            notifyHangup = true;
        } else {
            stringPref.push("notifyHangup!");
            mypreferences.notifyHangup = "";
            notifyHangup = false;
        }
 
        if ($('#prefAutoAnswer').is(':checked')) {
            stringPref.push("autoAnswer!on");
            mypreferences.autoAnswer = "on";
            AutoAnswer = true;
        } else {
            stringPref.push("autoAnswer!");
            mypreferences.autoAnswer = "";
            AutoAnswer = false;
        }

        if(AutoAnswer) { auto=1; } else { auto=0; }
        send("<msg data=\""+myposition+"|autoanswer|"+auto+"|\" />");

        if ($('#prefPopupUrlRinging').val() != '') {
            var urlencode = Base64.encode($('#prefPopupUrlRinging').val());
            stringPref.push("popupUrlRinging!" + urlencode);
            mypreferences.popupUrlRinging = urlencode;
            popupUrlRinging = mypreferences.popupUrlRinging;
            if(getPopupUrlRinging !== '') {
                popupUrlRinging = getPopupUrlRinging;
            }
        } else {
            stringPref.push("popupUrlRinging!");
            mypreferences.popupUrlRinging = "";
            popupUrlRinging = "";
        }

        if ($('#prefPopupUrlConnect').val() != '') {
            var urlencode = Base64.encode($('#prefPopupUrlConnect').val());
            stringPref.push("popupUrlConnect!" + urlencode);
            mypreferences.popupUrlConnect = urlencode;
            popupUrlConnect = mypreferences.popupUrlConnect;
            if(getPopupUrlConnect !== '') {
                popupUrlConnect = getPopupUrlConnect;
            }
        } else {
            stringPref.push("popupUrlConnect!");
            mypreferences.popupUrlConnect = "";
            popupUrlConnect = "";
        }

        if ($('#prefPopupUrlHangup').val() != '') {
            var urlencode = Base64.encode($('#prefPopupUrlHangup').val());
            stringPref.push("popupUrlHangup!" + urlencode);
            mypreferences.popupUrlHangup = urlencode;
            popupUrlHangup = mypreferences.popupUrlHangup;
            if(getPopupUrlHangup !== '') {
                popupUrlHangup = getPopupUrlHangup;
            }
        } else {
            stringPref.push("popupUrlHangup!");
            mypreferences.popupUrlHangup = "";
            popupUrlHangup = "";
        }

        for (var x in buttontype) {
            if (buttontype[x] == "queue") {
                $('#queue' + domhide + '_' + x).hide();
                $('#agent' + domhide + '_' + x).hide();
                $('#queue' + domshow + '_' + x).show();
                $('#agent' + domshow + '_' + x).show();
            }
        }

        mypreferences.notifyDuration = $('#prefDisplayNotifyDuration').val();
        notifyDuration = mypreferences.notifyDuration;
        stringPref.push("notifyDuration!" + mypreferences.notifyDuration);

        mypreferences.language = $('#prefDisplayLanguage').val();
        stringPref.push("language!" + mypreferences.language);

        if (language != mypreferences.language) {
            debug("Set language as it changed!");
            language = mypreferences.language;
            var langfile = "js/lang_" + mypreferences.language + ".js";
            jQuery.getScript(langfile, function() {
                setLang();
            });
        }

        var cl1 = "soundchat";
        var cl2 = "nosoundchat";
        if (mypreferences.soundChat == "on") {
            cl2 = "soundchat";
            cl1 = "nosoundchat";
        }
        for (var j in openchats) {
            $('#icosound_' + j).removeClass(cl1);
            $('#icosound_' + j).addClass(cl2);
        }
        var fullPref = stringPref.join("&");
        setFullPreference(fullPref);

        fullyGetPref = 0;
    } 
}

function getPreferences() {

    debug('get preferences');

    debug(mypreferences);

    if (mypreferences.soundChat == "on") {
        $('#prefSoundChat').attr('checked', true);
        $('#prefSoundChat').bootstrapSwitch('state', true);
    } else {
        $('#prefSoundChat').attr('checked', false);
        $('#prefSoundChat').bootstrapSwitch('state', false);
    }

    if (mypreferences.alwaysNotifyChat == "on") {
        $('#prefAlwaysNotifyChat').attr('checked', true);
        $('#prefAlwaysNotifyChat').bootstrapSwitch('state', true);
    } else {
        $('#prefAlwaysNotifyChat').attr('checked', false);
        $('#prefAlwaysNotifyChat').bootstrapSwitch('state', false);
    }

    if (mypreferences.soundQueue == "on") {
        $('#prefSoundQueue').attr('checked', true);
        $('#prefSoundQueue').bootstrapSwitch('state', true);
    } else {
        $('#prefSoundQueue').attr('checked', false);
        $('#prefSoundQueue').bootstrapSwitch('state', false);
    }

    if (mypreferences.soundRing == "on") {
        $('#prefSoundRing').attr('checked', true);
        $('#prefSoundRing').bootstrapSwitch('state', true);
    } else {
        $('#prefSoundRing').attr('checked', false);
        $('#prefSoundRing').bootstrapSwitch('state', false);
    }

    if (mypreferences.dynamicLineDisplay == "on") {
        $('#prefDisplayDynamicLine').attr('checked', true);
        $('#prefDisplayDynamicLine').bootstrapSwitch('state', true);
    } else {
        $('#prefDisplayDynamicLine').attr('checked', false);
        $('#prefDisplayDynamicLine').bootstrapSwitch('state', false);
    }

    if (mypreferences.displayQueue == "min") {
        $('#prefDisplayQueue')[0].selectedIndex = 0;
    } else {
        $('#prefDisplayQueue')[0].selectedIndex = 1;
    }

    if (mypreferences.autoPopup == "on") {
        $('#prefAutoPopup').attr('checked', true);
        $('#prefAutoPopup').bootstrapSwitch('state', true);
        autoPopup = true;
    } else {
        $('#prefAutoPopup').attr('checked', false);
        $('#prefAutoPopup').bootstrapSwitch('state', false);
        autoPopup = false;
    }

    if (mypreferences.notifyRinging == "on") {
        $('#prefNotifyRinging').attr('checked', true);
        $('#prefNotifyRinging').bootstrapSwitch('state', true);
        notifyRinging = true;
    } else {
        $('#prefNotifyRinging').attr('checked', false);
        $('#prefNotifyRinging').bootstrapSwitch('state', false);
        notifyRinging = false;
    }

    if (mypreferences.notifyConnect == "on") {
        $('#prefNotifyConnect').attr('checked', true);
        $('#prefNotifyConnect').bootstrapSwitch('state', true);
        notifyConnect = true;
    } else {
        $('#prefNotifyConnect').attr('checked', false);
        $('#prefNotifyConnect').bootstrapSwitch('state', false);
        notifyConnect = false;
    }

    if (mypreferences.notifyHangup == "on") {
        $('#prefNotifyHangup').attr('checked', true);
        $('#prefNotifyHangup').bootstrapSwitch('state', true);
        notifyHangup = true;
    } else {
        $('#prefNotifyHangup').attr('checked', false);
        $('#prefNotifyHangup').bootstrapSwitch('state', false);
        notifyHangup = false;
    }
 
    if (mypreferences.autoAnswer == "on") {
        $('#prefAutoAnswer').attr('checked', true);
        $('#prefAutoAnswer').bootstrapSwitch('state', true);
        AutoAnswer = true;
    } else {
        $('#prefAutoAnswer').attr('checked', false);
        $('#prefAutoAnswer').bootstrapSwitch('state', false);
        AutoAnswer = false;
    }

    if (typeof mypreferences.popupUrlRinging == 'undefined') {
        mypreferences.popupUrlRinging = '';
    }

    if (typeof mypreferences.popupUrlConnect == 'undefined') {
        mypreferences.popupUrlConnect = '';
    }

    if (typeof mypreferences.popupUrlHangup == 'undefined') {
        mypreferences.popupUrlHangup = '';
    }

    if (mypreferences.popupUrlRinging == '') {
        $('#prefPopupUrlRinging').val('');
    } else {
        var urldecoded = Base64.decode(mypreferences.popupUrlRinging);
        $('#prefPopupUrlRinging').val(urldecoded);
    }

    if (mypreferences.popupUrlConnect == '') {
        $('#prefPopupUrlConnect').val('');
    } else {
        var urldecoded = Base64.decode(mypreferences.popupUrlConnect);
        $('#prefPopupUrlConnect').val(urldecoded);
    }

    if (mypreferences.popupUrlHangup == '') {
        $('#prefPopupUrlHangup').val('');
    } else {
        var urldecoded = Base64.decode(mypreferences.popupUrlHangup);
        $('#prefPopupUrlHangup').val(urldecoded);
    }

    $('#prefDisplayNotifyDuration').val(mypreferences.notifyDuration);

    for (i = $('#prefDisplayLanguage')[0].options.length - 1; i >= 0; i--) {
        if ($('#prefDisplayLanguage')[0].options[i].value == mypreferences.language) {
            $('#prefDisplayLanguage')[0].selectedIndex = i;
            debug("elijo " + i);
        }
    }
//    $("#prefDisplayLanguage").trigger("chosen:updated");
    $('.selectpicker').selectpicker('refresh');

    fullyGetPref = 1;

    $('#prefSounds').html(lang.prefSounds);
    $('#prefDisplay').html(lang.prefDisplay);
    $('#labelSoundChat').html(lang.labelSoundChat);
    $('#labelAlwaysNotifyChat').html(lang.labelAlwaysNotifyChat);
    $('#labelSoundQueue').html(lang.labelSoundQueue);
    $('#labelSoundRing').html(lang.labelSoundRing);
    $('#labelDisplayQueue').html(lang.labelDisplayQueue);
    $('#labelDisplayDynamicLine').html(lang.labelDisplayDynamicLine);
    $('#labelDisplayNotifyDuration').html(lang.labelDisplayNotifyDuration);
    $('#labelDisplayLanguage').html(lang.labelDisplayLanguage);
    $('#labelAutoPopup').html(lang.labelAutoPopup);
    $('#labelAutoAnswer').html(lang.labelAutoAnswer);
    $('#labelNotification').html(lang.labelNotification);

    $('#prefDisplayQueue')[0].options[0].text = lang.summary;
    $('#prefDisplayQueue')[0].options[1].text = lang.detailed;

//    $('#prefDisplayQueue').chosen({
//        disable_search_threshold: 10
//    });
//    $('#prefDisplayLanguage').chosen({
//        disable_search_threshold: 15
//    });
}

ElementBehaviors = {
    clicky: function(element) {
        var elementid = $(element).attr('id');

        if(typeof elementid == 'undefined') {
            // handle no id icons (window controls)
            widget_id = $(element).parent().parent().parent().parent().parent().attr('id');
            icon = $(element).children('i').eq(0);
            $(element).tooltip('hide');

            if($(element).hasClass('widget-toggle-btn')) {
                debug('toggle de '+widget_id);
                widget_strip = widget_id.substring(0,widget_id.length-3);
                for(a=0;a<grid.grid.nodes.length;a++) {
                    if(grid.grid.nodes[a].el.attr('id')==widget_id) {
                        if(grid.grid.nodes[a].height==1) {
                            grid_auto_height(widget_strip,0);
                            icon.removeClass('fa-caret-square-o-down').addClass('fa-caret-square-o-up');
                        } else {
                            grid.resize(grid.grid.nodes[a].el,null,1)
                            icon.removeClass('fa-caret-square-o-up').addClass('fa-caret-square-o-down');
                        }
                    }
                }

            } else if ($(element).hasClass('widget-lock-btn')) {
                debug('lock de '+widget_id);
                widget_strip = widget_id.substring(0,widget_id.length-3);
                for(a=0;a<grid.grid.nodes.length;a++) { 
                    if(grid.grid.nodes[a].el.attr('id')==widget_id) {
                        if(grid.grid.nodes[a].locked==true) {
                            grid.grid.nodes[a].locked=false;
                            icon.removeClass('fa-lock').addClass('fa-unlock-alt');
                            debug('locking '+widget_id);
                        } else {
                            grid.grid.nodes[a].locked=true;
                            icon.removeClass('fa-unlock-alt').addClass('fa-lock');
                            debug('unlocking '+widget_id);
                        }
                    }
                }
                grid_serialized = gridDataSerialized();
                setPreference("grid", grid_serialized);
 
            }
            return;
        }

        if (element.id.substr(0, 7) == "action_") {

            if (element.id == "action_preferences") {
                showPref();
            } else if (element.id == "action_hangup" || element.id == "action_record") {
                // we let record or hangup with no target selected, if that is the case we use our own position
                var desti;
                var opa = $(element).css('opacity');
                if(globalselected !== undefined) {
                    desti = ExtraeNumero(globalselected.id);
                } else {
                    desti = myposition;
                }
                if(desti>0) {
                    if (element.id == "action_hangup") {
                        if (opa >= 0.7) {
                            hangup(desti);
                        }
                    } else if (element.id == "action_record") {
                        if (opa >= 0.7) {
                            record(desti);
                        }
                    }
                }
            } else if (element.id == "action_logout" || element.id == "menulogout") {
                alertify.set({
                    labels: {
                        ok: lang['yes'],
                        cancel: lang['no']
                    }
                });
                alertify.confirm('<span style="font-size:1.5em;">' + lang['logout'] + '</span><br/>' + lang['areyousure'], function(e) {
                    if (e) {
                        foplogout();
                    }
                });
            } else {
                
                if (globalselected !== undefined) {
                    var desti = ExtraeNumero(globalselected.id);
                    var opa = $(element).css('opacity');
                    if (element.id == "action_originate") {
                        if (opa >= 0.7) {
                            originate(desti)
                        }
                    } else if (element.id == "action_transfer") {
                        if (opa >= 0.7) {
                            transfer(desti);
                        }
                    } else if (element.id == "action_supervisedtransfer") {
                        if (opa >= 0.7) {
                            supervised_transfer(desti);
                        }
                    } else if (element.id == "action_vmail") {
                        if (opa >= 0.7) {
                            transfer_to_voicemail(desti);
                        }
                    } else if (element.id == "action_transferexternal") {
                        if (opa >= 0.7) {
                            transfer_to_external(desti);
                        }
                    } else if (element.id == "action_pickup") {
                        if (opa >= 0.7) {
                            pickup_ringing(desti);
                        }
                    } else if (element.id == "action_spy") {
                        if (opa >= 0.7) {
                            spy(desti);
                        }
                    } else if (element.id == "action_whisper") {
                        if (opa >= 0.7) {
                            whisper(desti);
                        }
                    } 
                } else {

                    // allow blind and supervised transfers if no target extension is selected by using dialbox number as target

                    var desti = ExtraeNumero($('#dialtext').val());
                    var opa = $(element).css('opacity');
                    if(desti!='') {
                        if (element.id == "action_transfer") {
                           if (opa >= 0.7) {
                               blind_transfer_dialbox(desti);
                           }
                        } else if (element.id == "action_supervisedtransfer") {
                           if (opa >= 0.7) {
                               supervised_transfer_dialbox(desti);
                           }
                        } 
                    } 
 
                }

                // Try action_ with plugins
                for (var iplug in plugins) {
                    if (typeof(plugins[iplug][element.id]) == 'function') {
                        plugins[iplug][element.id](desti);
                    }
                }
            }
        } else if (element.id.substr(0, 9) == "queueType") {

            var myid = element.id.substring(9, element.id.length);
            togleColaDisplay(myid);

        } else if (element.id.substr(0, 3) == "mwi") {
            if (licenselevel & 2) {
                var clicpos = element.id.substring(3, element.id.length);
                if (clicpos == myposition) {
                    if (botonitos[myposition]['MAILBOX'] !== undefined && disableVoicemail !== true) {
                        showVmail(myposition);
                    }
                } else {
                    if (hasPerm('0', 'all')) {
                        debug("tiene all global, lo dejo!");
                        if (botonitos[clicpos]['MAILBOX'] !== undefined && disableVoicemail !== true) {
                            showVmail(clicpos);
                        }
                    } else {
                        if (permisosbtn['voicemailadmin'] !== undefined) {
                            if (hasPerm(clicpos, 'voicemailadmin') || hasPerm(0,'voicemailadmin')) {
                                debug("tiene voicemailadmin o coincide la posicion "+clicpos);
                                if (botonitos[clicpos]['MAILBOX'] !== undefined && disableVoicemail !== true) {
                                    showVmail(clicpos);
                                }
                            }
                        }
                    }
                }
            }
        } else if (element.id.substr(0, 4) == "clid") {
            selectText(element.id);
            // we want to select the button also
            var nrobtn = element.id.substr(6);
            element = $("#boton"+nrobtn)[0]; 
        }

        if (element.id.substr(0, 5) == "boton") {

            var nro = element.id.substring(5);

            if (globalselected !== undefined) {
                if (element != globalselected) {
                    $(globalselected).removeClass('selected');

                    // habilitar botones
                    for (elm in disableActionBtn) {
                        if($('#'+elm).is(':visible')) {
                            $('#' + elm).fadeTo('fast', 1);
                        }
                    }
                }
            }

            if ($(element).hasClass('selected')) {

                $(element).removeClass('selected');

                // habilitar botones
                for (elm in disableActionBtn) {
                    if($('#'+elm).is(':visible')) {
                        $('#' + elm).fadeTo('fast', 1);
                    }
                }

                globalselected = undefined;

                if (buttontype[nro] == "queue") {
                    debug("desfiltro");
                    filter_list();
                    filter_queue();
                }

            } else {

                disableActionBtn['action_transferexternal'] = 0;
                disableActionBtn['action_supervisedtransfer'] = 0;
                disableActionBtn['action_transfer'] = 0;
                disableActionBtn['action_originate'] = 0;
                disableActionBtn['action_vmail'] = 0;
                disableActionBtn['action_pickup'] = 0;
                disableActionBtn['action_spy'] = 0;
                disableActionBtn['action_whisper'] = 0;
                disableActionBtn['action_record'] = 0;
                disableActionBtn['action_hangup'] = 0;

                $(element).addClass('selected');
                globalselected = element;

                if (buttontype[nro] == "queue") {
                    var misagentes = $('#agententries_' + nro).children('.qimember');
                    filter_agentes(misagentes);
                    filter_queue(nro);
                    $('#container').scrollTop(0);
                }

                if (permisosbtn['spy'] !== undefined) {
                    disableActionBtn['action_spy'] = 0;
                    if (hasPerm(nro, 'spy') || hasPerm(0, 'spy')) {
                        disableActionBtn['action_spy'] = 0;
                        disableActionBtn['action_spy'] = toolBarPrivacy(nro);
                        disableActionBtn['action_whisper'] = 0;
                        disableActionBtn['action_whisper'] = toolBarPrivacy(nro);
                    } else {
                        disableActionBtn['action_spy'] = 1;
                        disableActionBtn['action_whisper'] = 1;
                    }
                } else {
                    // Disable if permission is undefined
                    disableActionBtn['action_spy'] = 1;
                    disableActionBtn['action_whisper'] = 1;
                }

                if (permisosbtn['record'] !== undefined) {
                    disableActionBtn['action_record'] = 0;
                    if (hasPerm(nro, 'record') || hasPerm(0, 'record')) {
                        disableActionBtn['action_record'] = 0;
                        disableActionBtn['action_record'] = toolBarPrivacy(nro);
                    } else {
                        if (permisosbtn['recordself'] !== undefined) {
                            if (nro == myposition) {
                                disableActionBtn['action_record'] = 0;
                                disableActionBtn['action_record'] = toolBarPrivacy(nro);
                            } else {
                                disableActionBtn['action_record'] = 1;
                            }
                        } else {
                            if (nro != myposition) {
                                disableActionBtn['action_record'] = 1;
                            }
                        }
                    }
                } else {
                    if (permisosbtn['recordself'] !== undefined) {
                        if (nro == myposition) {
                            disableActionBtn['action_record'] = 0;
                            disableActionBtn['action_record'] = toolBarPrivacy(nro);
                        } else {
                            disableActionBtn['action_record'] = 1;
                        }
                    } else {
                        disableActionBtn['action_record'] = 1;
                    }
                }

                if (permisosbtn['hangup'] !== undefined) {
                    disableActionBtn['action_hangup'] = 0;
                    if (hasPerm(nro, 'hangup') || hasPerm(0, 'hangup')) {
                        disableActionBtn['action_hangup'] = 0;
                    } else {
                        if (permisosbtn['hangupself'] !== undefined) {
                            if (nro == myposition) {
                                disableActionBtn['action_hangup'] = 0;
                            } else {
                                disableActionBtn['action_hangup'] = 1;
                            }
                        } else {
                            if (nro != myposition) {
                                disableActionBtn['action_hangup'] = 1;
                            }
                        }
                    }
                } else {
                    disableActionBtn['action_hangup'] = 1;
                }

                if(disableActionBtn['action_hangup']==1) {
                    // only check hangupself if hangup is disabled as global
                    if (permisosbtn['hangupself'] !== undefined) {
                        if (nro == myposition) {
                            disableActionBtn['action_hangup'] = 0;
                        }
                    }
                }

                if (permisosbtn['transfer'] !== undefined) {
                    disableActionBtn['action_supervisedtransfer'] = 0;
                    disableActionBtn['action_transfer'] = 0;
                    disableActionBtn['action_vmail'] = 0;
                    if (hasPerm(nro, 'transfer') || hasPerm(0, 'transfer')) {
                        disableActionBtn['action_transfer'] = 0;
                        if (botonitos[nro]['EXTENVOICEMAIL'] !== undefined) {
                            disableActionBtn['action_vmail'] = 0;
                        }
                    } else {
                        disableActionBtn['action_supervisedtransfer'] = 1;
                        disableActionBtn['action_transfer'] = 1;
                        disableActionBtn['action_vmail'] = 1;
                    }
                } else {
                    disableActionBtn['action_supervisedtransfer'] = 1;
                    disableActionBtn['action_transfer'] = 1;
                    disableActionBtn['action_vmail'] = 1;
                }

                if (permisosbtn['transferexternal'] !== undefined) {
                    disableActionBtn['action_transferexternal'] = 0;
                    if (hasPerm(nro, 'transferexternal') || hasPerm(0, 'transferexternal')) {
                        if (botonitos[nro]['EXTERNAL'] !== undefined) {
                            disableActionBtn['action_transferexternal'] = 0;
                        } else {
                            disableActionBtn['action_transferexternal'] = 1;
                        }
                    } else {
                        disableActionBtn['action_transferexternal'] = 1;
                    }
                } else {
                    disableActionBtn['action_transferexternal'] = 1;
                }

                if (permisosbtn['pickup'] !== undefined) {
                    disableActionBtn['action_pickup'] = 0;
                    if (hasPerm(nro, 'pickup') || hasPerm(0, 'pickup')) {
                        disableActionBtn['action_pickup'] = 0;
                    } else {
                        disableActionBtn['action_pickup'] = 1;
                    }
                } else {
                    disableActionBtn['action_pickup'] = 1;
                }

                if (permisosbtn['dial'] !== undefined) {
                    disableActionBtn['action_originate'] = 0;
                    if (hasPerm(nro, 'dial') || hasPerm(0, 'dial')) {
                        disableActionBtn['action_originate'] = 0;
                    } else {
                        disableActionBtn['action_originate'] = 1;
                    }
                } else {
                    disableActionBtn['action_originate'] = 1;
                }

                if (permisosbtn['all'] !== undefined) {
                    // Solo revisar privacidad si tenemos permisos ALL
                    //
                    if (hasPerm(nro, 'all') || hasPerm(0, 'all')) {
                        disableActionBtn['action_spy'] = toolBarPrivacy(nro);
                        disableActionBtn['action_whisper'] = toolBarPrivacy(nro);
                        disableActionBtn['action_record'] = toolBarPrivacy(nro);

                        disableActionBtn['action_originate'] = 0;
                        disableActionBtn['action_pickup'] = 0;
                        disableActionBtn['action_transfer'] = 0;
                        disableActionBtn['action_supervisedtransfer'] = 0;
                        disableActionBtn['action_transferexternal'] = 0;
                        disableActionBtn['action_vmail'] = 0;
                        disableActionBtn['action_hangup'] = 0;

                        if (botonitos[nro]['EXTENVOICEMAIL'] !== undefined) {
                            disableActionBtn['action_vmail'] = 0;
                        } else {
                            disableActionBtn['action_vmail'] = 1;
                        }
                        if (botonitos[nro]['EXTERNAL'] !== undefined) {
                            disableActionBtn['action_transferexternal'] = 0;
                        } else {
                            disableActionBtn['action_transferexternal'] = 1;
                        }
                    }
                }

                for (elm in disableActionBtn) {

                    if ($(elm) !== null) {
                        var opa = $(elm).css('opacity');
                        if (opa === undefined) {
                            opa = 1;
                        }
                        if($('#'+elm).is(':visible')) {
                            if (disableActionBtn[elm] == 1) {
                                if (opa > 0.5) {
                                    $('#' + elm).fadeTo('fast', 0.5);
                                }
                            } else {
                                if (opa < 1) {
                                    $('#' + elm).fadeTo('fast', 1);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function showAgenda() {
    if (hasPerm(0, 'all') || hasPerm(0, 'phonebook')) {
        $('#slider').slideReveal('show');
    }
}

function ExtraeNumero(name) {
    var name = name.replace(/[^0-9\*]/g, "");
    return name;
}

function togleColaDisplay(myid) {
    if ($('#queuesummary_' + myid).is(':visible')) {
        $('#queuesummary_' + myid).hide();
        $('#agentsummary_' + myid).hide();
        $('#queueentries_' + myid).show();
        $('#agententries_' + myid).show();
    } else {
        $('#queuesummary_' + myid).show();
        $('#agentsummary_' + myid).show();
        $('#queueentries_' + myid).hide();
        $('#agententries_' + myid).hide();
    }
}

function removeUrlParameter(url, parameter) {

    if(url == '') {
        return url;
    }

    if(url.indexOf('?') == -1) {
        url = '?'+url;
    }

    var urlparts = url.split('?');

    if (urlparts.length >= 2) {
        var urlBase = urlparts.shift(); //get first part, and remove from array
        var queryString = urlparts.join("?"); //join it back up

        var prefix = encodeURIComponent(parameter) + '=';
        var pars = queryString.split(/[&;]/g);
        for (var i = pars.length; i-- > 0;) {
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }

        // remove empty elements from array
        len = pars.length;
        for(i = 0; i < len; i++ ) {
            pars[i] && pars.push(pars[i]);  // copy non-empty values to the end of the array
        }
        pars.splice(0 , len); 

        url = urlBase + '?' + pars.join('&');
    }
    return url;
}

function addUrlParameter(url, parameter, value) {
    url = removeUrlParameter(url, parameter);
    if(url == '') { url = '?'; }
    url += '&'+encodeURIComponent(parameter)+'='+encodeURIComponent(value);
    return url;
}

function confirmlogout() {
    alertify.set({
        labels: {
            ok: lang['yes'],
            cancel: lang['no']
        }
    });
    alertify.confirm('<span style="font-size:1.5em;">' + lang['logout'] + '</span><br/>' + lang['areyousure'], function(e) {
        if (e) {
            foplogout();
        }
    });
}

function foplogout() {

    var hash = hex_md5(secret + lastkey);
    command = "<msg data=\"" + myposition + "|close||" + hash + "\" />";
    send(command);

    unableToSetAuthSession=1;

    if ("WebSocket" in window && disableWebSocket === false) {
        ws.close();
    }

    fopexit = 1;
    if (logoutUrl != '') {
        urlfinal = logoutUrl;
    } else {
        urlfinal = window.location.href.split("?")[0].split("#")[0];
        if(context!='general') {
            urlfinal=urlfinal+"?context="+context;
        }
    }

    window.name = '';
    $('#myextension').val('');
    $('#securitycode').val('');

    myextension='';
    secret='';
    entered_secret='';
    entered_extension='';

    jQuery.ajaxSetup({async: true});
    jQuery.ajax({
        type: "POST",
        url: "setvar.php",
        data: {
            sesvar: 'logout',
            value: 'yes'
        }
    }).done(function(msg) {
        if (window.location.href != urlfinal) {
            window.location.href = urlfinal;
        } else {
            location.reload();
        }
    });

}

function escapeHTML(string) {
    // List of HTML entities for escaping.
    var htmlEscapes = {
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;'
    };

    // Regex containing the keys listed immediately above.
    var htmlEscaper = /[<>"']/g;

    return ('' + string).replace(htmlEscaper, function(match) {
        return htmlEscapes[match];
    });
}

function broomChatBox(id) {
    debug("broom chat " + id);
    $('#chatboxcontent_' + id).html('');
    $('#chatboxtextarea_' + id).focus();
}

function replaceURL(text) {
    // Used in CHAT to create a link when an url is posted
    //var exp = /(((https?|ftp|file):\/\/)?[A-Za-z0-9-_]+\.[A-Za-z0-9-_%&\?\/.=]+)/ig;
    var exp = /(((https?|ftp|file):\/\/)?[A-Za-z0-9-_]+\.[A-Za-z0-9-_%&\?\/=]+[A-Za-z0-9-_%&\?\/.=]+)/ig;
    var re = new RegExp(exp);
    var m = re.exec(text);
    var ret = '';
    if (m !== null) {
        if (m[2] === undefined) {
            ret = "http://";
        }
    }
    return text.replace(exp, "<a href='" + ret + "$1' target='_blank'>$1</a>");
}

function replaceNUMBER(text) {
    var exp = /(\d\d\d\d+)/ig;
    return text.replace(exp, "<a href='#' onclick='dial(\"$1\");'>$1</a>");
}

function checkChatInput(event, chatboxtextarea, chatboxid) {
    if (event.keyCode == 13 && event.shiftKey == 0) {
        var message = escapeHTML(chatboxtextarea.value);
        message = replace(message, '[b]', '<strong>');
        message = replace(message, '[/b]', '</strong>');
        message = replace(message, '[i]', '<i>');
        message = replace(message, '[/i]', '</i>');
        message = replaceNUMBER(message);
        message = replaceURL(message);

        var msgdiv = document.createElement('div');
        $(msgdiv).attr('class', 'chatboxmsgBubble');

        var me = lang.me;

        var thistime = new Date();
        var diftime = 60001;

        if (lastchat[chatboxid] !== undefined) {
            diftime = thistime - lastchat[chatboxid];
        }

        debug(diftime);

        var sDate = new Date();
        var tstamp = sDate.getTime();
        var formattedTime = dateFormat(tstamp, pdateFormat);

        if (diftime > 60000) {
            lastchat[chatboxid] = thistime;
            $(msgdiv).html(jQuery.template('<div class="chatboxmsgcontentSystem">#{fdate}</div>').eval({
                fdate: formattedTime
            }));
        }

        $(msgdiv).append(jQuery.template('<div class="bubbledLeft">#{message}</div>').eval({
            message: message,
            fdate: formattedTime
        }));

        $('#chatboxcontent_' + chatboxid).append(msgdiv);
        chatboxtextarea.value = '';
        $('#chatboxcontent_' + chatboxid).scrollTop($('#chatboxcontent_' + chatboxid).prop('scrollHeight'));

        var hash = hex_md5(secret + lastkey);
        var uuid = Math.random().toString(36).substr(2, 9);
        var msgEncoded = Base64.encode(message+'~'+uuid);

        var comando = "<msg data=\"" + myposition + "|chat!" + msgEncoded + "|" + chatboxid + "|" + hash + "\" />";

        if (chatboxid.indexOf('chatbroadcast') == 0) {
            var partes = chatboxid.split("_", 2);
            comando = "<msg data=\"" + myposition + "|chat!" + msgEncoded + "|bcast!" + partes[1] + "|" + hash + "\" />";
        }

        send(comando);

        if (mypreferences.soundChat !== "") {
            sonido['newchat'].play();
        }
        //lastchat[chatboxid]=20000;

        return false;
    }
}

function createChat(chatboxid, chatboxtitle, remote, msg) {

    var hash = hex_md5(secret + lastkey);
    var comando = "";

    openchats[chatboxid] = 1;

    if ($("#chatbox_" + chatboxid).length > 0) {
        if ($("#chatbox_" + chatboxid).is(':visible')) {

            // debug('la ventana de chat esta visible');
            if(mypreferences.alwaysNotifyChat=="on") {
                if (msg != 'notlogged' && msg != 'NOTONLINE' && msg != 'NOWONLINE') {
                    if (desktopNotify === true) {
                        window.notifylib.notify({
                        "title": lang.chat + " " + chatboxtitle,
                        "description": msg,
                        "timeout": notifyDuration
                        });
                    }
                }
            }

        } else {
            // debug('la ventana de chat no no no esta visible, la muestro');
            $("#chatbox_" + chatboxid).css('display', 'block');
            $('#chatboxcontent_' + chatboxid).scrollTop($('#chatboxcontent_' + chatboxid).prop('scrollHeight'));
            reacomodaChat();
            if (remote == 1) {
                if (msg != 'notlogged' && msg != 'NOTONLINE' && msg != 'NOWONLINE') {
                    if (desktopNotify === true) {
                        window.notifylib.notify({
                            "title": lang.chat + " " + chatboxtitle,
                            "description": msg,
                            "timeout": notifyDuration
                        });
                    }
                }
                return "blip";
            } else {
                if ($("#chatboxtextarea_" + chatboxid).length > 0) {
                    if ($('#chatboxcontent_' + chatboxid).is(':visible') !== false) {
                        if ($('#chatbox_' + chatboxid).is(':visible') !== false) {
                            $('#chatboxtextarea_' + chatboxid).focus();
                        }
                    }
                }
            }
        }

        if (remote == 1) {
            return "newchat";
        } else {
            comando = "<msg data=\"" + myposition + "|checkonline|" + chatboxid + "|" + hash + "\" />";
            send(comando);
            debug("chequeo si el usuario esta conectado " + chatboxid);
            return;
        }
    }

    if (remote == 1) {
        debug('set windows notify');
        if (msg != 'notlogged' && msg != 'NOTONLINE' && msg != 'NOWONLINE') {
            if (desktopNotify === true) {
                window.notifylib.notify({
                    "title": lang.chat + ' ' + chatboxtitle,
                    "description": msg,
                    "timeout": notifyDuration
                });
            }
        }
    } else {
        debug('not set windows notify because not remote');
        comando = "<msg data=\"" + myposition + "|checkonline|" + chatboxid + "|" + hash + "\" />";
        send(comando);
        debug("chequeo si el usuario esta conectado " + chatboxid);
    }

    var clasesound = "soundchat";

    if (mypreferences.soundChat === "") {
        clasesound = "nosoundchat";
    }

    var partes = chatboxtitle.split(" ", 2);
    var xhr = jQuery.ajax({
        type: "GET",
        data: {
            image: partes[0]
        },
        url: "vphonebook.php",
        success: function(output, status) {
            if (output != '') {
                $('#pict_' + partes[0]).attr('src', 'uploads/' + output);
            }
        }
    });

    debug("creo un nuevo div para chat");

    var chatdiv = document.createElement('div');
    $(chatdiv).attr('class', 'chatbox');
    $(chatdiv).attr('id', 'chatbox_' + chatboxid);

    document.body.appendChild(chatdiv);

    $('#chatbox_' + chatboxid).html(jQuery.template('<div class="chatboxhead" onClick="javascript:daleFoco(\'#{chatboxid}\');"><img id="pict_#{extension}" class="chatpicture" src="images/person.png"><div id="cbt_#{chatboxid}" class="chatboxtitle">#{chatboxtitle}</div><div class="chatboxoptions"><div id="cbmin_#{chatboxid}" class="minimizechat" onclick="javascript:toggleChat(\'#{chatboxid}\')"></div><div class="closechat" onclick="javascript:closeChatBox(\'#{chatboxid}\')"></div></div><br clear="all"/></div><div id="chatboxcontent_#{chatboxid}" class="chatboxcontent" onClick="javascript:daleFoco(\'#{chatboxid}\');"></div><div id="chatboxinput_#{chatboxid}" class="chatboxinput"><div class="chaticons"><div class="broomchat" title="#{clearlegend}" onclick="javascript:broomChatBox(\'#{chatboxid}\')"></div><div class="#{clasesound}" title="#{togglesound}" onclick="javascript:toggleChatSound(\'#{chatboxid}\')" id="icosound_#{chatboxid}"></div></div><textarea id="chatboxtextarea_#{chatboxid}" class="chatboxtextarea" onkeydown="javascript:return checkChatInput(event,this,\'#{chatboxid}\');" onFocus="javascript:chatHasFocus();" onBlur="javascript:chatLostFocus()"></textarea><div class="clear"></div></div>').eval({
        chatboxtitle: chatboxtitle,
        chatboxid: chatboxid,
        clearlegend: lang.clearchat,
        togglesound: lang.toggle_sound,
        clasesound: clasesound,
        extension: partes[0]
    }));
    // footer visible bottom=18
    if ($('#footer').is(':visible')) {
        $('#chatbox_' + chatboxid).css('bottom', '5px');
    } else {
        $('#chatbox_' + chatboxid).css('bottom', '0px');
    }

    visibleChats = 0;
    for (var x in openchats) {
        if ($("#chatbox_" + x).is(':visible')) {
            visibleChats++;
        } else {
            debug("chat " + x + " no estaba visible ");
        }
    }

    if (visibleChats === 0) {
        $("#chatbox_" + chatboxid).css('right', '1px');
    } else {
        width = (visibleChats) * (225 + 7) + 1;
        $("#chatbox_" + chatboxid).css('right', width + 'px');
    }

    openchats[chatboxid] = 1;

    var superz = findHighestZ();
    $('#chatbox_' + chatboxid).css('display', 'block');
    $('#chatbox_' + chatboxid).css('zIndex', superz);
    if (remote === 0) {
        $('#chatboxtextarea_' + chatboxid).focus();
    } else {
        return "blip";
    }
}

function daleFoco(chatboxid) {
    if ($('#chatboxcontent_' + chatboxid).is(':visible') !== false) {
        if ($('#chatbox_' + chatboxid).is(':visible') !== false) {
            $('#chatboxtextarea_' + chatboxid).focus();
        }
    }
}

function chatHasFocus() {
    chatFocus = 1;
    notiChatTitle = 0;
    document.title = savedTitle;
}

function chatLostFocus() {
    chatFocus = 0;
}

function toggleChatSound(chatboxid) {
    //if(soundChat == 1) {

    debug(mypreferences.soundChat);

    if (mypreferences.soundChat !== "") {
        //soundChat = 0;
        mypreferences.soundChat = "";
    } else {
        //soundChat = 1;
        mypreferences.soundChat = "on";
    }

    $('#chatboxtextarea_' + chatboxid).focus();
    var cl1 = "soundchat";
    var cl2 = "nosoundchat";
    //if(soundChat==1) {
    if (mypreferences.soundChat == "on") {
        cl2 = "soundchat";
        cl1 = "nosoundchat";
        setPreference("soundChat", "on");
        $('#prefSoundChat').attr('checked', true);
        $('#prefSoundChat').next().toggleClass('checked').children(':first').html(lang.yes);
        //.html(lang['yes']);
    } else {
        setPreference("soundChat", "");
        $('#prefSoundChat').attr('checked', false);
        $('#prefSoundChat').next().toggleClass('checked').children(':first').html(lang.no);
        //.html(lang['no']);

    }
    for (var j in openchats) {
        $('#icosound_' + j).removeClass(cl1);
        $('#icosound_' + j).addClass(cl2);
    }
}

function toggleChat(chatboxid) {
    debug("toggleChat");
    $('#chatboxcontent_' + chatboxid).toggle();
    $('#chatboxinput_' + chatboxid).toggle();
    $('#chatboxcontent_' + chatboxid).scrollTop($('#chatboxcontent_' + chatboxid).prop('scrollHeight'));
    if ($('#chatboxcontent_' + chatboxid).is(':visible') === false) {
        $('#cbmin_' + chatboxid).addClass("maximizechat");
        $('#cbmin_' + chatboxid).removeClass("minimizechat");
        debug("minimize");
    } else {
        $('#cbmin_' + chatboxid).removeClass("maximizechat");
        $('#cbmin_' + chatboxid).addClass("minimizechat");
        $('#chatboxtextarea_' + chatboxid).focus();
        document.title = savedTitle;
    }
}

function closeChatBox(chatboxid) {
    $('#chatbox_' + chatboxid).hide();
    delete openchats[chatboxid];
    notiChatTitle = 0;
    document.title = savedTitle;
    reacomodaChat();
}

function reacomodaChat() {
    align = 0;
    var superz = findHighestZ();
    for (var id in openchats) {
        if ($("#chatbox_" + id).is(':visible')) {
            if (align === 0) {
                $("#chatbox_" + id).css('right', '20px');
            } else {
                width = (align) * (225 + 7) + 20;
                $("#chatbox_" + id).css('right', width + 'px');
            }
            $("#chatbox_" + id).css('zIndex', superz);
            align++;
        }
    }
}

function getCookie(name) {
    var cname = name + "=";
    var dc = document.cookie;
    if (dc.length > 0) {
        begin = dc.indexOf(cname);
        if (begin != -1) {
            begin += cname.length;
            end = dc.indexOf(";", begin);
            if (end == -1) {
                end = dc.length;
            }
            return unescape(dc.substring(begin, end));
        }
    }
    return null;
}

function setCookie(name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) + ((expires === undefined) ? "" : "; expires=" + expires.toGMTString()) + ((path === undefined) ? "" : "; path=" + path) + ((domain === undefined) ? "" : "; domain=" + domain) + ((secure === undefined) ? "" : "; secure");
}

function makeSortable(what) {
    return;
}

function setPreference(parameter, value) {

    if(parameter=='grid' && resizinggrid==1) {
       return;
    }

    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + myposition + "|setpref|" + parameter + "!" + value + "|" + hash + "\" />";
    send(comando);
}

function setFullPreference(value) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + myposition + "|setpref|" + value + "|" + hash + "\" />";
    send(comando);
}


function findHighestZ() {
    var selector = '*';
    return Math.max(0, Math.max.apply(null, $.map(((selector || "*") === "*") ? $.makeArray(document.getElementsByTagName("*")) : $(selector),

    function(v) {
        if ($(v).hasClass("chatbox")) {
            return 0;
        } else {
            return parseFloat($(v).css("z-index")) || null;
        }
    })));
}

function getFirefoxVersion() {
    var ffversion = 0;
    if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
        var ffversion = new Number(RegExp.$1);
    }
    return ffversion;
}

function isIE(version) {
    var
    self = this.isIE,
        ieVersion = self.version;

    ieVersion = self.version = (ieVersion !== undefined) ? ieVersion : (function() {
        var
        v = 3,
            div, all,
            isIE10 = (eval("/*@cc_on!@*/false") && document.documentMode === 10);

        if (isIE10) return 10;

        div = document.createElement('div'),
        all = div.getElementsByTagName('i');

        while (
        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
        all[0]) {;
        }

        return (v > 4) ? v : false;
    }());

    return (version) ? version === ieVersion : ieVersion;
}

function isSecure() {
    return location.protocol == 'https:';
}

function openNewBackgroundTab(url) {

    debug('open new background tab');

    if($('#browseriframe').length>0) {
        $('#browseriframe').attr('src',url);
        $('#urlbar').val(url);
        return;
    }

    if (getFirefoxVersion() == 0 && !isIE()) {

        debug("Automatic popup chrome/safari ctrl/cmd click");
        // Not firefox, we use ctrl/cmd+key to open in tab

        if ($('#apopup').length > 0) {
            $('#apopup').remove();
        }

        var a = document.createElement('a');
        $(a).attr('href', url);
        $(a).attr('id', 'apopup');
        $(a).attr('target', '_blank');
        $(a).css('display', 'none');
        $('#head').append(a);

        var evt = document.createEvent('MouseEvents');

        if (isMac) {
            debug('is mac simulate click');
            evt.initMouseEvent('click', true, true, window, 0, 0, 0, 0, 0, true, false, false, true, 0, null);
        } else {
            debug('is not mac simulate click');
            evt.initMouseEvent('click', true, true, window, 0, 0, 0, 0, 0, true, false, false, false, 0, null);
        }

        a.dispatchEvent(evt);

    } else {

        // Firefox & ID do not support ctrl-click simulations to open in tab, so we use window open instead
        debug("Automatic popup window.open for firefox or IE");
        window.open(url, '_blank');
        window.focus();
    }
    return;
}

var getHiddenOffsetWidth = function(el) {
    var $hiddenElement = $(el).clone().appendTo('body');
    var width = $hiddenElement.outerWidth();
    $hiddenElement.remove();
    return width;
}

function setMenuExtensions() {

    debug("set menu for extensions");

    var menuitems = {};

    $('#allbuttons').contextMenu({
        selector: '.ctxmenu',
        trigger: 'left',
        build: function(trigger, e) {
            // this callback is executed every time the menu is to be shown
            // its results are destroyed every time the menu is hidden
            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
            debug('removemos items para ' + trigger.attr('id'));

            menuitems = {
                "chat": {
                    name: lang.chat,
                    icon: "chat"
                },
                "email": {
                    name: lang.email_user,
                    icon: "email"
                },
                "sms": {
                    name: lang.send_sms,
                    icon: "sms"
                },
                "pause": {
                    name: lang.pause_member,
                    icon: "pause"
                },
                "unpause": {
                    name: lang.unpause_member,
                    icon: "unpause"
                },
                "add": {
                    icon: "addto",
                    name: lang.add_member,
                    items: {}
                },
                "remove": {
                    icon: "removefrom",
                    name: lang.remove_member_from,
                    items: {}
                }
            };

            for (var mc = 0; mc < availablequeues.length; mc++) {
                menuitems["add"]["items"]["addmember^" + mc] = {
                    name: dict_queue[availablequeues[mc]]
                };
                menuitems["remove"]["items"]["delmember^" + mc] = {
                    name: dict_queue[availablequeues[mc]]
                };
            }

            if(typeof pauseReasons != 'undefined') {
                var reasonsize = 0, reasonkey;
                for (reasonkey in pauseReasons) {
                    if (pauseReasons.hasOwnProperty(reasonkey)) reasonsize++;
                }
                if(reasonsize > 0) {
                    menuitems["pause"]["items"] = {};
                    for (var item in pauseReasons) {
                        menuitems["pause"]["items"]["pausemember^"+item] = { 
                            name: item
                        }
                    }
                }
            }

            items = disableMenuItems(menuitems, trigger.attr('id'));

            // Hook for plugins so they can modify item list, if they have the setExtensionMenu method
            for (var iplug in plugins) {
                if (typeof(plugins[iplug].setExtensionMenu) == 'function') {
                    items = plugins[iplug].setExtensionMenu(items, trigger.attr('id'));
                }
            }

            return {
                callback: function(action, options) {
                    var target = -1;
                    var source = $(this).attr('id').substring(8);
                    debug("clicked: " + action + " on " + source);
                    if (action.indexOf('^') > -1) {
                        var partes = action.split('^');
                        action = partes[0];
                        target = partes[1];
                    }
                    if (typeof executeMenu[action] == "function") {
                        executeMenu[action](target, source);
                    } else {
                        debug('context menu action ' + action + ' not implemented, try plugins');

                        // Hook for plugins 
                        for (var iplug in plugins) {
                            if (typeof(plugins[iplug][action]) == 'function') {
                                plugins[iplug][action](target, source);
                            }
                        }
                    }


                },
                items: items
            };
        }
    });
}

function setMenuQueues() {

    $('#allbuttons').contextMenu({
        selector: '.ctxmenuqueue',
        trigger: 'left',
        build: function(trigger, e) {
            // this callback is executed every time the menu is to be shown
            // its results are destroyed every time the menu is hidden
            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)

            debug('removemos items para ' + trigger.attr('id'));
            var partes = trigger.data('channel').split("~");
            var member = partes[2];
            var idx = trigger.parent().attr('id').substring(13);
            var queuei = queueindex[idx];

            menuitems = {
                "pause": {
                    name: lang.pause_member,
                    icon: "pause"
                },
                "unpause": {
                    name: lang.unpause_member,
                    icon: "unpause"
                },
                "delmember": {
                    name: lang.remove_member,
                    icon: "removefrom"
                }
            };

            if(typeof pauseReasons != 'undefined') {
                var reasonsize = 0, reasonkey;
                for (reasonkey in pauseReasons) {
                    if (pauseReasons.hasOwnProperty(reasonkey)) reasonsize++;
                }
                if(reasonsize > 0) {
                    menuitems["pause"]["items"] = {};
                    for (var item in pauseReasons) {
                        menuitems["pause"]["items"]["pausequeuemember^"+item] = { 
                            name: item
                        }
                    }
                }
            }

            if(typeof queuePenalties != 'undefined') {

                menuitems['setpenalty'] = { name: lang.set_penalty, icon: "info" };

                var ptysize = 0, ptykey;
                for (ptykey in queuePenalties) {
                    if (queuePenalties.hasOwnProperty(ptykey)) ptysize++;
                }
                if(ptysize > 0) {
                    menuitems["setpenalty"]["items"] = {};
                    for (var item in queuePenalties) {
                        menuitems["setpenalty"]["items"]["setpenalty^"+queuePenalties[item]] = { 
                            name: item
                        }
                    }
                }
            }

            if (hasPerm(idx, 'queuemanager') || hasPerm(0, 'queuemanager') || hasPerm(idx, 'all') || hasPerm(0, 'all')) {
                items = menuitems;
            } else {
                items = {};
                debug('no tiene permisos');
                return false;
            }

            return {
                callback: function(action, options) {
                    reason='';
                    if (action.indexOf('^') > -1) {
                        var partes = action.split('^');
                        action = partes[0];
                        reason = partes[1];
                    }
                    executeMenu[action](queuei, member, reason);
                },
                items: items
            };
        }
    });
}

function setMenuMeetme() {

    $('#allbuttons').contextMenu({
        selector: '.ctxmenumeetme',
        trigger: 'left',
        build: function(trigger, e) {

            var nro = trigger.attr('id').substring(6);

            if (!$('#boton' + nro).hasClass('busy')) {
                debug('No active conferences, do not show menu');
                return false;
            }

            debug('meetme menu boton ' + nro)

            menuitems = {
                "muteall": {
                    name: lang.toggle_muteall,
                    icon: "mute"
                },
                "lock": {
                    name: lang.toggle_lock,
                    icon: "lock"
                }
            };

            if (hasPerm(nro, 'meetme') || hasPerm(0, 'meetme') || hasPerm(nro, 'all') || hasPerm(0, 'all')) {
                items = menuitems;
            } else {
                debug('No tiene permisos meetme');
                return false;
            }

            return {
                callback: function(action, options) {
                    executeMenu[action](nro);
                },
                items: items
            };
        }
    });

    $('#allbuttons').contextMenu({
        selector: '.ctxmenuparticipant',
        trigger: 'left',
        build: function(trigger, e) {

            var iddecoded = trigger.attr('id');
            var partes = iddecoded.split('-');

            var usernum = partes.pop();
            var meetme  = partes.join('-');
            //var meetme = partes[0];
            //var usernum = partes[1];

            var nro = trigger.parent().attr('id').substring(14); // meetmeentries_x

            debug('meetme menu ' + meetme + ' user num ' + usernum + ' button number ' + nro);

            menuitems = {
                "mute": {
                    name: lang.toggle_mute,
                    icon: "mute"
                },
                "kick": {
                    name: lang.kick,
                    icon: "kick"
                }
            };

            if (hasPerm(nro, 'meetme') || hasPerm(0, 'meetme') || hasPerm(nro, 'all') || hasPerm(0, 'all')) {
                items = menuitems;
            } else {
                debug('No tiene permisos meetme');
                return false;
            }

            return {
                callback: function(action, options) {
                    executeMenu[action]('CONFERENCE/' + meetme, usernum, iddecoded);
                },
                items: items
            };
        }
    });
}

function setMenuPickup() {

    $('#allbuttons').contextMenu({
        selector: '.ctxmenupickup',
        trigger: 'left',
        build: function(trigger, e) {

            var channel = '';
            var this_id = trigger.attr('id');
            var parent_id = trigger.parent().attr('id');

            var partes = parent_id.split("_");
            var nro = partes[1];

            if (parent_id.indexOf('queueentries') > -1) {
                var partes = this_id.split('!');
                channel = partes[3];
                channel = trigger.data('channel');
            } else if (parent_id.indexOf('trunkentries') > -1) {
                channel = this_id.substring(5);
            }

            debug('parent id ' + parent_id)
            debug('this id ' + this_id)

            menuitems = {
                "pickup": {
                    name: lang.pickup_call,
                    icon: "addto"
                }
            };

            //items = menuitems;

            if (hasPerm(nro, 'pickup') || hasPerm(0, 'pickup') || hasPerm(nro, 'all') || hasPerm(0, 'all')) {
                items = menuitems;
            } else {
                debug('No tiene permisos pickup');
                return false;
            }

            return {
                callback: function(action, options) {
                    executeMenu[action](channel);
                },
                items: items
            };
        }
    });
}

function setMenuGroup() {

    $('#allbuttons').contextMenu({
        selector: '.ctxmenugroup',
        trigger: 'left',
        build: function(trigger, e) {

            var channel = '';
            var this_id = trigger.attr('id');
            $(trigger).tooltip('hide');

            var partes = this_id.split("_", 2);
            if(partes[1].indexOf('grp')==0) {
               var pos = partes[1].substring(3);
               partes[1] = displaygroups[pos];
            }
            var chattitle = 'To ' + partes[1];

            if (licenselevel & 4) {
            
                menuitems = {
                    "chatbroadcast": {
                        name: lang.chat,
                        icon: "chat"
                    },
                    "notybroadcast": {
                        name: lang.note,
                        icon: "info"
                    }
                };

            } else {

                menuitems = {
                    "notybroadcast": {
                        name: lang.note,
                        icon: "info"
                    }
                };

            }

            if (hasPerm(0, 'broadcast') || hasPerm(0, 'all')) {
                items = menuitems;
            } else {
                debug('No tiene permisos chat');
                return false;
            }

            return {
                callback: function(action, options) {
                    executeMenu[action](this_id, chattitle);
                },
                items: items
            };
        }
    });
}


function disableMenuItems(items, target) {

    if (permisosbtn['chat'] === undefined) {
        permisosbtn['chat'] = [];
    }

    if (permisosbtn['sms'] === undefined) {
        permisosbtn['sms'] = [];
    }

    if (permisosbtn['queuemanager'] === undefined) {
        permisosbtn['queuemanager'] = [];
    }

    if (permisosbtn['queueagent'] === undefined) {
        permisosbtn['queueagent'] = [];
    }

    if (permisosbtn['queuelogin'] === undefined) {
        permisosbtn['queuelogin'] = [];
    }

    var btn = target.substring(8);

    // Envio de email, solo requiere tener configurado el email en la definicion del boton
    if (extenmail[btn] === undefined) {
        items.email.disabled = true;
    }

    // Chat, requiere permisos & licencia de chat
    if (licenselevel & 4) {
        if (hasPerm(btn, 'chat') || hasPerm(0, 'chat') || hasPerm(btn, 'all') || hasPerm(0, 'all')) {
            items.chat.disabled = false;
        } else {
            items.chat.disabled = true;
        }
    } else {
        // No tiene licencia chat
        delete items.chat;
    }

    // Opcion de SMS
    var showsmsmenu=0;
    var deletesmsmenu=0;
    if (sms_enabled == 1 && botonitos[btn]['EXTERNAL'] !== undefined) {
        if (hasPerm(btn, 'sms') || hasPerm(0, 'sms') || hasPerm(btn, 'all') || hasPerm(0, 'all')) {
            items.sms.disabled = false;
            showsmsmenu=1;
        }
    } else if(sms_messagesend == 1) {
        if (hasPerm(btn, 'sms') || hasPerm(0, 'sms') || hasPerm(btn, 'all') || hasPerm(0, 'all')) {
            items.sms.disabled = false;
            showsmsmenu=1;
        } 
    } else {
        deletesmsmenu=1;
    } 

    if(showsmsmenu==0) {
        // No tiene sms configurado
        items.sms.disabled = true;
        if(deletesmsmenu==1) {
            delete items.sms;
        }
    }

    // Opcion pause/unpause
    if (myposition == btn) {
        // chequeamos queueagent
        if (hasPerm(btn, 'queueagent') || hasPerm(0, 'queueagent') || hasPerm(btn, 'queuemanager') || hasPerm(0, 'queuemanager') || hasPerm(btn, 'all') || hasPerm(0, 'all')) {
            items.pause.disabled = false;
            items.unpause.disabled = false;

            // removemos colas si esta restrict queue definido
            for (i = 0; i < availablequeues.length; i++) {
                var queue = availablequeues[i].split("^")[0];
                if (restrictqueue[queue] !== undefined) {
                    if (jQuery.inArray(btn, restrictqueue[queue].split(',')) == -1) {
                        delete items.add.items["addmember^" + i];
                        delete items.remove.items["delmember^" + i];
                    }
                }
            }

        } else {
            if (hasPerm(btn, 'queuelogin') || hasPerm(0, 'queuelogin')) {
                // do not disable pauses if it has queuelogin
            } else {
                items.pause.disabled = true;
                items.unpause.disabled = true;
            }
            delete items.add;
            delete items.remove;
        }
    } else {
        // no chequeamos queueagent
        if (hasPerm(btn, 'queuemanager') || hasPerm(0, 'queuemanager') || hasPerm(btn, 'all') || hasPerm(0, 'all')) {
            items.pause.disabled = false;
            items.unpause.disabled = false;

            // removemos colas si esta restrict queue definido
            for (i = 0; i < availablequeues.length; i++) {
                var queue = availablequeues[i].split("^")[0];
                if (restrictqueue[queue] !== undefined) {
                    if (jQuery.inArray(btn, restrictqueue[queue].split(',')) == -1) {
                        delete items.add.items["addmember^" + i];
                        delete items.remove.items["delmember^" + i];
                    }
                }
            }
        } else {
            items.pause.disabled = true;
            items.unpause.disabled = true;
            delete items.add;
            delete items.remove;
        }
    }

    // Si no hay colas, eliminamos opciones de cola totalmente
    if (availablequeues.length == 0) {
        delete items.pause;
        delete items.unpause;
        delete items.add;
        delete items.remove;
    }

    // Add custom menu items OJO
    // jQuery.extend(items,myCustomMenuExtensions);

    return items;
}

function sendsms(nro, destino) {

    var mando = 0;
    if (hasPerm(0, 'all')) {
        mando = 1;
    } else {
        if (permisosbtn['sms'] !== undefined) {
            if (hasPerm(destino, 'sms') || hasPerm(0, 'sms')) {
                mando = 1;
            }
        }
    }

    if (mando == 1) {
        debug("mando un sms a " + nro + " porque esta autorizado=" + mando);
        var nroCoded = Base64.encode(destino);
        alertify.set({
            labels: {
                ok: lang.accept,
                cancel: lang.cancel
            },
            buttonFocus: "ok"
        });
        alertify.prompt(lang['message'], function(e, msg) {
            // str is the input text
            if (e) {
                var msgCoded = Base64.encode(msg);
                if (myposition > 0 && msg.length > 0) {
                    if (secret !== "") {
                        if ($('#smsSend').length > 0) {
                            $('#smsSend').prop('disabled', true);

                            smstimer = window.setTimeout(function() {
                                $("#dialtext").val('');
                                $('#dialtext').typeahead('val','');
                                $('#dialtext').trigger('blur');
                            }, 20000);

                        }
                        var hash = hex_md5(secret + lastkey);
                        var ko = new Date();
                        var ji = ko.getTime();
                        var randy = Math.random() * 1000;
                        var unique = "sms" + ji + randy;
                        send("<msg data=\"" + myposition + "!" + nroCoded + "!" + msgCoded + "!" + unique + "|sendsms|" + destino + "|" + hash + "\" />");
                    }
                }
            } else {
                debug('sms cancelado');
                // user clicked "cancel"
            }
        }, "");
    } else {
        debug("No mando SMS porque no tiene permiso");
    }
}

function do_mute(meetme, usernum, element_id) {
    var hash = hex_md5(secret + lastkey);
    var action = "";

    if ($('#' + element_id).hasClass('meetmemuted') || $('#' + element_id).hasClass('meetmeadminmuted')) {
        action = "unmute";
    } else {
        action = "mute";
    }
    var comando = "<msg data=\"" + meetme + "|" + action + "|" + usernum + "|" + hash + "\" />";
    send(comando);
}

function do_kick(meetme, usernum, element_id) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + meetme + "|kick|" + usernum + "|" + hash + "\" />";
    send(comando);
}

function do_muteall(nro) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + nro + "|muteall|" + nro + "|" + hash + "\" />";
    send(comando);
}

function do_meetmeLock(nro) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + nro + "|meetmelock|" + nro + "|" + hash + "\" />";
    send(comando);
}

function do_addmember(queue, member) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + queue + "|queueadd|" + member + "-" + myposition + "|" + hash + "\" />";
    send(comando);
}

function do_delmember(queue, member) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + queue + "|queuelogout|" + member + "|" + hash + "\" />";
    send(comando);
}

function qpause(queue, member, reason) {
    var hash = hex_md5(secret + lastkey);
    var miembro = member;
    if(reason !== undefined) { reason = Base64.encode(reason);  miembro += "!" + reason; }
    debug("qpause "+miembro);
    var comando = "<msg data=\"" + queue + "|queuepause|" + miembro + "|" + hash + "\" />";
    send(comando);
}

function qpenalty(queue, member, penalty) {
    var hash = hex_md5(secret + lastkey);
    var miembro = member;
    if(penalty !== undefined) { miembro += "!" + penalty; } else { return; }
    debug("qpenalty member "+miembro);
    var comando = "<msg data=\"" + queue + "|queuepenalty|" + miembro + "|" + hash + "\" />";
    send(comando);
}

function qunpause(queue, member) {
    var hash = hex_md5(secret + lastkey);
    var comando = "<msg data=\"" + queue + "|queueunpause|" + member + "|" + hash + "\" />";
    send(comando);
}

function pickupActive(channel) {
    if (myposition > 0) {
        var boton = $('#boton' + myposition);
        if (boton.hasClass('busy')) {
            debug('Extension busy, ignoring pickup action');
            return;
        }
        var hash = hex_md5(secret + lastkey);
        var comando = "<msg data=\"" + myposition + "|pickupActive|" + channel + "|" + hash + "\" />";
        send(comando);
    } else {
        debug("No origin extension defined for actions");
    }
}

function updateCountdown() {
    // 140 is the max message length
    var remaining = 160 - jQuery('#smsMsg').val().length;
    jQuery('#countdown').text(remaining);
}

function pre_init() {
    debug('pre init');
    if ("WebSocket" in window && disableWebSocket === false) {
        debug("Client has HTML5 web sockets!");

        if (getExten !== "" && getPass !== "") {
            myextension = getExten;
            secret = getPass;
            $('#loader').show();
        } 
    } else {
        debug("Websocket no habilitado");
    }
    connectXML();
}

function selectText(divid) {
    if (document.selection) {
        var div = document.body.createTextRange();
        div.moveToElementText(document.getElementById(divid));
        div.select();
    } else {
        var div = document.createRange();
        div.setStartBefore(document.getElementById(divid));
        div.setEndAfter(document.getElementById(divid)) ;
        window.getSelection().addRange(div);
    }
}

jQuery.fn.flipflop = function (args) {
    var that = $(this);
    var displayed = 2,
        args = $.extend(true, {
            speed: 3000,
            stop: false,
            text1: '',
            text2: ''
        }, args),
        dfd = $.Deferred();

    function init() {
        that.bind('flipflopstop', function() {
            args.stop = true;
            delete(that.flipflop);
            that.flipflop = null;
        });
    };
    function go() {
        if (args.stop === false) {
            if (displayed === 1) {
                that.text(args.text2);
                displayed = 2;
            } else {
                that.text(args.text1);
                displayed = 1;
            }
            setTimeout(go, args.speed);
        }
    };

    init();
    go();
    return dfd.promise();
};

function grid_auto_height(type,skipsave) {

    grid = $('.grid-stack').data('gridstack');

    original_resizinggrid=resizinggrid;

    origtype=type;
    if(type.indexOf('box_')==0) {
        type = type.substring(4);
    }

    // by default we skip saving position on auto height
    // when collapsing, we call this function with skipsave at zero so it *does* get saved
    if(typeof skipsave == 'undefined') {
        skipsave=1;
    }

    locked=0;
    for(a=0;a<grid.grid.nodes.length;a++) { 
        if(grid.grid.nodes[a].el.attr('id')==type+'box') {
            if(grid.grid.nodes[a].locked==true) {
                locked=1;
            }
        }
    }

    if($('#'+type+'content').length>0 || $('#'+origtype+'content').length>0) {
        if($('#'+type+'content').length>0) {
           actualcontent = $('#'+type+'content');
        } else {
           actualcontent = $('#'+origtype+'content');
        }

        if($('#'+type+'list').length>0) {
            actualcontent = $('#'+type+'list');
        }
        if($('#'+origtype+'list').length>0) {
            actualcontent = $('#'+origtype+'list');
        }
 
        //debug(actualcontent[0].id);

        var verticalMargin = 10;
        cellheight = grid.cellHeight();
        actualcontent.css('height','initial');
        //var height = actualcontent.innerHeight();
        var height = actualcontent[0].scrollHeight;
        actualcontent.css('height','100%');
        height += 7; // for padding
        rowheight  = Math.ceil(height / ( cellheight + verticalMargin ));
        //debug('height '+height);
        //debug('cel height '+cellheight);
        //debug('rowheight '+rowheight);
        //debug(actualcontent);
        resizinggrid=skipsave;
        if(skipsave==1 && locked==1) {
            // si esta lockeado, no queremos auto height automatico, solo cuando se toca toggle
        } else {
            grid.resize($('#'+origtype+'box'),null,rowheight);
        }
        resizinggrid=original_resizinggrid;
    } else {
        debug('pref no existe grid auto height '+type+ ' o bien esta locked');
    }
}

function escapeRegExp(text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
}

function loadFrames() {
    if (jQuery.inArray('phonebook', permisos) >= 0 || jQuery.inArray('all', permisos) >= 0) {
        $('#contactsframe').attr('src','contacts.php');
    }
}

function restoreGrid(jsongrid) {

    debug('restoring Grid');

    grid.batchUpdate();

    if(jsongrid.length>0) {
        resizinggrid=1;
        grid = $('.grid-stack').data('gridstack');
        try {
            var data = JSON.parse(jsongrid);
            for (var item in data) {
                grid.update($('#'+data[item].id), data[item].x, data[item].y, data[item].width, data[item].height );

                saveGridPos[data[item].id]= [ data[item].x, data[item].y, data[item].width, data[item].height ];

                if(data[item].height==1) {
                    $('#'+data[item].id).find('.widget-toggle-btn').children('i').eq(0).addClass('fa-caret-square-o-down').removeClass('fa-caret-square-o-up');
                }

                if(data[item].locked=='true') {
                    grid.locked($('#'+data[item].id),true);
                    $('#'+data[item].id).find('.widget-lock-btn').children('i').eq(0).addClass('fa-lock').removeClass('fa-unlock-alt');
                }
            }
        } catch(e) {
            debug("Invalid JSON in grid setting");
        }
        resizinggrid=0;
    } 
    grid.commit();
}

function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");

  //
  // *** This styling is an extra step which is likely not required. ***
  //
  // Why is it here? To ensure:
  // 1. the element is able to have focus and selection.
  // 2. if element was to flash render it has minimal visual impact.
  // 3. less flakyness with selection and copying which **might** occur if
  //    the textarea element is not visible.
  //
  // The likelihood is the element won't even render, not even a flash,
  // so some of these are just precautions. However in IE the element
  // is visible whilst the popup box asking the user for permission for
  // the web page to copy to the clipboard.
  //

  // Place in top-left corner of screen regardless of scroll position.
  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;

  // Ensure it has a small width and height. Setting to 1px / 1em
  // doesn't work as this gives a negative w/h on some browsers.
  textArea.style.width = '2em';
  textArea.style.height = '2em';

  // We don't need padding, reducing the size if it does flash render.
  textArea.style.padding = 0;

  // Clean up any borders.
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';

  // Avoid flash of white box if rendered for any reason.
  textArea.style.background = 'transparent';


  textArea.value = text;

  document.body.appendChild(textArea);

  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    debug('Copying text command was ' + msg);
  } catch (err) {
    debug('Oops, unable to copy');
  }

  document.body.removeChild(textArea);
}

function dblclickFunc(e, el){
    //alert('received an event of type ' + e.type + ' on ' + el.tagName);
    var texto = $(el).attr('data-original-title');
    copyTextToClipboard(texto);
}

function serialize_widget_map(items) {
    debug('serialize widget save preferences ' + resizinggrid);
    if(resizinggrid==0) {
        fullyGetPref=1;
        grid_serialized = gridDataSerialized();
        mypreferences.grid = grid_serialized;
        setPreference("grid", grid_serialized);
    } else {
        debug('save preferences skip serialize save as it is just auto resizing');
    }
};

jQuery(document).ready(function($) {

    debug('ready');

    $('#allbuttons [data-toggle="tooltip"]').tooltip({container:'body'});

    $('#menupreferences').click(function(e) {
        showPref();
    });

    $('#menurecordings').click(function(e) {
        showRecordings();
    });

    $('#menuchats').click(function(e) {
        showChats();
    });

    $('#menucdr').click(function(e) {
        showCDR();
    });

    $('#menulogout').click(function(e) {
        confirmlogout();
    });

    $('#tabnav a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    // Contacts Slider
    $('#slider').slideReveal({'position':'right','push':false,'trigger':$('#menucontacts'),show:function() {
            debug('slide shown');
            if($('#contactsframe').attr('src')=='') {
                $('#contactsframe').attr('src','contacts.php');
            }
    }});

    // Voice Mail Modal
    $('#vmailcontainer').on('show.bs.modal', function () {
        var playpos = currentVmailbox;
        getVmail(playpos);

        $("#tabnav .tab").droppable({
            hoverClass: 'tabhover',
            drop: function(event, ui) {
                debug(ui.draggable[0].id + ' dropped on ' + $(this).attr('id'));
                partesElement = ui.draggable[0].id.split("_");
                partesDest = $(this).attr('id').split("_");
                if (partesElement[1] != partesDest[1]) {
                    debug("Muevo mensaje " + partesElement[2] + " a carpeta " + partesDest[1]);
                    var mennum = '' + partesElement[2];
                    var originfolder = partesElement[1];
                    var destinationfolder = partesDest[1];
                    moveVoicemail(mennum, originfolder, destinationfolder);
                }
            }
        });

        $("#vmail_trash").droppable({
            hoverClass: 'trashfullicon',
            drop: function(event, ui) {
                debug(ui.draggable[0].id + ' dropped on ' + $(this).attr('id'));
                partesElement = ui.draggable[0].id.split("_");
                partesDest = $(this).attr('id').split("_");
                if (partesElement[1] != partesDest[1]) {
                    debug("Muevo mensaje " + partesElement[2] + " a carpeta " + partesDest[1]);
                    var mennum = '' + partesElement[2];
                    var originfolder = partesElement[1];
                    moveVoicemail(mennum, originfolder, "");
                }
            }
        });

    });

    // Registration dialog handlers
    $('#registrationaccept').on('click', function (e) {
        $('#registerdialog').modal('hide');
        sendreg();
    });

    $("#registrationcancel").click(function(event) {
        $('#registerdialog').modal('hide');
    });

    // Preference dialog handlers
    $('#prefbuttonaccept').on('click', function (e) {
        $('#preferencePane').modal('hide');
    });

    $('#preferencePane').on('show.bs.modal', function (e) {
        getPreferences();
    });

    $('#preferencePane').on('hidden.bs.modal', function (e) {
        savePreferences();
    });

    // Login dialog handlers 

    $(document).on('click','#logindialogaccept',function(e) { 
        if($('#myextension').val()!='') {
            $('#logindialog').modal('hide');
        } else {
            $('#myextension').focus();
        }
    });

    $('#logindialog').on('shown.bs.modal', function (e) {
        $('#loader').hide();
        $('#head').hide();
        $('#allbuttons').hide();
        $('#myextension').focus();
        fopexit = 1;
        fillextension = myextension;
        if(myextension!='' && entered_extension!='') { 
            if(entered_extension != myextension) {
                fillextension = entered_extension;
            } else {
                fillextension = myextension;
            }
            $('#myextension').val(fillextension);
            $('#securitycode').focus(); 
        } else {
            $('#myextension').focus();
        }
    });

    $('#logindialog').on('hidden.bs.modal', function (e) {
        secret = $('#securitycode').val();
        myextension = $('#myextension').val();

        entered_secret = $('#securitycode').val();
        entered_extension = $('#myextension').val();

        fopexit = 0;
        init();
        $('#loader').show();
        if(conectado==1) { sends_auth(); }
    });

    // Grid Stack Initialization
    $(function () {
        var options = {
            cellHeight: 40,
            verticalMargin: 10,
            alwaysShowResizeHandle: false,
            animate: true,
            draggable: {
                handle: '.handle'
            }
        };
        $('.grid-stack').gridstack(options);
    });

    $('.grid-stack').on('change', function (e, items) {
        // this change events propagates to all children, including input boxes
        debug('change on grid stack class');
        debug(e); 
        debug(e.target.id);
        if(e.target.id=='') {
            // only serialize if item has no id, as grid items have no id
            serialize_widget_map(items);
        }
    });

    // Cambiamos textos a ventana de login, no hacemos full setlang todavia
    $('#extenlabel').html(lang.exten);
    $('#secretlabel').html(lang.password);
    $('#enterseccode').html(lang.enter_sec_code);
    $('.preferencestitle').html(lang.preferences);
    $('.contactstitle').html(lang.contacts);
    $('.recordingstitle').html(lang.recordings);
    $('.chattitle').html(lang.chat);
    $('.cdrhistorytitle').html(lang.cdrrecords);
    $('.chathistorytitle').html(lang.chathistory);
    $('.logouttitle').html(lang.logout);
    $('.butAccept').html(lang.accept);
    $('.butReset').html(lang.reset);
    $('.butCancel').html(lang.cancel);
    $('#descriptiveMessage').html(lang.connecting_server + ": " + attempt);
    $('#loadermessage').html(lang.one_moment);

    if ($('#btnSendSMS').length > 0) {
        $('#btnSendSMS').html(lang.send_sms);
    }

    $('#container').show();
    $('#head').hide();
    $('#allbuttons').hide();
    $('#fatalerror').hide();
    $('#flashconnector').show();

    // Hace inselectables los botones 
    if (enableDragTransfer === true) {
        $('.noselect').on('selectstart dragstart', function(evt) {
            evt.preventDefault();
            return false;
        });
    }

   $('audio').each(function() {
       var name = $(this).attr('id');
       if(name != 'audioblock') {
           sonido[name] = new MediaElement(name, { success: function(media) {}});
       }
   });

    $("#filtertext").keyup(function(event) {
        if (event.keyCode == 27) {
            $('#filtertext').val('');
            $('#dialtext').val('');
            $('#dialtext').typeahead('val','');
            filter_list();
            $('#filtertext').blur();
            $('#dialtext').blur();
        } else {
            filter_list();
        }
    });

    $("#dialtext").keyup(function(event) {
        if (event.keyCode == 27) {
            $('#dialtext').val('');
            $('#dialtext').typeahead('val','');
            $('#dialtext').blur();
        } else if (event.keyCode == 13) {
            if ($('#dialtext').val().indexOf("http") === 0) {
                window.open($('#dialtext').val(), "_blank");
                $('#dialtext').val('');
                $('#dialtext').typeahead('val','');
            } else {
                if ($('#dialtext').val() !== '') {
                    dial($('#dialtext').val());
                    window.setTimeout(function() {
                        $("#dialtext").val('');
                        $('#dialtext').typeahead('val','');
                    }, 2000);
                }
            }
        }
    });

    $("#regcode").keyup(function(event) {
        if (event.keyCode == 13) {
            sendreg();
        }
    });

    $("#regname").keyup(function(event) {
        if (event.keyCode == 13) {
            sendreg();
        }
    });

    $("#myextension").keyup(function(event) {
        if (event.keyCode == 13) {
            $('#secretlabel').focus();
        }
    });

    $("#securitycode").keyup(function(event) {
        if (event.keyCode == 13) {
            $('#logindialog').modal('hide');
        }
    });

    // add language Options to UI taken from prsence.js array
    for (var item in availLang) {
        itemPrint = availLang[item];
        $('#prefDisplayLanguage').append($('<option>', {
            value: item,
            text: itemPrint
        }).attr({'data-content':'<i class="flag flag-'+item+'"></i> '+itemPrint}));
    }

    // Sms countound for input box
    $('#smsMsg').on('input', updateCountdown)

    // event handler for presence
    $('#presence').on('change', setState)

    // event handler for dialpad
    $("a.sphoneDtmfButton").click(function(event) {
        event.preventDefault();
        sendDtmf($(this).text(),1);
    });

    $("a.sphoneSendButton").click(function(event) {
        event.preventDefault();
        $(function() {
            var e = $.Event('keyup');
            e.keyCode = 13; 
            $('#dialtext').trigger(e);
        });
    });

    // sms form submission handler
    $("#smsSend").submit(function(event) {
        event.preventDefault();
        formsms();
    });

    // Preference form submit handler
    $("#preferences").submit(function(event) {
        event.preventDefault();
    });

    var autocompleteDialSource = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        url: 'vphonebook.php?term=%QUERY',
        wildcard: '%QUERY'
      }
    });

    autocompleteDialSource.initialize();

    $("#dialtext").typeahead({
      minLength: 3,
      highlight: true
    },
    {
      name: 'results',
      displayKey: 'value',
      source: autocompleteDialSource.ttAdapter(),
      limit: 100,
      templates: {
        empty: [
          '<div class="container">',
           lang.no_results,
          '</div>'
        ].join('\n'),
        suggestion: function(data) { return '<div><strong>' + data.value + '</strong></div>'; }
      }
    });


    // Autocomplete para el input dialtext
    $("#dialtextx").autocomplete({
        source: "vphonebook.php",
        minLength: 3,
        messages: {
            noResults: '',
            results: function() {}
        },
        focus: function(event, ui) {
            $("#dialtext").val(ui.item.value);
            return false;
        },
        select: function(event, ui) {
            $("#dialtext").val(ui.item.value);
            return false;
        },
        open: function() {
            //hideDialpad();
            var elem = $(this).autocomplete('widget');
            elem.css('top', (parseFloat(elem.css('top')) + 7) + 'px');
            elem.css('left', (parseFloat(elem.css('left')) - 7) + 'px');
            elem.css('width', (parseFloat(elem.css('width')) + 10) + 'px');
        }
    });

    // load plugins
    if (typeof loadPlugin != 'undefined') {
        for (i = 0; i < loadPlugin.length; i++) {
            jQuery.getScript(loadPlugin[i], function() {
                plugins[this.url.split('/').pop().split('.').shift()].init();
            });
        }
    }

    // Consulta fop2-variables para sacar puerto y si usa TLS o no
    jQuery.ajaxSetup({async: false});
    jQuery.get('fop2-variables' + context.toUpperCase() + '.txt', function(data) {
        var queryObj = toObject(data);
        for (var i in queryObj) {
            if (i.indexOf("port") === 0) {
                port = queryObj[i];
                var context_upper = context.toUpperCase();
                debug("Will use port " + port + " as read from fop2-variables" + context_upper + ".txt");
            } else if (i.indexOf("tlscert") === 0) {
                tlscert = queryObj[i];
                debug("TLS Cert = " + tlscert);
                if(isSecure() && tlscert==0) {
                    if(getFirefoxVersion()>=11) {
                        debug("Using https, no TLSCert configured in server and Firefox!, reverting to flash xmlsockets");
                        disableWebSocket=true;
                    } else {
                        debug("Using https but no TLSCert configured in server, reverting to ws");
                        wsproto="ws://";
                    }
                }
            }
        }
        debug('antes de preinit ok fop2variables');
        pre_init();
        conectado = 0;
    }).error(function() {

        // try to read variables file in uplaods dir
        jQuery.get('uploads/fop2-variables' + context.toUpperCase() + '.txt', function(data) {
            var queryObj = toObject(data);
            for (var i in queryObj) {
                if (i.indexOf("port") === 0) {
                    port = queryObj[i];
                    var context_upper = context.toUpperCase();
                    debug("Will use port " + port + " as read from uploads/fop2-variables" + context_upper + ".txt");
                } else if (i.indexOf("tlscert") === 0) {
                    tlscert = queryObj[i];
                    debug("TLS Cert = " + tlscert);
                    if(isSecure() && tlscert==0) {
                        if(getFirefoxVersion()>=11) {
                            debug("Using https, no TLSCert configured in server and Firefox!, reverting to flash xmlsockets");
                            disableWebSocket=true;
                        } else {
                            debug("Using https but no TLSCert configured in server, reverting to ws");
                            wsproto="ws://";
                        }
                    }
                }
            }
            debug('antes de preinit ok fop2variables');
            pre_init();
            conectado = 0;
        }).error(function() {
    
            port = 4445;
            tlscert = 0;
            conectado = 0;
            debug('fail fop2-variables, default to port 4445 wit no TLS');
            debug('antes de preinit fail fop2variables');
            pre_init();

        });;
 

    });;
    jQuery.ajaxSetup({async: true});

    $('#preferencePane input[type=checkbox]').each(function() {
        $(this).bootstrapSwitch({'size':'small','offColor':'warning'});
    });

    $('#head').bootstrapDropdownOnHover();

    $('li.dropdown.dialpad-dropdown a').on('click', function (event) {
        $(this).parent().addClass("open");
    });

    $('body').on('click', function (e) {
        if (!$('li.dropdown.dialpad-dropdown').is(e.target) && $('li.dropdown.dialpad-dropdown').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
            $('li.dropdown.dialpad-dropdown').removeClass('open');
        }
        if(e.target.id!='contactsmenu') {
            $('#slider').slideReveal("hide");
        }
    });


});

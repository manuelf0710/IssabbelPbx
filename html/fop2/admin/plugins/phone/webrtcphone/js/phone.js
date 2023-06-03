var callduration=0;

function newSession(newSess) {

    newSess.displayName = newSess.remoteIdentity.displayName || newSess.remoteIdentity.uri.user;

    var status;

    if (newSess.direction === 'incoming') {
        status = parent.lang.incoming + " " + newSess.displayName;
        startRingTone();
        setOutput(newSess.displayName);
        $('#autoansbtn').hide();
    } else {
        status = parent.lang.trying + " " + newSess.displayName;
    }

    setCallState(status);

    $('#backspace').hide();

    // EVENT CALLBACKS
    newSess.on('progress', function (e) {
        if (e.reason_phrase === 'Trying') {
            setCallState(parent.lang.calling);
            ringing.play();
            pendingCall = true;
        }
    });

    newSess.on('accepted', function (e) {
        attachMediaToSession(newSess);
        stopRingTone();
        ringing.pause();
        setCallState(parent.lang.answered);
        showControls();
        activeCall = true;
        callduration=0;
    });

    newSess.on('hold', function (e) {
        isHold = true;
        activeCall = false;
        setCallState('Hold');
    });

    newSess.on('unhold', function (e) {
        isHold = false;
        activeCall = true;
        setCallState('UnHold');
    });

    newSess.on('muted', function (e) {
        isMuted = true;
        setCallState("Muted");
    });

    newSess.on('unmuted', function (e) {
        isMuted = false;
        setCallState(parent.lang.answered);
    });


    newSess.on('canceled', function (e) {
        stopRingTone();
        ringing.pause();
        setCallState("Canceled");
        if (this.direction === 'outgoing') {
            activeCall = false;
            pendingCall = false;
            newSess = null;

        }
    });

    newSess.on('terminated', function (e) {

        stopRingTone();
        ringing.pause();
        $('#callcontrols').hide();
        $('#call').show();
        $('#autoansbtn').show();
        $('#dialpadicon').hide();

        try {
            if(e.status_code=='486' || e.status_code=='503') {
                busy.play();
                setTimeout(function() { busy.pause(); }, 3000);
            }
        } catch (e) { }

        setState("");
        activeCall = false;
        pendingCall = false;
        newSess = null;
        inviteSession = null;
        setCallState(parent.lang.call_ended);
        setOutput('');
        $('#btnmute').html(parent.lang.mute);
        $('#btnhold').html(parent.lang.hold);
        $('#contact').attr('src','');
        $('#contactimage').hide();
        $('#dialpadicon').hide();
        $('#phonedialpad').show();
        toggle_backspace();

    });

    newSess.on('failed', function (e) {
        stopRingTone();
        setCallState('Call Ended');
    });

    newSess.on('rejected', function (e) {
        stopRingTone();
        setCallState('Rejected');
        activeCall = false;
        pendingCall = false;

        newSess = null;
    });

}

function toggleMute(session,mute) {

    var pc = session.sessionDescriptionHandler.peerConnection;

    if (pc.getSenders) {
        pc.getSenders().forEach(function(sender) {
            if (sender.track) {
                sender.track.enabled = !mute;
            }
        });
    } else {
        pc.getLocalStreams().forEach(function(stream) {
            stream.getAudioTracks().forEach(function(track) {
                track.enabled = !mute;
            });
            stream.getVideoTracks().forEach(function(track) {
                track.enabled = !mute;
            });
        });
    }
};

function attachMediaToSession(session) {

    var pc = session.sessionDescriptionHandler.peerConnection;

    if (pc.getReceivers) {
        Stream = new window.MediaStream();
        pc.getReceivers().forEach(function (receiver) {
            var track = receiver.track;
            if (track) {
                Stream.addTrack(track);
            }
        });
    } else {
        Stream = pc.getRemoteStreams()[0];
    }

    var domElement = document.getElementById('voice');
    domElement.srcObject = Stream;
    domElement.play();
}

function answer() {
    console.log("PHONE accepting inviteSession");
    inviteSession.accept();
    Session = inviteSession;
    //$('#call').prop('disabled','disabled'); 
}


function dial(number) {

    if(!activeCall) {
        parent.plugins['phone'].getImage(number);
        $('#call').hide();
        $('#autoansbtn').hide();

        s = SIPPhone.invite(number);
        s.direction = 'outgoing';
        newSession(s);
        Session = s;
    }
}

function showControls() {
    $('#callcontrols').show();
    $('#call').hide();
    $('#autoansbtn').hide();
}

function clicknum(num) {

    // dialpad dtmf click or keypress

    if(SIPPhone.isRegistered()===false) {
        return;
    }

    if (activeCall) {
        Session.dtmf(num.trim());
    } else {
        if(pendingCall) { 
            // ignore dtmf if call in progress
            return; 
        }
        $("#output").append('<span>' + num.trim() + '</span>');
        toggle_backspace();
    }

    if(playDtmf==1) {
        el = document.getElementById('dtmf_'+num.trim());
        el.play();
    }
}

function extractDomain(url) {
    var domain;
    //find & remove protocol (http, ftp, etc.) and get domain
    if (url.indexOf("://") > -1) {
        domain = url.split('/')[2];
    } else {
        domain = url.split('/')[0];
    }

    //find & remove port number
    domain = domain.split(':')[0];

    return domain;
}

function startRingTone() {

    if(typeof(parent.document.phoneiframe)=='object') {
        // if contained inside fop2, disable
        return;
    }

    try {
        bell.play();
    } catch (e) {
    }
}

function stopRingTone() {

    if(typeof(parent.document.phoneiframe)=='object') {
        // if contained inside fop2, disable
        return;
    }

    try {
        bell.pause();
    } catch (e) {
    }
}

function setState(newState) {
    try {
        state.innerHTML = newState.toString();
    } catch (e) {
    }
}

function setCallState(newStatus) {
    $('#callState').html(newStatus);
}

function setOutput(text) {
    if(text=='') { $('#callinfo').text(''); }
    $('#output').text(text);
}


function hold() {
    if (Session) {
        Session.hold();
    }
}

function unhold() {
    if (Session) {
        Session.unhold();
    }
}


function mute() {
    if (Session) {
        Session.mute();
    }
}

function unmute() {
    if (Session) {
        Session.unmute();
    }
}

function hangup() {
    Session.terminate();
    $('#callcontrols').hide();
    $('#call').show();
    $('#autoansbtn').show();
    $('#dialpadicon').hide();
}

function mute_unmute() {
    if (activeCall) {
        if(!isMuted) {
            isMuted=true;
            toggleMute(Session,true);
            $('#btnmute').html(parent.lang.unmute);
        } else {
            toggleMute(Session,false);
            isMuted=false;
            $('#btnmute').html(parent.lang.mute);
        }
    }
}

function dotransfer() {
    if (activeCall) {
        if (isHold) {
            unhold();
            isHold=false;
        }
        $('#contactimage').hide();
        $('#phonedialpad').show();
        var code = parent.pluginconfig.phone.transfer_code[''];
        Session.dtmf(code);
    } else {  console.log('cannot transfer as we do not have an active call'); }
}

function hold_unhold() {
    if (activeCall) {
        if (!isHold) {
            hold();
            isHold=true;
            $('#btnhold').html(parent.lang.unhold);
        } else {
            unhold();
            isHold=false;
            $('#btnhold').html(parent.lang.hold);
        }
    } 
}

function updateTimer() {
    if(activeCall) {
        if($('#callinfo').text()=='') {
            $('#callinfo').text($('#output').text());
        }
        ++callduration;
        seconds = pad(callduration % 60);
        minutes = pad(parseInt(callduration / 60));
        final_output = minutes+":"+seconds;
        $('#output').text(final_output);
    }
}

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}

function process_key(event) {

    var type      = parent.document.activeElement.tagName;
    if(type=='INPUT' || type=='TEXTAREA') { return; }

    if(SIPPhone.isRegistered()===false) {
        return;
    }

    try {
        var type      = parent.document.scripterframe.document.activeElement.tagName;
        if(type=='INPUT') { return; }
    } catch(e) {}

    if ( event.which == 13 ) {
        event.preventDefault();
        output = $('#output').text();
        if(output!='') {
             dial(output);
             return;
        }
    }

    if(event.which >= 48 && event.which <= 57) {
       digit = event.which-48;
       clicknum(digit+'');
    } else if (event.which==8) {
        $('#output span:last-child').remove();
    } else if (event.which==106) {
        clicknum('*');
    } else if (event.which==187) {
        clicknum('#');
    } else if (event.which==27) {
        $('#output').html('');
    }

    if(!activeCall) {
        toggle_backspace();
    }
    //console.log(event.which);
}

function toggle_backspace() {

    if($('#output').text()=='') {
        $('#backspace').hide();
    } else {
        $('#backspace').show();
    }
}

function setText() {

    if($('#btnmute').data('value')=='') {
        $('#btnmute').data('value','mute');
    }

    if($('#btnhold').data('value')=='') {
        $('#btnhold').data('value','hold');
    }

    $('#autoanswer').bootstrapToggle('destroy');
    $('#autoanswer').bootstrapToggle({
        on: parent.lang.yes,
        off: parent.lang.no
    });
    $('#autoanswertext').text(parent.lang.autoanswer);

    mutetext     = $('#btnmute').data('value');
    holdtext     = $('#btnhold').data('value');

    $('#btnmute').html(parent.lang[mutetext]);
    $('#btnhold').html(parent.lang[holdtext]);
    $('#btntransfer').html(parent.lang.transfer);

}

$(document).ready(function () {

    var t=setInterval(updateTimer,1000);

    autoans = getCookie('fop2phone_autoanswer');
    if(autoans=='true') {
        $('#autoanswer').bootstrapToggle('on')
    } else {
        $('#autoanswer').bootstrapToggle('off')
    }

    // handle keyboard for dialplad
    $( document ).keydown(function( event ) {
        process_key(event);
    });

    // handle keyboard fro parent window if phone is embeded inside iframe
    $( parent.document).on('keydown', function (event) {
        process_key(event);
    });

    $( parent.document.scripterframe).on('keydown', function (event) {
        process_key(event);
    });

    var phone = new SIP.UA(config);

    phone.on('connected', function (e) {
        setState(parent.lang.connected);
    });

    phone.on('disconnected', function (e) {
        setState(parent.lang.error_websocket);
    });

    phone.on('registrationFailed', function (e) {
        setState(parent.lang.error_credentials);
    });

    phone.on('unregistered', function (e) {
        setState(parent.lang.unregistered);
    });

    phone.on('registered', function (e) {
        setState(parent.lang.phoneready);

        // Get the userMedia and cache the stream
        //getUserMediaStream();
    });

    // click digit dialpad
    $(".digit").on('click', function() {
        var num = ($(this).clone().children().remove().end().text());
        clicknum(num);
    });

    // click backspace dialpad
    $('#backspace').on('click', function() {
        $('#output span:last-child').remove();
        toggle_backspace();
    });

    // click phone/call button in  dialpad
    $('#call').on('click',function() {
        console.log("PHONE click answer");
        if(!activeCall) {
            if(inviteSession !== null && typeof(inviteSession)!='undefined') {
                console.log("PHONE we have inviteSession set, try to answer");
                answer();
            } else {
                console.log("PHONE we do not have inviteSession set, try to originate");
                output = $('#output').text();
                if(output!='') {
                    dial(output);
                }
            }
        } else {
            console.log("PHONE ignore answer click as we have an active call");
        }
    });

    // click hangup button  dialpad
    $('#hang').on('click',function() {

        if(Session != null) {
            if(Session.status==12 || Session.status==2) {
                Session.terminate();
            } else if(Session.status==9) {
                try {
                    inviteSession.reject();
                } catch(e) { }
            }
        } else {
            try {
                inviteSession.reject();
            } catch(e) { }
        }
    });

    $('#btnmute').on('click',function() {
        mute_unmute();
    });

    $('#btnhold').on('click',function() {
        hold_unhold();
    });

    $('#btntransfer').on('click',function() {
        dotransfer();
    });

    $('#dialpadicon').on('click', function() {
        if($('#contactimage').is(':visible')) {
            $('#contactimage').hide();
            $('#phonedialpad').show();
        } else {
            $('#contactimage').show();
            $('#phonedialpad').hide();
        }
    });

    $('#autoanswer').change(function() {
        var check = document.getElementById('autoanswer').checked;
        setCookie('fop2phone_autoanswer',check);
    });

    phone.on('invite', function (incomingSession) {

        inviteSession = incomingSession;
        pendingCall = true;

        var s = incomingSession;
        if (activeCall) {
            s.reject();
            return;
        }
        s.direction = 'incoming';
        newSession(s);

        if(document.getElementById('autoanswer').checked) { 

            incomingSession.accept();
            Session = incomingSession;

        } else {
            if(autoansweronce==true) {
                incomingSession.accept();
                Session = incomingSession;
                autoansweronce=false;
            } else {
                //$('#call').prop('disabled',''); 
            }
        }

    });

    // export a global function for un-registering the phone
    window.unRegisterPhone = function () {
        if (phone.isRegistered()) {
            phone.unregister();
        }
    };

    window.SIPPhone = phone;

    var unRegisterPhoneEvent = function (e) {
        console.info("Unregistering phone with closing event");
        window.unRegisterPhone();
    };

    // register onbeforeunload event
    if (typeof window.onbeforeunload === "function") {
        var oldUnloadEvent = window.onbeforeunload;
        window.onbeforeunload = function (e) {
            unRegisterPhoneEvent();
            oldUnloadEvent(e);
        }
    } else {
        window.onbeforeunload = unRegisterPhoneEvent;
    }

    // register onclose event
    if (typeof window.onclose === "function") {
        var oldCloseEvent = window.onclose;
        window.onclose = function (e) {
            unRegisterPhoneEvent();
            oldCloseEvent(e);
        }
    } else {
        window.onclose = unRegisterPhoneEvent;
    }

    setText();
});

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/; SameSite=Lax";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

<?php
header('Content-type: text/html; charset=utf-8'); 

$conf         = parse_ini_file("../phone.ini",true);
$port         = isset($conf['ws_port'])?$conf['ws_port']:8089;
$remoteserver = isset($conf['ws_server'])?$conf['ws_server']:'';
$servername   = $_SERVER['SERVER_NAME'];

if (isset($_REQUEST["phone_login"])) {
    $phone_login = $_REQUEST["phone_login"];
} else {
    $phone_login = "";
}

if (isset($_REQUEST["phone_pass"])) {
    $phone_pass = $_REQUEST["phone_pass"];
} else {
    $phone_pass = "";
}

if (isset($_REQUEST["server"])) {
    $server = $_REQUEST["server"];
} else {
    $server = "";
}

if (isset($_REQUEST["options"])) {
    $options = $_REQUEST["options"];
} else {
    $options = "";
}

if($remoteserver<>'') { $server = $remoteserver; }

$options     = base64_decode($options);

if($phone_login=='' && $phone_pass=='' && $server=='') {
    $showhide='$("#loginform").show(); $("#phonecontainer").hide();';
} else {
    $showhide='$("#loginform").hide(); $("#phonecontainer").show(); playDtmf=1;';
}
?>
<html>
<head>
    <title>Issabel Phone</title>
    <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="css/phone.css">
    <script src="js/sip-0.12.0.min.js"></script>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-toggle.min.js"></script>
    <script src="js/phone.js?0.12.0"></script>
</head>
<body>
<audio preload="auto" id="bell" src="sounds/incoming.mp3" loop></audio>
<audio preload="auto" id="ringing" src="sounds/ringing.mp3" loop></audio>
<audio preload="auto" id="busy" src="sounds/busy.mp3" loop></audio>
<audio id="voice"></audio>
<audio preload="auto" id="dtmf_1" src="sounds/dtmf/1.wav"></audio>
<audio preload="auto" id="dtmf_2" src="sounds/dtmf/2.wav"></audio>
<audio preload="auto" id="dtmf_3" src="sounds/dtmf/3.wav"></audio>
<audio preload="auto" id="dtmf_4" src="sounds/dtmf/4.wav"></audio>
<audio preload="auto" id="dtmf_5" src="sounds/dtmf/5.wav"></audio>
<audio preload="auto" id="dtmf_6" src="sounds/dtmf/6.wav"></audio>
<audio preload="auto" id="dtmf_7" src="sounds/dtmf/7.wav"></audio>
<audio preload="auto" id="dtmf_8" src="sounds/dtmf/8.wav"></audio>
<audio preload="auto" id="dtmf_9" src="sounds/dtmf/9.wav"></audio>
<audio preload="auto" id="dtmf_0" src="sounds/dtmf/0.wav"></audio>
<audio preload="auto" id="dtmf_*" src="sounds/dtmf/s.wav"></audio>
<audio preload="auto" id="dtmf_#" src="sounds/dtmf/h.wav"></audio>

<div id='loginform' class='containerform' style='display:none;'>
<form method='post'>
  <div class="form-group">
    <label for="phone_login">Username</label>
    <input type="text" class="form-control" name="phone_login" id="phone_login" aria-describedby="phone_loginHelp"  placeholder="Enter your SIP extension/username">
    <small id="phone_loginHelp" class="form-text text-muted">Enter your SIP extension/username.</small>
  </div>
  <div class="form-group">
    <label for="phone_pass">Password</label>
    <input type="password" class="form-control" id="phone_pass" name="phone_pass" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="server">Server</label>
    <input type="text" class="form-control" id="server" name="server" placeholder="Server" value='<?php echo $servername;?>'>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<div id='wrap'>
<div class="containerd" id='phonecontainer' style='display:none;'>

  <div style='position:relative;'>
      <div id="output" class='output'></div><div id='callinfo'></div><div id='backspace' class='bck'><i class="fa fa-backspace bckback" aria-hidden="true"></i></div>
  </div>

  <div id='phonedialpad' class='noselect'>

  <div class="rowd">
    <div class="digit" id="one">1
      <div class="sub">&nbsp;</div>
    </div>
    <div class="digit" id="two">2
      <div class="sub">ABC</div>
    </div>
    <div class="digit" id="three">3
      <div class="sub">DEF</div>
    </div>
    <div style='clear:both;'></div>
  </div>
  <div class="rowd">
    <div class="digit" id="four">4
      <div class="sub">GHI</div>
    </div>
    <div class="digit" id="five">5
      <div class="sub">JKL</div>
    </div>
    <div class="digit">6
      <div class="sub">MNO</div>
    </div>
    <div style='clear:both;'></div>
  </div>
  <div class="rowd">
    <div class="digit">7
      <div class="sub">PQRS</div>
    </div>
    <div class="digit">8
      <div class="sub">TUV</div>
    </div>
    <div class="digit">9
      <div class="sub">WXYZ</div>
    </div>
    <div style='clear:both;'></div>
  </div>
  <div class="rowd">
    <div class="digit">*
      <div class="sub">&nbsp;</div>
    </div>
    <div class="digit">0
      <div class="sub">&nbsp;</div>
    </div>
    <div class="digit">#
      <div class="sub">&nbsp;</div>
    </div>
    <div style='clear:both;'></div>
  </div>

  </div>
  <div id='contactimage'><img id='contact' class='contact' src='images/emptyprofile.jpg'/></div>

  <div class="botrow">
    <div id="hang" class='botbtn btn'><i class="fa fa-phone-slash" aria-hidden="true"></i></div>
      <div id='autoansbtn'>
        <input type=checkbox id='autoanswer' data-toggle="toggle" data-onstyle='success' data-offstyle='danger' xdata-width='85' xdata-height='1' ><br/>
        <span id='autoanswertext'>Auto Answer</span>
      </div>
    <div id="call" class='botbtn btn'><i class="fa fa-phone" aria-hidden="true"></i></div>
    <div style='clear:both;'></div>
  </div>

  <div class="botrow" id='callcontrols'>
    <button id="btnmute" class='botbtntxt btn btn-primary' data-value=""></button>
    <button id="btnhold" class='botbtntxt btn btn-primary' data-value=""></button>
    <button id="btntransfer" class='botbtntxt btn btn-primary'></button>
    <div style='clear:both;'></div>
  </div>

  <div class="botrowauto">
  </div>
  <div id='dialpadicon'><img src='images/dialpad.png' style='width:20px;'></div>

  <div id="outputbottom" class='outputbot'>
    <p id="state"></p>
    <p id="callState"></p>
  </div>

</div>
</div>

<script type="text/javascript">

    var lang = {};

    var playDtmf=0;
    var autoansweronce=false;
    <?php echo "$showhide\n"; ?>
    var Session = {};
    var inviteSession;
    var Stream;
    var audioCtx;
    var bell       = document.getElementById('bell');
    var ringing    = document.getElementById('ringing');
    var busy       = document.getElementById('busy');
    var state      = document.getElementById('state');
    var ws_url     = "wss://<?php echo $server;?>:<?php echo $port;?>/ws";
    var Session    = null;
    var activeCall = false;
    var pendingCall = false;
    var isMuted    = false;
    var isHold     = false;
    var options    = <?php echo json_encode($options) ?>;

    options = options.split("--");
    for (i in options) {
        if (options[i].search("WEBSOCKETURL") === 0) {
            ws_url = options[i].split("WEBSOCKETURL")[1];
        }
    }

    if (ws_url.length < 5) {
        $('#state').html("Got wrong web socket url. Please check your settings");
    } else {
        $('#state').html(null);
    }
    
    var phoneLogin = <?php echo json_encode($phone_login) ?>;
    if (!phoneLogin) {
        $('#state').html("Phone login is not provided. Please check your settings");
    } else {
        $('#state').html(null);
    }
    
    var config = {
        password: <?php echo json_encode($phone_pass) ?>,
        authorizationUser: phoneLogin,
        displayName: phoneLogin,
        uri: 'sip:' + phoneLogin + '@' + extractDomain(ws_url),
        transportOptions: {
            wsServers: [ws_url],
            traceSip: false,
            maxReconnectionAttempts: 30,
            reconnectionTimeout: 5
        },
        hackWssInTransport: true,
        registerExpires: 30,
        hackIpInContact: true,
        log: {
            level: 2
        },
        sessionDescriptionHandlerFactoryOptions: {
            constraints: {
                audio: true,
                video: false
            },
            peerConnectionOptions: {
                rtcConfiguration: {"rtcpMuxPolicy":"negotiate"},
                iceCheckingTimeout: 500
            },
        }
    };

    var browserUa = navigator.userAgent.toLowerCase();
    var isSafari = false;
    var isFirefox = false;
    if (browserUa.indexOf('safari') > -1 && browserUa.indexOf('chrome') < 0) {
        isSafari = true;
    } else if (browserUa.indexOf('firefox') > -1 && browserUa.indexOf('chrome') < 0) {
        isFirefox = true;
    }
    if (isSafari) {
        config.sessionDescriptionHandlerFactoryOptions.modifiers = [SIP.Web.Modifiers.stripG722];
    }

    if (isFirefox) {
        config.sessionDescriptionHandlerFactoryOptions.alwaysAcquireMediaFirst = true;
        config.sessionDescriptionHandlerFactoryOptions.modifiers = [SIP.Web.Modifiers.addMidLines];
    }
    $('#callcontrols').hide();
</script>

</body>
</html>

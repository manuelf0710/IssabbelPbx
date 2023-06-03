$Client_Pre_Command_Handler{'phone'}{'sipcredentials'} = sub {
    my @allreturn = ();
    my $origen   = shift;
    my $destino  = shift;
    my $contexto = shift;
    my $socket   = shift;
    my @elemento;
    my $ufilter;

    my $mychannel    = main::get_btn_config( "$contexto", $origen, 'MAINCHANNEL');
    my $sip_user     = main::get_btn_config( "$contexto", $origen, 'SIP_USERNAME');
    my $sip_password = main::get_btn_config( "$contexto", $origen, 'SIP_PASSWORD');

    my $returnjson64 = FOP2::utils::encode_base64($sip_user."^".$sip_password);

    $return  = "Action: UserEvent\r\n";
    $return .= "UserEvent: SIPCredentials\r\n";
    $return .= "Channel: $mychannel-fakesession\r\n";
    $return .= "Family: SIPCredentials\r\n";
    $return .= "Value: $returnjson64\r\n";
    $return .= "\r\n";
    push @allreturn, $return;


    return @allreturn;
}

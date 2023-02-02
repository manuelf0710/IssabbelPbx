CREATE TABLE acl_action (description varchar(200), id int(11) PRIMARY KEY, name varchar(10));
INSERT INTO acl_action VALUES('Access the resource',1,'access');
INSERT INTO acl_action VALUES('View the resource',2,'view');
INSERT INTO acl_action VALUES('Create into resource',3,'create');
INSERT INTO acl_action VALUES('Delete in resource',4,'delete');
INSERT INTO acl_action VALUES('Update into resource',5,'update');
CREATE TABLE acl_group (description TEXT, id int(11) PRIMARY KEY, name varchar(200));
INSERT INTO acl_group VALUES('total access',1,'administrator');
INSERT INTO acl_group VALUES('Supervisor CCenter',2,'Supervisor CCenter');
INSERT INTO acl_group VALUES('Agente CCenter',3,'Agente CCenter');
INSERT INTO acl_group VALUES('Admin CCenter',4,'Admin CCenter');
CREATE TABLE acl_membership (
  id int(11)  NOT NULL   PRIMARY KEY,
  id_user int(11)  NOT NULL default '0',
  id_group int(11)   NOT NULL default '0'
);
INSERT INTO acl_membership VALUES(1,1,1);
INSERT INTO acl_membership VALUES(2,2,4);
CREATE TABLE acl_user (id int(11) PRIMARY KEY, name varchar(50), description varchar(180), md5_password varchar(50), extension varchar(20));
INSERT INTO acl_user VALUES(1,'admin',NULL,'ce4cd67fbe4af5be44d4d7b2039ca34b',NULL);
INSERT INTO acl_user VALUES(2,'ADMINCC','ADMINCC','5dda848333ebbe6f5802ab3d5eb9266b',NULL);
CREATE TABLE acl_user_permission (id int(11) PRIMARY KEY, id_action int(11), id_user int(11), id_resource int(11));
CREATE TABLE acl_resource (id int(11) PRIMARY KEY, name varchar(50), description varchar(180));
INSERT INTO acl_resource VALUES(2,'usermgr','Users');
INSERT INTO acl_resource VALUES(3,'grouplist','Groups');
INSERT INTO acl_resource VALUES(4,'userlist','Users');
INSERT INTO acl_resource VALUES(5,'group_permission','Group Permission');
INSERT INTO acl_resource VALUES(16,'preferences','Preferences');
INSERT INTO acl_resource VALUES(17,'language','Language');
INSERT INTO acl_resource VALUES(18,'themes_system','Themes');
INSERT INTO acl_resource VALUES(19,'calendar','Calendar');
INSERT INTO acl_resource VALUES(20,'address_book','Address Book');
INSERT INTO acl_resource VALUES(21,'email_domains','Domains');
INSERT INTO acl_resource VALUES(22,'email_accounts','Accounts');
INSERT INTO acl_resource VALUES(23,'email_relay','Relay');
INSERT INTO acl_resource VALUES(24,'antispam','Antispam');
INSERT INTO acl_resource VALUES(25,'remote_smtp','Remote SMTP');
INSERT INTO acl_resource VALUES(26,'email_list','Email list');
INSERT INTO acl_resource VALUES(27,'email_stats','Email stats');
INSERT INTO acl_resource VALUES(28,'vacations','Vacations');
INSERT INTO acl_resource VALUES(29,'webmail','Webmail');
INSERT INTO acl_resource VALUES(30,'addons_availables','Addons');
INSERT INTO acl_resource VALUES(31,'virtual_fax','Virtual Fax');
INSERT INTO acl_resource VALUES(32,'faxlist','Virtual Fax List');
INSERT INTO acl_resource VALUES(33,'faxnew','New Virtual Fax');
INSERT INTO acl_resource VALUES(34,'sendfax','Send Fax');
INSERT INTO acl_resource VALUES(35,'faxqueue','Fax Queue');
INSERT INTO acl_resource VALUES(36,'faxmaster','Fax Master');
INSERT INTO acl_resource VALUES(37,'faxclients','Fax Clients');
INSERT INTO acl_resource VALUES(38,'faxviewer','Fax Viewer');
INSERT INTO acl_resource VALUES(39,'email_template','Email Template');
INSERT INTO acl_resource VALUES(40,'sysdash','Dashboard');
INSERT INTO acl_resource VALUES(41,'dashboard','Dashboard');
INSERT INTO acl_resource VALUES(42,'applet_admin','Dashboard Applet Admin');
INSERT INTO acl_resource VALUES(43,'network','Network');
INSERT INTO acl_resource VALUES(44,'network_parameters','Network Parameters');
INSERT INTO acl_resource VALUES(45,'dhcp_server','DHCP Server');
INSERT INTO acl_resource VALUES(46,'dhcp_clientlist','DHCP Client List');
INSERT INTO acl_resource VALUES(47,'dhcp_by_mac','Assign IP Address to Host');
INSERT INTO acl_resource VALUES(48,'ping','Ping & Tracepath');
INSERT INTO acl_resource VALUES(49,'shutdown','Shutdown');
INSERT INTO acl_resource VALUES(50,'hardware_detector','Hardware Detector');
INSERT INTO acl_resource VALUES(51,'updates','Updates');
INSERT INTO acl_resource VALUES(52,'packages','Packages');
INSERT INTO acl_resource VALUES(53,'repositories','Repositories');
INSERT INTO acl_resource VALUES(54,'backup_restore','Backup/Restore');
INSERT INTO acl_resource VALUES(55,'time_config','Date/Time');
INSERT INTO acl_resource VALUES(56,'currency','Currency');
INSERT INTO acl_resource VALUES(57,'myex_config','Settings');
INSERT INTO acl_resource VALUES(58,'pbxadmin','PBX Configuration');
INSERT INTO acl_resource VALUES(59,'control_panel','Operator Panel');
INSERT INTO acl_resource VALUES(60,'voicemail','Voicemail');
INSERT INTO acl_resource VALUES(61,'monitoring','Calls Recordings');
INSERT INTO acl_resource VALUES(62,'endpoints','Batch Configurations');
INSERT INTO acl_resource VALUES(63,'extensions_batch','Batch of Extensions');
INSERT INTO acl_resource VALUES(64,'conference','Conference');
INSERT INTO acl_resource VALUES(65,'tools','Tools');
INSERT INTO acl_resource VALUES(66,'asterisk_cli','Asterisk-Cli');
INSERT INTO acl_resource VALUES(67,'file_editor','Asterisk File Editor');
INSERT INTO acl_resource VALUES(68,'text_to_wav','Text to Wav');
INSERT INTO acl_resource VALUES(69,'festival','Festival');
INSERT INTO acl_resource VALUES(70,'recordings','Recordings');
INSERT INTO acl_resource VALUES(71,'sec_firewall','Firewall');
INSERT INTO acl_resource VALUES(72,'sec_rules','Firewall Rules');
INSERT INTO acl_resource VALUES(73,'sec_ports','Define Ports');
INSERT INTO acl_resource VALUES(74,'sec_portknock_if','Port Knocking Interfaces');
INSERT INTO acl_resource VALUES(75,'sec_portknock_users','Port Knocking Users');
INSERT INTO acl_resource VALUES(76,'fail2ban','Fail2Ban');
INSERT INTO acl_resource VALUES(77,'sec_fb_admin','Admin');
INSERT INTO acl_resource VALUES(78,'sec_fb_banned','Banned IPs');
INSERT INTO acl_resource VALUES(79,'sec_accessaudit','Audit');
INSERT INTO acl_resource VALUES(80,'sec_weak_keys','Weak Keys');
INSERT INTO acl_resource VALUES(81,'sec_advanced_settings','Advanced Settings');
INSERT INTO acl_resource VALUES(82,'sec_letsencrypt','HTTPS Certificate (Let''s Encrypt)');
INSERT INTO acl_resource VALUES(83,'addons_license','License Manager');
INSERT INTO acl_resource VALUES(84,'downloads','Downloads');
INSERT INTO acl_resource VALUES(85,'sphones','Softphones');
INSERT INTO acl_resource VALUES(86,'faxutils','Fax Utilities');
INSERT INTO acl_resource VALUES(87,'instantmessaging','Instant Messaging');
INSERT INTO acl_resource VALUES(88,'meet','Issabel Meet');
INSERT INTO acl_resource VALUES(89,'cdrreport','CDR Report');
INSERT INTO acl_resource VALUES(90,'channelusage','Channels Usage');
INSERT INTO acl_resource VALUES(91,'billing','Billing');
INSERT INTO acl_resource VALUES(92,'billing_rates','Rates');
INSERT INTO acl_resource VALUES(93,'billing_report','Billing Report');
INSERT INTO acl_resource VALUES(94,'dest_distribution','Destination Distribution');
INSERT INTO acl_resource VALUES(95,'billing_setup','Billing Setup');
INSERT INTO acl_resource VALUES(96,'asterisk_log','Asterisk Logs');
INSERT INTO acl_resource VALUES(97,'graphic_report','Graphic Report');
INSERT INTO acl_resource VALUES(98,'summary_by_extension','Summary');
INSERT INTO acl_resource VALUES(99,'missed_calls','Missed Calls');
INSERT INTO acl_resource VALUES(100,'webconsole','Web Console');
INSERT INTO acl_resource VALUES(101,'endpoint_configurator','Endpoint Configurator');
INSERT INTO acl_resource VALUES(102,'agent_console','Agent Console');
INSERT INTO acl_resource VALUES(103,'outgoing_calls','Outgoing Calls');
INSERT INTO acl_resource VALUES(104,'campaign_out','Campaigns');
INSERT INTO acl_resource VALUES(105,'dont_call_list','Do not Call List');
INSERT INTO acl_resource VALUES(106,'external_url','External URLs');
INSERT INTO acl_resource VALUES(107,'ingoing_calls','Ingoing Calls');
INSERT INTO acl_resource VALUES(108,'queues','Queues');
INSERT INTO acl_resource VALUES(109,'client','Clients');
INSERT INTO acl_resource VALUES(110,'campaign_in','Ingoing Campaigns');
INSERT INTO acl_resource VALUES(111,'agentoptions','Agent Options');
INSERT INTO acl_resource VALUES(112,'agents','Agents');
INSERT INTO acl_resource VALUES(113,'eccp_users','ECCP Users');
INSERT INTO acl_resource VALUES(114,'cb_extensions','Callback Extensions');
INSERT INTO acl_resource VALUES(115,'break_administrator','Breaks');
INSERT INTO acl_resource VALUES(116,'forms','Forms');
INSERT INTO acl_resource VALUES(117,'form_designer','Form Designer');
INSERT INTO acl_resource VALUES(118,'form_list','Form Preview');
INSERT INTO acl_resource VALUES(119,'reports_ingoing_call','Reports');
INSERT INTO acl_resource VALUES(120,'reports_break','Reports Break');
INSERT INTO acl_resource VALUES(121,'calls_detail','Calls Detail');
INSERT INTO acl_resource VALUES(122,'calls_per_hour','Calls per hour');
INSERT INTO acl_resource VALUES(123,'calls_per_agent','Calls per Agent');
INSERT INTO acl_resource VALUES(124,'hold_time','Hold Time');
INSERT INTO acl_resource VALUES(125,'login_logout','Login Logout');
INSERT INTO acl_resource VALUES(126,'ingoings_calls_success','Ingoing Calls Success');
INSERT INTO acl_resource VALUES(127,'graphic_calls','Graphic Calls per hour');
INSERT INTO acl_resource VALUES(128,'rep_agent_information','Agent Information');
INSERT INTO acl_resource VALUES(129,'rep_agents_monitoring','Agents Monitoring');
INSERT INTO acl_resource VALUES(130,'rep_trunks_used_per_hour','Trunks used per hour');
INSERT INTO acl_resource VALUES(131,'rep_incoming_calls_monitoring','Incoming calls monitoring');
INSERT INTO acl_resource VALUES(132,'campaign_monitoring','Campaign monitoring');
INSERT INTO acl_resource VALUES(133,'callcenter_config','Configuration');
INSERT INTO acl_resource VALUES(134,'packet_capture','Packet Capture');
INSERT INTO acl_resource VALUES(135,'upnpc','uPnP Control');
INSERT INTO acl_resource VALUES(136,'theme_designer','Theme Designer');
INSERT INTO acl_resource VALUES(137,'sec_2fa','Two Factor Authentication');
INSERT INTO acl_resource VALUES(138,'configuracion_general','Configuración General');
INSERT INTO acl_resource VALUES(139,'reportes','Reportes');
INSERT INTO acl_resource VALUES(140,'logs','Logs');
INSERT INTO acl_resource VALUES(141,'auditorias','Auditorias');
INSERT INTO acl_resource VALUES(142,'configuracion_ivrecs','Configuración de IVR ECS');
INSERT INTO acl_resource VALUES(143,'configuracion_general_module','Conexiones a Bases de Datos');
CREATE TABLE acl_group_permission (id int(11) NOT NULL PRIMARY KEY,  id_action int(11) NOT NULL, id_group INTEGER NOT NULL, id_resource INTEGER NOT NULL);
INSERT INTO acl_group_permission VALUES(2,1,1,2);
INSERT INTO acl_group_permission VALUES(3,1,1,3);
INSERT INTO acl_group_permission VALUES(4,1,1,4);
INSERT INTO acl_group_permission VALUES(5,1,1,5);
INSERT INTO acl_group_permission VALUES(7,1,1,16);
INSERT INTO acl_group_permission VALUES(8,1,1,17);
INSERT INTO acl_group_permission VALUES(9,1,1,18);
INSERT INTO acl_group_permission VALUES(10,1,1,19);
INSERT INTO acl_group_permission VALUES(11,1,2,19);
INSERT INTO acl_group_permission VALUES(12,1,3,19);
INSERT INTO acl_group_permission VALUES(13,1,1,20);
INSERT INTO acl_group_permission VALUES(14,1,2,20);
INSERT INTO acl_group_permission VALUES(15,1,3,20);
INSERT INTO acl_group_permission VALUES(16,1,1,21);
INSERT INTO acl_group_permission VALUES(17,1,1,22);
INSERT INTO acl_group_permission VALUES(18,1,1,23);
INSERT INTO acl_group_permission VALUES(19,1,1,24);
INSERT INTO acl_group_permission VALUES(20,1,1,25);
INSERT INTO acl_group_permission VALUES(21,1,1,26);
INSERT INTO acl_group_permission VALUES(22,1,1,27);
INSERT INTO acl_group_permission VALUES(23,1,1,28);
INSERT INTO acl_group_permission VALUES(24,1,2,28);
INSERT INTO acl_group_permission VALUES(25,1,3,28);
INSERT INTO acl_group_permission VALUES(26,1,1,29);
INSERT INTO acl_group_permission VALUES(27,1,2,29);
INSERT INTO acl_group_permission VALUES(28,1,3,29);
INSERT INTO acl_group_permission VALUES(29,1,1,30);
INSERT INTO acl_group_permission VALUES(30,1,1,31);
INSERT INTO acl_group_permission VALUES(31,1,1,32);
INSERT INTO acl_group_permission VALUES(32,1,1,33);
INSERT INTO acl_group_permission VALUES(33,1,1,34);
INSERT INTO acl_group_permission VALUES(34,1,1,35);
INSERT INTO acl_group_permission VALUES(35,1,1,36);
INSERT INTO acl_group_permission VALUES(36,1,1,37);
INSERT INTO acl_group_permission VALUES(37,1,1,38);
INSERT INTO acl_group_permission VALUES(38,1,1,39);
INSERT INTO acl_group_permission VALUES(39,1,1,40);
INSERT INTO acl_group_permission VALUES(40,1,2,40);
INSERT INTO acl_group_permission VALUES(41,1,3,40);
INSERT INTO acl_group_permission VALUES(42,1,1,41);
INSERT INTO acl_group_permission VALUES(43,1,2,41);
INSERT INTO acl_group_permission VALUES(44,1,3,41);
INSERT INTO acl_group_permission VALUES(45,1,1,42);
INSERT INTO acl_group_permission VALUES(46,1,2,42);
INSERT INTO acl_group_permission VALUES(47,1,3,42);
INSERT INTO acl_group_permission VALUES(48,1,1,43);
INSERT INTO acl_group_permission VALUES(49,1,1,44);
INSERT INTO acl_group_permission VALUES(50,1,1,45);
INSERT INTO acl_group_permission VALUES(51,1,1,46);
INSERT INTO acl_group_permission VALUES(52,1,1,47);
INSERT INTO acl_group_permission VALUES(53,1,1,48);
INSERT INTO acl_group_permission VALUES(54,1,1,49);
INSERT INTO acl_group_permission VALUES(55,1,1,50);
INSERT INTO acl_group_permission VALUES(56,1,1,51);
INSERT INTO acl_group_permission VALUES(57,1,1,52);
INSERT INTO acl_group_permission VALUES(58,1,1,53);
INSERT INTO acl_group_permission VALUES(59,1,1,54);
INSERT INTO acl_group_permission VALUES(60,1,1,55);
INSERT INTO acl_group_permission VALUES(61,1,1,56);
INSERT INTO acl_group_permission VALUES(62,1,1,57);
INSERT INTO acl_group_permission VALUES(63,1,2,57);
INSERT INTO acl_group_permission VALUES(64,1,3,57);
INSERT INTO acl_group_permission VALUES(65,1,1,58);
INSERT INTO acl_group_permission VALUES(66,1,1,59);
INSERT INTO acl_group_permission VALUES(67,1,2,59);
INSERT INTO acl_group_permission VALUES(68,1,1,60);
INSERT INTO acl_group_permission VALUES(69,1,2,60);
INSERT INTO acl_group_permission VALUES(70,1,3,60);
INSERT INTO acl_group_permission VALUES(71,1,1,61);
INSERT INTO acl_group_permission VALUES(72,1,2,61);
INSERT INTO acl_group_permission VALUES(73,1,3,61);
INSERT INTO acl_group_permission VALUES(74,1,1,62);
INSERT INTO acl_group_permission VALUES(75,1,1,63);
INSERT INTO acl_group_permission VALUES(76,1,1,64);
INSERT INTO acl_group_permission VALUES(77,1,1,65);
INSERT INTO acl_group_permission VALUES(78,1,1,66);
INSERT INTO acl_group_permission VALUES(79,1,1,67);
INSERT INTO acl_group_permission VALUES(80,1,1,68);
INSERT INTO acl_group_permission VALUES(81,1,1,69);
INSERT INTO acl_group_permission VALUES(82,1,1,70);
INSERT INTO acl_group_permission VALUES(83,1,2,70);
INSERT INTO acl_group_permission VALUES(84,1,3,70);
INSERT INTO acl_group_permission VALUES(85,1,1,71);
INSERT INTO acl_group_permission VALUES(86,1,1,72);
INSERT INTO acl_group_permission VALUES(87,1,1,73);
INSERT INTO acl_group_permission VALUES(88,1,1,74);
INSERT INTO acl_group_permission VALUES(89,1,1,75);
INSERT INTO acl_group_permission VALUES(90,1,1,76);
INSERT INTO acl_group_permission VALUES(91,1,1,77);
INSERT INTO acl_group_permission VALUES(92,1,1,78);
INSERT INTO acl_group_permission VALUES(93,1,1,79);
INSERT INTO acl_group_permission VALUES(94,1,1,80);
INSERT INTO acl_group_permission VALUES(95,1,1,81);
INSERT INTO acl_group_permission VALUES(96,1,1,82);
INSERT INTO acl_group_permission VALUES(97,1,1,83);
INSERT INTO acl_group_permission VALUES(98,1,1,84);
INSERT INTO acl_group_permission VALUES(99,1,1,85);
INSERT INTO acl_group_permission VALUES(100,1,1,86);
INSERT INTO acl_group_permission VALUES(101,1,1,87);
INSERT INTO acl_group_permission VALUES(102,1,1,88);
INSERT INTO acl_group_permission VALUES(103,1,2,88);
INSERT INTO acl_group_permission VALUES(104,1,3,88);
INSERT INTO acl_group_permission VALUES(105,1,1,89);
INSERT INTO acl_group_permission VALUES(106,1,2,89);
INSERT INTO acl_group_permission VALUES(107,1,1,90);
INSERT INTO acl_group_permission VALUES(108,1,2,90);
INSERT INTO acl_group_permission VALUES(109,1,1,91);
INSERT INTO acl_group_permission VALUES(110,1,1,92);
INSERT INTO acl_group_permission VALUES(111,1,1,93);
INSERT INTO acl_group_permission VALUES(112,1,2,93);
INSERT INTO acl_group_permission VALUES(113,1,1,94);
INSERT INTO acl_group_permission VALUES(114,1,2,94);
INSERT INTO acl_group_permission VALUES(115,1,1,95);
INSERT INTO acl_group_permission VALUES(116,1,2,95);
INSERT INTO acl_group_permission VALUES(117,1,1,96);
INSERT INTO acl_group_permission VALUES(118,1,1,97);
INSERT INTO acl_group_permission VALUES(119,1,1,98);
INSERT INTO acl_group_permission VALUES(120,1,1,99);
INSERT INTO acl_group_permission VALUES(121,1,1,100);
INSERT INTO acl_group_permission VALUES(122,1,1,101);
INSERT INTO acl_group_permission VALUES(123,1,1,102);
INSERT INTO acl_group_permission VALUES(124,1,1,103);
INSERT INTO acl_group_permission VALUES(125,1,1,104);
INSERT INTO acl_group_permission VALUES(126,1,1,105);
INSERT INTO acl_group_permission VALUES(127,1,1,106);
INSERT INTO acl_group_permission VALUES(128,1,1,107);
INSERT INTO acl_group_permission VALUES(129,1,1,108);
INSERT INTO acl_group_permission VALUES(130,1,1,109);
INSERT INTO acl_group_permission VALUES(131,1,1,110);
INSERT INTO acl_group_permission VALUES(132,1,1,111);
INSERT INTO acl_group_permission VALUES(133,1,1,112);
INSERT INTO acl_group_permission VALUES(134,1,1,113);
INSERT INTO acl_group_permission VALUES(135,1,1,114);
INSERT INTO acl_group_permission VALUES(136,1,1,115);
INSERT INTO acl_group_permission VALUES(137,1,1,116);
INSERT INTO acl_group_permission VALUES(138,1,1,117);
INSERT INTO acl_group_permission VALUES(139,1,1,118);
INSERT INTO acl_group_permission VALUES(140,1,1,119);
INSERT INTO acl_group_permission VALUES(141,1,1,120);
INSERT INTO acl_group_permission VALUES(142,1,1,121);
INSERT INTO acl_group_permission VALUES(143,1,1,122);
INSERT INTO acl_group_permission VALUES(144,1,1,123);
INSERT INTO acl_group_permission VALUES(145,1,1,124);
INSERT INTO acl_group_permission VALUES(146,1,1,125);
INSERT INTO acl_group_permission VALUES(147,1,1,126);
INSERT INTO acl_group_permission VALUES(148,1,1,127);
INSERT INTO acl_group_permission VALUES(149,1,1,128);
INSERT INTO acl_group_permission VALUES(150,1,1,129);
INSERT INTO acl_group_permission VALUES(151,1,1,130);
INSERT INTO acl_group_permission VALUES(152,1,1,131);
INSERT INTO acl_group_permission VALUES(153,1,1,132);
INSERT INTO acl_group_permission VALUES(154,1,1,133);
INSERT INTO acl_group_permission VALUES(155,1,1,134);
INSERT INTO acl_group_permission VALUES(156,1,1,135);
INSERT INTO acl_group_permission VALUES(157,1,1,136);
INSERT INTO acl_group_permission VALUES(158,1,1,137);
INSERT INTO acl_group_permission VALUES(159,1,1,141);
INSERT INTO acl_group_permission VALUES(160,1,1,138);
INSERT INTO acl_group_permission VALUES(161,1,1,142);
INSERT INTO acl_group_permission VALUES(162,1,1,140);
INSERT INTO acl_group_permission VALUES(163,1,1,139);
INSERT INTO acl_group_permission VALUES(164,1,4,141);
INSERT INTO acl_group_permission VALUES(165,1,4,138);
INSERT INTO acl_group_permission VALUES(166,1,4,142);
INSERT INTO acl_group_permission VALUES(167,1,4,140);
INSERT INTO acl_group_permission VALUES(168,1,4,139);
INSERT INTO acl_group_permission VALUES(169,1,4,30);
INSERT INTO acl_group_permission VALUES(170,1,4,83);
INSERT INTO acl_group_permission VALUES(171,1,4,20);
INSERT INTO acl_group_permission VALUES(172,1,4,102);
INSERT INTO acl_group_permission VALUES(173,1,4,111);
INSERT INTO acl_group_permission VALUES(174,1,4,112);
INSERT INTO acl_group_permission VALUES(175,1,4,24);
INSERT INTO acl_group_permission VALUES(176,1,4,42);
INSERT INTO acl_group_permission VALUES(177,1,4,66);
INSERT INTO acl_group_permission VALUES(178,1,4,96);
INSERT INTO acl_group_permission VALUES(179,1,4,54);
INSERT INTO acl_group_permission VALUES(180,1,4,91);
INSERT INTO acl_group_permission VALUES(181,1,4,92);
INSERT INTO acl_group_permission VALUES(182,1,4,93);
INSERT INTO acl_group_permission VALUES(183,1,4,95);
INSERT INTO acl_group_permission VALUES(184,1,4,115);
INSERT INTO acl_group_permission VALUES(185,1,4,19);
INSERT INTO acl_group_permission VALUES(186,1,4,133);
INSERT INTO acl_group_permission VALUES(187,1,4,121);
INSERT INTO acl_group_permission VALUES(188,1,4,123);
INSERT INTO acl_group_permission VALUES(189,1,4,122);
INSERT INTO acl_group_permission VALUES(190,1,4,110);
INSERT INTO acl_group_permission VALUES(191,1,4,132);
INSERT INTO acl_group_permission VALUES(192,1,4,104);
INSERT INTO acl_group_permission VALUES(193,1,4,114);
INSERT INTO acl_group_permission VALUES(194,1,4,89);
INSERT INTO acl_group_permission VALUES(195,1,4,90);
INSERT INTO acl_group_permission VALUES(196,1,4,109);
INSERT INTO acl_group_permission VALUES(197,1,4,64);
INSERT INTO acl_group_permission VALUES(198,1,4,59);
INSERT INTO acl_group_permission VALUES(199,1,4,56);
INSERT INTO acl_group_permission VALUES(200,1,4,41);
INSERT INTO acl_group_permission VALUES(201,1,4,94);
INSERT INTO acl_group_permission VALUES(202,1,4,47);
INSERT INTO acl_group_permission VALUES(203,1,4,46);
INSERT INTO acl_group_permission VALUES(204,1,4,45);
INSERT INTO acl_group_permission VALUES(205,1,4,105);
INSERT INTO acl_group_permission VALUES(206,1,4,84);
INSERT INTO acl_group_permission VALUES(207,1,4,113);
INSERT INTO acl_group_permission VALUES(208,1,4,22);
INSERT INTO acl_group_permission VALUES(209,1,4,21);
INSERT INTO acl_group_permission VALUES(210,1,4,26);
INSERT INTO acl_group_permission VALUES(211,1,4,23);
INSERT INTO acl_group_permission VALUES(212,1,4,27);
INSERT INTO acl_group_permission VALUES(213,1,4,39);
INSERT INTO acl_group_permission VALUES(214,1,4,101);
INSERT INTO acl_group_permission VALUES(215,1,4,62);
INSERT INTO acl_group_permission VALUES(216,1,4,63);
INSERT INTO acl_group_permission VALUES(217,1,4,106);
INSERT INTO acl_group_permission VALUES(218,1,4,76);
INSERT INTO acl_group_permission VALUES(219,1,4,37);
INSERT INTO acl_group_permission VALUES(220,1,4,32);
INSERT INTO acl_group_permission VALUES(221,1,4,36);
INSERT INTO acl_group_permission VALUES(222,1,4,33);
INSERT INTO acl_group_permission VALUES(223,1,4,35);
INSERT INTO acl_group_permission VALUES(224,1,4,86);
INSERT INTO acl_group_permission VALUES(225,1,4,38);
INSERT INTO acl_group_permission VALUES(226,1,4,69);
INSERT INTO acl_group_permission VALUES(227,1,4,67);
INSERT INTO acl_group_permission VALUES(228,1,4,117);
INSERT INTO acl_group_permission VALUES(229,1,4,118);
INSERT INTO acl_group_permission VALUES(230,1,4,116);
INSERT INTO acl_group_permission VALUES(231,1,4,127);
INSERT INTO acl_group_permission VALUES(232,1,4,97);
INSERT INTO acl_group_permission VALUES(233,1,4,5);
INSERT INTO acl_group_permission VALUES(234,1,4,3);
INSERT INTO acl_group_permission VALUES(235,1,4,50);
INSERT INTO acl_group_permission VALUES(236,1,4,124);
INSERT INTO acl_group_permission VALUES(237,1,4,107);
INSERT INTO acl_group_permission VALUES(238,1,4,126);
INSERT INTO acl_group_permission VALUES(239,1,4,87);
INSERT INTO acl_group_permission VALUES(240,1,4,17);
INSERT INTO acl_group_permission VALUES(241,1,4,125);
INSERT INTO acl_group_permission VALUES(242,1,4,88);
INSERT INTO acl_group_permission VALUES(243,1,4,99);
INSERT INTO acl_group_permission VALUES(244,1,4,61);
INSERT INTO acl_group_permission VALUES(245,1,4,57);
INSERT INTO acl_group_permission VALUES(246,1,4,43);
INSERT INTO acl_group_permission VALUES(247,1,4,44);
INSERT INTO acl_group_permission VALUES(248,1,4,103);
INSERT INTO acl_group_permission VALUES(249,1,4,52);
INSERT INTO acl_group_permission VALUES(250,1,4,134);
INSERT INTO acl_group_permission VALUES(251,1,4,58);
INSERT INTO acl_group_permission VALUES(252,1,4,48);
INSERT INTO acl_group_permission VALUES(253,1,4,16);
INSERT INTO acl_group_permission VALUES(254,1,4,108);
INSERT INTO acl_group_permission VALUES(255,1,4,70);
INSERT INTO acl_group_permission VALUES(256,1,4,25);
INSERT INTO acl_group_permission VALUES(257,1,4,128);
INSERT INTO acl_group_permission VALUES(258,1,4,129);
INSERT INTO acl_group_permission VALUES(259,1,4,131);
INSERT INTO acl_group_permission VALUES(260,1,4,130);
INSERT INTO acl_group_permission VALUES(261,1,4,120);
INSERT INTO acl_group_permission VALUES(262,1,4,119);
INSERT INTO acl_group_permission VALUES(263,1,4,53);
INSERT INTO acl_group_permission VALUES(264,1,4,137);
INSERT INTO acl_group_permission VALUES(265,1,4,79);
INSERT INTO acl_group_permission VALUES(266,1,4,81);
INSERT INTO acl_group_permission VALUES(267,1,4,77);
INSERT INTO acl_group_permission VALUES(268,1,4,78);
INSERT INTO acl_group_permission VALUES(269,1,4,71);
INSERT INTO acl_group_permission VALUES(270,1,4,82);
INSERT INTO acl_group_permission VALUES(271,1,4,74);
INSERT INTO acl_group_permission VALUES(272,1,4,75);
INSERT INTO acl_group_permission VALUES(273,1,4,73);
INSERT INTO acl_group_permission VALUES(274,1,4,72);
INSERT INTO acl_group_permission VALUES(275,1,4,80);
INSERT INTO acl_group_permission VALUES(276,1,4,34);
INSERT INTO acl_group_permission VALUES(277,1,4,49);
INSERT INTO acl_group_permission VALUES(278,1,4,85);
INSERT INTO acl_group_permission VALUES(279,1,4,98);
INSERT INTO acl_group_permission VALUES(280,1,4,40);
INSERT INTO acl_group_permission VALUES(281,1,4,68);
INSERT INTO acl_group_permission VALUES(282,1,4,136);
INSERT INTO acl_group_permission VALUES(283,1,4,18);
INSERT INTO acl_group_permission VALUES(284,1,4,55);
INSERT INTO acl_group_permission VALUES(285,1,4,65);
INSERT INTO acl_group_permission VALUES(286,1,4,51);
INSERT INTO acl_group_permission VALUES(287,1,4,135);
INSERT INTO acl_group_permission VALUES(288,1,4,4);
INSERT INTO acl_group_permission VALUES(289,1,4,2);
INSERT INTO acl_group_permission VALUES(290,1,4,28);
INSERT INTO acl_group_permission VALUES(291,1,4,31);
INSERT INTO acl_group_permission VALUES(292,1,4,60);
INSERT INTO acl_group_permission VALUES(293,1,4,100);
INSERT INTO acl_group_permission VALUES(294,1,4,29);
INSERT INTO acl_group_permission VALUES(295,1,1,143);






CREATE TABLE acl_user_shortcut(
       id           INTEGER     NOT NULL   PRIMARY KEY,
       id_user      INTEGER     NOT NULL,
       id_resource  INTEGER     NOT NULL,
       type         VARCHAR(25) NOT NULL,
       description  VARCHAR(25)
);
INSERT INTO acl_user_shortcut VALUES(1,1,59,'history',NULL);
INSERT INTO acl_user_shortcut VALUES(2,1,4,'history',NULL);
INSERT INTO acl_user_shortcut VALUES(3,1,3,'history',NULL);
INSERT INTO acl_user_shortcut VALUES(4,1,5,'history',NULL);
INSERT INTO acl_user_shortcut VALUES(5,1,143,'history',NULL);
CREATE TABLE sticky_note(
       id           INTEGER   NOT NULL   PRIMARY KEY,
       id_user      INTEGER   NOT NULL,
       id_resource  INTEGER   NOT NULL,
       date_edit    DATETIME  NOT NULL,
       description  TEXT
, auto_popup INTEGER NOT NULL DEFAULT '0');
CREATE TABLE acl_notification
(
    id              INTEGER     NOT NULL    PRIMARY KEY,
    datetime_create DATETIME    NOT NULL,
    level           VARCHAR(32) NOT NULL    DEFAULT 'info',
    id_user         INTEGER,
    id_resource     INTEGER,
    content         TEXT,

    FOREIGN KEY (id_user) REFERENCES acl_user(id),
    FOREIGN KEY (id_resource) REFERENCES acl_resource(id)
);
CREATE TABLE acl_module_privileges (
    id              INTEGER     NOT NULL    PRIMARY KEY,
    id_resource     INTEGER     NOT NULL,
    privilege       VARCHAR(32) NOT NULL,
    desc_privilege  TEXT,

    FOREIGN KEY (id_resource) REFERENCES acl_resource(id)
);
INSERT INTO acl_module_privileges VALUES(1,4,'viewany','View information for all users, not just their own');
INSERT INTO acl_module_privileges VALUES(2,4,'create','Create new users');
INSERT INTO acl_module_privileges VALUES(3,4,'editany','Update information for any user');
INSERT INTO acl_module_privileges VALUES(4,4,'deleteany','Delete any user');
INSERT INTO acl_module_privileges VALUES(5,28,'setanyemail','Update vacation status for any email account, not just their own');
INSERT INTO acl_module_privileges VALUES(6,60,'reportany','List voicemails from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(7,60,'downloadany','Listen and download voicemails from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(8,60,'deleteany','Delete voicemails from any user through GUI');
INSERT INTO acl_module_privileges VALUES(9,61,'reportany','List recordings from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(10,61,'downloadany','Listen and download recordings from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(11,61,'deleteany','Delete recordings from the system');
INSERT INTO acl_module_privileges VALUES(12,89,'reportany','View CDRs from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(13,89,'deleteany','Delete CDRs from the system report');
INSERT INTO acl_module_privileges VALUES(14,99,'viewany','View missed calls from all users, not just their own');
INSERT INTO acl_module_privileges VALUES(15,58,'modules','modules');
INSERT INTO acl_module_privileges VALUES(16,58,'callrecording','Call Recording');
INSERT INTO acl_module_privileges VALUES(17,58,'miscapps','Misc Applications');
INSERT INTO acl_module_privileges VALUES(18,58,'extensions','Extensions');
INSERT INTO acl_module_privileges VALUES(19,58,'did','Inbound Routes');
INSERT INTO acl_module_privileges VALUES(20,58,'dahdichandids','DAHDI Channel DIDs');
INSERT INTO acl_module_privileges VALUES(21,58,'routing','Outbound Routes');
INSERT INTO acl_module_privileges VALUES(22,58,'trunks','Trunks');
INSERT INTO acl_module_privileges VALUES(23,58,'advancedsettings','Advanced Settings');
INSERT INTO acl_module_privileges VALUES(24,58,'parking','Parking');
INSERT INTO acl_module_privileges VALUES(25,58,'customcontexts','Class of Service');
INSERT INTO acl_module_privileges VALUES(26,58,'customcontextsadmin','Class of Service Admin');
INSERT INTO acl_module_privileges VALUES(27,58,'setcid','Set CallerID');
INSERT INTO acl_module_privileges VALUES(28,58,'ringgroups','Ring Groups');
INSERT INTO acl_module_privileges VALUES(29,58,'cidlookup','CallerID Lookup Sources');
INSERT INTO acl_module_privileges VALUES(30,58,'music','Music on Hold');
INSERT INTO acl_module_privileges VALUES(31,58,'queueprio','Queue Priorities');
INSERT INTO acl_module_privileges VALUES(32,58,'trunkbalance','Trunk Balance');
INSERT INTO acl_module_privileges VALUES(33,58,'asteriskinfo','Asterisk Info');
INSERT INTO acl_module_privileges VALUES(34,58,'announcement','Announcements');
INSERT INTO acl_module_privileges VALUES(35,58,'blacklist','Blacklist');
INSERT INTO acl_module_privileges VALUES(36,58,'customextens','Custom Extensions');
INSERT INTO acl_module_privileges VALUES(37,58,'customdests','Custom Destinations');
INSERT INTO acl_module_privileges VALUES(38,58,'vmblast','Voicemail Blasting');
INSERT INTO acl_module_privileges VALUES(39,58,'managersettings','Asterisk Manager Settings');
INSERT INTO acl_module_privileges VALUES(40,58,'ivr','IVR');
INSERT INTO acl_module_privileges VALUES(41,58,'logfiles','Asterisk Logfiles');
INSERT INTO acl_module_privileges VALUES(42,58,'logfiles_settings','Asterisk Logfile Settings');
INSERT INTO acl_module_privileges VALUES(43,58,'iaxsettings','Asterisk IAX Settings');
INSERT INTO acl_module_privileges VALUES(44,58,'disa','DISA');
INSERT INTO acl_module_privileges VALUES(45,58,'queues','Queues');
INSERT INTO acl_module_privileges VALUES(46,58,'dynamicfeatures','Dynamic Features');
INSERT INTO acl_module_privileges VALUES(47,58,'sipsettings','Asterisk SIP Settings');
INSERT INTO acl_module_privileges VALUES(48,58,'timeconditions','Time Conditions');
INSERT INTO acl_module_privileges VALUES(49,58,'timegroups','Time Groups');
INSERT INTO acl_module_privileges VALUES(50,58,'conferences','Conferences');
INSERT INTO acl_module_privileges VALUES(51,58,'writequeuelog','Write in Queue Log');
INSERT INTO acl_module_privileges VALUES(52,58,'miscdests','Misc Destinations');
INSERT INTO acl_module_privileges VALUES(53,58,'bosssecretary','Boss Secretary');
INSERT INTO acl_module_privileges VALUES(54,58,'callback','Callback');
INSERT INTO acl_module_privileges VALUES(55,58,'featurecodeadmin','Feature Codes');
INSERT INTO acl_module_privileges VALUES(56,58,'voicemail','Voicemail Admin');
INSERT INTO acl_module_privileges VALUES(57,58,'pinsets','PIN Sets');
INSERT INTO acl_module_privileges VALUES(58,58,'findmefollow','Follow Me');
INSERT INTO acl_module_privileges VALUES(59,58,'languages','Languages');
INSERT INTO acl_module_privileges VALUES(60,58,'outroutemsg','Route Congestion Messages');
INSERT INTO acl_module_privileges VALUES(61,58,'daynight','Call Flow Control');
INSERT INTO acl_module_privileges VALUES(62,58,'dialplaninjection','Dialplan Injection');
INSERT INTO acl_module_privileges VALUES(63,58,'recordings','System Recordings');
INSERT INTO acl_module_privileges VALUES(64,58,'dynroute','Dynamic Routes');
INSERT INTO acl_module_privileges VALUES(65,58,'paging','Paging and Intercom');
CREATE TABLE acl_module_user_permissions (
    id                  INTEGER     NOT NULL    PRIMARY KEY,
    id_user             INTEGER     NOT NULL,
    id_module_privilege INTEGER     NOT NULL,

    FOREIGN KEY (id_user) REFERENCES acl_user(id),
    FOREIGN KEY (id_module_privilege) REFERENCES acl_module_privileges(id)
);
CREATE TABLE acl_module_group_permissions (
    id                  INTEGER     NOT NULL    PRIMARY KEY,
    id_group            INTEGER     NOT NULL,
    id_module_privilege INTEGER     NOT NULL,

    FOREIGN KEY (id_group) REFERENCES acl_group(id),
    FOREIGN KEY (id_module_privilege) REFERENCES acl_module_privileges(id)
);
INSERT INTO acl_module_group_permissions VALUES(1,1,1);
INSERT INTO acl_module_group_permissions VALUES(2,1,2);
INSERT INTO acl_module_group_permissions VALUES(3,1,3);
INSERT INTO acl_module_group_permissions VALUES(4,1,4);
INSERT INTO acl_module_group_permissions VALUES(5,1,5);
INSERT INTO acl_module_group_permissions VALUES(6,1,6);
INSERT INTO acl_module_group_permissions VALUES(7,1,7);
INSERT INTO acl_module_group_permissions VALUES(8,1,8);
INSERT INTO acl_module_group_permissions VALUES(9,1,9);
INSERT INTO acl_module_group_permissions VALUES(10,1,10);
INSERT INTO acl_module_group_permissions VALUES(11,1,11);
INSERT INTO acl_module_group_permissions VALUES(12,1,12);
INSERT INTO acl_module_group_permissions VALUES(13,1,13);
INSERT INTO acl_module_group_permissions VALUES(14,1,14);
INSERT INTO acl_module_group_permissions VALUES(15,1,15);
INSERT INTO acl_module_group_permissions VALUES(16,1,16);
INSERT INTO acl_module_group_permissions VALUES(17,1,17);
INSERT INTO acl_module_group_permissions VALUES(18,1,18);
INSERT INTO acl_module_group_permissions VALUES(19,1,19);
INSERT INTO acl_module_group_permissions VALUES(20,1,20);
INSERT INTO acl_module_group_permissions VALUES(21,1,21);
INSERT INTO acl_module_group_permissions VALUES(22,1,22);
INSERT INTO acl_module_group_permissions VALUES(23,1,23);
INSERT INTO acl_module_group_permissions VALUES(24,1,24);
INSERT INTO acl_module_group_permissions VALUES(25,1,25);
INSERT INTO acl_module_group_permissions VALUES(26,1,26);
INSERT INTO acl_module_group_permissions VALUES(27,1,27);
INSERT INTO acl_module_group_permissions VALUES(28,1,28);
INSERT INTO acl_module_group_permissions VALUES(29,1,29);
INSERT INTO acl_module_group_permissions VALUES(30,1,30);
INSERT INTO acl_module_group_permissions VALUES(31,1,31);
INSERT INTO acl_module_group_permissions VALUES(32,1,32);
INSERT INTO acl_module_group_permissions VALUES(33,1,33);
INSERT INTO acl_module_group_permissions VALUES(34,1,34);
INSERT INTO acl_module_group_permissions VALUES(35,1,35);
INSERT INTO acl_module_group_permissions VALUES(36,1,36);
INSERT INTO acl_module_group_permissions VALUES(37,1,37);
INSERT INTO acl_module_group_permissions VALUES(38,1,38);
INSERT INTO acl_module_group_permissions VALUES(39,1,39);
INSERT INTO acl_module_group_permissions VALUES(40,1,40);
INSERT INTO acl_module_group_permissions VALUES(41,1,41);
INSERT INTO acl_module_group_permissions VALUES(42,1,42);
INSERT INTO acl_module_group_permissions VALUES(43,1,43);
INSERT INTO acl_module_group_permissions VALUES(44,1,44);
INSERT INTO acl_module_group_permissions VALUES(45,1,45);
INSERT INTO acl_module_group_permissions VALUES(46,1,46);
INSERT INTO acl_module_group_permissions VALUES(47,1,47);
INSERT INTO acl_module_group_permissions VALUES(48,1,48);
INSERT INTO acl_module_group_permissions VALUES(49,1,49);
INSERT INTO acl_module_group_permissions VALUES(50,1,50);
INSERT INTO acl_module_group_permissions VALUES(51,1,51);
INSERT INTO acl_module_group_permissions VALUES(52,1,52);
INSERT INTO acl_module_group_permissions VALUES(53,1,53);
INSERT INTO acl_module_group_permissions VALUES(54,1,54);
INSERT INTO acl_module_group_permissions VALUES(55,1,55);
INSERT INTO acl_module_group_permissions VALUES(56,1,56);
INSERT INTO acl_module_group_permissions VALUES(57,1,57);
INSERT INTO acl_module_group_permissions VALUES(58,1,58);
INSERT INTO acl_module_group_permissions VALUES(59,1,59);
INSERT INTO acl_module_group_permissions VALUES(60,1,60);
INSERT INTO acl_module_group_permissions VALUES(61,1,61);
INSERT INTO acl_module_group_permissions VALUES(62,1,62);
INSERT INTO acl_module_group_permissions VALUES(63,1,63);
INSERT INTO acl_module_group_permissions VALUES(64,1,64);
INSERT INTO acl_module_group_permissions VALUES(65,1,65);
INSERT INTO acl_module_group_permissions VALUES(66,4,15);
INSERT INTO acl_module_group_permissions VALUES(67,4,16);
INSERT INTO acl_module_group_permissions VALUES(68,4,17);
INSERT INTO acl_module_group_permissions VALUES(69,4,18);
INSERT INTO acl_module_group_permissions VALUES(70,4,19);
INSERT INTO acl_module_group_permissions VALUES(71,4,20);
INSERT INTO acl_module_group_permissions VALUES(72,4,21);
INSERT INTO acl_module_group_permissions VALUES(73,4,22);
INSERT INTO acl_module_group_permissions VALUES(74,4,23);
INSERT INTO acl_module_group_permissions VALUES(75,4,24);
INSERT INTO acl_module_group_permissions VALUES(76,4,25);
INSERT INTO acl_module_group_permissions VALUES(77,4,26);
INSERT INTO acl_module_group_permissions VALUES(78,4,27);
INSERT INTO acl_module_group_permissions VALUES(79,4,28);
INSERT INTO acl_module_group_permissions VALUES(80,4,29);
INSERT INTO acl_module_group_permissions VALUES(81,4,30);
INSERT INTO acl_module_group_permissions VALUES(82,4,31);
INSERT INTO acl_module_group_permissions VALUES(83,4,32);
INSERT INTO acl_module_group_permissions VALUES(84,4,33);
INSERT INTO acl_module_group_permissions VALUES(85,4,34);
INSERT INTO acl_module_group_permissions VALUES(86,4,35);
INSERT INTO acl_module_group_permissions VALUES(87,4,36);
INSERT INTO acl_module_group_permissions VALUES(88,4,37);
INSERT INTO acl_module_group_permissions VALUES(89,4,38);
INSERT INTO acl_module_group_permissions VALUES(90,4,39);
INSERT INTO acl_module_group_permissions VALUES(91,4,40);
INSERT INTO acl_module_group_permissions VALUES(92,4,41);
INSERT INTO acl_module_group_permissions VALUES(93,4,42);
INSERT INTO acl_module_group_permissions VALUES(94,4,43);
INSERT INTO acl_module_group_permissions VALUES(95,4,44);
INSERT INTO acl_module_group_permissions VALUES(96,4,45);
INSERT INTO acl_module_group_permissions VALUES(97,4,46);
INSERT INTO acl_module_group_permissions VALUES(98,4,47);
INSERT INTO acl_module_group_permissions VALUES(99,4,48);
INSERT INTO acl_module_group_permissions VALUES(100,4,49);
INSERT INTO acl_module_group_permissions VALUES(101,4,50);
INSERT INTO acl_module_group_permissions VALUES(102,4,51);
INSERT INTO acl_module_group_permissions VALUES(103,4,52);
INSERT INTO acl_module_group_permissions VALUES(104,4,53);
INSERT INTO acl_module_group_permissions VALUES(105,4,54);
INSERT INTO acl_module_group_permissions VALUES(106,4,55);
INSERT INTO acl_module_group_permissions VALUES(107,4,56);
INSERT INTO acl_module_group_permissions VALUES(108,4,57);
INSERT INTO acl_module_group_permissions VALUES(109,4,58);
INSERT INTO acl_module_group_permissions VALUES(110,4,59);
INSERT INTO acl_module_group_permissions VALUES(111,4,60);
INSERT INTO acl_module_group_permissions VALUES(112,4,61);
INSERT INTO acl_module_group_permissions VALUES(113,4,62);
INSERT INTO acl_module_group_permissions VALUES(114,4,63);
INSERT INTO acl_module_group_permissions VALUES(115,4,64);
INSERT INTO acl_module_group_permissions VALUES(116,4,65);
CREATE TABLE acl_profile_properties
(
       id_profile   INTEGER     NOT NULL,
       property     VARCHAR(32) NOT NULL,
       value        VARCHAR(256),

       PRIMARY KEY (id_profile, property),
       FOREIGN KEY (id_profile) REFERENCES acl_user_profile (id_profile)
);
CREATE TABLE acl_user_profile
(
       id_profile   INTEGER     NOT NULL,
       id_user      INTEGER     NOT NULL,
       id_resource  INTEGER     NOT NULL,
       profile      VARCHAR(32) NOT NULL,

       PRIMARY KEY (id_profile),
       FOREIGN KEY (id_user)     REFERENCES acl_user(id),
       FOREIGN KEY (id_resource) REFERENCES acl_resource(id)
);
INSERT INTO acl_user_profile VALUES(1,2,29,'default');
COMMIT;

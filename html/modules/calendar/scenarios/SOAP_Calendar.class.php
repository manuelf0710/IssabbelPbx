<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.4                                                |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License  |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php                   |
  |                                                                      |
  | Software distributed under the License is distributed on an "AS IS"  |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See  |
  | the License for the specific language governing rights and           |
  | limitations under the License.                                       |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions    |
  +----------------------------------------------------------------------+
  $Id: SOAP_Calendar.class.php,v 1.0 2011-03-31 12:30:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/modules/calendar/libs/core.class.php");

class SOAP_Calendar extends core_Calendar
{
    /**
     * SOAP Server Object
     *
     * @var object
     */
    private $objSOAPServer;

    /**
     * Constructor
     *
     * @param  object   $objSOAPServer     SOAP Server Object
     */
    public function SOAP_Calendar($objSOAPServer)
    {
        parent::core_Calendar();
        $this->objSOAPServer = $objSOAPServer;
    }

    /**
     * Static function that calls to the function getFP of its parent
     *
     * @return  array     Array with the definition of the function points.
     */
    public static function getFP()
    {
        return parent::getFP();
    }

    /**
     * Function that implements the SOAP call to see the events on the calendar
     * of the registered user, by date range. If an error exists a SOAP fault is
     * thrown
     * 
     * @param mixed request:
     *                  startdate:  (date)  Starting date of event
     *                  enddate:    (date)  Ending date of event
     * @return  mixed   Array with the information of the calendar events
     */
    public function listCalendarEvents($request)
    {
        $return = parent::listCalendarEvents($request->startdate, $request->enddate);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return $return;
    }

    private function _fillNullParam($request)
    {
        foreach (array('id', 'startdate', 'enddate', 'subject', 'description',
            'asterisk_call', 'recording', 'call_to', 'reminder_timer',
            'color', 'emails_notification') as $k)
            if (!isset($request->$k)) $request->$k = NULL;
        if (isset($request->emails_notification) && !is_array($request->emails_notification))
            $request->emails_notification = array($request->emails_notification);
        return $request;
    }

    /**
     * Function that implements the SOAP call to add a new one-time event in the 
     * calendar of the registered user. If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  startdate:           (datetime) Starting date and time of event
     *                  enddate:             (datetime) Ending date and time of event
     *                  subject:             (string)   Subject of event
     *                  description:         (string) Long description of event
     *                  asterisk_call:       (bool) TRUE if must be generated reminder call
     *                  recording:           (string,optional) Name of the recording used to call. It is required if asterisk_call
     *                                                         is TRUE The file must exist in the recording directory for the
     *                                                         extension associated with the user.
     *                  call_to:             (string,optional) Extension to which call for Reminder. If omitted, assume the associated 
     *                                                         extension registered user. Not applicable unless asterisk_call is TRUE.
     *                  reminder_timer:      (string,optional) Number of minutes before which will make the call reminder. Applies if 
     *                                                         Asterisk_call is TRUE. By default it is assumed 0. Normal values ​​are 
     *                                                         10/30/60 minutes.
     *                  emails_notification: (array(string)) Zero or more emails will be notified with a message when creating the 
     *                                                       event.
     *                  color:               (string,optional) Color for the event
     * @return mixed    Array with boolean data, true if was successful or false if an error exists
     */
    public function addCalendarEvent($request)
    {
        $this->_fillNullParam($request);
        $return = parent::addCalendarEvent($request->startdate, $request->enddate,
            $request->subject, $request->description, $request->asterisk_call, 
            $request->recording, $request->call_to, $request->reminder_timer,
            $request->color, $request->emails_notification);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }

    /**
     * Function that implements the SOAP call to update an one-time event in the 
     * calendar of the registered user. If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  id:                  (integer)  ID of the event to update
     *                  startdate:           (datetime) Starting date and time of event
     *                  enddate:             (datetime) Ending date and time of event
     *                  subject:             (string)   Subject of event
     *                  description:         (string) Long description of event
     *                  asterisk_call:       (bool) TRUE if must be generated reminder call
     *                  recording:           (string,optional) Name of the recording used to call. It is required if asterisk_call
     *                                                         is TRUE The file must exist in the recording directory for the
     *                                                         extension associated with the user.
     *                  call_to:             (string,optional) Extension to which call for Reminder. If omitted, assume the associated 
     *                                                         extension registered user. Not applicable unless asterisk_call is TRUE.
     *                  reminder_timer:      (string,optional) Number of minutes before which will make the call reminder. Applies if 
     *                                                         Asterisk_call is TRUE. By default it is assumed 0. Normal values ​​are 
     *                                                         10/30/60 minutes.
     *                  emails_notification: (array(string)) Zero or more emails will be notified with a message when creating the 
     *                                                       event.
     *                  color:               (string,optional) Color for the event
     * @return mixed    Array with boolean data, true if was successful or false if an error exists
     */
    public function editCalendarEvent($request)
    {
        $this->_fillNullParam($request);
        $return = parent::editCalendarEvent($request->id,
            $request->startdate, $request->enddate,
            $request->subject, $request->description, $request->asterisk_call, 
            $request->recording, $request->call_to, $request->reminder_timer,
            $request->color, $request->emails_notification);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }

    /**
     * Procedure that implements the SOAP call to remove an existing event calendar of the registered user. If an
     * error exists a SOAP fault is thrown
     * 
     * @param   mixed   $request:
     *                      id: ID of the event to remove
     * @return  mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function delCalendarEvent($request)
    {
        $return = parent::delCalendarEvent($request->id);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }
}
?>
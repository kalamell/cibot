<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use LINE\LINEBot;

class Api extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function callback() {
        $secret_key = 'a0c814e8887c18be08dc2200ee89df5f';
        $access_token = 'iU//m/woK4ybtOBA0uGvpdLBF0qnIxl5yvxM5zzK4a0ChfkG5qIMKVLxAeQ93uuYIR2I6wzp2TxIiVV0jtZ3J1YPnLwJDNpjiUR8UUquXhbSV/YWbj0J7yYd5ReVrJQ4rIxuA34LxDQ0jt1IzK82nAdB04t89/1O/w1cDnyilFU=';
        $httpClient = new LINEBot\HTTPClient\CurlHTTPClient($secret_key);
        $bot = new LINEBot($httpClient, ['channelSecret' => $access_token]);
        $signature = $_SERVER['HTTP_' . LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
        $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
        
        foreach ($events as $event) {
			if (($event instanceof LINEBot\Event\MessageEvent\TextMessage)) {
                $outputText = new LINEBot\MessageBuilder\TextMessageBuilder('สวัสดี');
			}
			  
			$bot->replyMessage($event->getReplyToken(), $outputText);
		}

    }
}

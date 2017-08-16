<?php
namespace Dashboard\Controller;
use Think\Controller;
use xmpush\IOSBuilder;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;

/**
* @ author yuanpoint
* @os 推送消息
* @time 2017.3.10
*/
class MipushosController extends MainController
{
	private $secret = '';//AppScret
	private $bundleId = '';//包名

	public function _initialize(){
		vendor('MiPush.autoload');
		Constants::setBundleId($this->bundleId);
		Constants::setSecret($this->secret);
	}
	/**
	* os 系统 单发消息
	*/
	public function os_send_one($desc,$payload,$regit){

		$message = new IOSBuilder();
		$message->description($desc);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('payload',$payload);
		$message->build();

		$sender = new Sender();

		$res = $sender->send($message,$regit)->getRaw();

		return $res;

	}
	/**
	* os 系统 组发消息
	*/
	public function os_send_group($Description,$Payload,$regid_list){
		
		$message = new IOSBuilder();
		$message->description($Description);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('Payload',$Payload);
		$message->build();

		$sender = new Sender();

		$res  = $sender->sendToIds($message,$regid_list)->getRaw();
		return $res;

	}
	/**
	* os 系统 群发消息发消息
	*/
	public function os_send_all($Description,$Payload){

		$message = new IOSBuilder();
		$message->description($Description);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('Payload',$Payload);
		$message->build();

		$sender = new Sender();

		$res = $sender->broadcastAll($message)->getRaw();

		return $res;

	}
}




























?>

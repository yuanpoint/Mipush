<?php
namespace Dashboard\Controller;
use Think\Controller;
use xmpush\Builder;
use xmpush\HttpBase;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;
use xmpush\Feedback;
use xmpush\DevTools;
use xmpush\Subscription;
use xmpush\TargetedMessage;
class MipushController extends MainController {
	//消息发送成功返回格式：
	//Array ( [result] => ok [trace_id] => Xlm31b52487926945652nL [code] => 0 [data] => Array ( [id] => tlm31b52487926945784rQ ) [description] => 成功 [info] => Received push messages for 1 TOPIC )
	//消息发送失败返回格式：
	//Array ( [result] => error [reason] => Title or Description is empty! [trace_id] => Xlm15b74487927078175yr [code] => 65011 [description] => 未提供参数 )
	private $secret='2paBxstzolDkcM4zaqYx7g==';//AppSecret
	private $package='cn.iaapp.app.guanggaopai';//包名
	
	public function _initialize(){
		vendor('MiPush.autoload');
		Constants::setSecret($this->secret);
		Constants::setPackage($this->package);
	}
	


	
}
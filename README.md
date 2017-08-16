使用说明
/*
	 * 小米推送安卓单发
	 * $title 标题 限制50个字内
	 * $description 描述 限制125个字内
	 * $payload 透传内容，json格式，例子：{'MsgID':1}
	 * $regid 推送ID
	 * */
	public function send_one($title,$description,$payload,$regid){
		
		Vendor("Mipush.index");
		\Mipush\xmpush\Constants::setSecret("123");//AppSecret
		\Mipush\xmpush\Constants::setPackage("345");//包名
		
		$message1 = new \Mipush\xmpush\Builder();
		$message1->title($title);  // 通知栏的title
		$message1->description($description); // 通知栏的descption
		$message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
		$message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
		$message1->extra(\Mipush\xmpush\Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
		$message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
		$message1->build();

		$sender = new \Mipush\xmpush\Sender();
		$res=$sender->send($message1, $regid)->getRaw();
		return $res;
	}
	/*
	 * 小米推送Android组发
	 * $title 标题 限制50个字内
	 * $description 描述 限制125个字内
	 * $payload 透传内容，json格式，例子：{'MsgID':1}
	 * $regid_list 推送ID列表，数组格式,例子：array('UCY6aPDrrq7MZ9txjDMqQ4wWSLltEyXsUvCbJpUTn0M=','EZesFkhbrI7VmeTR8Nm25KIek7ffnHPX0C0LQvJg+Pk=')
	 * */
	public function send_group($title,$description,$payload,$regid_list){
		Vendor("Mipush.index");

		\Mipush\xmpush\Constants::setSecret("");//AppSecret
		\Mipush\xmpush\Constants::setPackage("");//包名

		$message1 = new \Mipush\xmpush\Builder();
		$message1->title($title);  // 通知栏的title
		$message1->description($description); // 通知栏的descption
		$message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
		$message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
		$message1->extra(\Mipush\xmpush\Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
		$message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
		$message1->build();
		/*$targetMessage = new TargetedMessage();
		$targetMessage->setTarget($regid, TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
		$targetMessage->setMessage($message1);*/

		$sender = new \Mipush\xmpush\Sender();
		$res=$sender->sendToIds($message1, $regid_list)->getRaw();
		return $res;
	}
	/*
	 *小米推送安卓群发
	 * $title 标题 限制50个字内
	 * $description 描述 限制125个字内
	 * $payload 透传内容，json格式，例子：{'MsgID':1}
	 * $regid 推送ID
	 * */
	public function send_all($title,$description,$payload){

		Vendor("Mipush.index");

		\Mipush\xmpush\Constants::setSecret("123");//AppSecret
		\Mipush\xmpush\Constants::setPackage("345");//包名

		$message1 = new \Mipush\xmpush\Builder();
		$message1->title($title);  // 通知栏的title
		$message1->description($description); // 通知栏的descption
		$message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
		$message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
		$message1->extra(\Mipush\xmpush\Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
		$message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
		$message1->build();
		/*$targetMessage = new TargetedMessage();
		$targetMessage->setTarget($regid, TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
		$targetMessage->setMessage($message1);*/

		$sender = new \Mipush\xmpush\Sender();

		$res=$sender->broadcastAll($message1)->getRaw();
		return $res;
	}
	/**
	* os 系统 单发消息
	*/
	public function os_send_one($desc,$payload,$regit){

		Vendor("Mipush.index");
		\Mipush\xmpush\Constants::setBundleId("");
		\Mipush\xmpush\Constants::setSecret("");

		$message = new \Mipush\xmpush\IOSBuilder();
		$message->description($desc);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('payload',$payload);
		$message->build();

		$sender = new \Mipush\xmpush\Sender();

		$res = $sender->send($message,$regit)->getRaw();

		return $res;

	}
	/**
	* os 系统 组发消息
	*/
	public function os_send_group($Description,$Payload,$regid_list){

		Vendor("Mipush.index");
		\Mipush\xmpush\Constants::setBundleId("");
		\Mipush\xmpush\Constants::setSecret("");

		$message = new \Mipush\xmpush\IOSBuilder();
		$message->description($Description);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('Payload',$Payload);
		$message->build();

		$sender = new \Mipush\xmpush\Sender();

		$res  = $sender->sendToIds($message,$regid_list)->getRaw();
		return $res;

	}
	/**
	* os 系统 群发消息发消息
	*/
	public function os_send_all($Description,$Payload){

		Vendor("Mipush.index");
		\Mipush\xmpush\Constants::setBundleId("");
		\Mipush\xmpush\Constants::setSecret("");

		$message = new \Mipush\xmpush\IOSBuilder();
		$message->description($Description);
		$message->soundUrl('default');
		$message->badge('0');
		$message->extra('Payload',$Payload);
		$message->build();

		$sender = new \Mipush\xmpush\Sender();

		$res = $sender->broadcastAll($message)->getRaw();

		return $res;

	}


<?php namespace platform\Repo\PushQueueInterface.php

class PushQueue implements PushQueueInterface {

$ironmq = new IronMQ();

public function pushQueue($job,$data)
{
	Queue::push('Sendmail', array('message' => $data));


}
public function updateQueue($job,$data){

$job = $ironmq->updateQueue($queue_name, array(
    'subscribers' => $subscribers,
    'push_type' => "unicast"
));

}

public function deleteQueue($job){

$job = $ironmq->deleteQueue($queue_name);

}

public function QueueContent($job){

$job = $ironmq->getQueue($queue_name);
 $message = $ironmq->getMessage($job);
	
}


}
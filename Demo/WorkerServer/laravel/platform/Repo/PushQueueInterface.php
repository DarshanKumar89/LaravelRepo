<?php namespace platform\Repo\PushQueueInterface;

interface PushQueueInterface{


public function pushQueue($job,$data);

public function updateQueue($job,$data);

public function deleteQueue($job);

public function QueueContent($job);




}
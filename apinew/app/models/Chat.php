<?php

class Chat extends Eloquent{

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chat_data';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	

    protected $primaryKey="intChatDataId";

    protected $dates = ['deleted_at'];

}

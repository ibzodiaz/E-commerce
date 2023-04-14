<?php

class NoticeManager extends Model
{

	public function getAllNotices($id){
		$this->getBdd();
		return $this->getJoinTablesInfoNotice('notices','products','customers','Notice',$id);
	}


	public function insertNotice($objet){
		$this->getBdd();
		$this->insertObject('notices',$objet);
	}

}

?>
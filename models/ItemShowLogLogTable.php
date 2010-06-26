<?php




class ItemShowLogLogTable extends Omeka_Db_Table
{
	
	public function findCountByItemId($item_id)
	{
		$select = $this->getSelectForCount()->where('item_id = ?', $item_id);
		return $this->fetchOne($select);
	}
	
}

?>

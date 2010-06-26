<?php
class ItemShowLog_IndexController extends Omeka_Controller_Action
{
  public function indexAction()
  {
    $db = get_db();
    $table = $db->getTable('ItemShowLogLog');
  }




}
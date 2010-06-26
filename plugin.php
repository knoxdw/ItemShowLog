<?php


add_plugin_hook('install', 'item_show_log_install');
add_plugin_hook('uninstall', 'item_show_log_uninstall');
add_plugin_hook('admin_theme_header','item_show_log_admin_theme_header');
add_plugin_hook('admin_append_to_items_show_secondary', 'item_show_log_admin_append_to_items_show_secondary');
add_plugin_hook('public_append_to_items_show', 'item_show_log_public_append_to_items_show');

add_filter('admin_navigation_main', 'adminNavigationMain');

function item_show_log_install()
{
	$db = get_db();
	
	$sql = "
CREATE TABLE `{$db->prefix}item_show_log_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `ip_address` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
	
	$db->exec($sql);
	
}

function item_show_log_uninstall()
{
	$db = get_db();
	
	$sql = "DROP TABLE IF EXISTS `{$db->prefix}item_show_log_logs` ; ";
	$db->exec($sql);
}


function item_show_log_public_append_to_items_show()
{
	
	$item = get_current_item();

	$newLogRecord = new ItemShowLogLog();
	$newLogRecord->item_id = $item->id;
	$newLogRecord->timestamp = date('Y-m-d H:i:s');
	$newLogRecord->ip_address =$_SERVER['REMOTE_ADDR'];
	$newLogRecord->save();
#	print_r($newLogRecord);
	
}

function item_show_log_admin_theme_header() {
  echo "<link rel='stylesheet' href='" . css('itemshowlog') . "' />";
}

function item_show_log_admin_append_to_items_show_secondary()
{
	$item = get_current_item();
	$log_count = get_db()->getTable('ItemShowLogLog')->findCountByItemId($item->id);
	echo "<div class='info-panel'><h2>Log data</h2><p>Viewed $log_count times in public view.</p></div>";

}

function adminNavigationMain($nav)
{
  $nav['Item Show Log'] = uri('item-show-log');
  return $nav;
}

<?php
$s_store = null;
$db = db_connect();
$s_user = session()->get('user');
$s_level = $s_user['level_id'];
$q_store = $db->query('SELECT * FROM store_users WHERE user_id = ' . $s_user['id'])->getFirstRow();
if ($q_store) $s_store = $db->query('SELECT * FROM stores WHERE id = ' . $q_store->store_id)->getFirstRow();

<?php

use App\Models\LevelModel;

function formatRupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function terbilang($x)
{
    $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}

function isLoggedIn(): bool
{
    if (session()->get('user'))
        return true;

    return false;
}

function getLevel($field = null, $session = true, $user = null)
{
    $level_id = session()->get('user')['level_id'];
    if ($session == false && $user) $level_id = $user['level_id'];

    $db      = \Config\Database::connect();
    $builder = $db->table('levels');
    $level = $builder->getWhere(['id' => $level_id])->getFirstRow();
    if ($level)
        $level = $level->$field;
    return $level ?? $field;
}

function getStoreId($session = true, $user = null)
{
    $user_id = session()->get('user')['id'];
    if ($session == false && $user) $user_id = $user['id'];
    $db      = \Config\Database::connect();
    $builder = $db->table('store_users');
    $store_id = $builder->getWhere(['user_id' => $user_id])->getFirstRow();
    if ($store_id) $store_id = $store_id->store_id;

    return $store_id ?? null;
}


function baseStore($query)
{
    return $query->where('store_id', getStoreId());
}

function getRecord($query, $where = null, $select = null, $order = null)
{
    if ($where) $query = $query->where($where);
    if ($select) $query = $query->select($select);
    if ($order) $query = $query->orderBy($order);
    return $query;
}


function replaceString($string, $find, $replace)
{
    $string = str_replace($find, $replace, $string);
    return $string;
}
function dateIndo($date, $delimiter = '-')
{
    $month = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $explode = explode($delimiter, $date);

    // variabel explode 0 = year
    // variabel explode 1 = month
    // variabel explode 2 = date

    return $explode[2] . ' ' . $month[(int)$explode[1]] . ' ' . $explode[0];
}


function noInvoice()
{
    $db = \Config\Database::connect();
    $builder = $db->table('orders');

    $tgl = date('Ymd');
    $builder->select("MAX(RIGHT(id,4)) as id")->where('id LIKE', '%' . $tgl . '%')
        ->where('store_id', getStoreId());
    $query = $builder->get()->getResult();
    $queue = '0001';
    if ($orders = $query[0]) {
        $tmp = $orders->id + 1;
        $queue = str_pad($tmp, 4, "0", STR_PAD_LEFT);
    }

    $no_invoice = $tgl . $queue;
    return $no_invoice;
}

function getMonthIndo($month)
{
    if (substr($month, 0, 1) == 0 && $month < 10)
        $month = substr($month, 1, 3);

    $months = [
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    ];
    return $months[$month];
}

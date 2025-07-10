<?php
function validationError($field)
{
    $error = null;
    switch ($field) {
        case 'store_name':
            $error = [
                'required' => 'Masukkan Nama Toko.',
                'is_unique' => 'Nama Toko Sudah Tersedia.',
                'min_length' => 'Nama Toko Minimum 3 Karakter.',
            ];
            break;
        case 'category_name':
            $error = [
                'required' => 'Masukkan Nama Kategori.',
                'is_unique' => 'Nama Kategori Sudah Tersedia.',
                'min_length' => 'Nama Kategori Minimum 2 Karakter.',
            ];
            break;
        case 'unit_name':
            $error = [
                'required' => 'Masukkan Nama Satuan.',
                'is_unique' => 'Nama Satuan Sudah Tersedia.',
                'min_length' => 'Nama Satuan Minimum 2 Karakter.',
            ];
            break;
        case 'username':
            $error = [
                'required' => 'Masukkan Username.',
                'is_unique' => 'Username Sudah Tersedia.',
                'min_length' => 'Username Minimum 4 Karakter.',
            ];
            break;
        case 'email':
            $error = [
                'required' => 'Masukkan Email.',
                'is_unique' => 'Email Sudah Tersedia.',
            ];
            break;

        default:
            # code...
            break;
    }
    return $error;
}

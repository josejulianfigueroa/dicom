<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class BlacklistModel extends Model
{
	//protected $primaryKey = 'rut';
    protected $table = 'efi_blacklist_rut_fono';

    protected $fillable =['rut','motivo','idcliente','fono']; //columnas que pueden ser llenadas

    public $timestamps = false;

    public $incrementing= false;

}

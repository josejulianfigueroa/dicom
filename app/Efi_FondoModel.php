<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class Efi_FondoModel extends Model
{
    protected $table ='efi_fondo' ;

    protected $primaryKey = 'idcliente';

    public $fillable=['idcliente','cuenta2'];

    public $timestamps = false;

    public $incrementing= false;
}

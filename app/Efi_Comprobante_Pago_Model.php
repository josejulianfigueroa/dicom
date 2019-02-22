<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class Efi_Comprobante_Pago_Model extends Model
{
    protected $table ='efi_comprobante_pago' ;

    protected $primaryKey = 'id';

    public $fillable=['cierre'];

    public $timestamps = false;

    public $incrementing= false;
}

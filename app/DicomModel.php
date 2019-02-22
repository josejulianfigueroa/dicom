<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class DicomModel extends Model
{
    protected $table ='efi_dicom_lista' ;

    protected $primaryKey = 'id';

    public $fillable=['idcliente','rut','dv','moneda','monto_protesto','numero_documento','fecha_protesto','fecha_vencimiento','fecha_pago','situacion','fecha_aclaracion','observacion'];

     public $timestamps = false;

    public $incrementing= false;
}

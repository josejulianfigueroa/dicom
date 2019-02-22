<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class WalmartGrbacionModel extends Model
{
   
    protected $table ='efi_seguros_72' ;

    protected $primaryKey = 'id';

    public $fillable=['idcliente','nombre_archivo','activo','rut','id','codigo_usuario'];

    public $timestamps = false;

    public $incrementing= false;

}

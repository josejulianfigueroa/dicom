<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class DicomBaseModel extends Model
{
    protected $table ='efi_dicom_base';

    protected $primaryKey='id';

    public $fillable=['idcliente','rut','dv','apellido_pat','apellido_mat','nombres','situacion'];

    public $timestamps=false;
    
    public $incrementing=false;
}

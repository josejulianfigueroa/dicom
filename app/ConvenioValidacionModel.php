<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class ConvenioValidacionModel extends Model
{
    protected $table ='efi_convenios_validacion' ;

    protected $primaryKey = 'id';

    public $fillable=['id','idconvenio','idusuario','fecha_update','convenio','contacto','observacion'];

    public $timestamps = false;

    public $incrementing= false;
}
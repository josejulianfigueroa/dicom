<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class Gestion2 extends Model
{
    protected $table ='gestion2' ;

    protected $primaryKey = 'id';

    public $fillable=['rut','fecha','idgestion','idcliente'];

    public $timestamps = false;

    public $incrementing= false;
}
<?php

namespace DICOM;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table ='j_base_pagos_eficaz' ;

    protected $primaryKey = 'id';

    public $fillable=['rut','fecha_pago','monto','idcliente'];

    public $timestamps = false;

    public $incrementing= false;
}
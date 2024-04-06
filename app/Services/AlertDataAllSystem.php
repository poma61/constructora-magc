<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Obra;

class AlertDataAllSystem
{

    public static function listFechaReunionCliente()
    {
        //selecionar todos los clientes que tengan fecha de reunion segun la fecha actual date('Y-m-d')        
        $cliente = Cliente::select('nombres', 'apellido_paterno', 'apellido_materno', 'fecha_reunion', 'hora_reunion')
            ->where('status', true)
            ->whereDate('fecha_reunion', date('Y-m-d'))
            ->get();

        return $cliente;
    }

    public static function listFechaFirmaContrato()
    {
        //selecionar todos los clientes que tengan fecha de firma de contrato segun la fecha actual date('Y-m-d')        
        $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
            ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.fecha_firma_contrato','contratos.n_contrato')
            ->where('clientes.status', true)
            ->where('contratos.status', true)
            ->whereDate('contratos.fecha_firma_contrato', date('Y-m-d'))
            ->get();

        return $contrato;
    }

    public static function listFechaInicioObra()
    {
        //seleccionar todas  las obras que inician  hoy date('Y-m-d') segun contratos by clientes        
        $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
            ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
            ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'obras.fecha_inicio','contratos.n_contrato')
            ->where('obras.status', true)
            ->where('contratos.status', true)
            ->where('clientes.status', true)
            ->whereDate('obras.fecha_inicio', date('Y-m-d'))
            ->get();

        return $obra;
    }

    public static function listFechaFinalizacionObra()
    {
        //seleccionar todas  las obras que finalizan  hoy date('Y-m-d') segun contratos by clientes        
        $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
            ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
            ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'obras.fecha_finalizacion','contratos.n_contrato')
            ->where('obras.status', true)
            ->where('contratos.status', true)
            ->where('clientes.status', true)
            ->whereDate('obras.fecha_finalizacion', date('Y-m-d'))
            ->get();

        return $obra;
    }
}//class

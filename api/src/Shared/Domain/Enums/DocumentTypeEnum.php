<?php

namespace Src\Shared\Domain\Enums;

enum DocumentTypeEnum: string
{
    case DNI = 'DNI';                       // Documento Nacional de Identidad
    case CI = 'CI';                         // Cédula de Identidad
    case CC = 'CC';                         // Cédula de Ciudadanía
    case PASSPORT = 'PASSPORT';             // Pasaporte
    case CPF = 'CPF';                       // Cadastro de Pessoas Físicas (Brasil)
    case RUT = 'RUT';                       // Rol Único Tributario (Chile)
    case CURP = 'CURP';                     // Clave Única de Registro de Población (México)
    case RNC = 'RNC';                       // Registro Nacional del Contribuyente
    case DRIVERS_LICENSE = 'DRIVERS_LICENSE'; // Licencia de Conducir
    case FOREIGN_CARD = 'FOREIGN_CARD';     // Carnet de Extranjería / Residencia
    case OTHER = 'OTHER';                   // Otro documento oficial

    public function label(): string
    {
        return match($this) {
            self::DNI => 'Documento Nacional de Identidad',
            self::CI => 'Cédula de Identidad',
            self::CC => 'Cédula de Ciudadanía',
            self::PASSPORT => 'Pasaporte',
            self::CPF => 'Cadastro de Pessoas Físicas (CPF)',
            self::RUT => 'Rol Único Tributario (RUT)',
            self::CURP => 'Clave Única de Registro de Población (CURP)',
            self::RNC => 'Registro Nacional del Contribuyente',
            self::DRIVERS_LICENSE => 'Licencia de Conducir',
            self::FOREIGN_CARD => 'Carnet de Extranjería',
            self::OTHER => 'Otro Documento Oficial',
        };
    }
}
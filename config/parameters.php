<?php

return [
    'parameters' => [
        'action' => [
            'name' => 'Acciones',
            'description' => 'Acciones del sistema',
            'editable' => 0,
            'values' => [
                'all',
                'index',
                'create',
                'store',
                'show',
                'destroy',
                'delete',
                'update',
                'edit',
                'assign',
                'import',
                'export',
                'record'
            ]
        ],
        'user_document_types' => [
            'name' => 'Tipos de documentos del usuario',
            'description' => 'Tipos de documentos de las personas',
            'editable' => 1,
            'values' => [
                'Cédula',
                'NIT',
            ]
        ],
        'role_documents' => [
            'name' => 'Documentos del rol',
            'description' => 'Tipos de documentos asociados a los usuarios con tal rol',
            'editable' => 1,
            'values' => [
                'Cédula',
                'NIT',
                'RUT',
                'Cámara de comercio',
                'Carta de intención de proveedor',
                'Tarjeta profesional',
                'Certificado de cuenta bancaria',
                'Certificado seguridad social',
                'Certificado ARL',
                'Firma'
            ]
        ],
        'petition_documents' => [
            'name' => 'Documentos de la solicitud',
            'description' => 'Tipos de documentos de la solicitud',
            'editable' => 1,
            'values' => [
                'Estudios y diseños',
                'Fichas técnicas',
            ]
        ],
        'application_documents' => [
            'name' => 'Documentos de los postulados',
            'description' => 'Tipos de documentos requeridos en la convocatoria',
            'editable' => 1,
            'values' => [
                'Certificado de idoneidad', 'Formato único de hoja de vida',
                'Anexos de hoja de vida',
                'Fotocopia de la cédula',
                'Libreta militar',
                'RUT',
                'Certificados de antecedentes fiscales',
            ]
        ],
        'documents' => [
            'name' => 'Tipos de documentos',
            'description' => 'Tipos de documentos',
            'editable' => 1,
            'values' => [
                'Estudios previos',
                'Contrato',
                'Cotización',
                'Orden de compra',
                'CDP',
                'rp',
                'Acta de inicio',
                'Acta de seguimiento',
                'Acta de cierre',
                'Factura',
                'Remisión de entrega',
            ]
        ],
        'contract_legalization_documents' => [
            'name' => 'Documentos de legalización de contrato',
            'description' => 'Documentos de legalización de contrato',
            'editable' => 1,
            'values' => [
                'Póliza',
            ]
        ],
        'person_types' => [
            'name' => 'Tipo de persona',
            'description' => '',
            'editable' => 0,
            'values' => [
                'Jurídica',
                'Natural',
            ]
        ],
        'contract_types' => [
            'name' => 'Tipos de contrato',
            'description' => 'Clases de contrato',
            'editable' => 0,
            'values' => [
                'Prestación de servicios',
                'Arriendo',
                'Licencia de software',
                'Obra',
                'De seguro',
                'Compra venta',
                'Otros',
            ]
        ],
        'amount_modalities' => [
            'name' => 'Modalidades de cuantía',
            'description' => 'Modalidades de las cuantías',
            'editable' => 1,
            'values' => [
                'Orden de compra',
                'Contratación directa',
                'Invitación',
                'Licitación'
            ]
        ],
        'amount_resolution' => [
            'name' => 'Resoluciones de las cuantías',
            'description' => 'Resoluciones de las cuantías',
            'editable' => 0,
            'values' => []
        ],
        'dependencies' => [
            'name' => 'Dependencias',
            'description' => 'Dependencias del sistema',
            'editable' => 1,
            'values' => [
                'Bienes y suministros',
                'Talento humano',
            ]
        ],
        'specific_obligation_types' => [
            'name' => 'Tipos de obligaciones especificas',
            'description' => 'Tipos de obligaciones especificas',
            'editable' => 0,
            'values' => [
                'Actividad',
                'Producto'
            ]
        ],
        'payment_types' => [
            'name' => 'Tipos de pago',
            'description' => 'Tipos de pago del contrato',
            'editable' => 0,
            'values' => [
                'Periódico',
                'Por entrega'
            ]
        ],
        'banks' => [
            'name' => 'Bancos',
            'description' => 'Bancos',
            'editable' => 1,
            'values' => [
                'Banco A',
                'Banco B'
            ]
        ],
        'bank_account_types' => [
            'name' => 'Tipos de cuentas de banco',
            'description' => 'Tipos de  de cuentas de banco',
            'editable' => 1,
            'values' => [
                'Débito',
                'Crédito'
            ]
        ],
        'insurance_companies' => [
            'name' => 'Aseguradoras',
            'description' => 'Aseguradoras',
            'editable' => 1,
            'values' => [
                'Aseguradora Solidaria de Colombia',
                'Comseguros Asesores Ltda'
            ]
        ],
        'financing_source' => [
            'name' => 'Fuentes de financiación',
            'description' => 'Fuentes de financiación',
            'editable' => 1,
            'values' => [
                'Crowdfunding'
            ]
        ],
        'resource_types' => [
            'name' => 'Tipos de recurso',
            'description' => 'Tipos de recurso',
            'editable' => 1,
            'values' => []
        ],
        'strategic_lines' => [
            'name' => 'Lineas estratégicas',
            'description' => 'Lineas estratégicas',
            'editable' => 1,
            'values' => [
                'Prueba'
            ]
        ],
        'development_engines' => [
            'name' => 'Motor de desarrollo',
            'description' => 'Motor de desarrollo',
            'editable' => 1,
            'values' => []
        ],
        'project_name_cdp' => [
            'name' => 'Nombre del proyecto cdp',
            'description' => 'Nombre del proyecto cdp',
            'editable' => 1,
            'values' => []
        ],
        'cdp_expense_types' => [
            'name' => 'Tipos de gastos de cdp',
            'description' => 'Tipos de gastos de cdp',
            'editable' => 1,
            'values' => [
                'efectivo'
            ]
        ],
        'execution_places' => [
            'name' => 'Lugares de ejecución',
            'description' => 'Lugares de ejecución del contrato',
            'editable' => 0,
            'values' => [
                'Universidad del Atlántico Sede Norte',
                'Universidad del Atlántico Sede Centro',
                'Universidad del Atlántico Sede Regional Sur',
                'Bellas Artes- Museo de Antropología',
            ]
        ],
        'petition_statuses' => [
            'name' => 'Estados de la petición',
            'description' => 'Estados de la petición',
            'editable' => 0,
            'values' => [
                'Borrador',
                'Solicitada',
                'Aprobada rectoría',
                'Proceso de selección',
                'Cerrada'
            ]
        ],
        'application_statuses' => [
            'name' => 'Estados de la postulación',
            'description' => 'Estados de la postulación',
            'editable' => 0,
            'values' => [
                'Presentada',
                'Rechazada',
                'Aceptada',
                'Seleccionado',
                'No seleccionado',
                'Con solicitud de contratos',
                'Minuta',
                'Revisado jurídico',
                'Firma rectoría',
                'Rechazado rectoría',
                'Numeración th',
                'Firma de contratista',
                'Rechazado por contratista',
                'Legalización',
                'Verificado th',
            ]
        ],
        'application_cdp_statuses' => [
            'name' => 'Estados del cdp la solicitud',
            'description' => 'Estados del cdp la solicitud',
            'editable' => 0,
            'values' => [
                'Borrador',
                'Solicitada',
                'Abierta',
                'Cerrada'
            ]
        ],
        'contract_statuses' => [
            'name' => 'Estados del contrato',
            'description' => 'Estados del cdp la solicitud',
            'editable' => 0,
            'values' => [
                'Borrador',
                'Radicado',
                'Firma Rector',
                'Firma de contratista',
                'Con pólizas',
                'Con acta de inicio',
                'En ejecución',
                'Pagado',
                'Con acta de cierre',
                'Terminado'
            ]
        ],
        'payment_statuses' => [
            'name' => 'Estados del pago',
            'description' => 'Estados del pago del contrato',
            'editable' => 0,
            'values' => [
                'Pendiente',
                'Solicitado',
                'Revisado',
                'Programado',
                'Efectuado',
                'Recibido',
            ]
        ],
        'specific_obligations_statuses' =>  [
            'name' => 'Estados de las obligaciones especificas',
            'description' => 'Estados de las obligaciones especificas',
            'editable' => 0,
            'values' => [
                'Pendiente',
                'Solicitado',
                'Revisado',
                'Programado',
                'Efectuado',
                'Recibido',
            ]
        ],
        'required_petition_documents' =>  [
            'name' => 'Documentos requeridos solicitud',
            'description' => 'Lista documentos requeridos por la solicitud',
            'editable' => 1,
            'values' => [
                'Carta de intención laboral',
                'Seguro de vida',
                'Titulo universitario',
            ]
        ],
        'consecutive_contract_prefixes' =>  [
            'name' => 'Prefijos de consecutivo de contrato',
            'description' => 'Prefijos del consecutivo de los contratos',
            'editable' => 1,
            'values' => [
                'DBS',
                'OBS',
            ]
        ],
    ],
];

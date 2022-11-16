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
        'person_types' => [
            'name' => 'Tipo de persona',
            'description' => '',
            'editable' => 0,
            'values' => [
                'Jurídica',
                'Natural',
            ]
        ],
    ],
];

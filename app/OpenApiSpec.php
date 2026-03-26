<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Covoit API',
    description: 'Documentation Swagger de l API REST Covoit'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8092',
    description: 'Serveur local'
)]
#[OA\Tag(name: 'Employes', description: 'Operations sur la ressource employes')]
#[OA\Tag(name: 'Vehicules', description: 'Operations sur la ressource vehicules')]
class OpenApiSpec
{
    // Classe support uniquement pour les annotations globales OpenAPI.
}

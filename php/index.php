<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/DocentiController.php';
require __DIR__ . '/controllers/ScuoleController.php';

$app = AppFactory::create();

//end-point per le scuole
$app->get('/scuole', "ScuoleController:allSchools");
$app->get('/scuole/{scuola_id:[0-9+]}', "ScuoleController:singleSchool");
$app->post('/scuole', "ScuoleController:createSchool");
$app->put('/scuole/{scuola_id:[0-9+]}', "ScuoleController:updateSchool");
$app->delete('/scuole/{scuola_id:[0-9+]}', "ScuoleController:deleteSchool");
$app->get('/scuole/search/{txt}', "ScuoleController:filterSchool");

//end-point per i docenti
$app->get('/scuole/{scuola_id}/docenti', "DocentiController:allDocenti");
$app->get('/scuole/{scuola_id:[0-9+]}/docenti/{id_docente:[0-9+]}', "docentiController:singleDocente");
$app->post('/scuole/{scuola_id:[0-9+]}/docenti', "docentiController:createDocente");
$app->put('/scuole/{scuola_id:[0-9+]}/docenti/{id_docente:[0-9+]}', "docentiController:updateDocente");
$app->delete('/scuole/{scuola_id:[0-9+]}/docenti/{id_docente:[0-9+]}', "docentiController:deleteDocente");
$app->get('/scuole/{scuola_id:[0-9+]}/docenti/search/{txt}', "ScuoleController:filterDocente");

$app->run();

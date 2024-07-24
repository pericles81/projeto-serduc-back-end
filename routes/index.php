<?php 

use function src\slimConfiguration;
use App\Controllers\TeachersController;
use App\Controllers\SchoolsController;
use App\Controllers\StudentsController;
use Tuupola\Middleware\CorsMiddleware;

require 'vendor/autoload.php';

$container = slimConfiguration();
$app = new \Slim\App($container);

$cors = require __DIR__ . '/../App/Middlewares/corsConfiguration.php';
$app->add($cors);

$app->get('/teachers', TeachersController::class . ':getTeachers');
$app->get('/teachers/{cpf}', TeachersController::class . ':getTeacherById');
$app->post('/teachers', TeachersController::class . ':insertTeachers');
$app->put('/teachers/{cpf}', TeachersController::class . ':updateTeachers');
$app->delete('/teachers/{cpf}', TeachersController::class . ':deleteTeachers');

$app->get('/schools', SchoolsController::class . ':getSchools');
$app->get('/schools/{id}', SchoolsController::class . ':getSchoolById');
$app->post('/schools', SchoolsController::class . ':insertSchools');
$app->put('/schools/{id}', SchoolsController::class . ':updateSchools');
$app->delete('/schools/{id}', SchoolsController::class . ':deleteSchools');

$app->get('/students', StudentsController::class . ':getStudents');
$app->get('/students/{id}', StudentsController::class . ':getSchoolById');
$app->post('/students', StudentsController::class . ':insertStudents');
$app->put('/students/{id}', StudentsController::class . ':updateStudents');
$app->delete('/students/{id}', StudentsController::class . ':deleteStudents');

$app->run();
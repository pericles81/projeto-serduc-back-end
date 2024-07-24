<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\SchoolsDAO;
use App\Models\SchoolsModel;

final class SchoolsController{
    
    public function getSchools(Request $request, Response $response, array $args): Response{

        $schoolsDAO = new SchoolsDAO();
        $schools = $schoolsDAO->getAllSchools();
        $response = $response->withJson($schools);
        return $response;
    }

    public function getSchoolById(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $schoolsDAO = new SchoolsDAO();
        $school = $schoolsDAO->getSchoolById($id);
        
        if ($school) {
            $response = $response->withJson($school);
        } else {
            $response = $response->withJson(['message' => 'School not found'], 404);
        }
        
        return $response;
    }
    
    public function insertSchools(Request $request, Response $response, array $args): Response{

        $data = $request->getParsedBody();
        $schoolsDAO = new SchoolsDAO();
        $school = new SchoolsModel();
        $school->setNome($data['nome'])
        ->setEndereco($data['endereco']);
        $schoolsDAO->insertSchools($school);
        $response = $response->withJson(['messege'=>'Escola inserida com sucesso!']);

        return $response;

    }

    public function updateSchools(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $schoolsDAO = new SchoolsDAO();
        $school = new SchoolsModel();
        $school->setId((int)$args['id'])
            ->setNome($data['nome'])
            ->setEndereco($data['endereco']);
        $schoolsDAO->updateSchools($school);

        $response = $response->withJson([
            'message' => 'Escola alterada com sucesso!'
        ]);

        return $response;
    }

    public function deleteSchools(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getParsedBody();

        $schoolsDAO = new SchoolsDAO();
        $id = (int)$queryParams['id'];
        $schoolsDAO->deleteSchools($id);

        $response = $response->withJson([
            'message' => 'Escola excluida com sucesso!'
        ]);

        return $response;
    }

}
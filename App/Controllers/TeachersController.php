<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\TeachersDAO;
use App\Models\TeachersModel;

final class TeachersController{
    
    public function getTeachers(Request $request, Response $response, array $args): Response{

        $teachersDAO = new TeachersDAO();
        $teachers = $teachersDAO->getAllTeachers();
        $response = $response->withJson($teachers);
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

    public function getTeacherById(Request $request, Response $response, array $args): Response {
        $cpf = $args['cpf'];
        $teachersDAO = new TeachersDAO();
        $teacher = $teachersDAO->getTeacherById($cpf);
        
        if ($teacher) {
            $response = $response->withJson($teacher);
        } else {
            $response = $response->withJson(['message' => 'School not found'], 404);
        }
        
        return $response;
    }
    
    public function insertTeachers(Request $request, Response $response, array $args): Response{

        $data = $request->getParsedBody();

        $teachersDAO = new TeachersDAO();
        $teacher = new TeachersModel();
        $dataNasc = new \DateTime($data['data_nasc']);

        $teacher->setCpf($data['cpf'])
        ->setNome($data['nome'])
        ->setSenha($data['senha'])
        ->setDataNasc($dataNasc)
        ->setEscolaId($data['escola_id'])
        ->setCpfUsers($data['cpf_users']);
        $teachersDAO->insertTeachers($teacher);
        $response = $response->withJson(['messege'=>'Professor inserido com sucesso!']);

        return $response;

    }

    public function updateTeachers(Request $request, Response $response, array $args): Response
    {
        $dataNasc = new \DateTime($data['data_nasc']);
        // 'nome' => $school->getNome(),
        // 'senha' => $school->getSenha(),
        // 'data_nasc' => $school->getDataNasc()->format('Y-m-d'),
        // 'escola_id' => $school->getEscolaId(),
        // 'cpf' => $school->getCpf()

        // $teacher->setCpf($data['cpf'])
        // ->setNome($data['nome'])
        // ->setSenha($data['senha'])
        // ->setDataNasc($dataNasc)
        // ->setEscolaId($data['escola_id'])
        // ->setCpfUsers($data['cpf_users']);

        $data = $request->getParsedBody();

        $teachersDAO = new TeachersDAO();
        $teacher = new TeachersModel();
        $teacher->setCpf($args['cpf'])
            ->setNome($data['nome'])
            ->setSenha($data['senha'])
            ->setDataNasc($dataNasc)
            ->setEscolaId($data['escola_id']);

        $teachersDAO->updateTeachers($teacher);

        $response = $response->withJson([
            'message' => 'Escola alterada com sucesso!'
        ]);

        return $response;
    }

    public function deleteTeachers(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getParsedBody();

        $teachersDAO = new TeachersDAO();
        $cpf = $queryParams['cpf'];
        $teachersDAO->deleteTeachers($cpf);

        $response = $response->withJson([
            'message' => 'Escola excluida com sucesso!'
        ]);

        return $response;
    }

}
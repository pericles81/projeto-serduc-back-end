<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\StudentsDAO;
use App\Models\StudentsModel;

final class StudentsController{

    public function getStudents(Request $request, Response $response, array $args): Response{

        $studentsDAO = new StudentsDAO();
        $students = $studentsDAO->getAllStudents();
        $response = $response->withJson($students);
        return $response;
    }

    public function getStudentsById(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $schoolsDAO = new SchoolsDAO();
        $school = $schoolsDAO->getStudentsById($id);
        
        if ($school) {
            $response = $response->withJson($school);
        } else {
            $response = $response->withJson(['message' => 'School not found'], 404);
        }
        
        return $response;
    }
    
    public function insertStudents(Request $request, Response $response, array $args): Response{

        $data = $request->getParsedBody();

        $studentsDAO = new StudentsDAO();

        $student = new StudentsModel();
        $dataNasc = new \DateTime($data['data_nasc']);

        $student->setCpf($data['cpf'])
        ->setNome($data['nome'])
        ->setSenha($data['senha'])
        ->setDataNasc($dataNasc)
        ->setTeacherId($data['teacher_id']);
   
        $studentsDAO->insertStudents($student);

        $response = $response->withJson(['messege'=>'Estudante inserido com sucesso!']);

        return $response;

    }

    public function updateStudents(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $schoolsDAO = new StudentsDAO();
        $school = new StudentsModel();
        $school->setId((int)$args['id'])
            ->setNome($data['nome'])
            ->setEndereco($data['endereco']);
        $schoolsDAO->updateStudents($school);

        $response = $response->withJson([
            'message' => 'Escola alterada com sucesso!'
        ]);

        return $response;
    }

    public function deleteStudents(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getParsedBody();

        $schoolsDAO = new SchoolsDAO();
        $id = (int)$queryParams['id'];
        $schoolsDAO->deleteStudents($id);

        $response = $response->withJson([
            'message' => 'Escola excluida com sucesso!'
        ]);

        return $response;
    }

}
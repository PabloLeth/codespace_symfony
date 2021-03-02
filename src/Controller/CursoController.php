<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Curso;
use Repository\CursoRepository;

class CursoController extends AbstractController
{
    /**
     * @Route("/curso", name="curso")
     */
    public function index(CursoRepository $repo): Response
    {
        $cursos = $repo->findAll();
        return $this->render('curso/index.html.twig', [
            'controller_name' => 'CursoController',
            'courses'=> $cursos
        ]);
    }
    /*
    * @Route ("curso/add" , name= "curso_add")
    */
    public function add(EntityManagerInterface $em): Response
    {
        $curso = new Curso ();
        $curso -> setNombre('Curso de Ingles');
        $curso -> setIdioma('Ingles');
        $curso -> setNivel(5);
        $em -> persist($curso);
        
    return $this -> render('index.html.twig', [
        'controller_name' => 'CursoController',
        'courses'=> $cursos
    ]);
    }
    
}
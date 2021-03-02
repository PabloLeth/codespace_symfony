<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Curso;
use App\Repository\CursoRepository;

    /**
     * @Route("/api/curso", name="apiCurso")
     */
class ApiCursoController extends AbstractController
{

     /**
     * @Route("/{id}", name="api_curso_show", methods={"GET"})
     */
    public function show($id , CursoRepository $repo): Response {
        $curso = $repo->find($id);
        
        if ($curso === null){
            throw $this-> createNotFoundException('the curso doesnt exist');
        }
        
        $alumnosArray=[];
        $alumnos=$curso->getAlumnos();
        foreach($alumnos as $alumno){
            $alumnoArray=[
                'id'=>$alumno->getId(),
                'nombre'=>$alumno->getNombre(),
                'email'=>$alumno->getEmail()
            ];
    
            $alumnosArray[]=$alumnoArray;
        }
        $cursos = [
            'nombre'=> $curso->getNombre(),
            'idioma'=> $curso->getIdioma(),
            'nivel'=> $curso->getnivel(),
            'alumnos'=>$alumnosArray
        ];
    
    
        
        return new JsonResponse($cursos);
    }

      /** 
      * @Route ("/new" , name= "api_curso_new", methods={"POST"})
      */
    public function newCourse( Request $request, EntityManagerInterface $em): Response {

        $bodyRequest = $request->getContent();
        $cursoArray = json_decode($bodyRequest);
        $curso = new Curso();
        $curso->setNombre($cursoArray->nombre);
        $curso->setIdioma($cursoArray->idioma);
        $curso->setNivel($cursoArray->nivel);
       $em->persist($curso);
        $em->flush();

        $respuesta= ['id'=>$curso->getId()];

        return new JsonResponse($respuesta);
    }


      /** 
      * @Route ("/update/{id}" , name= "api_curso_update", methods={"PUT"})
      */
      public function update($id, CursoRepository $cursoRepo, EntityManagerInterface $em, Request $request): Response {

        $bodyRequest = $request->getContent();
        $cursoArray = json_decode($bodyRequest);

        $curso = $cursoRepo->find($id);
        $curso->setNombre($cursoArray->nombre);
        $curso->setIdioma($cursoArray->idioma);
        $curso->setNivel($cursoArray->nivel);
       $em->persist($curso);
        $em->flush();

        $respuesta= ['id'=>$curso->getId()];

        return new JsonResponse($respuesta);
      }

            /** 
      * @Route ("/delete/{id}" , name= "api_curso_delete", methods={"DELETE"})
      */
      public function delete($id, CursoRepository $cursoRepo, EntityManagerInterface $em): Response {

       

        $curso = $cursoRepo->find($id);
        $cursonom = $curso->getNombre();
       $em->remove($curso);
        $em->flush();

        $respuesta= ['mensaje'=>"el curso: $cursonom eliminado"];

        return new JsonResponse($respuesta);
      }



    // /**
    //  * @Route("/curso", name="curso")
    //  */
    // public function index(CursoRepository $repo): Response
    // {
    //     $cursos = $repo->findAll();
    //     return $this->render('curso/index.html.twig', [
    //         'controller_name' => 'CursoController',
    //         'courses'=> $cursos
    //     ]);
    // }
    // /*
    // * @Route ("curso/add" , name= "curso_add")
    // */
    // public function add(EntityManagerInterface $em): Response
    // {
    //     $curso = new Curso ();
    //     $curso -> setNombre('Curso de Ingles');
    //     $curso -> setIdioma('Ingles');
    //     $curso -> setNivel(5);
    //     $em -> persist($curso);
        
    // return $this -> render('index.html.twig', [
    //     'controller_name' => 'CursoController',
    //     'courses'=> $cursos
    // ]);
    // }
    
}
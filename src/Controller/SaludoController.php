<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SaludoController extends AbstractController{

    /**
     * @Route ("/hola", name="hola")
     */
    public function hola(): Response {
$name = "Pablo";
return new Response('<html><body>Hola, '.$name.'</body></html>');
    }
 /**
     * @Route ("/adios", name="adios")
     */
    public function adios(): Response {
        $name = "Pablo";
        return new Response('<html><body>Adios, '.$name.' que tengas buen dia</body></html>');
            }
        
 /**
     * @Route ("/editar/{id}", name="editar")
     */
    public function editar($id): Response {
        $name = "Pablo";
        return new Response('<html><body>este es el id: '.$id.', es el que has puesto en la url</body></html>');
            }
 
            
 
         /**
     * @Route ("/employees/list", name="employees_list")
     */
    public function orderList(Request $request): Response {
        $orderBy = $request->query->get('orderby',"name");
        $page = $request->query->get('page', 1);

        $name = "Pablo";
        return new Response('<html><body>List order by: '.$orderBy.', y la page es '.$page.'</body></html>');
            }   
}


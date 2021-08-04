<?php

namespace App\Controller;

use Kreait\Firebase\Database;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(Database $database): Response
    {

        // //dump($database);
        // dd($database->getReference('User')->getValue());

        // dump($newKey);
        // $result = $database->getReference('User')->OrderByChild("email")->EqualTo("dhia.djobbi@gmail.com")->getValue();

        $userTable = $database->getReference('User');
        dd($userTable->orderByChild("email")
            ->equalTo("dhia.djobbi@gmail.com")
            ->getSnapshot()->getValue());

        die();

        //  $newKey =$database->getReference('User')->push()->getKey();
        // $database->getReference('User/'.$newKey."/")->set([
        //     'age' => 70,
        //     'email' => "wejden bedwi@gmail.com",
        //     'name' => 'heycha bakma',
        // ]);
        // dd($database->getReference('User')->getValue());

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 12/07/18
 * Time: 15:24
 */
namespace App\Controller;

use App\Form\SearchPersonType;
use App\Repository\PersonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(PersonRepository $personRepository)
    {
        $form = $this->createForm(SearchPersonType::class);

        $people = $personRepository->findAll();
        shuffle($people);
        $people = array_slice($people, 0, 6);

        return $this->render('index.html.twig', [
                'people' => $people,
                'form'    => $form->createView(),
            ]
        );
    }
}
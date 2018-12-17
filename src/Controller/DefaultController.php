<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 12/07/18
 * Time: 15:24
 */
namespace App\Controller;

use App\Form\SearchMovieType;
use App\Repository\MoviesRepository;
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
    public function index(MoviesRepository $movieRepository)
    {
        $form = $this->createForm(SearchMovieType::class);

        $movies = $movieRepository->findAll();
        return $this->render('index.html.twig', [
                'movies' => $movies,
                'form'    => $form->createView(),
            ]
        );
    }
}
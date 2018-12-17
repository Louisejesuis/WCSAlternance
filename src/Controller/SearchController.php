<?php

namespace App\Controller;

use App\Form\SearchMovieType;
use App\Repository\MoviesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, MoviesRepository $movieRepository)
    {
        $form = $this->createForm(SearchMovieType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchInput = $data['search'];
            // recherche par LIKE
            $movies = $movieRepository->advancedMovieSearch($searchInput);
            // si pas de resultat, recherche floue (metaphone + levenstein)
            if (empty($movies)) {
                $allMovies = $movieRepository->findAll();
                foreach ($allMovies as $movie) {
                    $titleWords = explode(' ', $movie->getName());
                    foreach ($titleWords as $word) {
                        if (
                            metaphone($word) === metaphone($searchInput)
                            ||
                            levenshtein($word, $searchInput) <= 3
                        ) {
                            $proposal = $word;
                            break;
                        }
                    }
                }
            }
        }

        return $this->render('search/index.html.twig', [
            'form'    => $form->createView(),
            'movies' => $movies ?? [],
        ]);
    }
}

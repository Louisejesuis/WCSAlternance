<?php

namespace App\Controller;

use App\Form\SearchPersonType;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, PersonRepository $personRepository)
    {
        $form = $this->createForm(SearchPersonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchInput = $data['search'];
            // recherche par LIKE
            $persons = $personRepository->advancedPersonSearch($searchInput);
            // si pas de resultat, recherche floue (metaphone + levenstein)
            if (empty($persons)) {
                $allPersons = $personRepository->findAll();
                foreach ($allPersons as $person) {
                    $titleWords = explode(' ', $person->getFirstName());
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
            'proposal' => $proposal ?? '',
            'persons' => $persons ?? [],
        ]);
    }
}

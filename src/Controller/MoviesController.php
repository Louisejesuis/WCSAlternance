<?php

namespace App\Controller;

use App\Entity\Movies;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\People;
use App\Form\MoviesType;
use App\Repository\MoviesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/movies")people_new
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies_index", methods="GET")
     */
    public function index(MoviesRepository $moviesRepository): Response
    {
        return $this->render('movies/index.html.twig', ['movies' => $moviesRepository->findAll()]);
    }

    /**
     * @Route("/new", name="movies_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $movie = new Movies();
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);
        $movie->setTrailerLink(str_replace('watch?v=', 'embed/', $movie->getTrailerLink()));
        $people = $this->getDoctrine()
        ->getRepository(People::class)
        ->findAll();
        $genre = $this->getDoctrine()
        ->getRepository(Genre::class)
        ->findAll();
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->findByFullName(get_current_user());
        $movie->setUser($user[0]);
        if(empty($people)) {
            $this->addFlash(
                'info',
                'Aucune personne n\'a été créé...<a href="/people/new">en créer une ?</a>'
            );
        }
        if(empty($genre)) {
            $this->addFlash(
                'info',
                'Aucun genre n\'a été créé...<a href="/genre/new">en créer un ?</a>'
            );
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('movies/new.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movies_show", methods="GET")
     * @var \App\Entity\User $user
     */
    public function show(Movies $movie): Response
    {
        $user = $this->getUser();
        return $this->render('movies/show.html.twig', ['movie' => $movie, 'user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="movies_edit", methods="GET|POST")
     */
    public function edit(Request $request, Movies $movie): Response
    {
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);
        $movie->setTrailerLink(str_replace('watch?v=', 'embed/', $movie->getTrailerLink()));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movies_show', ['id' => $movie->getId()]);
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movies_delete", methods="DELETE")
     */
    public function delete(Request $request, Movies $movie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movie);
            $em->flush();
        }

        return $this->redirectToRoute('movies_index');
    }


}

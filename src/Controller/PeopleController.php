<?php

namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
use App\Repository\PeopleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/people")
 */
class PeopleController extends Controller
{
    /**
     * @Route("/", name="people_index", methods="GET")
     */
    public function index(PeopleRepository $peopleRepository): Response
    {
        return $this->render('people/index.html.twig', ['people' => $peopleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="people_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $person = new People();
        $form = $this->createForm(PeopleType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('people_index');
        }

        return $this->render('people/new.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="people_show", methods="GET")
     */
    public function show(People $person): Response
    {
        return $this->render('people/show.html.twig', ['person' => $person]);
    }

    /**
     * @Route("/{id}/edit", name="people_edit", methods="GET|POST")
     */
    public function edit(Request $request, People $person): Response
    {
        $form = $this->createForm(PeopleType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('people_edit', ['id' => $person->getId()]);
        }

        return $this->render('people/edit.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="people_delete", methods="DELETE")
     */
    public function delete(Request $request, People $person): Response
    {
        if ($this->isCsrfTokenValid('delete'.$person->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirectToRoute('people_index');
    }
}

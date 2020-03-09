<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Helper\UserHelperTrait;
use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mods/brand")
 */
class BrandController extends AbstractController
{
    use UserHelperTrait;
    private string $adminPath = 'admin/';


    /**
     * @Route("/", name="brand_index", methods={"GET"})
     * @param BrandRepository $brandRepository
     * @return Response
     */
    public function index(BrandRepository $brandRepository): Response
    {
        return $this->render($this->adminPath . 'brand/index.html.twig', [
            'brands' => $brandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="brand_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {

        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brand->setCreatedAt($this->getCurrentDate());
            $brand->setCreatedBy($this->getCurrentUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render($this->adminPath . 'brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brand_show", methods={"GET"})
     * @param Brand $brand
     * @return Response
     */
    public function show(Brand $brand): Response
    {
        return $this->render($this->adminPath . 'brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="brand_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Brand $brand
     * @return Response
     */
    public function edit(Request $request, Brand $brand): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render($this->adminPath . 'brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brand_delete", methods={"DELETE"})
     * @param Request $request
     * @param Brand $brand
     * @return Response
     */
    public function delete(Request $request, Brand $brand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($brand);
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->adminPath . 'brand_index');
    }

}

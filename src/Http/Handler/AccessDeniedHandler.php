<?php


namespace App\Http\Handler;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler extends AbstractController implements AccessDeniedHandlerInterface
{





    /**
     * @inheritDoc
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        return  $this->redirectToRoute('app_home');

    }
}

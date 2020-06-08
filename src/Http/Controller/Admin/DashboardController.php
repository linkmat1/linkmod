<?php


namespace App\Http\Controller\Admin;




use App\Http\Controller\Admin\Core\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**

 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin", name="admin_")
 */
class DashboardController extends BaseController
{

    /**
     * @Route("/", name="dashboard" )
     **/
    public function index(): Response
    {

        return $this->render($this->prefixAdmin .'/dashboard.html.twig');
    }



}

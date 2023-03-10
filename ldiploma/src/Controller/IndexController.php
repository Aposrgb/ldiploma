<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Garb;
use App\Entity\User;
use App\Helper\DTO\ApplicationDTO;
use App\Helper\EnumStatus\ApplicationStatus;
use App\Repository\ApplicationRepository;
use App\Repository\GarbRepository;
use App\Repository\ServiceRepository;
use App\Repository\TariffRepository;
use App\Service\IndexService;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

class IndexController extends AbstractController
{
    #[Route("", name: "index", methods: ["GET"])]
    public function index(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route("/app/doc", name: "get_app_doc", methods: ["GET"])]
    public function getAppDoc(Request $request, IndexService $indexService, ApplicationRepository $applicationRepository): JsonResponse
    {
        $data = $request->query->all();
        if($data['id'] && $data['type']){
            if($data['type'] == 1 or $data['type'] == '1'){
                $link = $indexService->getContract($applicationRepository->find($data['id']));
            } else {
                $link = $indexService->getGrab($applicationRepository->find($data['id']));
            }
        }
        return $this->json(['link' => $link ?? null]);
    }

    #[Route("/lk/check", name: "check", methods: ["GET"])]
    public function check(Request $request, ApplicationRepository $applicationRepository): Response
    {
        $id = $request->query->get('id');
        if(!($app = $applicationRepository->find($id))){
            return $this->redirectToRoute('lk_admin');
        }
        return $this->render('check.html.twig', [
            'appl' => $app
        ]);
    }

    #[Route("/lk/check", name: "check_post", methods: ["POST"])]
    public function checkPost(Request $request, ApplicationRepository $applicationRepository, GarbRepository $garbRepository, SerializerInterface $serializer): Response
    {
        /** @var ApplicationDTO $appDTO */
        $appDTO = $serializer->deserialize(json_encode($request->request->all()), ApplicationDTO::class, 'json');
        $app = $applicationRepository->find($appDTO->getAppId());
        $app->setStatus(ApplicationStatus::APPROVED->value);
        $garbRepository->save(
            (new Garb())
                ->setDateVisit(new \DateTime($appDTO->getDateVisit()))
                ->setDopInform($appDTO->getDopInform())
                ->setTech($appDTO->getTech())
                ->setApp($app)
                ->setAddres(
                    ($user = $app->getOwner())->getType() == SecurityController::PHISIC ?
                        "Индекс: " . $user->getindex() . "
                         Область: " . $user->getlocality() . "
                         Район: " . $user->getdistrict() . "
                         Улица: " . $user->getstreet() . "
                         Дом: " . $user->gethouse() . "
                         Квартира: " . $user->getapartment()
                        : "Юридический адрес: " . $user->geturAddress() . " Почтовый адрес: " . $user->getpostAddress()
                ),true
        );
        return $this->render('check.html.twig', [
            'appl' => $app
        ]);
    }

    #[Route("/lk/delete", name: "delete", methods: ["GET"])]
    public function delete(Request $request, ApplicationRepository $applicationRepository): JsonResponse
    {
        $id = $request->query->get('id');
        if ($id) {
            $applicationRepository->remove($applicationRepository->find($id), true);
        }
        return $this->json([]);
    }

    #[Route("/lk/zayvaki", name: "lk_admin", methods: ["GET"])]
    public function lkAdmin(ApplicationRepository $applicationRepository): Response
    {
        return $this->render('f_admin.html.twig', [
            'apps' => $applicationRepository->findAll()
        ]);
    }

    #[Route("/lk", name: "lk", methods: ["GET"])]
    public function lk(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return $this->redirectToRoute('lk_admin');
        }
        if ($user->getType() == SecurityController::PHISIC) {
            $template = 'fuserdetails.html.twig';
        } else {
            $template = 'u_userdetails.html.twig';
        }
        return $this->render($template);
    }

    #[Route("/lk", name: "lk_post", methods: ["POST"])]
    public function lk_post(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        /** @var \UserDTO $userDTO */
        $userDTO = $serializer->deserialize(json_encode($request->request->all()), \UserDTO::class, 'json');
        /** @var User $user */
        $user = $this->getUser();
        if ($user->getType() == SecurityController::PHISIC) {
            $user
                ->setName($userDTO->getName())
                ->setSurname($userDTO->getSurname())
                ->setApartment($userDTO->getApartment())
                ->setDistrict($userDTO->getDistrict())
                ->setHouse($userDTO->getHouse())
                ->setLocality($userDTO->getLocality())
                ->setPassNumber($userDTO->getPassNumber())
                ->setPassSerias($userDTO->getPassSerias())
                ->setTelephone($userDTO->getTelephone())
                ->setIndex($userDTO->getIndex())
                ->setStreet($userDTO->getStreet())
                ->setPatronymic($userDTO->getPatronymic());
            $template = 'fuserdetails.html.twig';
        } else {
            $template = 'u_userdetails.html.twig';
            $user
                ->setTelephone($userDTO->getTelephone())
                ->setNameOrg($userDTO->getNameOrg())
                ->setBik($userDTO->getBik())
                ->setInn($userDTO->getInn())
                ->setKpp($userDTO->getKpp())
                ->setPostAddress($userDTO->getPostAddress())
                ->setUrAddress($userDTO->getUrAddress())
                ->setTrustPers($userDTO->getTrustPers());
        }
        $entityManager->flush();
        return $this->render($template);
    }

    #[Route ("/applications", name: "applications", methods: ["GET"])]
    public function application()
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->render("fzayvka.html.twig", ["applications" => $user->getApplications()->toArray()]);
    }

    #[Route ("/create-applications", name: "createapps", methods: ["GET"])]
    public function create_application(ServiceRepository $serviceRepository)
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user->getType() == SecurityController::PHISIC) {
            $services = $serviceRepository->findByType(SecurityController::PHISIC);
        } else {
            $services = $serviceRepository->findByType(SecurityController::UR);
        }
        return $this->render("fzayvka_1.html.twig", ["services" => $services]);
    }

    #[Route ("/create-applications", name: "create_apps_post", methods: ["POST"])]
    public function createApplicationPost(Request $request, TariffRepository $tariffRepository, EntityManagerInterface $entityManager)
    {
        $apps = json_decode($request->getContent(), true)['application'] ?? [];
        if (!empty($apps)) {
            $tariffsId = array_map(fn($item) => $item['id'], $apps);
            $tariffs = $tariffRepository->findBy(['id' => $tariffsId]);
        }
        /** @var User $user */
        $user = $this->getUser();
        foreach ($tariffs ?? [] as $tariff) {
            foreach ($apps as $app) {
                if ($app['id'] == $tariff->getId()) {
                    $user
                        ->addApplication(
                            (new Application())->addTariffe($tariff)->setCount($app['count'] ?: null)
                        );
                }
            }

        }
        $entityManager->flush();
        return $this->render("fzayvka.html.twig", ["applications" => $user->getApplications()->toArray()]);
    }
}
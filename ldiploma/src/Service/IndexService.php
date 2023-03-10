<?php

namespace App\Service;

use App\Controller\SecurityController;
use App\Entity\Application;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IndexService
{
    public function __construct(
        protected ParameterBagInterface $parameterBag,
    )
    {
    }

    public function getContract(Application $application): string
    {
        $user = $application->getOwner();
        $arr = [
            'январь',
            'февраль',
            'март',
            'апрель',
            'май',
            'июнь',
            'июль',
            'август',
            'сентябрь',
            'октябрь',
            'ноябрь',
            'декабрь'
        ];
        $dir = $this->parameterBag->get('DIRECTORY') . "/public/";
        if ($application->getOwner()->getType() == SecurityController::PHISIC) {
            $name = 'contract_f.docx';
            $templateProcessor = new TemplateProcessor($dir . $name);
            $templateProcessor->setValues([
                '{{app.id}}' => $application->getId(),
                '${{date}}' => $application->getCreatedAt()?->format('Y-m-d') ?? '',
                '{{telephone}}' => $user->getTelephone() ?? '',
                '{{surname}}' => $user->getSurname() ?? '',
                '{{name}}' => $user->getName() ?? '',
                '{{patron}}' => $user->getPatronymic() ?? '',
                '{{serP}}' => $user->getPassSerias(),
                '{{numP}}' => $user->getPassNumber(),
                '${{index}}' => $user->getIndex(),
                '${{location}}' => $user->getLocality(),
                '${{dis}}' => $user->getDistrict(),
                '${{house}}' => $user->getHouse(),
                '${{street}}' => $user->getStreet(),
                '${{apart}}' => $user->getApartment(),
                '{{index}}' => $user->getIndex(),
                '{{location}}' => $user->getLocality(),
                '{{dis}}' => $user->getDistrict(),
                '{{house}}' => $user->getHouse(),
                '{{street}}' => $user->getStreet(),
                '{{apart}}' => $user->getApartment(),
                '{{tar}}' => $application->getTariffes()->first()->getName(),
            ]);
        } else {
            $name = 'contract_u.docx';
            $templateProcessor = new TemplateProcessor($dir . $name);
            $templateProcessor->setValues([
                '${{app.id}}' => $application->getId(),
                '${{day}}' => $application->getCreatedAt()?->format('d'),
                '${{month}}' => $arr[((int)$application->getCreatedAt()->format('m')) - 1],
                '${{year}}' => $application->getCreatedAt()?->format('y'),
                '${{bik}}' => $user->getBik(),
                '${{inn}}' => $user->getInn(),
                '${{telephone}}' => $user->getTelephone() ?? '',
                '${{nameOrg}}' => $user->getNameOrg(),
                '${{kpp}}' => $user->getKpp(),
                '${{uAddress}}' => $user->getUrAddress(),
                '${{poAddress}}' => $user->getPostAddress(),
                '${{payAcc}}' => $user->getPayAcc(),
                '${{email}}' => $user->getEmail(),
                '${{price}}' => $application->getTariffes()->first()->getPrice() * $application->getCount(),
                '${{monthPrice}}' => $application->getTariffes()->first()->getPrice(),
            ]);
        }

        $fullName = "docs/" . $application->getOwner()->getId() . '_' . microtime() . '_' . $name;
        $templateProcessor->saveAs($dir . $fullName);
        return $fullName;
    }

    public function getGrab(Application $application): string
    {
        $name = "grab.docx";
        $dir = $this->parameterBag->get('DIRECTORY') . "/public/";
        $user = $application->getOwner();
        $templateProcessor = new TemplateProcessor($dir . $name);
        $templateProcessor->setValues([
            '${{app.id}}' => $application->getId(),
            '${{date}}' => $application->getCreatedAt()?->format('Y-m-d H:i'),
            '${{tech}}' => $application->getGarb()?->getTech() ?? '',
            '${{telephone}}' => $user->getTelephone() ?? '',
            '${{nameOrg}}' => $user->getNameOrg(),
            '${{index}}' => $user->getIndex(),
            '${{loc}}' => $user->getLocality(),
            '${{dis}}' => $user->getDistrict(),
            '${{house}}' => $user->getHouse(),
            '${{street}}' => $user->getStreet(),
            '${{apart}}' => $user->getApartment(),
            '${{sname}}' => $user->getSurname(),
            '${{name}}' => $user->getName() ?? '',
            '${{patron}}' => $user->getPatronymic() ?? '',
            '${{dopInform}}' => $application->getGarb()?->getDopInform()?? '',
        ]);
        $fullName = "docs/" . $application->getOwner()->getId() . '_' . microtime() . '_' . $name;
        $templateProcessor->saveAs($dir . $fullName);
        return $fullName;
    }
}
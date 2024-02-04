<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuCrudController extends AbstractCrudController

{
    const MENU_PAGES = 0;
    const MENU_ARTICLES = 1;
    const MENU_LINK = 2;
    const MENU_SUBJECTS = 3;


    public function __construct(
        private MenuRepository $menuRepo,
        private RequestStack $requestStack
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $submenuIndex = $this->getSubMenuIndex();

        return $this->menuRepo->getIndexQueryBuilder($this->getFieldNameFromSubMenuIndex($submenuIndex));
    }


    public function configureCrud(Crud $crud): Crud
    {
        $submenuIndex = $this->getSubMenuIndex();
        $entityLabelInSingular = 'un menu';

        $entityLabelInPlural = match ($submenuIndex) {
            self::MENU_ARTICLES => 'Articles',
            self::MENU_SUBJECTS => 'Subjects',
            self::MENU_LINK => 'liens personnalisés',
            default => 'Pages'
        };

        return $crud
            ->setEntityLabelInSingular($entityLabelInSingular)
            ->setEntityLabelInPlural($entityLabelInPlural);
    }



    public function configureFields(string $pageName): iterable
    {
        $submenuIndex = $this->getSubMenuIndex();

        yield TextField::new('name', 'Titre de la navigation');

        yield NumberField::new('menuOrder', 'Ordre');

        // ATTENTION BUG toujours pas de récupération des article_id, subject_id and link


        yield $this->getFieldFromSubMenuIndex($submenuIndex)
            ->setRequired(true);

        yield BooleanField::new('isVisible', 'Visible');

        yield AssociationField::new('subMenus', 'Sous-éléments');
    }

    private function getFieldNameFromSubMenuIndex($submenuIndex): string
    {
        return match ($submenuIndex) {
            self::MENU_ARTICLES => 'article',
            self::MENU_SUBJECTS => 'subject',
            self::MENU_LINK => 'link',
            default => 'page'
        };
    }

    private function getFieldFromSubMenuIndex($submenuIndex): AssociationField|TextField
    {
        $fieldName = $this->getFieldNameFromSubMenuIndex($submenuIndex);



        return ($fieldName === 'link') ? TextField::new($fieldName)->setLabel('Lien') : AssociationField::new($fieldName);
    }


    private function getSubMenuIndex(): int
    {
        $query = $this->requestStack->getMainRequest()->query;

        if ($referrer = $query->get('referrer')) {
            parse_str(parse_url($referrer, PHP_URL_QUERY), $query);

            return $query['submenuIndex'] ?? 0;
        }

        return $query->getInt('submenuIndex');
    }
}

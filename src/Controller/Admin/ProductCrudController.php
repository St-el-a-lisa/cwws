<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public const PRODUCT_BASE_PATH = 'upload/images/products';
    public const PRODUCT_UPLOAD_DIR = 'public/upload/images/products';

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->onlyOnDetail();
        yield TextField::new('name', 'Label');
        yield SlugField::new('slug')->setTargetFieldName('name');

        yield TextEditorField::new('description');
        yield MoneyField::new('price')->setRequired(true)->setCurrency('EUR');

        yield ImageField::new('image')
            ->setBasePath(self::PRODUCT_BASE_PATH)
            ->setUploadDir(self::PRODUCT_UPLOAD_DIR)
            ->setSortable(false);

        yield AssociationField::new('categories')
            ->formatValue(function ($value, $entity) {
                $subjectNames = [];
                foreach ($value as $subject) {
                    $subjectNames[] = $subject->getName();
                }
                return implode(', ', $subjectNames);
            });
        yield NumberField::new('totalStock')
            ->setLabel('Total Stock')->hideOnForm();


        yield BooleanField::new('active');
        yield TextareaField::new('featuredText', 'Featured Text (100 characters)');

        yield  DateTimeField::new('createdAt')->hideOnForm();
        yield  DateTimeField::new('updatedAt')->hideOnForm();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('active');
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}

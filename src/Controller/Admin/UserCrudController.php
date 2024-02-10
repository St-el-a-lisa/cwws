<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @method User getUser()
 */
class UserCrudController extends AbstractCrudController
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityRepository $entityRepo
    ) {
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {

        // IdField::new('id'),
        yield TextField::new('username');
        yield NumberField::new('matricule');
        yield TextField::new('email');
        yield ChoiceField::new('roles')
            ->allowMultipleChoices()
            ->renderAsBadges([
                'ROLE_ADMIN' => 'dark',
                'ROLE_AUTHOR' => 'info',
                'ROLE_VENDOR' => 'success'
            ])
            ->setChoices([
                'Administrateur' => 'ROLE_ADMIN',
                'Auteur' => 'ROLE_AUTHOR',
                'Conseiller' => 'ROLE_VENDOR'
            ]);
        yield BooleanField::new('Active');

        yield TextField::new('password')
            ->setFormType(PasswordType::class)
            ->onlyOnForms()
            ->setRequired(true)
            ->setFormTypeOptions([
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit comporter {{ limit }} caractères minimum.',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial(&!%$...).',
                    ]),
                ],
            ]);
    }

    // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     $user = $entityInstance;

    //     $plainPassword = $user->getPassword();
    //     $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

    //     $user->setPassword($hashedPassword);
    //     parent::persistEntity($entityManager, $entityInstance);
    // }

    // public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    // {
    //     $userId = $this->getUser()->getId();

    //     $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

    //     $qb->andWhere($qb->expr()->neq('entity.id', ':userId'))
    //         ->setParameter('userId', $userId);

    //     return $qb;
    // }
}

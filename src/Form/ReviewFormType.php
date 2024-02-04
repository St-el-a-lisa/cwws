<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre avis'
            ])
            ->add('product', HiddenType::class)
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer'
            ]);
        $builder->get('product')
            ->addModelTransformer(new CallbackTransformer(
                fn (Product $product) => $product->getId(),
                fn (Product $product) => $product->getName()
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}

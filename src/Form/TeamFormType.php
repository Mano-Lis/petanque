<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score')
            // ->add('players', CollectionType::class, [
            //     'entry_type' => PlayerFormType::class,
            //     'entry_options' => ['label' => false],
            //     'allow_add' => true,
            //     'allow_delete' => true
            // ])
            // ->add('players', CollectionType::class, [
            //         'entry_type' => EntityType::class,
            //         'entry_options' => [
            //             'class' => Player::class,
            //             'choice_label' => 'name',
            //             'by_reference' => false
            //         ],
            //         'allow_add' => true,
            //         'allow_delete' => true
            // ])
            ->add('players', EntityType::class, [
                'class' => Player::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}

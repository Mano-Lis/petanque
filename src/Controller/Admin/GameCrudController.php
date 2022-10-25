<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Form\PlayerFormType;
use App\Form\TeamFormType;
use App\Field\PlayersField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Game::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield DateTimeField::new('playedAt');
        yield TextField::new('result')
            ->setTemplatePath('admin/game/result.html.twig')
            ->hideOnForm();
        /*yield AssociationField::new('teams')
            ->hideOnIndex();
        yield CollectionField::new('playersTeam1')
            // ->useEntryCrudForm(PlayerCrudController::class)
            ->hideOnIndex()
            // ->setEntryType(PlayerFormType::class)
            ->setFormTypeOptions([
                'by_reference' => false
            ]);
        yield CollectionField::new('playersTeam2')
            ->hideOnIndex()
            // ->setEntryType(PlayerFormType::class)
            ->setFormTypeOptions([
                'by_reference' => false
            ]);
            // ->setEntryType(PlayerFormType::class);*/ 
        yield AssociationField::new('teams')
            ->setFormTypeOptions([
                'by_reference' => false
            ])
            ->hideOnIndex();           
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
    ;
}
    
}

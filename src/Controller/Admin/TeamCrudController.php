<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use App\Form\PlayerFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        if ($pageName === Crud::PAGE_INDEX) {
                yield AssociationField::new('players')
                    ->setTemplatePath('admin/team/players.html.twig');
        } else {
                yield AssociationField::new('players')
                    ->hideOnIndex();
        }
        yield AssociationField::new('game')
            // ->setFormTypeOption('choice_label', 'result')
            // ->setTemplatePath('admin/team/result.html.twig')
            ->hideOnForm();
        yield IntegerField::new('score')
            ->hideOnIndex();
    }
    
}

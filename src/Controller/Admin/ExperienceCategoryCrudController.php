<?php

namespace App\Controller\Admin;

use App\Entity\ExperienceCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExperienceCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
        ];
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController {
	public static function getEntityFqcn(): string {
		return User::class;
	}


	public function configureFields(string $pageName): iterable {
		yield IdField::new('id');
		yield TextField::new('firstName');
		yield TextField::new('lastName');
		yield BooleanField::new('enabled');
		yield DateField::new('createdAt');
	}
}

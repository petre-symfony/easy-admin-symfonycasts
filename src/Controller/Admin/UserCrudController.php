<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController {
	public static function getEntityFqcn(): string {
		return User::class;
	}


	public function configureFields(string $pageName): iterable {
		yield IdField::new('id')
			->onlyOnIndex();
		yield EmailField::new('email');
		yield TextField::new('fullName')
			->hideOnForm();
		yield Field::new('firstName');
		yield Field::new('lastName');
		yield BooleanField::new('enabled')
			->renderAsSwitch(false);
		yield DateField::new('createdAt');
	}
}

<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
		yield Field::new('firstName')
			->onlyOnForms();
		yield Field::new('lastName')
			->onlyOnForms();
		yield BooleanField::new('enabled')
			->renderAsSwitch(false);
		yield DateField::new('createdAt')
			->hideOnForm();
		$roles = ['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_MODERATOR', 'ROLE_USER'];
		yield ArrayField::new('roles')
			->setHelp('Available roles: ROLE_SUPER_ADMIN, ROLE_ADMIN, ROLE_MODERATOR, ROLE_USER')
			->setFormType(ChoiceType::class)
			->setFormTypeOptions([
				'choices' => array_combine($roles, $roles)
			]);
	}
}

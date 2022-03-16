<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class QuestionCrudController extends AbstractCrudController {
	public static function getEntityFqcn(): string {
		return Question::class;
	}


	public function configureFields(string $pageName): iterable {
		yield IdField::new('id')
			->onlyOnIndex();
		yield Field::new('name');
		yield Field::new('votes')
			->setLabel('Total Votes');
		yield Field::new('createdAt')
			->hideOnForm();
	}
}

<?php

namespace App\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VotesField implements FieldInterface {
	use FieldTrait;

	public static function new(string $propertyName, ?string $label = null) {
		return (new self())
			->setProperty($propertyName)
			->setLabel($label)
			->setTemplateName('crud/field/integer')
			->setFormType(IntegerType::class)
			->addCssClass('field-integer')
			->setDefaultColumns('col-md-4 col-xxl-3');
	}

	public function getAsDto(): FieldDto {
		// TODO: Implement getAsDto() method.
	}

}

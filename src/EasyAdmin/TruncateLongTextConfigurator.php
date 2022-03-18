<?php

namespace App\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldConfiguratorInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use function Symfony\Component\String\u;

class TruncateLongTextConfigurator implements FieldConfiguratorInterface {
	private const MAX_LENGTH = 25;

	public function supports(FieldDto $field, EntityDto $entityDto): bool {
		return $field->getFieldFqcn() === TextareaField::class;
	}

	public function configure(FieldDto $field, EntityDto $entityDto, AdminContext $context): void {
		if (strlen($field->getFormattedValue()) <= self::MAX_LENGTH) {
			return;
		};

		$truncatedValue = u($field->getFormattedValue())
			->truncate(self::MAX_LENGTH, '...', false);
		$field->setFormattedValue($truncatedValue);
	}

}

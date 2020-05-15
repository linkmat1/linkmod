<?php

namespace App\Tests\Validation;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ValidatorBuilder;


class CategoryValidationTest extends KernelTestCase
{


    public function getEntity(): Category
    {
        return (new Category())
            ->setName('21')
            ->setContent('Description de test')
            ->setCreatedAt(new \DateTime());
    }
    public function assertHasErrors(Category $category, int $number = 0)
    {
        $validator = new ValidatorBuilder();

        $errors = $validator->getValidator()->validate($category);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }
    public function testTitleValidation(){

        $this->assertHasErrors($this->getEntity()->setName('1'), 0);
    }
    public function testContentValidation():void {

        $this->assertHasErrors($this->getEntity()->setContent('0'), 1);
    }


}
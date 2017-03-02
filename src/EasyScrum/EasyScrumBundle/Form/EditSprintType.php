<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Sprint ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EditSprintType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
    ->add('nom', TextType::class, array(
          'label' => 'Nom',
          'required' => true,
    ))
    ->add('description', TextType::class, array(
          'label' => 'Description',
          'required' => false,
    ))
    ->add('dateStart' , DateType::class, array(
          'label' => 'Date début',
          'required' => true,
    ))
    ->add('dateEnd' , DateType::class, array(
          'label' => 'Date fin',
          'required' => true,
    ));

  }

  public function getName()
  {
    return "editSprintType";
  }

}

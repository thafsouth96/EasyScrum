<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Sprint;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CreateSprintType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $this->current_user = $options['current_user'];

    $builder
    ->add('name', TextType::class, array(
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

  public function configureOptions(OptionsResolver $resolver){

    $resolver->setDefaults(array(
        'data_calss' => 'EasyScrum\EasyScrumBundle\Entity\Sprint',
         'current_user'      => null,
    ));
  }


  public function getName()
  {
    return "CreateSprintType";
  }


  }

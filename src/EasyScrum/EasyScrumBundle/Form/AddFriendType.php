<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Projet ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddFriendType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
    ->add('nom', TextType::class, array(
          'label' => 'Nom',
          'required' => true,
    ));

  }

/*  public function configureOptions(OptionsResolver $resolver){

    $resolver->setDefaults(array(
        'data_calss' => 'EasyScrum\EasyScrumBundle\Entity\User',
    ));
  }*/


  public function getName()
  {
    return "AddFriendType";
  }


  }
?>

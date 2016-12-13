<?php
 namespace EasyScrum\EasyScrumBundle\Form ;

use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Form\FormBuilderInterface;
use EasyScrum\EasyScrumBundle\Entity\Release1 ;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyScrum\EasyScrumBundle\Repository\ProjetRepository;

class CreateRelease extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $this->current_user = $options['current_user'];

    $builder
    ->add('nom', TextType::class, array(
          'label' => 'Nom',
          'required' => true,
    ))
    ->add('description', TextType::class, array(
          'label' => 'Description',
          'required' => false,

    ))
    ->add('dateLivraisonP' , DateType::class, array(
          'label' => 'Date livraison prévisionnel',
          'required' => false,
    ))
    ->add('projet', ChoiceType::class, array(
              //'class' => 'EasyScrumEasyScrumBundle:Projet',
              /*'query_builder'=> function (ProjetRepository $pr) {
                  var_dump($this->current_user);
                    return $pr->findProjectsByUser($this->current_user);
                }*/
                'choices' => $this->current_user->getProjets(),
                'placeholder' => 'Sélectionner un projet',
    ));
  }

  public function configureOptions(OptionsResolver $resolver){

    $resolver->setDefaults(array(
        'data_calss' => 'EasyScrum\EasyScrumBundle\Entity\Release1',
         'current_user'      => null,
    ));
  }


  public function getName()
  {
    return "CreateReleaseForm";
  }


  }

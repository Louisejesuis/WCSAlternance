<?php

namespace App\Form;

use App\Entity\Movies;
use App\Entity\People;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, array('label' => 'Nom'))
        ->add('releaseDate', DateType::class, ['label' => 'Date de sortie'])
        ->add('synopsis',TextareaType::class,  ['label' => 'Synopsis'])
        ->add('trailerLink',UrlType::class,  ['label' => 'Lien de la bande-annonce'])
        ->add('duration', IntegerType::class, ['label' => 'Durée du film ( en minutes )'])
       ->add('director', EntityType::class, ['class' => People::class, 'label' => 'Directeur', 'multiple' => true])
        ->add('writer', EntityType::class, ['class' => People::class, 'label' => 'Ecrivain', 'multiple' => true])
        ->add('actor', EntityType::class, ['class' => People::class, 'label' => 'Acteurs', 'multiple' => true])
        ->add('genre', EntityType::class, ['class' => Genre::class, 'label' => 'Genre du film', 'choice_label' => 'name', 'multiple' => true])
            ->add('imageFile', VichFileType::class, array(
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Choisir un fichier',
                'label' => "Affiche du film",
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}

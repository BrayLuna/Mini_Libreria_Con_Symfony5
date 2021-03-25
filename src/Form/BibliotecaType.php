<?php

namespace App\Form;

use App\Entity\Biblioteca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliotecaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
        $builder
            ->add('titulo')
            ->add('descripcion',TextareaType::class)
            ->add('autor')
            ->add('portada',FileType::class,['label'=>'Selecciona una nueva imagen','mapped'=> false,'required'=>false])
            ->add('descripcionCorta',TextareaType::class)
            ->add('ISBN')
            ->add('editorial')
            ->add('paginas')
            ->add('edicion')
            ->add('pais')
            ->add('lanzamiento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Biblioteca::class,
        ]);
    }
}

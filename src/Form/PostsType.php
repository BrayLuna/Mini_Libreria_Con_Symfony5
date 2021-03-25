<?php

namespace App\Form;

use App\Entity\Biblioteca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use function PHPSTORM_META\type;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcionCorta', TextareaType::class)
            ->add('descripcion', TextareaType::class)
            ->add('autor')
            ->add('ISBN')
            ->add('editorial')
            ->add('edicion')
            ->add('paginas')
            ->add('pais')
            ->add('lanzamiento')
            ->add('portada', FileType::class, ['label' => 'Selecciona una imagen', 'mapped' => false, 'required' => false])
            ->add('guardar', type: SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Biblioteca::class,
        ]);
    }
}

<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Upload;


class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('file', FileType::class, [
                'label' => 'Microsoft Office file',
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
                            'application/vnd.ms-word.document.macroEnabled.12',
                            'application/vnd.ms-word.template.macroEnabled.12',
                            'application/vnd.ms-excel',
                            'application/vnd.ms-excel',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
                            'application/vnd.ms-excel.sheet.macroEnabled.12',
                            'application/vnd.ms-excel.template.macroEnabled.12',
                            'application/vnd.ms-excel.addin.macroEnabled.12',
                            'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'application/vnd.openxmlformats-officedocument.presentationml.template',
                            'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
                            'application/vnd.ms-powerpoint.addin.macroEnabled.12',
                            'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
                            'application/vnd.ms-powerpoint.template.macroEnabled.12',
                            'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid MS Office document',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}

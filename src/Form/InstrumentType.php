<?php

namespace App\Form;

use App\Entity\Instrument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InstrumentType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $lucky = 100;     
        $builder
            ->add('symbol', ChoiceType::class, [
                'choices'  => [
                    'Apple Inc.' => 'AAPL',
                    'Alphabet Inc.' => 'GOOG',
                    'Microsoft' => 'MSFT',
                    'Target Corporation' => 'TGT',
                    'Walmart' => 'WMT',
                    ],
                ]
            );
                $builder
                ->add ('quantity',ChoiceType::class, [
                    'choices'  => [
                        '1' => 1,
                        '5' => 5,
                        '10' => 10,
                        '15' => 15,
                        '20' => 20,
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
            'data_class' => Instrument::class,           
        ]);        
    }
}

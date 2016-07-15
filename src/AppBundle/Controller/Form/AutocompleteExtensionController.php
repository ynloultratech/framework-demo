<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use AppBundle\Entity\Continent;
use AppBundle\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\TagsType;

class AutocompleteExtensionController extends DefaultController
{
    const TITLE = 'AutoComplete';
    const ICON = 'list-alt';

    /**
     * @Route(path="/form/extensions/auto_complete", name="form_extension_auto_complete")
     */
    public function defaultAction(Request $request)
    {
        $form = $this->get('form.factory')->create();

        $form->add(
            'continent', ChoiceType::class,
            [
                'autocomplete' => 'name',
                'label' => 'AutoComplete (Select2)',
                'class' => Continent::class,
            ]
        );
        $form->add(
            'autocomplete_chained', EntityType::class,
            [
                'autocomplete' => ['name', 'iso', 'phoneCode'],
                'autocomplete_related_fields' => ['continent'],
                'label' => 'AutoComplete (chained)',
                'class' => Country::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('c')
                        ->where('c.continent = :continent');
                },
                'select2_template_result' => 'forms\autocomplete\country_item_choice_template.html.twig',
                'select2_template_selection' => 'forms\autocomplete\country_item_selection_template.html.twig'
            ]
        );

        $form->add(
            'autocomplete_multiple', EntityType::class,
            [
                'multiple' => true,
                'autocomplete' => ['name', 'iso', 'phoneCode'],
                'label' => 'AutoComplete (Select2-multiple)',
                'class' => Country::class,
                'select2_template_result' => 'forms\autocomplete\country_item_choice_template.html.twig',
                'select2_template_selection' => 'forms\autocomplete\country_item_selection_template.html.twig'
            ]
        );

        $form->add(
            'autocomplete_tags', TagsType::class,
            [
                'multiple' => true,
                'autocomplete' => 'iso',
                'label' => 'AutoComplete (Tags)',
                'class' => Country::class,
            ]
        );

        $form->add(
            'autocomplete_text', TextType::class,
            [
                'autocomplete' => 'name',
                'class' => Country::class,
                'label' => 'AutoComplete (Text-remote)',
            ]
        );

        $form->add(
            'autocomplete_text_local', TextType::class,
            [
                'autocomplete' => ['PHP', 'ASP', 'Phyton', 'JavaScript', 'CSS', 'HTML'],
                'label' => 'AutoComplete (Text-local)',
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}

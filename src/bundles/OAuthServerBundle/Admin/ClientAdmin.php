<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\OAuthServerBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use OAuth2\OAuth2;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ClientAdmin extends Admin
{
    /**
     * Override method, add default values
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = parent::getNewInstance();
        $object->setAllowedGrantTypes(
            //array('authorization_code','password','refresh_token','token','client_credentials')
            array('authorization_code', 'refresh_token', 'client_credentials')
        );
        return $object;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        if (($id = $subject->getId())) {
            $formMapper
                ->with('bruery_oauth_server_tab_general', array('class' => 'col-md-8'))
                    ->add('getId', 'text', array(
                        'attr'     => array(
                            'readonly' => true),
                        'data'     => $id,
                        'required' => false,
                        'mapped'   => false)
                    )
                ->end();
        }

        $formMapper
            ->with('bruery_oauth_server_tab_general', array('class' => 'col-md-8'))
                ->add('code', null, array('attr' => array('style' => 'font-weight:bold;color:#3A87AD;')))
                ->add('name', null, array('attr' => array()))
                ->add('description', 'textarea', array('required' => false,
                                                       'attr'     => array('rows'=> 5)))
            ->end();

        if ($subject->getId()) {
            $publicId = $subject->getPublicId();
            $formMapper
                ->with('bruery_oauth_server_tab_settings', array('class' => 'col-md-4'))
                    ->add('getPublicId', 'text', array(
                        'attr'     => array('readonly' => true),
                        'data'     => $publicId,
                        'required' => false,
                        'mapped'   => false)
                    )
                ->end();
        }

        $formMapper
            ->with('bruery_oauth_server_tab_settings', array('class' => 'col-md-4'))
                ->add('secret', null, array('attr' => array('readonly' => true), 'required' => false))
            ->end()
        ;

        $formMapper
            ->with('bruery_oauth_server_tab_urls', array('class' => 'col-md-12'))
            ->add('redirectUris', 'sonata_type_native_collection',
                array(
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'type'         => 'url',
                    'error_bubbling' => false,
                    'options'      => array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'span12'
                        )
                    )
                ))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('randomId', null)
            ->add('secret')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('getPublicId', null, array('footable'=>array('attr'=>array('data-breakpoints'=>array('xs', 'sm')))))
        ;
    }
}

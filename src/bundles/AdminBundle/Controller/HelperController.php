<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\HelperController as BaseHelperController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;

class HelperController extends BaseHelperController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function setObjectFieldValueAction(Request $request)
    {
        $field = $request->get('field');
        $code = $request->get('code');
        $objectId = $request->get('objectId');
        $value = $request->get('value');
        $context = $request->get('_context');

        $admin = $this->pool->getInstance($code);
        $admin->setRequest($request);

        // alter should be done by using a post method
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('status' => 'KO', 'message' => 'Expected a XmlHttpRequest request header'));
        }

        if ($request->getMethod() != 'POST') {
            return new JsonResponse(array('status' => 'KO', 'message' => 'Expected a POST Request'));
        }

        $rootObject = $object = $admin->getObject($objectId);

        if (!$object) {
            return new JsonResponse(array('status' => 'KO', 'message' => 'Object does not exist'));
        }

        // check user permission
        if (false === $admin->isGranted('EDIT', $object)) {
            return new JsonResponse(array('status' => 'KO', 'message' => 'Invalid permissions'));
        }

        if ($context == 'list') {
            $fieldDescription = $admin->getListFieldDescription($field);
        } else {
            return new JsonResponse(array('status' => 'KO', 'message' => 'Invalid context'));
        }

        if (!$fieldDescription) {
            return new JsonResponse(array('status' => 'KO', 'message' => 'The field does not exist'));
        }

        if (!$fieldDescription->getOption('editable')) {
            return new JsonResponse(array('status' => 'KO', 'message' => 'The field cannot be edit, editable option must be set to true'));
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $propertyPath = new PropertyPath($field);

        // If property path has more than 1 element, take the last object in order to validate it
        if ($propertyPath->getLength() > 1) {
            $object = $propertyAccessor->getValue($object, $propertyPath->getParent());

            $elements = $propertyPath->getElements();
            $field = end($elements);
            $propertyPath = new PropertyPath($field);
        }

        // Handle date type has setter expect a DateTime object
        if ('' !== $value && $fieldDescription->getType() == 'date') {
            $value = new \DateTime($value);
        }

        if ('' !== $value && $fieldDescription->getType() == 'datetime') {
            $value = new \DateTime($value);
        }

        $propertyAccessor->setValue($object, $propertyPath, '' !== $value ? $value : null);

        $violations = $this->validator->validate($object);

        if (count($violations)) {
            $messages = array();

            foreach ($violations as $violation) {
                $messages[] = $violation->getMessage();
            }

            return new JsonResponse(array('status' => 'KO', 'message' => implode("\n", $messages)));
        }

        $admin->update($object);

        // render the widget
        // todo : fix this, the twig environment variable is not set inside the extension ...
        $extension = $this->twig->getExtension('sonata_admin');
        $extension->initRuntime($this->twig);

        $content = $extension->renderListElement($this->twig, $rootObject, $fieldDescription);

        return new JsonResponse(array('status' => 'OK', 'content' => $content));
    }
}

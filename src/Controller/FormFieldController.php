<?php

   namespace Grayl\Input\Form\Controller;

   use Grayl\Input\Form\Entity\FormFieldData;
   use Grayl\Input\Form\Entity\FormFieldValidation;
   use Grayl\Input\Form\Service\FormFieldService;
   use Grayl\Input\Form\Service\FormFieldValidationService;

   /**
    * Class FormFieldController
    * The controller for working with an individual form field
    *
    * @package Grayl\Input\Form
    */
   class FormFieldController
   {

      /**
       * The FormFieldData instance to interact with
       *
       * @var FormFieldData
       */
      private FormFieldData $form_field_data;

      /**
       * The FormFieldValidation instance to interact with
       *
       * @var FormFieldValidation
       */
      private FormFieldValidation $validation;

      /**
       * The FormFieldService instance to interact with
       *
       * @var FormFieldService
       */
      private FormFieldService $form_field_service;

      /**
       * The FormFieldValidationService instance to interact with
       *
       * @var FormFieldValidationService
       */
      private FormFieldValidationService $validation_service;


      /**
       * The class constructor
       *
       * @param FormFieldData              $form_field_data    The FormFieldData instance to work with
       * @param FormFieldValidation        $validation         The FormFieldValidation instance to work with
       * @param FormFieldService           $form_field_service The FormFieldService instance to use
       * @param FormFieldValidationService $validation_service The FormFieldValidationService instance to use
       */
      public function __construct ( FormFieldData $form_field_data,
                                    FormFieldValidation $validation,
                                    FormFieldService $form_field_service,
                                    FormFieldValidationService $validation_service )
      {

         // Set the data
         $this->form_field_data = $form_field_data;
         $this->validation      = $validation;

         // Set the services
         $this->form_field_service = $form_field_service;
         $this->validation_service = $validation_service;
      }


      /**
       * Gets the field's ID
       *
       * @return string
       */
      public function getID (): string
      {

         // Return the ID
         return $this->form_field_data->getID();
      }


      /**
       * Gets the field's sanitized value
       *
       * @return mixed
       */
      public function getSanitizedFormFieldValue ()
      {

         // Return the value
         return $this->form_field_service->getSanitizedFormFieldValue( $this->form_field_data );
      }


      /**
       * Validates the field's sanitized value using the service
       *
       * @return bool
       */
      public function isFormFieldValid (): bool
      {

         // Return the value
         return $this->validation_service->isFormFieldValid( $this->getSanitizedFormFieldValue(),
                                                             $this->form_field_data,
                                                             $this->validation );
      }

   }
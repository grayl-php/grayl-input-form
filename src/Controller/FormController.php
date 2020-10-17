<?php

   namespace Grayl\Input\Form\Controller;

   use Grayl\Input\Form\Entity\FormData;
   use Grayl\Input\Form\Service\FormService;

   /**
    * Class FormController
    * The controller for working with a group of form fields
    *
    * @package Grayl\Input\Form
    */
   class FormController
   {

      /**
       * The FormData instance to interact with
       *
       * @var FormData
       */
      private FormData $form_data;

      /**
       * The FormService instance to interact with
       *
       * @var FormService
       */
      private FormService $form_service;


      /**
       * The class constructor
       *
       * @param FormData    $form_data    The FormData instance to work with
       * @param FormService $form_service The FormService instance to use
       */
      public function __construct ( FormData $form_data,
                                    FormService $form_service )
      {

         // Set the data
         $this->form_data = $form_data;

         // Set the service
         $this->form_service = $form_service;
      }


      /**
       * Puts a new FormFieldController entity into the form
       *
       * @param FormFieldController $form_field The form field entity to store
       */
      public function putFormField ( FormFieldController $form_field ): void
      {

         // Store the field
         $this->form_data->putFormField( $form_field );
      }


      /**
       * Retrieves a FormFieldController from the form using its ID
       *
       * @param string $field_id The ID of the form field to retrieve
       *
       * @return FormFieldController
       */
      public function getFormField ( string $field_id ): FormFieldController
      {

         // Use the bag function to retrieve the field
         return $this->form_data->getFormField( $field_id );
      }


      /**
       * Puts multiple FormFieldController entities into the bag of fields using a passed array
       *
       * @param FormFieldController[] $form_fields The fields to store
       */
      public function putFormFields ( array $form_fields ): void
      {

         // Store the field
         $this->form_data->putFormFields( $form_fields );
      }


      /**
       * Returns the array of created field entities
       *
       * @return FormFieldController[]
       */
      public function getFormFields (): array
      {

         // Use the bag function to retrieve the fields
         return $this->form_data->getFormFields();
      }


      /**
       * Validates every field in this form using the service
       *
       * @return bool
       */
      public function isFormValid (): bool
      {

         // Return the value
         return $this->form_service->isFormDataValid( $this->form_data );
      }

   }
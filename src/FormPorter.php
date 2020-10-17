<?php

   namespace Grayl\Input\Form;

   use Grayl\Input\Form\Controller\FormController;
   use Grayl\Input\Form\Controller\FormFieldController;
   use Grayl\Input\Form\Entity\FormData;
   use Grayl\Input\Form\Entity\FormFieldData;
   use Grayl\Input\Form\Entity\FormFieldValidation;
   use Grayl\Input\Form\Service\FormFieldService;
   use Grayl\Input\Form\Service\FormFieldValidationService;
   use Grayl\Input\Form\Service\FormService;
   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * Front-end for the Form package
    *
    * @package Grayl\Input\Form
    */
   class FormPorter
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * Creates a new FormController entity
       *
       * @return FormController
       */
      public function newFormController (): FormController
      {

         // Return the entity
         return new FormController( new FormData(),
                                    new FormService() );
      }


      /**
       * Creates a new string FormFieldController entity
       *
       * @param string $id               The ID of the field
       * @param string $source           The source of the value ( post, get )
       * @param bool   $strip_whitespace Strip all whitespace characters from the field value before validating
       * @param bool   $required         If a value is required for this field
       * @param ?int   $minimum          The minimum string length (optional)
       * @param ?int   $maximum          The maximum string length (optional)
       *
       * @return FormFieldController
       */
      public function newStringFormField ( string $id,
                                           string $source,
                                           bool $strip_whitespace,
                                           bool $required,
                                           ?int $minimum,
                                           ?int $maximum ): FormFieldController
      {

         // Create a FormFieldData entity for a string
         $form_field_data = new FormFieldData( $id,
                                               'string',
                                               $source,
                                               $strip_whitespace );

         // Create a FormFieldValidation entity for a string
         $validation = new FormFieldValidation( $required,
                                                $minimum,
                                                $maximum,
                                                null );

         // Return the entity
         return new FormFieldController( $form_field_data,
                                         $validation,
                                         new FormFieldService(),
                                         new FormFieldValidationService() );
      }


      /**
       * Creates a new boolean FormFieldController entity
       *
       * @param string $id       The ID of the field
       * @param string $source   The source of the value ( post, get )
       * @param bool   $required If a value is required for this field
       *
       * @return FormFieldController
       */
      public function newBooleanFormField ( string $id,
                                            string $source,
                                            bool $required ): FormFieldController
      {

         // Create a FormFieldData entity for a boolean
         $form_field_data = new FormFieldData( $id,
                                               'boolean',
                                               $source,
                                               false );

         // Create a FormFieldValidation entity for a boolean
         $validation = new FormFieldValidation( $required,
                                                null,
                                                null,
                                                null );

         // Return the entity
         return new FormFieldController( $form_field_data,
                                         $validation,
                                         new FormFieldService(),
                                         new FormFieldValidationService() );
      }


      /**
       * Creates a new integer FormFieldController entity
       *
       * @param string $id       The ID of the field
       * @param string $source   The source of the value ( post, get )
       * @param bool   $required If a value is required for this field
       * @param ?int   $minimum  The minimum string length (optional)
       * @param ?int   $maximum  The maximum string length (optional)
       *
       * @return FormFieldController
       */
      public function newIntegerFormField ( string $id,
                                            string $source,
                                            bool $required,
                                            ?int $minimum,
                                            ?int $maximum ): FormFieldController
      {

         // Create a FormFieldData entity for an integer
         $form_field_data = new FormFieldData( $id,
                                               'integer',
                                               $source,
                                               false );

         // Create a FormFieldValidation entity for an integer
         $validation = new FormFieldValidation( $required,
                                                $minimum,
                                                $maximum,
                                                null );

         // Return the entity
         return new FormFieldController( $form_field_data,
                                         $validation,
                                         new FormFieldService(),
                                         new FormFieldValidationService() );
      }


      /**
       * Creates a new regular expression FormFieldController entity
       *
       * @param string $id                 The ID of the field
       * @param string $source             The source of the value ( post, get )
       * @param bool   $required           If a value is required for this field
       * @param string $regular_expression A regular expression to validate against
       *
       * @return FormFieldController
       */
      public function newRegularExpressionFormField ( string $id,
                                                      string $source,
                                                      bool $required,
                                                      string $regular_expression ): FormFieldController
      {

         // Create a FormFieldData entity for a regular expression
         $form_field_data = new FormFieldData( $id,
                                               'regular_expression',
                                               $source,
                                               false );

         // Create a FormFieldValidation entity for a regular expression
         $validation = new FormFieldValidation( $required,
                                                null,
                                                null,
                                                $regular_expression );

         // Return the entity
         return new FormFieldController( $form_field_data,
                                         $validation,
                                         new FormFieldService(),
                                         new FormFieldValidationService() );
      }


      /**
       * Creates a new email address FormFieldController entity
       *
       * @param string $id       The ID of the field
       * @param string $source   The source of the value ( post, get )
       * @param bool   $required If a value is required for this field
       *
       * @return FormFieldController
       */
      public function newEmailAddressFormField ( string $id,
                                                 string $source,
                                                 bool $required ): FormFieldController
      {

         // Create a FormFieldData entity for an email address
         $form_field_data = new FormFieldData( $id,
                                               'email_address',
                                               $source,
                                               false );

         // Create a FormFieldValidation entity for an email address
         $validation = new FormFieldValidation( $required,
                                                null,
                                                null,
                                                null );

         // Return the entity
         return new FormFieldController( $form_field_data,
                                         $validation,
                                         new FormFieldService(),
                                         new FormFieldValidationService() );
      }

   }
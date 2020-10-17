<?php

   namespace Grayl\Input\Form\Entity;

   use Grayl\Input\Form\Controller\FormFieldController;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class FormData
    * The data element of a FormController
    *
    * @package Grayl\Input\Form
    */
   class FormData
   {

      /**
       * A KeyedDataBag of all FormFieldController entities in this form
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $form_fields;


      /**
       * The class constructor
       */
      public function __construct ()
      {

         // Create the KeyedDataBag
         $this->form_fields = new KeyedDataBag();
      }


      /**
       * Puts a new FormFieldController entity into the bag of fields
       *
       * @param FormFieldController $field The field entity to store
       */
      public function putFormField ( FormFieldController $field ): void
      {

         // Store the field entity by its ID
         $this->form_fields->setVariable( $field->getID(),
                                          $field );
      }


      /**
       * Puts multiple FormFieldController entities into the bag of fields using a passed array
       *
       * @param FormFieldController[] $form_fields The fields to store
       */
      public function putFormFields ( array $form_fields ): void
      {

         // Loop through each form field
         foreach ( $form_fields as $form_field ) {
            // Store the field entity by its ID
            $this->form_fields->setVariable( $form_field->getID(),
                                             $form_field );
         }
      }


      /**
       * Retrieves a FormFieldController from the bag using its ID
       *
       * @param string $id The ID of the form field to retrieve
       *
       * @return FormFieldController
       */
      public function getFormField ( string $id ): FormFieldController
      {

         // Return the item from the bag
         return $this->form_fields->getVariable( $id );
      }


      /**
       * Returns all fields in the bag
       *
       * @return FormFieldController[]
       */
      public function getFormFields (): array
      {

         // Return all field entities
         return $this->form_fields->getVariables();
      }

   }
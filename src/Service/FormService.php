<?php

   namespace Grayl\Input\Form\Service;

   use Grayl\Input\Form\Entity\FormData;

   /**
    * Class FormService
    * The service for working with forms
    *
    * @package Grayl\Input\Form
    */
   class FormService
   {

      /**
       * Validates each field inside of a FormData entity
       *
       * @param FormData $form_data A FormData instance to validate
       *
       * @return bool
       */
      public function isFormDataValid ( FormData $form_data ): bool
      {

         // Loop through each form field
         foreach ( $form_data->getFormFields() as $form_field ) {
            // Call the fields validation routine
            if ( ! $form_field->isFormFieldValid() ) {
               // Invalid form field
               return false;
            }
         }

         // Valid form
         return true;
      }

   }
<?php

   namespace Grayl\Input\Form\Service;

   use Grayl\Input\Form\Entity\FormFieldData;

   /**
    * Class FormFieldService
    * The service for working with form fields
    *
    * @package Grayl\Input\Form
    */
   class FormFieldService
   {

      /**
       * Gets a form field's raw value from POST or GET
       *
       * @param FormFieldData $form_field A FormFieldData instance to work with
       *
       * @return string
       */
      public function getRawFormFieldValue ( FormFieldData $form_field ): ?string
      {

         // Set the field ID
         $id = $form_field->getID();

         // For a value in GET
         if ( ( strtolower( $form_field->getSource() ) == 'get' ) && ( ! empty( $_GET[ $id ] ) ) ) {
            // Return the value from GET
            return $_GET[ $id ];
         }

         // For a value in POST
         if ( ( strtolower( $form_field->getSource() ) == 'post' ) && ( ! empty( $_POST[ $id ] ) ) ) {
            // Return the value from POST
            return $_POST[ $id ];
         }

         // No value found
         return null;
      }


      /**
       * Gets a form field's sanitized value
       *
       * @param FormFieldData $form_field A FormFieldData instance to work with
       *
       * @return string
       */
      public function getSanitizedFormFieldValue ( FormFieldData $form_field ): ?string
      {

         // Trim whitespace from the front and back of the value
         $raw_value = trim( $this->getRawFormFieldValue( $form_field ) );

         // Strip whitespaces if needed
         if ( $form_field->doStripWhitespace() ) {
            $raw_value = $this->stripWhitespace( $raw_value );
         }

         // Clean the value based on the field type
         switch ( $form_field->getType() ) {
            // Integer
            case 'integer':
               return $this->sanitizeInteger( $raw_value );
               break;

            // Email
            case 'email_address':
               return $this->sanitizeEmailAddress( $raw_value );
               break;

            // String, boolean, regular expression
            case 'string':
            case 'boolean';
            case 'regular_expression';
               return $this->sanitizeString( $raw_value );
               break;
         }

         // No field type match
         return null;
      }


      /**
       * Sanitizes a string
       *
       * @param string $raw_string A raw string to sanitize
       *
       * @return string
       */
      public function sanitizeString ( string $raw_string ): ?string
      {

         // If the value is empty, return
         if ( empty( $raw_string ) ) {
            // No value to clean
            return null;
         }

         // Return the sanitized version
         return (string) filter_var( $raw_string,
                                     FILTER_SANITIZE_STRING );
      }


      /**
       * Sanitize an integer
       *
       * @param string $raw_integer A raw integer to sanitize
       *
       * @return int
       */
      public function sanitizeInteger ( $raw_integer ): ?int
      {

         // If the value is empty, return
         if ( empty( $raw_integer ) ) {
            // No value to clean
            return null;
         }

         // Return the sanitized version
         return (int) filter_var( $raw_integer,
                                  FILTER_SANITIZE_NUMBER_INT );
      }


      /**
       * Sanitize an email address
       *
       * @param string $raw_email_address A raw email address to sanitize
       *
       * @return string
       */
      public function sanitizeEmailAddress ( string $raw_email_address ): ?string
      {

         // If the value is empty, return
         if ( empty( $raw_email_address ) ) {
            // No value to clean
            return null;
         }

         // Replace harmful characters
         $email_address = preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i',
                                        '',
                                        $raw_email_address );

         // Return the sanitized version
         return (string) filter_var( $email_address,
                                     FILTER_SANITIZE_EMAIL );
      }


      /**
       * Strips whitespace from a value
       *
       * @param string $value A value to strip whitespace from
       *
       * @return string
       */
      private function stripWhitespace ( string $value ): ?string
      {

         // Strip the value and return it
         return preg_replace( '/\s+/',
                              '',
                              $value );
      }

   }
<?php

   namespace Grayl\Input\Form\Service;

   use Grayl\Input\Form\Entity\FormFieldData;
   use Grayl\Input\Form\Entity\FormFieldValidation;

   /**
    * Class FormFieldValidationService
    * The service for validating form fields
    *
    * @package Grayl\Input\Form
    */
   class FormFieldValidationService
   {

      /**
       * Validates a form field's sanitized value
       *
       * @param mixed               $sanitized_value The sanitized value of the form field
       * @param FormFieldData       $form_field      A FormFieldData instance to work with
       * @param FormFieldValidation $validation      A FormFieldValidation instance to work with
       *
       * @return bool
       */
      public function isFormFieldValid ( $sanitized_value,
                                         FormFieldData $form_field,
                                         FormFieldValidation $validation ): bool
      {

         // If the field is empty and a value is not required, return true
         if ( empty( $sanitized_value ) && ! $validation->isRequired() ) {
            // Empty value was allowed
            return true;
         }

         // Validate the value based on the field type
         switch ( $form_field->getType() ) {
            // String
            case 'string':
               return $this->validateString( $sanitized_value,
                                             $validation->getMinimum(),
                                             $validation->getMaximum() );
               break;

            // Boolean
            case 'boolean':
               return $this->validateBoolean( $sanitized_value );
               break;

            // Integer
            case 'integer':
               return $this->validateInteger( $sanitized_value,
                                              $validation->getMinimum(),
                                              $validation->getMaximum() );
               break;

            // Regular expression
            case 'regular_expression':
               return $this->validateRegularExpression( $sanitized_value,
                                                        $validation->getRegularExpression() );
               break;

            // Email
            case 'email_address':
               return $this->validateEmailAddress( $sanitized_value );
               break;
         }

         // Invalid
         return false;
      }


      /**
       * Validates a string value
       *
       * @param string $string  A string to validate
       * @param ?int   $minimum The minimum string length (optional)
       * @param ?int   $maximum The maximum string length (optional)
       *
       * @return bool
       */
      public function validateString ( string $string,
                                       ?int $minimum,
                                       ?int $maximum ): bool
      {

         // If the string is not empty and is valid
         if ( ! empty( $string ) && ( is_string( $string ) ) ) {
            // Check the minimum string length
            if ( $minimum > 0 && strlen( $string ) < $minimum ) {
               // Not long enough
               return false;
            } // Check maximum string length
            elseif ( $maximum > 0 && strlen( $string ) > $maximum ) {
               // Too long
               return false;
            }

            // Valid string
            return true;
         }

         // Invalid string
         return false;
      }


      /**
       * Validates a boolean value
       *
       * @param string $value A value to validate as boolean
       *
       * @return bool
       */
      public function validateBoolean ( $value ): bool
      {

         // For a boolean, we need to make sure that the value is not null
         if ( filter_var( $value,
                          FILTER_VALIDATE_BOOLEAN,
                          FILTER_NULL_ON_FAILURE ) !== null ) {
            // Acceptable boolean value
            return true;
         }

         // Invalid boolean
         return false;
      }


      /**
       * Validates an integer value
       *
       * @param string $integer An integer to validate
       * @param ?int   $minimum The minimum number range (optional)
       * @param ?int   $maximum The maximum number range (optional)
       *
       * @return bool
       */
      public function validateInteger ( $integer,
                                        ?int $minimum,
                                        ?int $maximum ): bool
      {

         // Create an array of options for the validation call
         $options = [];

         // Set the minimum range
         if ( $minimum > 0 ) {
            $options[ 'min_range' ] = $minimum;
         }

         // Set the maximum range
         if ( $maximum > 0 ) {
            $options[ 'max_range' ] = $maximum;
         }

         // If it is not empty and is valid
         if ( ! empty( $integer ) && ( filter_var( $integer,
                                                   FILTER_VALIDATE_INT,
                                                   [ "options" => $options ] ) ) ) {
            // Valid integer
            return true;
         }

         // Invalid integer
         return false;
      }


      /**
       * Validates a value against a regular expression
       *
       * @param string $value              A value to check against the regular expression
       * @param string $regular_expression The regular expression to use for validation
       *
       * @return bool
       */
      public function validateRegularExpression ( string $value,
                                                  string $regular_expression ): bool
      {

         // Create the options array to use for validation
         $options = [ "options" => [ "regexp" => $regular_expression ] ];

         // If it is not empty and is valid
         if ( ! empty( $value ) && ( filter_var( $value,
                                                 FILTER_VALIDATE_REGEXP,
                                                 $options ) ) ) {
            // Valid against the regular expression
            return true;
         }

         // Not valid
         return false;
      }


      /**
       * Validates an email address value
       *
       * @param string $email_address An email address to validate
       *
       * @return bool
       */
      public function validateEmailAddress ( string $email_address ): bool
      {

         // If it is not empty and is valid
         if ( ! empty( $email_address ) && ( filter_var( $email_address,
                                                         FILTER_VALIDATE_EMAIL ) ) ) {
            // Valid email
            return true;
         }

         // Invalid email
         return false;
      }

   }
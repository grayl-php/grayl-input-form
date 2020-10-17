<?php

   namespace Grayl\Input\Form\Entity;

   /**
    * Class FormFieldValidation
    * The entity for a form field validation
    *
    * @package Grayl\Input\Form
    */
   class FormFieldValidation
   {

      /**
       * If a value is required for this field
       *
       * @var bool
       */
      private bool $required;

      /**
       * The minimum value of this field (can be length for string or number for numeric)
       *
       * @var ?int
       */
      private ?int $minimum;

      /**
       * The maximum value of this field (can be length for string or number for numeric)
       *
       * @var ?int
       */
      private ?int $maximum;

      /**
       * A regular expression to validate against
       *
       * @var ?string
       */
      private ?string $regular_expression;


      /**
       * The class constructor
       *
       * @param bool    $required           If a value is required for this field
       * @param ?int    $minimum            The minimum number range (optional)
       * @param ?int    $maximum            The maximum number range (optional)
       * @param ?string $regular_expression A regular expression to use for validation
       */
      public function __construct ( bool $required,
                                    ?int $minimum,
                                    ?int $maximum,
                                    ?string $regular_expression )
      {

         // Set the class data
         $this->setRequired( $required );
         $this->setMinimum( $minimum );
         $this->setMaximum( $maximum );
         $this->setRegularExpression( $regular_expression );
      }


      /**
       * Returns the required value
       *
       * @return bool
       */
      public function isRequired (): bool
      {

         // Return the value
         return $this->required;
      }


      /**
       * Sets the required value
       *
       * @param bool $required If a value is required for this field
       */
      public function setRequired ( bool $required ): void
      {

         // Set the required value
         $this->required = $required;
      }


      /**
       * Returns the minimum
       *
       * @return ?int
       */
      public function getMinimum (): ?int
      {

         // Return the minimum
         return $this->minimum;
      }


      /**
       * Sets the minimum
       *
       * @param ?int $minimum The minimum value of this field (can be length for string or number for numeric)
       */
      public function setMinimum ( ?int $minimum ): void
      {

         // Set the minimum
         $this->minimum = $minimum;
      }


      /**
       * Returns the maximum
       *
       * @return ?int
       */
      public function getMaximum (): ?int
      {

         // Return the maximum
         return $this->maximum;
      }


      /**
       * Sets the maximum
       *
       * @param ?int $maximum The maximum value of this field (can be length for string or number for numeric)
       */
      public function setMaximum ( ?int $maximum ): void
      {

         // Set the maximum
         $this->maximum = $maximum;
      }


      /**
       * Returns the regular expression
       *
       * @return ?string
       */
      public function getRegularExpression (): ?string
      {

         // Return the regular expression
         return $this->regular_expression;
      }


      /**
       * Sets the regular expression
       *
       * @param ?string $regular_expression A regular expression to validate against
       */
      public function setRegularExpression ( ?string $regular_expression ): void
      {

         // Set the regular expression
         $this->regular_expression = $regular_expression;
      }

   }
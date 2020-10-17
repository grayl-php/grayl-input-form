<?php

   namespace Grayl\Input\Form\Entity;

   /**
    * Class FormFieldData
    * The entity for form field data
    *
    * @package Grayl\Input\Form
    */
   class FormFieldData
   {

      /**
       * The ID of the field
       *
       * @var string
       */
      private string $id;

      /**
       * The type of field (string, boolean, integer, regular_expression, email_address)
       *
       * @var string
       */
      private string $type;

      /**
       * The source of the field value ( post, get )
       *
       * @var string
       */
      private string $source;

      /**
       * Strip all whitespace characters from the field value before validating?
       *
       * @var bool
       */
      private bool $strip_whitespace;


      /**
       * The class constructor
       *
       * @param string $id               The ID of the field
       * @param string $type             The type of input (string, boolean, integer, regular_expression, email_address)
       * @param string $source           The source of the value ( post, get )
       * @param bool   $strip_whitespace Strip all whitespace characters from the field value before validating
       */
      public function __construct ( string $id,
                                    string $type,
                                    string $source,
                                    bool $strip_whitespace )
      {

         // Set the class data
         $this->setID( $id );
         $this->setType( $type );
         $this->setSource( $source );
         $this->setStripWhitespace( $strip_whitespace );
      }


      /**
       * Returns the ID
       *
       * @return string
       */
      public function getID (): string
      {

         // Return the ID
         return $this->id;
      }


      /**
       * Sets the ID
       *
       * @param string $id The ID of the field
       */
      public function setID ( string $id ): void
      {

         // Set the ID
         $this->id = $id;
      }


      /**
       * Return the type
       *
       * @return string
       */
      public function getType (): string
      {

         // Return the type
         return $this->type;
      }


      /**
       * Sets the type
       *
       * @param string $type The type of field (string, boolean, integer, regular_expression, email_address)
       */
      public function setType ( string $type ): void
      {

         // Set the type
         $this->type = $type;
      }


      /**
       * Returns the source
       *
       * @return string
       */
      public function getSource (): string
      {

         // Return the source
         return $this->source;
      }


      /**
       * Sets the source
       *
       * @param string $source The source of the value ( post, get )
       */
      public function setSource ( string $source ): void
      {

         // Set the source
         $this->source = strtolower( $source );
      }


      /**
       * Returns the strip whitespace value
       *
       * @return bool
       */
      public function doStripWhitespace (): bool
      {

         // Return the strip whitespace value
         return $this->strip_whitespace;
      }


      /**
       * Sets the strip whitespace value
       *
       * @param bool $strip_whitespace Strip all whitespace characters from the field value before validating
       */
      public function setStripWhitespace ( bool $strip_whitespace ): void
      {

         // Set the strip whitespace value
         $this->strip_whitespace = $strip_whitespace;
      }

   }
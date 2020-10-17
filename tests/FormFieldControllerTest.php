<?php

   namespace Grayl\Test\Input\Form;

   use Grayl\Input\Form\Controller\FormFieldController;
   use Grayl\Input\Form\FormPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Form package
    *
    * @package Grayl\Input\Form
    */
   class FormFieldControllerTest extends TestCase
   {

      /**
       * Tests the creation of a string FormFieldController
       *
       * @return FormFieldController
       */
      public function testCreateStringFormFieldController (): FormFieldController
      {

         // Create a unique ID
         $id = "string_" . $this->generateHash( 3 );

         // Populate a fake value in GET
         $_GET[ $id ] = 'TEST STRING';

         // Create a new form field
         $field = FormPorter::getInstance()
                            ->newStringFormField( $id,
                                                  'get',
                                                  false,
                                                  true,
                                                  $minimum = 5,
                                                  $maximum = 20 );

         // Check the type of object returned
         $this->assertInstanceOf( FormFieldController::class,
                                  $field );

         // Return it
         return $field;
      }


      /**
       * Tests the data from a string FormFieldController
       *
       * @param FormFieldController $field A FormFieldController entity to test
       *
       * @depends testCreateStringFormFieldController
       */
      public function testStringFormFieldControllerData ( FormFieldController $field ): void
      {

         // Perform some checks on the value
         $this->assertNotEmpty( $field->getSanitizedFormFieldValue() );
         $this->assertEquals( 'TEST STRING',
                              $field->getSanitizedFormFieldValue() );

         // Run the field validation routine
         $this->assertTrue( $field->isFormFieldValid() );
      }


      /**
       * Tests the creation of a boolean FormFieldController
       *
       * @return FormFieldController
       */
      public function testCreateBooleanFormFieldController (): FormFieldController
      {

         // Create a unique ID
         $id = "boolean_" . $this->generateHash( 3 );

         // Populate a fake value in POST
         $_POST[ $id ] = 'no';

         // Create a new form field
         $field = FormPorter::getInstance()
                            ->newBooleanFormField( $id,
                                                   'post',
                                                   true );

         // Check the type of object returned
         $this->assertInstanceOf( FormFieldController::class,
                                  $field );

         // Return it
         return $field;
      }


      /**
       * Tests the data from a boolean FormFieldController
       *
       * @param FormFieldController $field A FormFieldController entity to test
       *
       * @depends testCreateBooleanFormFieldController
       */
      public function testBooleanFormFieldControllerData ( FormFieldController $field ): void
      {

         // Perform some checks on the value
         $this->assertEquals( 'no',
                              $field->getSanitizedFormFieldValue() );

         // Run the field verification
         $this->assertTrue( $field->isFormFieldValid() );
      }


      /**
       * Tests the creation of a integer FormFieldController
       *
       * @return FormFieldController
       */
      public function testCreateIntegerFormFieldController (): FormFieldController
      {

         // Create a unique ID
         $id = "integer_" . $this->generateHash( 3 );

         // Populate a fake value in GET
         $_GET[ $id ] = 11;

         // Get a new form field
         $field = FormPorter::getInstance()
                            ->newIntegerFormField( $id,
                                                   'get',
                                                   true,
                                                   2,
                                                   11 );

         // Check the type of object returned
         $this->assertInstanceOf( FormFieldController::class,
                                  $field );

         // Return it
         return $field;
      }


      /**
       * Tests the data from a integer FormFieldController
       *
       * @param FormFieldController $field A FormFieldController entity to test
       *
       * @depends testCreateIntegerFormFieldController
       */
      public function testIntegerFormFieldControllerData ( FormFieldController $field ): void
      {

         // Perform some checks on the value
         $this->assertEquals( 11,
                              $field->getSanitizedFormFieldValue() );

         // Run the field verification
         $this->assertTrue( $field->isFormFieldValid() );
      }


      /**
       * Tests the creation of a regular expression FormFieldController
       *
       * @return FormFieldController
       */
      public function testCreateRegularExpressionFormFieldController (): FormFieldController
      {

         // Create a unique ID
         $id = "regexp_" . $this->generateHash( 3 );

         // Populate a fake value in POST
         $_POST[ $id ] = 'testing123';

         // Create a new form field
         $field = FormPorter::getInstance()
                            ->newRegularExpressionFormField( $id,
                                                             'post',
                                                             true,
                                                             '/^[a-zA-Z\d]+$/' );

         // Check the type of object returned
         $this->assertInstanceOf( FormFieldController::class,
                                  $field );

         // Return it
         return $field;
      }


      /**
       * Tests the data from a regular expression FormFieldController
       *
       * @param FormFieldController $field A FormFieldController entity to test
       *
       * @depends testCreateRegularExpressionFormFieldController
       */
      public function testRegularExpressionFormFieldControllerData ( FormFieldController $field ): void
      {

         // Perform some checks on the value
         $this->assertEquals( 'testing123',
                              $field->getSanitizedFormFieldValue() );

         // Run the field verification
         $this->assertTrue( $field->isFormFieldValid() );
      }


      /**
       * Tests the creation of an email address FormFieldController
       *
       * @return FormFieldController
       */
      public function testCreateEmailAddressFormFieldController (): FormFieldController
      {

         // Create a unique ID
         $id = "email_address_" . $this->generateHash( 3 );

         // Populate a fake value in GET
         $_GET[ $id ] = 'test@test.com';

         // Create a new form field
         $field = FormPorter::getInstance()
                            ->newEmailAddressFormField( $id,
                                                        'get',
                                                        true );

         // Check the type of object returned
         $this->assertInstanceOf( FormFieldController::class,
                                  $field );

         // Return it
         return $field;
      }


      /**
       * Tests the data from an email address FormFieldController
       *
       * @param FormFieldController $field A FormFieldController entity to test
       *
       * @depends testCreateEmailAddressFormFieldController
       */
      public function testEmailAddressFormFieldControllerData ( FormFieldController $field ): void
      {

         // Perform some checks on the value
         $this->assertEquals( 'test@test.com',
                              $field->getSanitizedFormFieldValue() );

         // Run the field verification
         $this->assertTrue( $field->isFormFieldValid() );
      }


      /**
       * Generates a unique testing hash
       *
       * @param int $length The length of the hash
       *
       * @return string
       */
      private function generateHash ( int $length ): string
      {

         // Generate a random string
         $hash = openssl_random_pseudo_bytes( $length );

         // Convert the binary data into hexadecimal representation and return it
         $hash = strtoupper( bin2hex( $hash ) );

         // Trim to length and return
         return substr( $hash,
                        0,
                        $length );
      }

   }

<?php

   namespace Grayl\Test\Input\Form;

   use Grayl\Input\Form\Controller\FormController;
   use Grayl\Input\Form\Controller\FormFieldController;
   use Grayl\Input\Form\FormPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the Form package
    *
    * @package Grayl\Input\Form
    */
   class FormControllerTest extends TestCase
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
       * Tests the creation of a FormController object
       *
       * @param FormFieldController $string_field A populated string FormFieldController
       * @param FormFieldController $email_field  A populated email FormFieldController
       *
       * @return FormController
       * @depends testCreateStringFormFieldController
       * @depends testCreateEmailAddressFormFieldController
       */
      public function testCreateFormController ( FormFieldController $string_field,
                                                 FormFieldController $email_field ): FormController
      {

         // Get a new FormController
         $form = FormPorter::getInstance()
                           ->newFormController();

         // Check the type of object returned
         $this->assertInstanceOf( FormController::class,
                                  $form );

         // Add a string test field
         $form->putFormField( $string_field );

         // Add an email test field
         $form->putFormField( $email_field );

         // Return it
         return $form;
      }


      /**
       * Tests the data from a FormController
       *
       * @param FormController $form A FormController entity to test
       *
       * @depends testCreateFormController
       */
      public function testFormControllerData ( FormController $form ): void
      {

         // Perform some checks on the bag contents
         $this->assertEquals( 2,
                              count( $form->getFormFields() ) );

         // Run the field validation
         $this->assertTrue( $form->isFormValid() );
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

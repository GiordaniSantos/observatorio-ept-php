<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/contact');
    }

    public function checkContact(FunctionalTester $I)
    {
        $I->see('Contact', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contact', 'h1');
        $I->seeValidationError('Name não pode ser branco');
        $I->seeValidationError('Email não pode ser branco');
        $I->seeValidationError('Subject não pode ser branco');
        $I->seeValidationError('Body não pode ser branco');
        $I->seeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeValidationError('Email is not a valid email address.');
        $I->dontSeeValidationError('Name não pode ser branco');
        $I->dontSeeValidationError('Subject não pode ser branco');
        $I->dontSeeValidationError('Body não pode ser branco');
        $I->dontSeeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}

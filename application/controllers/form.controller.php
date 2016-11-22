<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class FormController extends \F3il\Controller {

    public function formAction() {
        $page = \F3il\Page::getInstance();
        $page->setTemplate("template-bt")->setView("form");
        $form = new TestForm();
        $page->form = $form;
    }

}

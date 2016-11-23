<?php

namespace Sistr;

defined('SISTR') or die("Accès interdit");

class FormController extends \F3il\Controller {

    public function formAction() {
        $page = \F3il\Page::getInstance();
        $page->setTemplate("template-bt")->setView("form");
        $form = new TestForm("?controller=form&action=form");        
        $page->form = $form;
        $form->loadData(INPUT_POST);
    }

}

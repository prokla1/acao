<?php

class Application_Form_Entrar extends Zend_Form
{

    public function init()
    {
        $this->setName('form_login');
        $this->setAttrib('id', 'form_login');
        $this->setAction('/usuario/entrar');
        $this->setMethod('post');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty', false, array('messages' => 'Insira o email') )//->getValidator('NotEmpty')->setMessage('Insira o email')
              ->addValidator('EmailAddress', false, array('messages' => 'Insira um email válido'))//->getValidator('EmailAddress')->setMessage('Insira um email válido')
        ;
        		//->setDescription('Insira seu email cadastrado.');
              

        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty', false, array('messages' => 'Insira a senha') )
        ;

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Logar')
               ->setAttrib('id', 'submitbutton');

        $this->addElements(array($email, $senha, $submit));
    }


}


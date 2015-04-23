<?php

namespace TwigExtensions;

class Form extends \Twig_Extension
{
    private $environment;

    public function __construct()
    {

    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getName()
    {
        return 'formElements';
    }

    public function getFunctions()
    {
        return array(
            'formStatic'    => new \Twig_Function_Method($this, 'formStatic',   array('is_safe' => array('html'))),
            'formTextarea'  => new \Twig_Function_Method($this, 'formTextarea', array('is_safe' => array('html'))),
            'formText'      => new \Twig_Function_Method($this, 'formText',     array('is_safe' => array('html'))),
            'formEmail'     => new \Twig_Function_Method($this, 'formEmail',    array('is_safe' => array('html'))),
            'formPassword'  => new \Twig_Function_Method($this, 'formPassword', array('is_safe' => array('html'))),
            'formCheckbox'  => new \Twig_Function_Method($this, 'formCheckbox', array('is_safe' => array('html'))),
            'formDate'      => new \Twig_Function_Method($this, 'formDate',     array('is_safe' => array('html'))),
            'formSubmit'    => new \Twig_Function_Method($this, 'formSubmit',   array('is_safe' => array('html'))),

            'formStaticHorizontal'    => new \Twig_Function_Method($this, 'formStaticHorizontal',   array('is_safe' => array('html'))),
            'formTextareaHorizontal'  => new \Twig_Function_Method($this, 'formTextareaHorizontal', array('is_safe' => array('html'))),
            'formTextHorizontal'      => new \Twig_Function_Method($this, 'formTextHorizontal',     array('is_safe' => array('html'))),
            'formNumberHorizontal'    => new \Twig_Function_Method($this, 'formNumberHorizontal',   array('is_safe' => array('html'))),
            'formEmailHorizontal'     => new \Twig_Function_Method($this, 'formEmailHorizontal',    array('is_safe' => array('html'))),
            'formPasswordHorizontal'  => new \Twig_Function_Method($this, 'formPasswordHorizontal', array('is_safe' => array('html'))),
            'formCheckboxHorizontal'  => new \Twig_Function_Method($this, 'formCheckboxHorizontal', array('is_safe' => array('html'))),
            'formDateHorizontal'      => new \Twig_Function_Method($this, 'formDateHorizontal',     array('is_safe' => array('html'))),
            'formSelectHorizontal'    => new \Twig_Function_Method($this, 'formSelectHorizontal',   array('is_safe' => array('html'))),
            'formSubmitHorizontal'    => new \Twig_Function_Method($this, 'formSubmitHorizontal',   array('is_safe' => array('html'))),
        );
    }

    public function formStatic($class, $label, $value)
    {
        return $this->environment->render('form/formStatic.html.twig', array(
            'class' => $class,
            'label' => $label,
            'value' => $value,
        ));
    }

    public function formTextarea($class, $rows, $label, $name, $value, $error, $placeholder = false, $autofocus = false)
    {
        return $this->environment->render('form/formTextarea.html.twig', array(
            'class'       => $class,
            'rows'        => $rows,
            'label'       => $label,
            'name'        => $name,
            'value'       => $value,
            'error'       => $error,
            'placeholder' => $placeholder,
            'autofocus'   => $autofocus,
        ));
    }

    public function formText($class, $label, $name, $value, $error, $placeholder = '', $attributes = '', $autofocus = false)
    {
        return $this->environment->render('form/formText.html.twig', array(
            'class' => $class,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'placeholder' => $placeholder,
            'attributes' => $attributes,
            'autofocus' => $autofocus,
        ));
    }

    public function formEmail($class, $label, $name, $value, $error, $autofocus = false)
    {
        return $this->environment->render('form/formEmail.html.twig', array(
            'class' => $class,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'autofocus' => $autofocus,
        ));
    }

    public function formPassword($label,  $name, $value, $autofocus = false)
    {
        return $this->environment->render('form/formPassword.html.twig', array(
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'autofocus' => $autofocus,
        ));
    }

    public function formCheckbox($class, $label, $name, $checked = false, $autofocus = false)
    {
        return $this->environment->render('form/formCheckbox.html.twig', array(
            'class' => $class,
            'label' => $label,
            'name'  => $name,
            'checked' => $checked,
            'autofocus' => $autofocus,
        ));
    }

    public function formDate($label,  $name, $value = null, $autofocus = false)
    {
        return $this->environment->render('form/formDate.html.twig', array(
            'label' => $label,
            'name'  => $name,
            'value' => ($value) ? $value->format('Y-m-d') : '',
            'autofocus' => $autofocus,
        ));
    }

    public function formSubmit($value = '', $name = '', $disabled = false)
    {
        return $this->environment->render('form/formSubmit.html.twig', array(
            'value'     => $value,
            'name'      => $name,
            'disabled'  => $disabled,
        ));
    }

    ////

    public function formStaticHorizontal($class, $classLeft, $classRight, $label, $value)
    {
        return $this->environment->render('form/formStaticHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'value' => $value,
        ));
    }

    public function formTextHorizontal($class, $classLeft, $classRight, $label, $name, $value = '', $error = '', $placeholder = '', $attributes = '', $autofocus = false)
    {
        return $this->environment->render('form/formTextHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'placeholder' => $placeholder,
            'attributes' => $attributes,
            'autofocus' => $autofocus,
        ));
    }

    public function formTextareaHorizontal($class, $classLeft, $classRight, $rows, $label, $name, $value = '', $error = '', $placeholder = false, $autofocus = false)
    {
        return $this->environment->render('form/formTextareaHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'rows'        => $rows,
            'label'       => $label,
            'name'        => $name,
            'value'       => $value,
            'error'       => $error,
            'placeholder' => $placeholder,
            'autofocus'   => $autofocus,
        ));
    }

    public function formNumberHorizontal($class, $classLeft, $classRight, $label, $name, $value, $step, $pattern, $error, $autofocus = false)
    {
        return $this->environment->render('form/formNumberHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'pattern' => $pattern,
            'step'  => $step,
            'autofocus' => $autofocus,
        ));
    }

    public function formEmailHorizontal($class, $classLeft, $classRight, $label, $name, $value, $error, $autofocus = false)
    {
        return $this->environment->render('form/formEmailHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'autofocus' => $autofocus,
        ));
    }

    public function formPasswordHorizontal($class, $classLeft, $classRight, $label, $name, $value = '', $error = '', $placeholder = '', $attributes = '', $autofocus = false)
    {
        return $this->environment->render('form/formPasswordHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'value' => $value,
            'error' => $error,
            'placeholder' => $placeholder,
            'attributes' => $attributes,
            'autofocus' => $autofocus,
        ));
    }

    public function formCheckboxHorizontal($class, $classLeft, $classRight, $label, $name, $checked = false, $disabled = false)
    {
        return $this->environment->render('form/formCheckboxHorizontal.html.twig', array(
            'class' => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'checked' => $checked,
            'disabled' => $disabled,
        ));
    }

    public function formDateHorizontal($class, $classLeft, $classRight, $label, $name, $value = null, $error = '', $autofocus = false)
    {
        return $this->environment->render('form/formDateHorizontal.html.twig', array(
            'class'       => $class,
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'name'  => $name,
            'error'  => $error,
            'value' => ($value) ? $value->format('Y-m-d') : '',
            'autofocus' => $autofocus,
        ));
    }

    public function formSubmitHorizontal($classLeft, $classRight, $label, $name = '', $value = '', $disabled = false)
    {
        return $this->environment->render('form/formSubmitHorizontal.html.twig', array(
            'classLeft'     => $classLeft,
            'classRight'    => $classRight,
            'label'         => $label,
            'value'         => $value,
            'name'          => $name,
            'disabled'      => $disabled,
        ));
    }

    /*public function formSelectHorizontal($classLeft, $classRight, $label, $name, $value)
    {
        return $this->environment->render('form/formSubmitHorizontal.html.twig', array(
            'classLeft'   => $classLeft,
            'classRight'  => $classRight,
            'label' => $label,
            'value' => $value,
            'name' => $name,
        ));
    }*/
}
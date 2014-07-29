<?php

/* model.twig */
class __TwigTemplate_a8f7b3b973d1a8d22d9ece14cb72a934db525c6d307dc56970c4bca10fba863f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "class ";
        echo twig_escape_filter($this->env, (isset($context["entityNameWithUpperCamelCase"]) ? $context["entityNameWithUpperCamelCase"] : null), "html", null, true);
        echo " extends IlluminateDatabaseEloquentModel
{
    protected \$table = '";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["tableRef"]) ? $context["tableRef"] : null), "html", null, true);
        echo "';

    protected \$hidden = ['password', 'password_reset_hash', 'temp_password'];

    public function groups()
    {
        return \$this->belongsToMany('Group', 'users_groups', 'user_id', 'group_id');
    }
}";
    }

    public function getTemplateName()
    {
        return "model.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 3,  19 => 1,);
    }
}

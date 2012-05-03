<?php /* Smarty version Smarty-3.1.8, created on 2012-05-03 13:21:58
         compiled from "templates/combatantDescription.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18211206834fa27866612859-52956287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e44985d0717e246be5ff6bdfb016cac8647bd7d' => 
    array (
      0 => 'templates/combatantDescription.tpl',
      1 => 1336002930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18211206834fa27866612859-52956287',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name' => 0,
    'class' => 0,
    'health' => 0,
    'strength' => 0,
    'defence' => 0,
    'speed' => 0,
    'luck' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa278666d2023_14662229',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa278666d2023_14662229')) {function content_4fa278666d2023_14662229($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 is a <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
 with:
Health:   <?php echo $_smarty_tpl->tpl_vars['health']->value;?>

Strength: <?php echo $_smarty_tpl->tpl_vars['strength']->value;?>

Defence:  <?php echo $_smarty_tpl->tpl_vars['defence']->value;?>

Speed:    <?php echo $_smarty_tpl->tpl_vars['speed']->value;?>

Luck:     <?php echo $_smarty_tpl->tpl_vars['luck']->value;?>

<?php }} ?>